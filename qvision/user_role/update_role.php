<?php
require '../../connect.php';

$id = $_POST['id'];
$user_id = $_POST['user_id'];
$code = $_POST['code'];
$descriptions = $_POST['descriptions'];
$modified_on = date('Y-m-d');
$modified_by = '1';

if(isset($id) && $id != '') {
    $stmt = $con->prepare("UPDATE z_role_mapping SET user_id=:user_id, code=:code, descriptions=:descriptions, modified_on=:modified_on, modified_by=:modified_by WHERE id=:id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':code', $code);
    $stmt->bindParam(':descriptions', $descriptions);
    $stmt->bindParam(':modified_on', $modified_on);
    $stmt->bindParam(':modified_by', $modified_by);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}
?>
