<?php
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];

$question_name=$_REQUEST['question'];
$status=$_REQUEST['status'];


$sql=$con->query("INSERT INTO `master_page` (`id`,`name`,`status`) VALUES (NULL,'$question_name','$status')");



echo "insert into `asses_master_page` (`question_name`,`status`) values ('$question_name','$status')";
if($sql)
{
	echo "values inserted";
}
else
{
	echo "values not inserted" ;
}
?>