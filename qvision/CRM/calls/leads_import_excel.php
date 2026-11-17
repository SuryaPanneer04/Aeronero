<?php
ob_start();
ini_set('display_errors', 0);
error_reporting(E_ALL);
set_time_limit(0); // Required so 3,673 rows don't hit XAMPP's 30-second timeout
ini_set('memory_limit', '512M');

require '../../../connect.php';
include("../../../user.php");

function outputResult($status, $message) {
    if (ob_get_length()) {
        ob_clean();
    }
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['status' => $status, 'message' => $message]);
    exit;
}

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        outputResult(0, 'Invalid request method.');
    }

    $userId = $_SESSION['userid'] ?? null;
    $candidateId = $_SESSION['candidateid'] ?? '';

    if (!$userId) {
        outputResult(0, 'Your session has expired. Please log in again.');
    }

    // Security check: Only allow the authorized user_id to import
    $allowed_import_userid = 4; 
    if ((int)$userId !== $allowed_import_userid) {
        outputResult(0, 'Unauthorized: You do not have permission to import leads.');
    }

    $rawInput = file_get_contents('php://input');
    $payload = json_decode($rawInput, true);
    $rows = $payload['rows'] ?? [];

    if (empty($rows) || !is_array($rows)) {
        outputResult(0, 'No valid rows found to import.');
    }

    // Tell PDO to use utf8mb4 so emojis and all languages insert cleanly
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->exec("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");

    // Fetch active lead sources for mapping
    $sourceMap = [];
    $sourceStmt = $con->query("SELECT id, LOWER(TRIM(name)) AS name FROM lead_sources WHERE status = 1");
    while ($sRow = $sourceStmt->fetch(PDO::FETCH_ASSOC)) {
        $sourceMap[$sRow['name']] = (int)$sRow['id'];
    }

    $con->beginTransaction();

    $leadStmt = $con->prepare("
        INSERT INTO crm_leads (
            client_org,
            client_name,
            client_id,
            ind_client_id,
            services,
            contact,
            whatsapp,
            email,
            alternative_email,
            address,
            website,
            call_type,
            call_source,
            client_type,
            product_service,
            remarks,
            employee,
            created_by,
            created_on,
            status
        ) VALUES (
            '',
            :client_name,
            NULL,
            :ind_client_id,
            :services,
            :contact,
            :whatsapp,
            :email,
            :alternative_email,
            :address,
            :website,
            :call_type,
            :call_source,
            :client_type,
            :product_service,
            :remarks,
            :employee,
            :created_by,
            NOW(),
            1
        )
    ");

    $feedbackStmt = $con->prepare("
        INSERT INTO crm_leads_feedback (
            lead_id,
            feedback,
            feedback_date,
            followup_date
        ) VALUES (
            :lead_id,
            :feedback,
            :feedback_date,
            :followup_date
        )
    ");

    $indStmt = $con->prepare("SELECT id FROM individual_form WHERE client_name = :cname LIMIT 1");

    $insertedCount = 0;

    foreach ($rows as $index => $row) {
        $rowNum = $index + 2;

        $contact = trim((string)($row['Contact Number'] ?? ''));
        $clientName = trim((string)($row['Client Name'] ?? ''));

        // Skip empty rows and the dummy header row at Row 2795 ('one_number')
        if (($contact === '' && $clientName === '') || strtolower($contact) === 'one_number') {
            continue;
        }

        if ($contact === '') {
            throw new RuntimeException("Row {$rowNum}: Contact Number is required.");
        }

        if (strpos($contact, '+') !== 0) {
            $contact = '+91-' . ltrim($contact, '0 -');
        }

        // Always Individual (call_type = '2')
        $callType = '2';

        $rawSource = strtolower(trim((string)($row['Call Source'] ?? '')));
        $sourceId = null;
        if ($rawSource !== '' && ctype_digit($rawSource) && in_array((int)$rawSource, $sourceMap, true)) {
            $sourceId = (int)$rawSource;
        } elseif (isset($sourceMap[$rawSource])) {
            $sourceId = $sourceMap[$rawSource];
        } else {
            $sourceId = !empty($sourceMap) ? reset($sourceMap) : 1;
        }

        // Client Type for Individual: 3 = New, 4 = Existing
        $rawClientType = strtolower(trim((string)($row['Client Type'] ?? 'new')));
        $individualClientId = 0;
        $clientType = '3'; // Default New

        if ($rawClientType === '4' || $rawClientType === 'existing') {
            $clientType = '4';
            $indStmt->execute(['cname' => $clientName]);
            $indRow = $indStmt->fetch(PDO::FETCH_ASSOC);
            if ($indRow) {
                $individualClientId = (int)$indRow['id'];
            }
        }

        $rawProduct = strtolower(trim((string)($row['Product/Service'] ?? '1')));
        $productService = ($rawProduct === '2' || strpos($rawProduct, 'service') === 0) ? '2' : '1';

        $whatsapp = trim((string)($row['Whatsapp Number'] ?? ''));
        $email = trim((string)($row['Email'] ?? ''));
        $altEmail = trim((string)($row['Alternative Email'] ?? ''));
        $address = trim((string)($row['Location'] ?? ''));
        $website = trim((string)($row['Website'] ?? ''));
        $remarks = trim((string)($row['Remarks'] ?? ''));

        $leadStmt->execute([
            'client_name'       => $clientName,
            'ind_client_id'     => $individualClientId,
            'services'          => 12,
            'contact'           => $contact,
            'whatsapp'          => $whatsapp,
            'email'             => $email,
            'alternative_email' => $altEmail,
            'address'           => $address,
            'website'           => $website,
            'call_type'         => $callType,
            'call_source'       => $sourceId,
            'client_type'       => $clientType,
            'product_service'   => $productService,
            'remarks'           => $remarks,
            'employee'          => $candidateId,
            'created_by'        => $userId
        ]);

        $newLeadId = (int)$con->lastInsertId();

        $initialFeedback = trim((string)($row['Initial Feedback'] ?? ''));
        if ($initialFeedback !== '') {
            $rawFbDate = trim((string)($row['Feedback Date'] ?? ''));
            $rawFollowupDate = trim((string)($row['Followup Date'] ?? ''));

            $fbTs = $rawFbDate !== '' ? strtotime(str_replace('/', '-', $rawFbDate)) : false;
            $fbDate = $fbTs ? date('Y-m-d', $fbTs) : date('Y-m-d');

            $followupTs = $rawFollowupDate !== '' ? strtotime(str_replace('/', '-', $rawFollowupDate)) : false;
            $followupDate = $followupTs ? date('Y-m-d', $followupTs) : null;

            $feedbackStmt->execute([
                'lead_id'       => $newLeadId,
                'feedback'      => $initialFeedback,
                'feedback_date' => $fbDate,
                'followup_date' => $followupDate
            ]);
        }

        $insertedCount++;
    }

    $con->commit();
    outputResult(1, "Successfully imported {$insertedCount} individual leads.");

} catch (Throwable $e) {
    if (isset($con) && $con instanceof PDO && $con->inTransaction()) {
        $con->rollBack();
    }
    error_log('Excel Individual Lead Import Error: ' . $e->getMessage());
    outputResult(0, 'Import Error (Row ' . ($rowNum ?? 'N/A') . '): ' . $e->getMessage());
}