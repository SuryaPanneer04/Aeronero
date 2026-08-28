<?php
require '../../../connect.php';

$name = $_POST['name'];
$status = isset($_POST['status']) ? $_POST['status'] : 1;

if(isset($name) && $name != '') {
    $stmt = $con->prepare("INSERT INTO assets_master (name, status) VALUES (:name, :status)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':status', $status);
    $stmt->execute();
}
?>
