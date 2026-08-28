<?php
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];
$fid=$_REQUEST['id'];
$name=$_REQUEST['name'];
$code=$_REQUEST['code'];
$status=$_REQUEST['status'];
$sql=$con->query("update prefixcode_master set name='$name',code='$code',status='$status',modified_by='$userid',modified_on=now() where id='$fid'");


if($sql)
{
	echo 0;
}
else
{
	echo 1;
}
?>