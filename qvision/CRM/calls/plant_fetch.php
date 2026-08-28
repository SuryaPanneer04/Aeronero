<?php
require '../../../connect.php';
include("../../../user.php");
$state = $_REQUEST["client"];
	$states=rtrim($state);
	$str_arr = preg_split ("/\-/", $states); 
	$client_id         =$str_arr[2];
$sqlx=$con->prepare("SELECT a.*,b.* FROM  crm_calls a left join new_client_master b on (a.id=b.calls_id) where b.id ='$client_id'");
$sqlx->execute(); 
$row = $sqlx->fetch();

$client_name=$row['client_name'];
$contact=$row['contact'];
$whatsapp=$row['whatsapp'];
$email=$row['email'];
$alternative_mail=$row['alternative_mail'];
$address=$row['address'];

echo $client_name."=".$contact."=".$whatsapp."=".$email."=".$alternative_mail."=".$address;
?>