<?php
require '../../connect.php';

$code = $_POST['code'];
$role_name = $_POST['role_name'];
$status = $_POST['status'];
$created_on = date('Y-m-d');
$created_by = '1';

if(isset($code) && $code != '') {
    $stmt = $con->prepare("INSERT INTO z_role_master (code, role_name, status, created_on, created_by) VALUES (:code, :role_name, :status, :created_on, :created_by)");
    $stmt->bindParam(':code', $code);
    $stmt->bindParam(':role_name', $role_name);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':created_on', $created_on);
    $stmt->bindParam(':created_by', $created_by);
    $stmt->execute();
}
?>
