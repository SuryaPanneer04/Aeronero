<?php
require '../../config.php';
include("../../user.php");
$user=$_SESSION['userid'];

$feedback=$_REQUEST['feedback'];
$feedback_date=$_REQUEST['feedback_date'];
$fed_date=$_REQUEST['fed_date'];
$id=$_REQUEST['id'];


for($i=0;$i<count($feedback);$i++){
	
	$feedback1=$feedback[$i];
$feedback_date1=$feedback_date[$i];
$fed_date1=$fed_date[$i];
$id1=$_REQUEST['id'];
$Department=$_REQUEST['Department'];
$employee=$_REQUEST['employee'];


$sql11=$con->query("insert into crm_calls_feedback(calls_id,feedback,feedback_date,date,department,employee,created_by,created_on) values('$id1','$feedback1','$feedback_date1','$fed_date1','$Department','$employee','$user',now())"); 
echo "insert into crm_calls_feedback(calls_id,feedback,feedback_date,date,department,employee,created_by,created_on) values('$id1','$feedback1','$feedback_date1','$fed_date1','$Department','$employee','$user',now())";

}

$sql12=$con->query("Update crm_calls set department='$Department',employee='$employee',status='2' where id='$id'"); 


/* echo "insert into crm_calls_feedback(calls_id,feedback,feedback_date,date,created_by,created_on) values('$id','$feedback','$feedback_date','$fed_date','$user',now())"; */
//echo "insert into products_master(`Product_name`) values('$product_name')";
?>