<?php
require '../../connect.php';

$cid=$_REQUEST['candidateId'];
$staff_id =$_REQUEST['staff_id'];
$id =$_REQUEST['id'];

if($id == 0){
$reject=$_REQUEST['remark'];

$insert_query = $con->query("INSERT INTO `candidate_accept_reject`(`candidateID`, `staff_id`, `reject_remark`, `status`) VALUES ('$cid','$staff_id','$reject','0')");
$update = $con->query("UPDATE `candidate_form_details` SET `status`=12 WHERE id = '$cid'");

} else{
    $accpet_time=$_REQUEST['accept_time']; 
    $accpet_date=$_REQUEST['accept_date']; 
    
    $insert_query = $con->query("INSERT INTO `candidate_accept_reject`(`candidateID`, `staff_id`, `status`, `available_date`, `available_time`) VALUES ('$cid','$staff_id','1','$accpet_date','$accpet_time')");
    $update = $con->query("UPDATE `candidate_form_details` SET `status`=100 WHERE id = '$cid'");

    echo "INSERT INTO `candidate_accept_reject`(`candidateID`, `staff_id`, `status`, `available_date`, `available_time`) VALUES ('$cid','$staff_id','1','$accpet_date','$accpet_time')";

}
?>  