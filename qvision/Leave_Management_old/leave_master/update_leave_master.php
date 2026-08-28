<?php
//require '../../user.php';
require '../../connect.php';

 $id=$_REQUEST['id'];
 
 

$date=$_REQUEST['from_date'];
$leave_name=$_REQUEST['leave_name'];
$month=$_REQUEST['days_per_month'];
$year=$_REQUEST['days_per_year'];
$cummulative=$_REQUEST['is_cummulative'];
if($_REQUEST['status']==1)
{
	$status = 1;
}
else
{
	$status = 2;
}



 $sql=$con->query("Update leave_master set  from_date='$date', leave_name='$leave_name', days_per_month='$month', days_per_year='$year', is_cummulative='$cummulative', status='$status'  where id='$id'");
 
 echo "Update leave_master set from_date='$date', leave_name='$leave_name', days_per_month='$month', days_per_year='$year', is_cummulative='$cummulative', status='$status'  where id='$id'";

?>