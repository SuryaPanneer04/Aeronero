<?php 
require '../../connect.php';
$leave_type=$_REQUEST['type'];
echo $leave_type;
$doj=$_REQUEST['doj'];
echo $doj;
exit;
$stmt1 = $con->query("select * from candidate_form_details where id='$candid_id'");
//echo "select * from candidate_form_details where id='$candid_id'";
$row = $stmt1->fetch();
	$joining_date=$row['joining_date'];
	$joining=1;
	$time1 = strtotime("$joining_date");
	$time2 = strtotime("$joining_date");
$sl_from = date("Y-m-d", strtotime("+1 month", $time1));
$pl_from = date("Y-m-d", strtotime("+7 month", $time2));

echo $joining.','.$joining_date;
?>