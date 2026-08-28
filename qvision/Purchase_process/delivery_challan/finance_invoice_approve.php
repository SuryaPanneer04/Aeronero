<?php
//purchase_generate =  Initial status = 0,
//purchase_generate =  Request to finance Approve for invoice raising  status =1,
//purchase_generate =  finance Approve to invoice  status =2,
//purchase_generate =  finance Reject to invoice  status =3,

require '../../../connect.php';
require '../../../user.php';
$candidateid = $_SESSION['candidateid'];

$po_id    = $_REQUEST['id'];
$pur_invoice_id    = $_REQUEST['pur_invoice_id'];

$update= $con->query("Update purchase_generate set status='2' where id='$pur_invoice_id'");
echo "Update purchase_generate set status='2' where id='$pur_invoice_id'";
?>