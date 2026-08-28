<?php
require '../../connect.php';



$date=$_REQUEST['from_date'];
echo $date;
$date1=date("Y-m-d", strtotime($date));
$leave_name=$_REQUEST['leave_name'];
$month=$_REQUEST['days_per_month'];
$year=$_REQUEST['days_per_year'];
$cummulative=$_REQUEST['is_cummulative'];

$sql=$con->query("insert into leave_master(from_date, leave_name, days_per_month, days_per_year, is_cummulative, status) values('$date1','$leave_name','$month','$year','$cummulative','1')");

 echo "insert into leave_master(from_date, leave_name, days_per_month, days_per_year, is_cummulative, status) values('$date1','$leave_name','$month','$year','$cummulative','1')";

?>
