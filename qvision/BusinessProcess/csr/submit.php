<?php
require_once '../../../connect.php';
if (!headers_sent() && session_status() == PHP_SESSION_NONE) {
    session_start();
}

$created_by = isset($_SESSION['userid']) ? $_SESSION['userid'] : NULL;

$project_id_input = isset($_POST['project_id']) ? $_POST['project_id'] : '';
$custom_project_name = isset($_POST['custom_project_name']) ? trim($_POST['custom_project_name']) : '';
$project_name = isset($_POST['project_name']) ? trim($_POST['project_name']) : '';

$final_project_id = NULL;
$final_project_name = '';

if ($project_id_input === 'custom') {
    $final_project_name = $custom_project_name;
} else if (!empty($project_id_input)) {
    $final_project_id = intval($project_id_input);
    // Fetch project name from y_project_details if not provided
    if (empty($project_name)) {
        $st = $con->prepare("SELECT project_name FROM y_project_details WHERE project_id = ?");
        $st->execute([$final_project_id]);
        $final_project_name = $st->fetchColumn() ?: 'Project #' . $final_project_id;
    } else {
        $final_project_name = $project_name;
    }
}

if (empty($final_project_name)) {
    echo "Error: Project is required.";
    exit;
}

$installation_status = isset($_POST['installation_status']) ? trim($_POST['installation_status']) : 'Installation Pending';
$condition_status = isset($_POST['condition_status']) ? trim($_POST['condition_status']) : 'Working';
$visits_completed = isset($_POST['visits_completed']) ? intval($_POST['visits_completed']) : 0;
$next_visit_planned = !empty($_POST['next_visit_planned']) ? $_POST['next_visit_planned'] : NULL;
$assigned_team = isset($_POST['assigned_team']) ? trim($_POST['assigned_team']) : '';
$remarks = isset($_POST['remarks']) ? trim($_POST['remarks']) : '';

$upload_dir = 'uploads/';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

$impact_report_file = NULL;
if (!empty($_FILES['impact_report']['name'])) {
    $impact_report_file = time() . "_impact_" . preg_replace("/[^a-zA-Z0-9._-]/", "_", basename($_FILES['impact_report']['name']));
    move_uploaded_file($_FILES['impact_report']['tmp_name'], $upload_dir . $impact_report_file);
}

$stmt = $con->prepare("INSERT INTO z_csr (project_id, project_name, installation_status, condition_status, impact_report, visits_completed, next_visit_planned, assigned_team, remarks, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$res = $stmt->execute([
    $final_project_id,
    $final_project_name,
    $installation_status,
    $condition_status,
    $impact_report_file,
    $visits_completed,
    $next_visit_planned,
    $assigned_team,
    $remarks,
    $created_by
]);

if ($res) {
    echo "CSR Record Saved Successfully!";
} else {
    echo "Error: Failed to save CSR record.";
}
