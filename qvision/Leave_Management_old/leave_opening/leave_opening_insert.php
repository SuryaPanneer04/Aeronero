<?php
require '../../connect.php';

$staffid=$_REQUEST['staff_id'];
$stafftype=$_REQUEST['staff_type_id'];
$date=$_REQUEST['doj'];
$date1=date("Y-m-d", strtotime($date));
$fdate=$_REQUEST['from_date'];
$date2=date("Y-m-d", strtotime($fdate));
$leaveid=$_REQUEST['leave_type_id'];
$leavename=$_REQUEST['leave_name'];
$leavebal=$_REQUEST['leave_op_balance'];
$now=date('Y-m-d');

$sql=$con->query("insert into leave_opening_balance(staff_id, staff_type_id, doj,from_date , leave_type_id, leave_name, leave_op_balance, status, created_by, created_on) 
values('$staffid','$stafftype','$date1','$date2','$leaveid','$leavename','$leavebal','1', '1', '$now')");

 echo "insert into leave_opening_balance(staff_id, staff_type_id, doj,from_date , leave_type_id, leave_name, leave_op_balance, status, created_by, created_on) 
values('$staffid','$stafftype','$date1','$date2','$leaveid','$leavename','$leavebal','1', '1', '$now')";
if($sql)
{
	1;
}
else
{
	0;
}
?>