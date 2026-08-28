<?php
require '../../../connect.php';

$Year = $_REQUEST['Year'];
$date = $_REQUEST['date'];
$holiday_name = $_REQUEST['holiday_name'];

//$sql = $con->query("insert into holiday_master(year,leave_date,leave_name) values('$Year','$date','$holiday_name')");

$sql=$con->query("INSERT INTO `holiday_master`(`id`, `year`, `leave_date`, `leave_name`, `status`, `md_approve_sts`) VALUES (NULL,'$Year','$date','$holiday_name',1,0)");

// print_r($sql);
// die();
?>