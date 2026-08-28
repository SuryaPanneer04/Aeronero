<?php
require '../../connect.php';


$leaveid=$_REQUEST['leave_id'];
$fdate=$_REQUEST['from_date'];
$date1=date("Y-m-d", strtotime($fdate));
$todate=$_REQUEST['to_date'];
$date2=date("Y-m-d", strtotime($todate));
$month=$_REQUEST['days_per_month'];
$year=$_REQUEST['days_per_year'];
$cummulative=$_REQUEST['is_cummulative'];
$now=date('Y-m-d');

$sql=$con->query("insert into leave_master_mapping(leave_id,from_date,to_date , days_per_month, days_per_year, is_cummulative, status, created_by, created_on) 
values('$leaveid','$date1','$date2','$month','$year','$cummulative','1', '1', '$now')");

 echo "insert into leave_master_mapping(leave_id,from_date,to_date , days_per_month, days_per_year, is_cummulative, status, created_by, created_on) 
values('$leaveid','$date1','$date2','$month','$year','$cummulative','1', '1', '$now')";
if($sql)
{
	1;
}
else
{
	0;
}
?>