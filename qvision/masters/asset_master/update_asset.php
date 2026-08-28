<?php
require '../../../connect.php';

$id = $_POST['id'];
$name = $_POST['name'];
$status = isset($_POST['status']) ? $_POST['status'] : 1;

if(isset($id) && $id != '') {
    $stmt = $con->prepare("UPDATE assets_master SET name=:name, status=:status WHERE id=:id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}
?>
