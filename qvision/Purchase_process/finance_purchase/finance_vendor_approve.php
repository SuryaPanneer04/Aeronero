<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid = $_SESSION['candidateid'];

$po_id    = $_REQUEST['id'];

$update= $con->query("Update purchase_vendor_master set status='2',finance_status='1',finance_approved_by='$candidateid' where id='$po_id'");
echo "Update purchase_vendor_master set finance_status='1',finance_approved_by='$candidateid' where id='$po_id'";
?>