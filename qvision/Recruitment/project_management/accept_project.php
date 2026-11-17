<?php
require '../../../connect.php';

$id = $_POST['id'];

$stmt = $con->prepare("UPDATE y_project_employees SET acceptance_status = 'Accepted' WHERE id = :id");
$stmt->execute([':id' => $id]);

echo "Success";
?>
