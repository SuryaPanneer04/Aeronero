<?php
require '../../../../connect.php';
include("../../../../user.php");
$candidateid = $_SESSION['candidateid'];

$id = $_REQUEST['id'];
$emp_name = $_REQUEST['empId'];
$mailID = $_REQUEST['mailCC'];

$sql = $con->query("UPDATE `z_user_master` SET  `user_name`='$mailID',`email_id`='$mailID' ,`modified_by`='$candidateid',`modified_on`=now() WHERE `candidate_id`='$emp_name' ");  //Update Username and email id.

$mailupdate = $con->query("UPDATE `emp_mail_details` SET  `mail_id`='$mailID' WHERE id='$id' ");  //Update email id.

if($sql && $mailupdate){
	echo 1;
}
else{
	echo 0;
}
?>