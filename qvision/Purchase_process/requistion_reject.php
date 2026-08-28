<?php
require '../../connect.php';
require '../../user.php';
$candidateid = $_SESSION['candidateid'];

$id    = $_REQUEST['id'];
$remark=$_REQUEST['remark'];

$update= $con->query("Update purchase_requistion_entry set req_status='3',approved_by='$candidateid',remarks='$remark' where id='$id'");
echo '<script>alert("Rejected successfully..")</script>';
?>