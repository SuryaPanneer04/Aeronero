<?php
require_once '../../../connect.php';
if (!headers_sent() && session_status() == PHP_SESSION_NONE) {
    session_start();
}

$updated_by = isset($_SESSION['userid']) ? $_SESSION['userid'] : NULL;

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$project_code = isset($_POST['project_code']) ? trim($_POST['project_code']) : '';
$project_name = isset($_POST['project_name']) ? trim($_POST['project_name']) : '';
$project_lead = isset($_POST['project_lead']) ? trim($_POST['project_lead']) : '';
$resources = [];
if (!empty($_POST['resource_used'])) {
    if (is_array($_POST['resource_used'])) {
        $resources = $_POST['resource_used'];
    } else {
        $resources[] = $_POST['resource_used'];
    }
}
if (!empty($_POST['additional_resources'])) {
    $resources[] = trim($_POST['additional_resources']);
}
$resource_used = implode(', ', array_map('trim', array_filter($resources)));
$collab_id = !empty($_POST['collab_id']) ? intval($_POST['collab_id']) : NULL;
$deadline = !empty($_POST['deadline']) ? $_POST['deadline'] : NULL;
$status = isset($_POST['status']) ? trim($_POST['status']) : 'Planned';

if(empty($id) || empty($project_code) || empty($project_name)) {
    echo "Error: Missing required fields.";
    exit;
}

$upload_dir = 'uploads/';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Check if a new file was uploaded
if(!empty($_FILES['report_file']['name'])) {
    $report_file_name = time() . "_report_" . preg_replace("/[^a-zA-Z0-9._-]/", "_", basename($_FILES['report_file']['name']));
    move_uploaded_file($_FILES['report_file']['tmp_name'], $upload_dir . $report_file_name);
    
    $stmt = $con->prepare("UPDATE z_projects SET project_code = ?, project_name = ?, project_lead = ?, resource_used = ?, collab_id = ?, deadline = ?, report_file = ?, status = ?, updated_by = ? WHERE id = ?");
    $res = $stmt->execute([
        $project_code,
        $project_name,
        $project_lead,
        $resource_used,
        $collab_id,
        $deadline,
        $report_file_name,
        $status,
        $updated_by,
        $id
    ]);
} else {
    $stmt = $con->prepare("UPDATE z_projects SET project_code = ?, project_name = ?, project_lead = ?, resource_used = ?, collab_id = ?, deadline = ?, status = ?, updated_by = ? WHERE id = ?");
    $res = $stmt->execute([
        $project_code,
        $project_name,
        $project_lead,
        $resource_used,
        $collab_id,
        $deadline,
        $status,
        $updated_by,
        $id
    ]);
}

if($res) {
    echo "Project Updated Successfully!";
} else {
    echo "Error: Failed to update project.";
}
