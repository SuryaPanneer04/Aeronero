<?php
include("../config.php");

$customer_code=$_POST['customer_code'];
$customer_name=$_POST['customer_name'];
$customer_address=$_POST['customer_address'];
$customer_person=$_POST['customer_person'];
$customer_contact=$_POST['customer_contact'];
$customer_mail=$_POST['customer_mail'];
$customer_website=$_POST['customer_website'];

$cus_follo_date=$_POST['cus_follo_date'];
$cus_remark=$_POST['cus_remark'];
$created_by=$_POST['created_by'];
$created_on=$_POST['created_on'];
$status=1;
$create_date=date('Y-m-d');

if(!$mysqlit){
	die("Connection failed:".mysqli_connect_error());
}

$sqlInsertcusDet = "INSERT INTO `customer_details`(`customer_code`, `customer_name`, `customer_address`, `customer_person`, `customer_contact`, `customer_mail`, `customer_website`, `create_date`, `status`, `cus_follo_date`, `cus_remark`, `created_by`, `created_on`) VALUES ('$customer_code','$customer_name','$customer_address','$customer_person','$customer_contact','$customer_mail','$customer_website','$create_date','$status','$cus_follo_date','$cus_remark','$created_by',now())"; 

$reslt=mysqli_query($mysqlit ,$sqlInsertcusDet);

 if($reslt){
	    $result['status']="true"; 
	    $result['status_message']="customer information created successfully!"; 
		echo json_encode($result);
	 }else{
		 $result["status"] = "false";
	   $result["status_message"] = "Insert Failed";
	   echo json_encode($result);
	 }
	
mysqli_close($mysqlit);
 
?>