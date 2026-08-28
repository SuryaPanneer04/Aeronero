<?php
require '../../../connect.php';

$id = $_POST['id'];
$site_name = $_POST['site_name'];
$status = isset($_POST['status']) ? $_POST['status'] : 1;
$modified_on = date('Y-m-d');
$modified_by = '1';

if(isset($id) && $id != '') {
    $stmt = $con->prepare("UPDATE site_master SET site_name=:site_name, status=:status, modified_on=:modified_on, modified_by=:modified_by WHERE id=:id");
    $stmt->bindParam(':site_name', $site_name);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':modified_on', $modified_on);
    $stmt->bindParam(':modified_by', $modified_by);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}
?>
