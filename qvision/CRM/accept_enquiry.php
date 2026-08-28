<?php
require '../../connect.php';
require '../../user.php';

$id=$_REQUEST['get_id'];
$candidateid=$_SESSION['candidateid'];
$feedback = isset($_REQUEST['feedback']) ? $_REQUEST['feedback'] : [];
$feedback_count = count($feedback);
$date = isset($_REQUEST['f_date']) ? $_REQUEST['f_date'] : [];


 for($i=0;$i<$feedback_count;$i++)
{
	
$feedbacks= $feedback[$i];
$dates= $date[$i];

if(trim($feedbacks) == "" || trim($dates) == "") {
    continue; // Skip empty rows
}

$candidateid = empty($candidateid) ? 0 : $candidateid;
 
$sql1=$con->query("insert into `feedback_enquiry_crm`(`enquiry_id`, `Feedback`, `feedback_date`, `created_by`)  values('$id','$feedbacks','$dates','$candidateid')");  
if(!$sql1) {
    $err = $con->errorInfo();
    echo "SQL Error: " . $err[2];
    exit;
}
}
echo "2";




?>






