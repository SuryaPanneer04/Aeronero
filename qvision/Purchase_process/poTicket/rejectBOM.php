<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid = $_SESSION['candidateid']; //Candidate Id From Session.


$taskid = $_REQUEST['po']; //Ticket Id.
$bom = $_REQUEST['bom']; //costSheet Id.
$reject_remark = $_REQUEST['remark']; 

$update_sts = $con->query("UPDATE po_ticket SET status= 5 WHERE id='$taskid'"); //BOM Verification   /// Status = 5 BOM Reject ////

$con->query("UPDATE `bom_component` SET `status`= 2, `reject_remark`='$reject_remark' WHERE `id`='$bom' "); /// Status = 2 BOM Reject ////
