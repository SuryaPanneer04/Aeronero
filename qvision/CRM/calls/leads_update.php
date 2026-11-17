
<?php
require '../../../connect.php';
include("../../../user.php");

header('Content-Type: application/json');

function sendLeadUpdateResult($status, $message) {
    echo json_encode([
        'status' => $status,
        'message' => $message
    ]);
    exit;
}

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendLeadUpdateResult(0, 'Invalid request method.');
    }

    if (empty($_SESSION['userid'])) {
        sendLeadUpdateResult(0, 'Your session has expired. Please log in again.');
    }

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $sourceId = filter_input(INPUT_POST, 'Call_type', FILTER_VALIDATE_INT);

    if (!$id) {
        sendLeadUpdateResult(0, 'Invalid Lead ID.');
    }

    if (!$sourceId) {
        sendLeadUpdateResult(0, 'Please select a Call Source.');
    }

    // Confirm that this lead exists.
    $checkLead = $con->prepare(
        "SELECT id FROM crm_leads WHERE id = :id LIMIT 1"
    );
    $checkLead->execute(['id' => $id]);

    if (!$checkLead->fetch(PDO::FETCH_ASSOC)) {
        sendLeadUpdateResult(0, 'Lead not found.');
    }

    // Confirm that the selected source is active.
    $checkSource = $con->prepare(
        "SELECT id FROM lead_sources
         WHERE id = :source_id AND status = 1 LIMIT 1"
    );
    $checkSource->execute(['source_id' => $sourceId]);

    if (!$checkSource->fetch(PDO::FETCH_ASSOC)) {
        sendLeadUpdateResult(0, 'The selected Call Source is invalid.');
    }

    $company = trim($_POST['client_org1'] ?? '');
    $clientName = trim($_POST['client_name'] ?? '');
    $contact = trim($_POST['contact'] ?? '');
    $whatsapp = trim($_POST['whatsapp'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $alternativeEmail = trim($_POST['mail'] ?? '');
    $website = trim($_POST['website'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $productService = trim($_POST['Product'] ?? '');
    $remarks = trim($_POST['remarks'] ?? '');

    $update = $con->prepare("
        UPDATE crm_leads
        SET
            client_org = :client_org,
            client_name = :client_name,
            contact = :contact,
            whatsapp = :whatsapp,
            email = :email,
            alternative_email = :alternative_email,
            website = :website,
            address = :address,
            call_source = :call_source,
            product_service = :product_service,
            remarks = :remarks
        WHERE id = :id
    ");

    $update->execute([
        'client_org' => $company,
        'client_name' => $clientName,
        'contact' => $contact,
        'whatsapp' => $whatsapp,
        'email' => $email,
        'alternative_email' => $alternativeEmail,
        'website' => $website,
        'address' => $address,
        'call_source' => $sourceId,
        'product_service' => $productService,
        'remarks' => $remarks,
        'id' => $id
    ]);

    sendLeadUpdateResult(1, 'Lead updated successfully.');

} catch (Throwable $e) {
    error_log('Lead update error: ' . $e->getMessage());
    sendLeadUpdateResult(0, 'Unable to update lead. Check the server error log.');
}
