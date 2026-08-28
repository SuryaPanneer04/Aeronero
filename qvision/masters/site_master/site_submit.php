<?php
require '../../../connect.php';

$site_name = $_POST['site_name'];
$status = isset($_POST['status']) ? $_POST['status'] : 1;
$created_on = date('Y-m-d');
$created_by = '1';

if(isset($site_name) && $site_name != '') {
    $stmt = $con->prepare("INSERT INTO site_master (site_name, status, created_on, created_by) VALUES (:site_name, :status, :created_on, :created_by)");
    $stmt->bindParam(':site_name', $site_name);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':created_on', $created_on);
    $stmt->bindParam(':created_by', $created_by);
    $stmt->execute();
}
?>
