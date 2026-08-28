<?php
require '../../config.php';
include("../../user.php");

$user = $_SESSION['userid'];

$feedback = $_POST['feedback1'];
$feedback_date = $_POST['feedback_date1'];
$fed_date = $_POST['fed_date1'];
$id = $_POST['id'];

$success = 0;

for($i=0; $i<count($feedback); $i++){

    $feedback1 = trim($feedback[$i]);
    $feedback_date1 = !empty($feedback_date[$i]) ? "'".$feedback_date[$i]."'" : "NULL";
    $fed_date1 = !empty($fed_date[$i]) ? "'".$fed_date[$i]."'" : "NULL";

    if($feedback1 == ''){
        continue;
    }

    $sql = $con->query("INSERT INTO crm_calls_feedback
    (calls_id, feedback, feedback_date, date, created_by, created_on)
    VALUES
    ('$id', '$feedback1', $feedback_date1, $fed_date1, '$user', NOW())");

    if($sql){
        $success = 1;
    }
}

echo $success;
?>