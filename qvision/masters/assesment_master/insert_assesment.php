<?php
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];
$assesment_name=$_REQUEST['assesment_name'];

$status=$_REQUEST['status'];
$sql=$con->query("insert into z_assesment_master (assesment_name,status,created_by,created_on) values ('$assesment_name','$status','$userid',now())");


if($sql)
{
	echo 0;
}
else
{
	echo 1;
}
?>