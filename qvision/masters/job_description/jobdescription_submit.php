<?php
require '../../../connect.php';
include("../../../user.php");
$candidate_id = $_SESSION['candidateid'];

	$jd_tittle=$_REQUEST['title'];
	//$approve_level=$_REQUEST['approve'];
	$round_level=$_REQUEST['round'];
	$status=$_REQUEST['status'];

	$sql=$con->query("insert into jobdescription_master(tittle,interview_round_level,status,created_by,created_on)values('$jd_tittle','$round_level','$status','$candidate_id',now())");

	//header("location:/../index.php");
if($sql)
{
	echo "1";
}
else{
	echo "0";
}
?>