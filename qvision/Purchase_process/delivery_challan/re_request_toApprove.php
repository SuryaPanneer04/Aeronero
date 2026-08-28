<?php
//purchase_generate =  Initial status = 0,
//purchase_generate =  Request to finance Approve for invoice raising  status =1,
//purchase_generate =  finance Approve to invoice  status =2,
//purchase_generate =  finance Reject to invoice  status =3,

require '../../../connect.php';
require '../../../user.php';
$candidateid = $_SESSION['candidateid'];

$po_gen_id    = $_REQUEST['id'];

$update= $con->query("Update purchase_generate set status='1' where id='$po_gen_id'"); //Re-Request to Finance for raising Invoice /// Status = 1 ////
echo "Update purchase_generate set status='1' where id='$po_gen_id'";
?>