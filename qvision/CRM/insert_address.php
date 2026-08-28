<?php
require '../config.php';
require '../user.php';

$candidateid = $_SESSION['candidateid'];

$id        = $_REQUEST['id'];
$Location  = $_REQUEST['newlocation'];
$Address   = $_REQUEST['Address'];
$area      = $_REQUEST['area_1'];
$pincode   = $_REQUEST['pincode_1'];
$status    = 1;


$sql=$con->query("insert into same_address(`enquiry_id`,`location`,`address`,`area`,`pincode`,`status`,`created by`, `created on`)
	values('$id','$Location','$Address','$area','$pincode','$status','$candidateid',now())");
	
	echo "insert into same_address(`enquiry_id`,`location`,`address`,`area`,`pincode`,`status`,`created by`, `created on`)
	values('$id','$Location','$Address','$area','$pincode','$status','$candidateid',now())";
?>