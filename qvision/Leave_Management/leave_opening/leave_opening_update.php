<?php
//require '../../user.php';
require '../../config.php';

$id=$_REQUEST['id'];
$staffid=$_REQUEST['staff_id'];
$stafftype=$_REQUEST['staff_type_id'];
$doj=$_REQUEST['doj'];
$fdate=$_REQUEST['from_date'];
$leavetype=$_REQUEST['leave_type_id'];

$leavename=$_REQUEST['leave_name'];
$leavebal=$_REQUEST['leave_op_balance'];

if($_REQUEST['status']==1)
{
	$status = 1;
}
else
{
	$status = 2;
}



 $sql=$con->query("Update leave_opening_balance set staff_id='$staffid',staff_type_id='$stafftype',doj='$doj', from_date='$fdate', leave_type_id='$leavetype', leave_name='$leavename', leave_op_balance='$leavebal', status='$status'  where id='$id'");
 
 echo"Update leave_opening_balance set staff_id='$staffid',staff_type_id='$stafftype',doj='$doj', from_date='$fdate', leave_type_id='$leavetype', leave_name='$leavename', leave_op_balance='$leavebal', status='$status'  where id='$id'";
?>