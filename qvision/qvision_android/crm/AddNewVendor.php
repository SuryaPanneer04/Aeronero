<?php
include("../config.php");

if(!$mysqlit){
	die("Connection failed:".mysqli_connect_error());
}

$vendor_name=$_POST['vendor_name'];
$vendor_type  =$_POST['vendor_type'];
$address1=$_POST['address1'];
$address2=$_POST['address2'];
$area=$_POST['area'];
$town_city=$_POST['town_city'];
$state=$_POST['state'];
$district=$_POST['district'];
$country=$_POST['country'];
$pincode=$_POST['pincode'];

$account_name=$_POST['account_name'];
$account_no=$_POST['account_no'];
$swift_code=$_POST['swift_code'];
$ifsc_code=$_POST['ifsc_code'];
$mail_id=$_POST['mail_id'];
$status=$_POST['status'];


		
 $insertqryVendor="INSERT INTO doller_vendor_mastor(`vendor_name`, `vendor_type`, `address1`,`address2`, `area`, `town_city`, `state`, `district`,`country`, `pincode`, `account_name`, `account_no`, `swift_code`, `ifsc_code`, `mail_id`, `status`,`created_by`,`created_on`, `modified_by`, `modified_on`) VALUES ('$vendor_name','$vendor_type','$address1','$address2','$area','$town_city','$state','$district','$country','$pincode','$account_name','$account_no','$swift_code','$ifsc_code',
 '$mail_id','$status','2',now(),'3',now())";
 

$rslt_vendor=mysqli_query($mysqlit ,$insertqryVendor);

 if($rslt_vendor){

	    $result['status']="true"; 
	    $result['status_message']="new vendor created successfully!"; 
	 }else{
		$result['status']="false"; 
	    $result['status_message']="unable to create new record!";
	 }
echo json_encode($result);
?>