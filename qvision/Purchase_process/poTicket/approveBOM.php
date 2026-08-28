<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid = $_SESSION['candidateid']; //Candidate Id From Session.


$taskid = $_REQUEST['po']; //Ticket Id.
$bom = $_REQUEST['bom']; //costSheet Id.

$update_sts = $con->query("UPDATE po_ticket SET status= 4 WHERE id='$taskid'"); //BOM Verification   /// Status = 4 BOM apprve ////

$con->query("UPDATE `bom_component` SET `status`= 1  WHERE `id`='$bom' "); /// Status = 1 BOM apprve ////
