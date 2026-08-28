<?php
require '../../config.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$user=$_SESSION['userid'];
$candidateid=$_SESSION['candidateid'];
//$feedback=$_REQUEST['feedback'];
//$feedback_date=$_REQUEST['feedback_date'];
//$fed_date=$_REQUEST['fed_date'];
$id=$_REQUEST['id'];
//$remark=$_REQUEST['remark'];


//$sql12=$con->query("Update crm_calls set status='3' where id='$id'"); 
$sql12=$con->query("Update crm_calls set status='3' where id='$id'"); 
/* echo "insert into Enquiry(`Call_type`, `date`, `Client_type`, `consultant`,`Company_name`, `Location`, `Address`, `Client`, `Designation`, `Mobile`, `mail`, `Product`,`Feedback`, `Follup`,`Department`, `employee`,  `created_by`, `created_on`) values('$Call_type',now(),'','','$Company_name','$Location','$Address','$Client','','$contact','$email','','','','','','$candidateid',now())"; */
/* $sql11=$con->query("insert into Enquiry(`Call_type`, `date`, `Client_type`, `Company_name`, `Location`, `Address`, `Client`, `Designation`, `Mobile`, `mail`, `Product`,`list`,`Feedback`, `Follup`, `Department`, `employee`,  `created_by`, `created_on`) values('$Call_type','$date','','$Company_name','$Location','$Address','$Client','','$contact','$email','','','','','','$employee','1',now())");  */
?>