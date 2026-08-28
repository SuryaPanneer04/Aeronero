<?php
require '../../connect.php';
include("../../user.php");

$user=$_SESSION['userid'];

$feedback = isset($_POST['feedback1']) ? $_POST['feedback1'] : [];
$feedback_date = isset($_POST['feedback_date1']) ? $_POST['feedback_date1'] : [];
$fed_date = isset($_POST['fed_date1']) ? $_POST['fed_date1'] : [];

$id = isset($_POST['id']) ? $_POST['id'] : (isset($_POST['idd']) ? $_POST['idd'] : 0);
if(is_array($id)) {
    $id = $id[0];
}

$success = 0;

for($i=0; $i<count($feedback); $i++){
    $feedback1 = trim($feedback[$i]);
    $feedback_date1 = !empty($feedback_date[$i]) ? "'".$feedback_date[$i]."'" : "NULL";
    $fed_date1 = !empty($fed_date[$i]) ? "'".$fed_date[$i]."'" : "NULL";

    if($feedback1 != ''){
        $sql11 = $con->query("insert into crm_calls_feedback(calls_id,feedback,feedback_date,date,created_by,created_on) values('$id','$feedback1',$feedback_date1,$fed_date1,'$user',now())");  
        if($sql11) {
            $success = 1;
        }
    }
}
file_put_contents('debug.txt', print_r($_POST, true) . "\nSuccess: $success\n");
echo $success;
?>