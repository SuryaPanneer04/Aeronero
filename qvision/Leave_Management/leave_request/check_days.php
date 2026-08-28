<?php 
require '../../../connect.php';
$value=$_REQUEST['value'];
echo$value; 
echo$$leave_type; 
exit;

$stmt1 = $con->query("select a.*,b.* from staff_master a left join candidate_form_details b on (a.candid_id=b.id) where a.candid_id='$candid_id'");


$row = $stmt1->fetch();
	$Doj=$row['joining_date'];
echo $Doj;
$time = strtotime("$Doj");
$sl_from = date("Y-m-d", strtotime("+1 month", $time));
$pl_from = date("Y-m-d", strtotime("+7 month", $time));


$date = date('Y-m-d');

if($sl_from>$date )
{

$yearEnd = date('Y-m-d', strtotime('Dec 31'));



$ts1 = strtotime($sl_from);
$ts2 = strtotime($yearEnd);

$year1 = date('Y', $ts1);
$year2 = date('Y', $ts2);

$month1 = date('m', $ts1);
$month2 = date('m', $ts2);
$sl_bal_month = (($year2 - $year1) * 12) + ($month2 - $month1);

$val1 = strtotime($pl_from);
$val12 = strtotime($yearEnd);

$years1 = date('Y', $val1);
$years2 = date('Y', $val12);

$months1 = date('m', $val1);
$months2 = date('m', $val12);


$pl_bal_month = (($years2 - $years1) * 12) + ($months2 - $months1);

echo $sl_bal_month;


$stmt = $con->query("SELECT me.leave_type as ids,me.user_name as user_name FROM y_masters_employee me join y_leave_category lc on me.leave_type=lc.id where me.status=1 and me.id='$value'");
$row1 = $stmt->fetch();
	$leave_id=$row1['ids'];
	$user_name=$row1['user_name'];
$stmt1 = $con->query("SELECT leave_name,no_of_days FROM master_leave where id='$leave_id' and status=1");
$row2 = $stmt1->fetch();
	$leave_name=$row2['leave_name'];
	$no_of_days=$row2['no_of_days'];

echo $user_name.'-'.$leave_name.'-'.$no_of_days;
}else{
	$day="0";
echo $day;
	
}
?>