<?php
require '../../../connect.php';
$scale=$_REQUEST['scale']; //scale name
$amount=$_REQUEST['amount'];
$percentage=$_REQUEST['percentage'];
$status=$_REQUEST['status']; // payroll_scale_details  status
$id=$_REQUEST['id'];

$sql = $con->query("UPDATE payroll_scale_details set name='$scale', amount='$amount', percentage='$percentage',status='$status' WHERE id='$id'");
echo "UPDATE payroll_scale_details set name='$scale', amount='$amount', percentage='$percentage',status='$status' WHERE id='$id'";

if($sql)
{
	1;
}
else
{
	0;
}
?>