<?php 
require '../../connect.php';
$value=$_REQUEST['value'];
$stmt = $con->query("SELECT me.leave_type as ids,me.user_name as user_name FROM y_masters_employee me join y_leave_category lc on me.leave_type=lc.id where me.status=1 and me.id='$value'");
$row1 = $stmt->fetch();
	$leave_id=$row1['ids'];
	$user_name=$row1['user_name'];
$stmt1 = $con->query("SELECT leave_name,no_of_days FROM master_leave where id='$leave_id' and status=1");
$row2 = $stmt1->fetch();
	$leave_name=$row2['leave_name'];
	$no_of_days=$row2['no_of_days'];

echo $user_name.'-'.$leave_name.'-'.$no_of_days;

?>