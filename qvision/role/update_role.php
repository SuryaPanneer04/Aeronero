<?php
require '../../connect.php';

$id = $_POST['id'];
$code = $_POST['code'];
$role_name = $_POST['role_name'];
$status = $_POST['status'];

if(isset($id) && $id != '') {
    $stmt = $con->prepare("UPDATE z_role_master SET code=:code, role_name=:role_name, status=:status WHERE id=:id");
    $stmt->bindParam(':code', $code);
    $stmt->bindParam(':role_name', $role_name);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}
?>
