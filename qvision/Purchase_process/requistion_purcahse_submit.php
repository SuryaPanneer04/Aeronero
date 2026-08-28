<?php
require '../../connect.php';
require '../../user.php';
$candidateid = $_SESSION['candidateid'];

$id    = $_REQUEST['id'];

$update= $con->query("update purchase_requistion_entry set req_status='4',approved_by='$candidateid' where id='$id'");
echo '<script>alert("approved successfully..")</script>';
?>