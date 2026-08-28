<?php
require '../../connect.php';
include("../../user.php");
$user=$_SESSION['userid'];

$feedback=$_REQUEST['feedbacks'];
//$feedback_date=$_REQUEST['feedback_date'];
//$fed_date=$_REQUEST['fed_date'];
$id=$_REQUEST['id'];

 $Department=$_REQUEST['Department'] ?? 0;
$employee=$_REQUEST['employee'] ?? 0;

/* $sql12=$con->query("Update crm_calls set department='$Department',employee='$employee',status='2' where id='$id'"); 
echo "Update crm_calls set department='$Department',employee='$employee',status='2' where id='$id'";
 */

if($Department != 0 && $employee != 0 || $Department != '' && $employee != ''){
	$sql12=$con->query("Update crm_calls set department='$Department',employee='$employee',status='2' where id='$id'"); 
	
	echo "1";
}
else{
echo "2";
}

/* echo "insert into crm_calls_feedback(calls_id,feedback,feedback_date,date,created_by,created_on) values('$id','$feedback','$feedback_date','$fed_date','$user',now())"; */
//echo "insert into products_master(`Product_name`) values('$product_name')";
?>