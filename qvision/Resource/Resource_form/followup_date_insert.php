<?php
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];

$resource_id        = $_REQUEST['rid'];
$remarks            = $_REQUEST['feedback'];
$feedback_count     = count($remarks);

$followup_dates = $_REQUEST['date'];

$next_followup_date = $_REQUEST['next_date'];


for($i=0;$i<$feedback_count;$i++)
{
 
 $feedbacks= $remarks[$i];
 $dates= $followup_dates[$i];
 
$sql2=$con->query("insert into resource_feedback (`resource_id`, `feedback`, `feedback_date`)values('$resource_id','$feedbacks','$dates')");

echo "insert into resource_feedback (`resource_id`, `feedback`, `feedback_date`)values('$resource_id','$feedbacks','$dates')"; echo "<br>";

}


$sql=$con->query("UPDATE resource_form_detail SET `next_followup_date` = '$next_followup_date' WHERE id = '$resource_id' ");
	
	echo "UPDATE resource_form_detail SET `next_followup_date` = '$next_followup_date' WHERE id = '$resource_id' ";

?>


 