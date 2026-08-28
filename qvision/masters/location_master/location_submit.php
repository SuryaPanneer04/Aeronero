<?php
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];

	$site=$_REQUEST['site'];
	$location=$_REQUEST['location'];
	$status=$_REQUEST['status'];
	$sql=$con->query("insert into location_master(site_id,location,status,created_by,created_on)values('$site','$location','$status','$userid',now())");
	//echo "insert into company_master(companyname,status)values('$company','$status')";
	//echo "insert into location_master(site_id,location,status,created_by,created_on)values('$site','$location','$status','$userid',now())";
if($sql)
{
	echo "1";
	
}

?>