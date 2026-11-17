
<?php
require '../../../connect.php';
include("../../../user.php");

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new RuntimeException('Invalid request method.');
    }

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if (!$id || $id < 1) {
        throw new RuntimeException('Invalid lead ID.');
    }

    $check = $con->prepare(
        "SELECT id FROM crm_leads WHERE id = :id"
    );
    $check->execute(['id' => $id]);

    if (!$check->fetch(PDO::FETCH_ASSOC)) {
        throw new RuntimeException('Lead not found.');
    }

    $delete = $con->prepare(
        "DELETE FROM crm_leads_feedback WHERE lead_id = :id"
    );
    $delete->execute(['id' => $id]);

    echo json_encode([
        'status' => 1,
        'message' => $delete->rowCount() > 0
            ? 'Lead feedback deleted successfully.'
            : 'No feedback records were found for this lead.'
    ]);
} catch (Throwable $e) {
    http_response_code(400);
    echo json_encode([
        'status' => 0,
        'message' => $e->getMessage()
    ]);
}
