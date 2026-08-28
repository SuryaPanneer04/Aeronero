<?php
require '../../../connect.php';

	$id=$_REQUEST['id'];
	$jd_tittle=$_REQUEST['title'];
	$status=$_REQUEST['status'];
	$approve=$_REQUEST['approve'];
	$round=$_REQUEST['round'];

	$sql=$con->query("update jobdescription_master set tittle='$jd_tittle',approval_level='$approve',interview_round_level='$round',status='$status' where id='$id'");

	//echo "update jobdescription_master set tittle='$jd_tittle',status='$status' where id='$id'";
	if($sql)
{
	echo 1;	
}
else{
	echo 0;
}
?>
