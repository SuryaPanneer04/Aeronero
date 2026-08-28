<?php
require '../../config.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$candidateid=$_SESSION['candidateid'];
 $id=$_REQUEST['id'];
$user=$_SESSION['userid'];
$Call_type=$_REQUEST['Call_type'];
 $Client_type=$_REQUEST['client_org1']; 
$client_name=$_REQUEST['client_name1'];
$contact=$_REQUEST['contact1'];
$whatsapp=$_REQUEST['whatsapp1'];
$email=$_REQUEST['email1'];
$mail=$_REQUEST['mail1'];
$website=$_REQUEST['website1'];
$address=$_REQUEST['address1'];

$services=$_REQUEST['services'];
 $sql11=$con->query("UPDATE `crm_calls` SET `Call_type`='$Call_type',`Client_org`='$Client_type',`client_name`='$client_name',`contact`='$contact',`email`='$email',`alternative_mail`='$mail',`website`='$website',`whatsapp`='$whatsapp',`address`='$address',`services`='$services',`modified_by`='$user',`modified_on`=now(),`status`='2' WHERE id='$id'"); 

echo "UPDATE `crm_calls` SET `Call_type`='$Call_type',`Client_type`='$Client_type',`client_name`='$client_name',`contact`='$contact',`email`='$email',`website`='$website',`address`='$address',`services`='$services',`modified_by`='$user',`modified_on`=now(),`status`='2' WHERE id='$id'";
/* echo "UPDATE `enquiry` SET `Call_type`='$Call_type',`date`='$date',`Client_type`='$Client_type',`Company_name`='$Company_name',`Location`='$Location',`Address`='$Address',`Client`='$Client',`Designation`='$Designation',`Mobile`='$Number',`mail`='$mail',`Product`='$Product',`list`='$list',`Feedback`='$Feedback',`Follup`='$Follup',`Department`='$Department',`employee`='$employee',`Modified_by`='$candidateid',`modified_on`=now() WHERE id='$id'"; */


$feedback=$_REQUEST['feedback1'];
$feedback_date=$_REQUEST['feedback_date1'];
$fed_date=$_REQUEST['fed_date1'];




 $sql11=$con->query("UPDATE `crm_calls_feedback` SET `calls_id`='$id',`feedback`='$feedback',`feedback_date`='$feedback_date',`date`='$fed_date',`created_by`='$user',`created_on`=now() WHERE calls_id='$id'"); 
 
 echo "UPDATE `crm_calls_feedback` SET `calls_id`='$id',`feedback`='$feedback',`feedback_date`='$feedback_date',`date`='$fed_date',`created_by`='$user',`created_on`=now() WHERE calls_id='$id'";
/* 
echo "UPDATE `crm_calls_feedback` SET `calls_id`='$id',`feedback`='$feedback',`feedback_date`='$feedback_date',`date`='$fed_date',`created_by`='$user',`created_on`=now() WHERE calls_id='$id'"; */




?>