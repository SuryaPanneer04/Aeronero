<?php
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];

$name = $_REQUEST['emp_name'];
$month = $_REQUEST['month'];
$arrear_amt = $_REQUEST['arrear_amt'];
$arrear_remark = $_REQUEST['arrear_remark'];

$sql=$con->query("INSERT INTO `arrear_pay`(`emp_id`, `payroll_month`, `amount`, `remark`, `status`) VALUES ('$name','$month','$arrear_amt','$arrear_remark', 0)");

if($sql)
{
	echo 1;
}
else
{
	echo 0;
}
?>