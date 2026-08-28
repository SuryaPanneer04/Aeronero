<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid = $_SESSION['candidate_id'];

$po_id    = $_REQUEST['id'];
$remark=$_REQUEST['remark'];

$update= $con->query("Update purchase_vendor_master set finance_status='2',finance_approved_by='$candidateid',finance_remarks='$remark' where id='$po_id'");
echo "Update purchase_vendor_master set finance_status='2',finance_approved_by='$candidateid',finance_remarks='$remark' where id='$po_id'";
?>