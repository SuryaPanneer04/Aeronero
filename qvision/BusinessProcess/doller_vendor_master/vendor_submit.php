<?php
require '../../../connect.php';
include("../../../user.php");


$user_id =$_SESSION['userid'];
$candidateid=$_SESSION['candidateid']; 

$txt_vendor_name=$_REQUEST['txt_vendor_name'];
$txt_address1=$_REQUEST['txt_address1'];
$txt_address2=$_REQUEST['txt_address2'];
$txt_area=$_REQUEST['txt_area'];
$txt_town=$_REQUEST['txt_town'];
$txt_pincode=$_REQUEST['txt_pincode'];
$txt_district=$_REQUEST['txt_district'];
$txt_country=$_REQUEST['txt_country'];
$txt_state=$_REQUEST['txt_state'];

$txt_account_name=$_REQUEST['txt_account_name'];
$txt_account_no=$_REQUEST['txt_account_no'];
$txt_swift_code=$_REQUEST['txt_swift_code'];
$txt_ifsc_code=$_REQUEST['txt_ifsc_code'];
$txt_mailid=$_REQUEST['txt_mailid'];
$status=$_REQUEST['status'];
//$gst=$_REQUEST['gst'];
//$gst=$_REQUEST['gst'];
//$gst=$_REQUEST['gst'];
$gst_number=$_REQUEST['gst_number'];
$phoneno=$_REQUEST['phoneno'];
$sql = $con->query("INSERT INTO `doller_vendor_mastor`(`vendor_name`, `address1`, `address2`, `area`, `town_city`, `state`, `district`, `country`, `pincode`, `account_name`, `account_no`, `swift_code`, `ifsc_code`, `mail_id`, `gst`, `contact`, `status`, `created_by`, `created_on`) 
VALUES ('$txt_vendor_name', '$txt_address1', '$txt_address2', '$txt_area', '$txt_town', '$txt_state', '$txt_district', '$txt_country', '$txt_pincode', '$txt_account_name', '$txt_account_no', '$txt_swift_code', '$txt_ifsc_code', '$txt_mailid', '$gst_number', '$phoneno', '1', '$candidateid', now())");

echo "INSERT INTO `doller_vendor_mastor`(`vendor_name`, `address1`, `address2`, `area`, `town_city`, `state`, `district`, `country`, `pincode`, `account_name`, `account_no`, `swift_code`, `ifsc_code`, `mail_id`, `gst`, `contact`, `status`, `created_by`, `created_on`) 
VALUES ('$txt_vendor_name', '$txt_address1', '$txt_address2', '$txt_area', '$txt_town', '$txt_state', '$txt_district', '$txt_country', '$txt_pincode', '$txt_account_name', '$txt_account_no', '$txt_swift_code', '$txt_ifsc_code', '$txt_mailid', '$gst_number', '$phoneno', '1', '$candidateid', now())";

/*$sql11=$con->query("insert into doller_vendor_mastor(vendor_name,address1,address2,area,town_city,state,district,country,pincode,account_name,account_no,swift_code,
  ifsc_code,mail_id,status,created_by,created_on)
  values('$txt_vendor_name','$txt_address1','$txt_address2','$txt_area','$txt_town','$txt_state','$txt_district','$txt_country','$txt_pincode','$txt_account_name',
  '$txt_account_no','$txt_swift_code','$txt_ifsc_code','$txt_mailid','$status','$user_id',NOW() )"); 
*/
/*echo "insert into doller_vendor_mastor(vendor_name,address1,address2,area,town_city,state,district,country,pincode,account_name,account_no,swift_code,
  ifsc_code,mail_id,status,created_by,created_on)
  values('$txt_vendor_name','$txt_address1','$txt_address2','$txt_area','$txt_town','$txt_state','$txt_district','$txt_country','$txt_account_name',
  '$txt_account_no','$txt_swift_code','$txt_ifsc_code','$txt_mailid','$status','$user_id',NOW() )";*/
?>