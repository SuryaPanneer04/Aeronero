<?php
//purchase_generate =  Initial status = 0,
//purchase_generate =  Request to finance Approve for invoice raising  status =1,
//purchase_generate =  finance Approve to invoice  status =2,
//purchase_generate =  finance Reject to invoice  status =3,

require '../../../connect.php';

$pur_invoice_id    = $_REQUEST['id'];
$remark=$_REQUEST['remark'];

$update= $con->query("Update purchase_generate set status='3' , invoice_reject_remark ='$remark' where id='$pur_invoice_id'");
echo "Update purchase_generate set status='3' , invoice_reject_remark ='$remark' where id='$pur_invoice_id'";
?>