
<?php
require '../../../connect.php';
include("../../../user.php");

header('Content-Type: application/json');

function outputResult($status, $message) {
    echo json_encode(['status' => $status, 'message' => $message]);
    exit;
}

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        outputResult(0, 'Invalid request method.');
    }

    $userId = $_SESSION['userid'] ?? null;
    $candidateId = $_SESSION['candidateid'] ?? null;

    if (!$userId) {
        outputResult(0, 'Your session has expired. Please log in again.');
    }

    $sourceId = filter_input(INPUT_POST, 'Call_type', FILTER_VALIDATE_INT);
    if (!$sourceId) {
        outputResult(0, 'Please select a Call Source.');
    }

    $sourceCheck = $con->prepare(
        "SELECT id FROM lead_sources WHERE id = :id AND status = 1"
    );
    $sourceCheck->execute(['id' => $sourceId]);

    if (!$sourceCheck->fetch(PDO::FETCH_ASSOC)) {
        outputResult(0, 'The selected Call Source is invalid.');
    }

    // Support the different company/client fields in the existing form.
    $company = trim($_POST['client_org1'] ?? '');

    if ($company === '' && !empty($_POST['client_orgg'])) {
        $companyValue = $_POST['client_orgg'];
        $parts = explode('-', $companyValue, 2);
        $company = trim($parts[1] ?? '');
    }

    $clientName = trim($_POST['client_name'] ?? '');

    if ($clientName === '') {
        $clientName = trim($_POST['client_org'] ?? '');
    }

    
$clientId = null;
$individualClientId = 0;
$services = (int)($_POST['services'] ?? 12);

// Existing corporate company: client_orgg contains "id-name".
if (($callType = trim($_POST['cust_type'] ?? '')) === '1'
    && trim($_POST['client_type'] ?? '') === '1') {

    $selectedCompany = trim($_POST['client_orgg'] ?? '');
    $parts = explode('-', $selectedCompany, 2);

    if (isset($parts[0]) && ctype_digit($parts[0])) {
        $clientId = (int)$parts[0];
    }
}

// Existing individual customer: resolve its database ID.
if ($callType === '2' && trim($_POST['client_type1'] ?? '') === '4') {
    $individualName = trim($_POST['client_org'] ?? '');

    $individualStmt = $con->prepare("
        SELECT id
        FROM individual_form
        WHERE client_name = :client_name
        LIMIT 1
    ");
    $individualStmt->execute(['client_name' => $individualName]);

    $individualRow = $individualStmt->fetch(PDO::FETCH_ASSOC);

    if ($individualRow) {
        $individualClientId = (int)$individualRow['id'];
    } else {
        throw new RuntimeException('Existing individual customer was not found.');
    }
}


    $contact = trim($_POST['contact'] ?? '');
    $whatsapp = trim($_POST['whatsapp'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $alternativeEmail = trim($_POST['mail'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $website = trim($_POST['website'] ?? '');
    $callType = trim($_POST['cust_type'] ?? '');
    $clientType = trim($_POST['client_type'] ?? '');

    if ($clientType === '') {
        $clientType = trim($_POST['client_type1'] ?? '');
    }

    $productService = trim($_POST['Product'] ?? '');
    $remarks = trim($_POST['remarks'] ?? '');

    if ($contact === '') {
        outputResult(0, 'Please enter the contact number.');
    }

    $con->beginTransaction();

    $stmt = $con->prepare("
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
            :client_org,
            :client_name,
            :client_id,
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

    $stmt->execute([
        'client_org' => $company,
        'client_name' => $clientName,
        'client_id' => $clientId,
        'ind_client_id' => $individualClientId,
        'services' => $services,
        'contact' => $contact,
        'whatsapp' => $whatsapp,
        'email' => $email,
        'alternative_email' => $alternativeEmail,
        'address' => $address,
        'website' => $website,
        'call_type' => $callType,
        'call_source' => $sourceId,
        'client_type' => $clientType,
        'product_service' => $productService,
        'remarks' => $remarks,
        'employee' => $candidateId,
        'created_by' => $userId
    ]);

    $leadId = (int)$con->lastInsertId();

    $feedbacks = $_POST['feedback1'] ?? [];
    $feedbackDates = $_POST['feedback_date1'] ?? [];
    $followupDates = $_POST['fed_date1'] ?? [];

    $feedbackStmt = $con->prepare("
        INSERT INTO crm_leads_feedback
            (lead_id, feedback, feedback_date, followup_date)
        VALUES
            (:lead_id, :feedback, :feedback_date, :followup_date)
    ");

    if (is_array($feedbacks)) {
        foreach ($feedbacks as $index => $feedbackText) {
            $feedbackText = trim((string)$feedbackText);

            if ($feedbackText === '') {
                continue;
            }

            $feedbackDate = $feedbackDates[$index] ?? date('Y-m-d');
            $followupDate = trim((string)($followupDates[$index] ?? ''));

            $feedbackStmt->execute([
                'lead_id' => $leadId,
                'feedback' => $feedbackText,
                'feedback_date' => $feedbackDate !== ''
                    ? str_replace('/', '-', $feedbackDate)
                    : date('Y-m-d'),
                'followup_date' => $followupDate !== ''
                    ? $followupDate
                    : null
            ]);
        }
    }

    $con->commit();

    outputResult(1, 'Lead added successfully.');
} catch (Throwable $e) {
    if ($con->inTransaction()) {
        $con->rollBack();
    }

    error_log('Lead save error: ' . $e->getMessage());
    outputResult(0, 'Unable to save the lead. Check the server error log.');
}
