<?php
require '../../../connect.php';
include("../../../user.php");

header('Content-Type: application/json');

function respond($status, $message, $extra = []) {
    echo json_encode(array_merge([
        'status' => $status,
        'message' => $message
    ], $extra));
    exit;
}

// Handle both bulk 'ids' (from Move Selected) and single 'id' (from row Move button)
$rawIds = $_POST['ids'] ?? $_GET['ids'] ?? null;
$isBulk = false;
$leadIds = [];

if ($rawIds !== null) {
    $isBulk = true;
    if (!is_array($rawIds)) {
        $rawIds = explode(',', (string)$rawIds);
    }
    foreach ($rawIds as $rawId) {
        $validId = filter_var($rawId, FILTER_VALIDATE_INT);
        if ($validId && $validId > 0) {
            $leadIds[] = (int)$validId;
        }
    }
    $leadIds = array_values(array_unique($leadIds));
} else {
    $singleId = filter_var($_POST['id'] ?? $_GET['id'] ?? '', FILTER_VALIDATE_INT);
    if ($singleId && $singleId > 0) {
        $leadIds[] = (int)$singleId;
    }
}

if (empty($leadIds)) {
    respond(0, 'Invalid lead ID.');
}

$userId = $_SESSION['userid'] ?? null;
$role_id = 'R018'; // Matches the default role used in calls_submit
$flag = 1; // Default flag for crm_calls

try {
    $con->beginTransaction();

    // Prepare statements once before the loop
    $stmt = $con->prepare("SELECT * FROM crm_leads WHERE id = :id FOR UPDATE");

    $sourceStmt = $con->prepare("
        SELECT cm.id
        FROM lead_sources ls
        INNER JOIN calls_master cm ON LOWER(TRIM(cm.name)) = LOWER(TRIM(ls.name))
        WHERE ls.id = :source_id LIMIT 1
    ");

    $feedbackStmt = $con->prepare("
        SELECT feedback, feedback_date, followup_date
        FROM crm_leads_feedback
        WHERE lead_id = :lead_id
        ORDER BY id DESC LIMIT 1
    ");

    $insertCall = $con->prepare("
        INSERT INTO crm_calls (
            cust_type, call_type, client_type, client_org, client_id, ind_client_id,
            client_name, role_id, contact, whatsapp, email, alternative_mail,
            address, Product, services, image, remarks,
            created_by, created_on, status, flag
        ) VALUES (
            :cust_type, :call_type, :client_type, :client_org, :client_id, :ind_client_id,
            :client_name, :role_id, :contact, :whatsapp, :email, :alternative_mail,
            :address, :product, :services, :image, :remarks,
            :created_by, NOW(), 1, :flag
        )
    ");

    $insertFeedback = $con->prepare("
        INSERT INTO crm_calls_feedback (
            calls_id, feedback, feedback_date, date, created_by, created_on
        ) VALUES (
            :calls_id, :feedback, :feedback_date, :followup_date, :created_by, NOW()
        )
    ");

    $update = $con->prepare("
        UPDATE crm_leads
        SET moved_to_enquiry = 1,
            enquiry_id = :call_id,
            moved_at = NOW(),
            status = 0
        WHERE id = :id
    ");

    $movedLeads = [];
    $skippedAlreadyMoved = 0;
    $skippedNotFound = 0;

    foreach ($leadIds as $leadId) {
        // 1. Fetch and lock the selected lead
        $stmt->execute(['id' => $leadId]);
        $lead = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$lead) {
            if (!$isBulk) {
                throw new RuntimeException('Lead not found.');
            }
            $skippedNotFound++;
            continue;
        }

        if ((int)$lead['moved_to_enquiry'] === 1) {
            if (!$isBulk) {
                throw new RuntimeException('This lead has already been moved.');
            }
            $skippedAlreadyMoved++;
            continue;
        }

        // 2. Map lead sources to calls_master if needed
        $sourceStmt->execute(['source_id' => $lead['call_source']]);
        $sourceId = $sourceStmt->fetchColumn() ?: $lead['call_source'];

        // 3. Get the latest lead feedback
        $feedbackStmt->execute(['lead_id' => $leadId]);
        $feedbackRow = $feedbackStmt->fetch(PDO::FETCH_ASSOC);

        // 4. Prepare data mapping for crm_calls
        $custType = $lead['call_type'] ?? '';
        $clientType = $lead['client_type'] ?? '';
        $companyName = trim((string)($lead['client_org'] ?? ''));
        $clientName = trim((string)($lead['client_name'] ?? ''));

        if ($custType == '2' && $companyName === '') {
            $companyName = 'Individual Customer';
        } elseif ($companyName === '') {
            $companyName = $clientName;
        }

        // 5. Insert into crm_calls table
        $insertCall->execute([
            'cust_type' => $custType,
            'call_type' => $sourceId,
            'client_type' => $clientType,
            'client_org' => $companyName,
            'client_id' => $lead['client_id'] ?? 0,
            'ind_client_id' => $lead['ind_client_id'] ?? 0,
            'client_name' => $clientName,
            'role_id' => $role_id,
            'contact' => $lead['contact'] ?? '',
            'whatsapp' => $lead['whatsapp'] ?? '',
            'email' => $lead['email'] ?? '',
            'alternative_mail' => $lead['alternative_email'] ?? '',
            'address' => $lead['address'] ?? '',
            'product' => $lead['product_service'] ?? '',
            'services' => $lead['services'] ?? 12,
            'image' => $lead['image'] ?? '',
            'remarks' => trim((string)($lead['remarks'] ?? '')),
            'created_by' => $userId ?? $lead['created_by'],
            'flag' => $flag
        ]);

        $callId = (int)$con->lastInsertId();

        // 6. Insert latest feedback into crm_calls_feedback
        if ($feedbackRow && !empty($feedbackRow['feedback'])) {
            $insertFeedback->execute([
                'calls_id' => $callId,
                'feedback' => $feedbackRow['feedback'],
                'feedback_date' => $feedbackRow['feedback_date'] ?? date('Y-m-d'),
                'followup_date' => $feedbackRow['followup_date'] ?? null,
                'created_by' => $userId ?? $lead['created_by']
            ]);
        }

        // 7. Mark the lead as moved
        $update->execute([
            'call_id' => $callId,
            'id' => $leadId
        ]);

        $movedLeads[] = [
            'lead_id' => $leadId,
            'call_id' => $callId
        ];
    }

    if (empty($movedLeads)) {
        $con->rollBack();
        if ($skippedAlreadyMoved > 0) {
            respond(0, 'Selected leads have already been moved.');
        }
        respond(0, 'No valid leads found to move.');
    }

    $con->commit();

    if (!$isBulk) {
        respond(1, 'Lead successfully moved to Calls List.', $movedLeads[0]);
    }

    $movedCount = count($movedLeads);
    $message = $movedCount . ' lead(s) successfully moved to Calls List.';
    if ($skippedAlreadyMoved > 0) {
        $message .= ' (' . $skippedAlreadyMoved . ' already moved and skipped.)';
    }

    respond(1, $message, [
        'moved_count' => $movedCount,
        'skipped_already_moved' => $skippedAlreadyMoved,
        'skipped_not_found' => $skippedNotFound,
        'moved' => $movedLeads
    ]);

} catch (Throwable $e) {
    if ($con->inTransaction()) {
        $con->rollBack();
    }
    respond(0, $e->getMessage());
}
?>