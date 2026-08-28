<?php
require '../../config.php';
include("../../user.php");
$user=$_SESSION['userid'];

$Call_type=$_REQUEST['Call_type'];
$Client_type=$_REQUEST['Client_type'];
$client_name=$_REQUEST['client_name'];
$contact=$_REQUEST['contact'];
$whatsapp=$_REQUEST['whatsapp'];
$email=$_REQUEST['email'];
$website=$_REQUEST['website'];
$address=$_REQUEST['address'];

$services=$_REQUEST['services'];


echo $Company_name=$_REQUEST['client_org'];

$mail=$_REQUEST['mail'];
$flag = '1';

$sql11=$con->query("insert into crm_calls(call_type,client_type,client_org,client_name,contact,whatsapp,email,alternative_mail,website,address,services,created_by,created_on,status,flag) values('$Call_type','$Client_type','$Company_name','$client_name','$contact','$whatsapp','$email','$mail','$website','$address','$services','$user',now(),1,'$flag')"); 
echo "insert into crm_calls(call_type,client_type,client_org,client_name,contact,whatsapp,email,alternative_mail,website,address,services,created_by,created_on,status,flag) values('$Call_type','$Client_type','$Company_name','$client_name','$contact','$whatsapp','$email','$mail','$website','$address','$services','$user',now(),1,'$flag')";

//echo "insert into products_master(`Product_name`) values('$product_name')";



?>