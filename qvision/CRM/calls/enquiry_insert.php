
<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$user=$_SESSION['userid'];
$candidateid=$_SESSION['candidateid'];
/* $feedback=$_REQUEST['feedback'];
$feedback_date=$_REQUEST['feedback_date'];
$fed_date=$_REQUEST['fed_date']; */
$id=$_REQUEST['id'];
 $remark=$_REQUEST['remark'];

if($remark != ''){
	$sql12=$con->query("Update crm_calls set drop_remark='$remark',status='5' where id='$id'"); 
	
	echo "1";
}
else{
echo "2";
}
?>