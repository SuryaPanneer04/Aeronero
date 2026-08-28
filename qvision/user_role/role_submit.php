<?php
require '../../connect.php';

$user_id = $_POST['user_id'];
$code = $_POST['code'];
$descriptions = $_POST['descriptions'];
$created_on = date('Y-m-d');
$created_by = '1';

if(isset($user_id) && $user_id != '' && isset($code) && $code != '') {
    $stmt = $con->prepare("INSERT INTO z_role_mapping (user_id, code, descriptions, created_on, created_by, modified_on, modified_by) VALUES (:user_id, :code, :descriptions, :created_on, :created_by, :created_on, :created_by)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':code', $code);
    $stmt->bindParam(':descriptions', $descriptions);
    $stmt->bindParam(':created_on', $created_on);
    $stmt->bindParam(':created_by', $created_by);
    $stmt->execute();
}
?>
