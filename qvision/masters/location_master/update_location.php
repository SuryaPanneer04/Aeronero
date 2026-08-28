<?php
require '../../../connect.php';

	$id=$_REQUEST['id'];
	$site=$_REQUEST['site'];
	$location=$_REQUEST['location'];
	$status=$_REQUEST['status'];
	$sql=$con->query("update location_master set site_id='$site',location='$location',status='$status' where id='$id'");
	//echo "update location_master set site_id='$site',location='$location',status='$status' where id='$id'";
	if($sql)
{
	echo "1";
	
}
?>