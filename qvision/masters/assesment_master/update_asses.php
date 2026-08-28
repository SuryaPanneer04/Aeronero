<?php
require '../../../connect.php';
include("../../../user.php");
$id=$_REQUEST['quesion_no'];
$question=$_REQUEST['question'];
$status=$_REQUEST['status'];
$sql=$con->query("update z_assesment_master set assesment_name='$assesment_name',status='$status',created_on='$created_on',created_by=now() where id='$id'");
 
//$sql=$con->query("update z_assesment_master (assesment_name,status,created_by,created_on) values ('$assesment_name','$status','$userid',now())");


if($sql)
{
	echo 0;
}
else
{
	echo 1;
}
?>