<?php
require '../../../connect.php';

	$COMPANY_NAME=$_REQUEST['company'];
	
	$ADDRESS=$_REQUEST['address'];
	$EMAIL_ID=$_REQUEST['email_id'];
	$PHONE_NO=$_REQUEST['phone_no'];
	$GST_NO=$_REQUEST['gst_no'];
	
	$STATUS=$_REQUEST['status'];
	$sql=$con->query("insert into company_master(companyname,address,phone_no,email_id,gst_no)values
	('$COMPANY_NAME','$ADDRESS','$EMAIL_ID','$PHONE_NO','$GST_NO')");
	echo "insert into company_master(companyname,address,email_id,phone_no,gst_no,pan_no,cin_no,status)values
	('$COMPANY_NAME','$ADDRESS','$EMAIL_ID','$PHONE_NO','$GST_NO','$PAN_NO','$CIN_NO','$STATUS')";
if($sql)
{
	echo "1";
	
}

?>