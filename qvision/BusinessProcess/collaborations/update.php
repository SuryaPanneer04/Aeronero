<?php
require '../../../connect.php';

$id = $_POST['id'];
$collab_type = $_POST['collab_type'];
$collaborator_name = $_POST['collaborator_name'];
$nda_status = $_POST['nda_status'];
$nda_date = !empty($_POST['nda_date']) ? $_POST['nda_date'] : NULL;
$mou_status = $_POST['mou_status'];
$mou_date = !empty($_POST['mou_date']) ? $_POST['mou_date'] : NULL;
$work_description = $_POST['work_description'];
$next_steps = $_POST['next_steps'];
$status = $_POST['status'];

$upload_dir = 'uploads/';

// NDA File
$nda_file_name = isset($_POST['old_nda_file']) ? $_POST['old_nda_file'] : '';
if(!empty($_FILES['nda_file']['name'])) {
    $nda_file_name = time() . "_nda_" . basename($_FILES['nda_file']['name']);
    move_uploaded_file($_FILES['nda_file']['tmp_name'], $upload_dir . $nda_file_name);
}

// MoU File
$mou_file_name = isset($_POST['old_mou_file']) ? $_POST['old_mou_file'] : '';
if(!empty($_FILES['mou_file']['name'])) {
    $mou_file_name = time() . "_mou_" . basename($_FILES['mou_file']['name']);
    move_uploaded_file($_FILES['mou_file']['tmp_name'], $upload_dir . $mou_file_name);
}

// Results File
$results_file_name = isset($_POST['old_results_file']) ? $_POST['old_results_file'] : '';
if(!empty($_FILES['results_file']['name'])) {
    $results_file_name = time() . "_res_" . basename($_FILES['results_file']['name']);
    move_uploaded_file($_FILES['results_file']['tmp_name'], $upload_dir . $results_file_name);
}

$stmt = $con->prepare("UPDATE z_collaborations SET collab_type=?, collaborator_name=?, nda_status=?, nda_file=?, nda_date=?, mou_status=?, mou_file=?, mou_date=?, work_description=?, next_steps=?, results_file=?, status=? WHERE id=?");
$res = $stmt->execute([
    $collab_type, 
    $collaborator_name, 
    $nda_status, 
    $nda_file_name, 
    $nda_date, 
    $mou_status, 
    $mou_file_name, 
    $mou_date, 
    $work_description, 
    $next_steps, 
    $results_file_name, 
    $status,
    $id
]);

if($res) {
    echo "Successfully Updated!";
} else {
    echo "Error: Failed to update.";
}
?>
