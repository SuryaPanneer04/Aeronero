<?php
require '../../../connect.php';
include("../../../user.php");
$candidateid = $_SESSION['candidateid'];


	$emp_name=$_REQUEST['emp_name'];
	$asset_name =$_REQUEST['asset_name'];
	$serial_number=$_REQUEST['serial_number'];
	$asset_name_count=count($asset_name);

	$sql = $con->query("insert into staff_asset(emp_name,created_by,created_on) values ('$emp_name','$candidateid',now())");

$maxid = $con->query("select max(id) as mid from staff_asset");
$max = $maxid->fetch();

$max_id = $max['mid'];


	for($i=0;$i<$asset_name_count;$i++)
	{
	$asset= $asset_name[$i]; 
	$serial_no= $serial_number[$i]; 
	
	$sql=$con->query("insert into staff_asset_serial_no(staff_asset_id,asset_name,serial_number) values ('$max_id','$asset','$serial_no')");
	}
?>