<?php
require '../../../connect.php';
require '../../../user.php';
$candid = $_SESSION['candidateid'];

 $emp_code = $_REQUEST['emp_code'];
 $amount = $_REQUEST['amount'];
//  $emi_status = $_REQUEST['emi_status'];
 $emi_period = $_REQUEST['emi_period'];
 $start_date = $_REQUEST['start_date'];
 $end_date = $_REQUEST['end_date'];
 $emi_amount = $_REQUEST['no_emi'];
 
 
	// if ($emi_period == '3') {
	// 	 $emi_amount = $amount/3;
	// }
	// elseif ($emi_period == '6') {
	// 	 $emi_amount = $amount/6;
	// }
	// elseif ($emi_period == '1') {
	// 	 $emi_amount = $amount/1;
	// }
	// elseif ($emi_period == '2') {
	// 	 $emi_amount = $amount/2;
	// }
	// elseif ($emi_period == '4') {
	// 	 $emi_amount = $amount/4;
	// }
	// elseif ($emi_period == '5') {
	// 	 $emi_amount = $amount/5;
	// }
	// else {
	// 	 $emi_amount = $amount;
	// }


//$query=$con->query("insert into salary_advance(emp_id,advance_amount,emi_status,emi_period,start_date,end_date,emi_amount,created_by,created_on) values('$emp_code','$amount','$emi_status','$emi_period','$start_date','$end_date','$emi_amount','$candid',now())");

$query=$con->query("insert into salary_advance(emp_id,advance_amount,emi_period,start_date,end_date,emi_amount,created_by,created_on) values('$emp_code','$amount','$emi_period','$start_date','$end_date','$emi_amount','$candid',now())");

if($query){
	echo 1;
}
else{
	echo 0;
}

?>