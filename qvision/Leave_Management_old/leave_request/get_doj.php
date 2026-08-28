<?php 
require '../../connect.php';
$candid_id=$_REQUEST['candid_id'];

$stmt1 = $con->query("select id,joining_date from candidate_form_details where id='$candid_id'");
//echo "select * from candidate_form_details where id='$candid_id'";
$row = $stmt1->fetch();
	
	$joining_date=$row['joining_date'];
	$joining=1;
$newDate = date("d-m-Y", strtotime($joining_date));

echo $joining.','.$newDate.','.$candid_id;
?>