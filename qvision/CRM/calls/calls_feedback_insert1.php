
<?php
require '../../config.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$user=$_SESSION['userid'];
$candidateid=$_SESSION['candidateid'];
 $feedback=$_REQUEST['feedback1'];
 $feedback_date=$_REQUEST['feedback_date1'];
 $fed_date=$_REQUEST['fed_date1'];
$id=$_REQUEST['id'];
//$remark=$_REQUEST['remark'];

for($i=0;$i<count($feedback);$i++){
	
	$feedback1=$feedback[$i];
$feedback_date1=$feedback_date[$i];
$fed_date1=$fed_date[$i];
$id1=$id;



  $sql11=$con->query("insert into crm_calls_feedback(calls_id,feedback,feedback_date,date,created_by,created_on) values('$id1','$feedback1','$feedback_date1','$fed_date1','$user',now())");   
echo "insert into crm_calls_feedback(calls_id,feedback,feedback_date,date,created_by,created_on) values('$id1','$feedback1','$feedback_date1','$fed_date1','$user',now())";
//echo "insert into crm_calls_feedback(calls_id,feedback,feedback_date,date,created_by,created_on) values($id1','$feedback1','$feedback_date1','$fed_date1','$user',now())";

}
?>