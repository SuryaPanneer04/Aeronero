<?php
require '../../../connect.php';
include("../../../user.php");

$userid = $_SESSION['userid'];

$name   = $_POST['resource'];
$status = $_POST['status'];

$stmt = $con->prepare("INSERT INTO source_master (name, status, created_by, created_on) VALUES (?, ?, ?, NOW())");

if ($stmt->execute([$name, $status, $userid])) {
    echo 0; // success
} else {
    echo 1; // error
}
?>