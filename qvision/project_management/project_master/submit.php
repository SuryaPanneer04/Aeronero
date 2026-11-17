<?php
require '../../../connect.php';
session_start();

$project_name = $_POST['project_name'];
$project_code = $_POST['project_code'];
$country = $_POST['country'];
$assigner_id = $_SESSION['userid'] ?? '1'; 

$sql = "INSERT INTO y_project_details (project_name, project_code, country, assigner_id) VALUES (:project_name, :project_code, :country, :assigner_id)";
$stmt = $con->prepare($sql);
$stmt->execute([
    ':project_name' => $project_name,
    ':project_code' => $project_code,
    ':country' => $country,
    ':assigner_id' => $assigner_id
]);

echo "Success";
?>
