<?php
$_POST['feedback1'] = ['testing again'];
$_POST['feedback_date1'] = [''];
$_POST['fed_date1'] = [''];
$_POST['id'] = '297'; 

session_start();
$_SESSION['userid'] = 41; 

require '../../connect.php';
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $user = 41;
    $id = 297;
    $feedback1 = 'testing again';
    $feedback_date1 = 'NULL';
    $fed_date1 = 'NULL';
    $sql = "insert into crm_calls_feedback(calls_id,feedback,feedback_date,date,created_by,created_on) values('$id','$feedback1',$feedback_date1,$fed_date1,'$user',now())";
    $con->query($sql);
    echo "Success";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
