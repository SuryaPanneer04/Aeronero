<?php
//require '../../user.php';
require '../../connect.php';

$id=$_REQUEST['id'];
$leaveid=$_REQUEST['leave_id'];
$fdate=$_REQUEST['from_date'];
$todate=$_REQUEST['to_date'];

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



 $sql=$con->query("Update leave_master_mapping set leave_id='$leaveid', from_date='$fdate', to_date='$todate', days_per_month='$month', days_per_year='$year', is_cummulative='$cummulative', status='$status'  where id='$id'");
 
 echo "Update leave_master set from_date='$date', leave_name='$leave_name', days_per_month='$month', days_per_year='$year', is_cummulative='$cummulative', status='$status'  where id='$id'";

?>