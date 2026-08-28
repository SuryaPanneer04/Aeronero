<?php
require '../../connect.php';
require '../../user.php';

$candidateid=$_SESSION['candidateid'];
$user_id =$_SESSION['userid'];


if(isset($_POST['cus_id']) || isset($_POST['cus_code'])|| isset($_POST['plant_id']) || isset($_POST['clients_id'])|| isset($_POST['enquiry_id'])|| isset($_POST['txt_org_name'])|| isset($_POST['Location'])|| isset($_POST['city_1'])|| isset($_POST['txt_gst_no'])|| isset($_POST['txt_pan_no'])|| isset($_POST['txt_address'])|| isset($_POST['txt_area'])|| isset($_POST['txt_pincode'])|| isset($_POST['cs_name'])|| isset($_POST['cs_dess'])|| isset($_POST['txt_mobileone'])|| isset($_POST['txt_mobiletwo'])|| isset($_POST['txt_mail_idone'])|| isset($_POST['txt_mail_idtwo'])|| isset($_POST['txt_landno'])|| isset($_POST['pur_name']) || isset($_POST['pur_designation'])|| isset($_POST['pur_contact']) || isset($_POST['pur_mail'])|| isset($_POST['fin_name'])|| isset($_POST['fin_designation'])|| isset($_POST['fin_contact'])|| isset($_POST['fin_mail'])|| isset($_POST['txt_mobile1'])|| isset($_POST['txt_mobile2'])|| isset($_POST['txt_mail_id1'])|| isset($_POST['txt_mail_id2'])|| isset($_POST['txt_website'])|| isset($_POST['Product'])|| isset($_POST['services'])|| isset($_POST['Feedback'])|| isset($_POST['Follup'])|| isset($_POST['state_1'])|| isset($_POST['customer_id']) ||  isset($_POST['txt_client_name'])|| isset($_POST['txt_client_desig'])|| isset($_POST['file']))

{
	$client_id     = $_POST['clients_id'];
	$enquiry_id     = $_POST['enquiry_id'];
	$plant_id     = $_POST['plant_id'];
	//$sales_person     = $_POST['sale_person'];
	//$credit_period    = $_POST['credit_period'];
	///$credit_limit     = $_POST['credit_limit'];
	$cus_id           = $_POST['cus_id'];
	$customer_code    = $_POST['cus_code'];
	$org_name         = $_POST['txt_org_name'];
	$Location         = $_POST['Location'];
	$city             = $_POST['city_1'];
	$gst_no           = $_POST['txt_gst_no'];
	$pan_no           = $_POST['txt_pan_no'];
	$address          = $_POST['txt_address'];
	$area             = $_POST['txt_area'];
	$pincode          = $_POST['txt_pincode'];
	$it_name          = $_POST['cs_name'];
	$it_desg          = $_POST['cs_dess'];	
	$iit_names        =$_POST['txt_client_name'];
	$iit_desgs        =$_POST['txt_client_desig'];
	$it_mob1          = $_POST['txt_mobileone'];
	$it_mob2          = $_POST['txt_mobiletwo'];
	$it_mail1         = $_POST['txt_mail_idone'];
	$it_mail2         = $_POST['txt_mail_idtwo'];	
	$it_landno        = $_POST['txt_landno'];	
	$pur_name         = $_POST['pur_name'];	
	$pur_designation  = $_POST['pur_designation'];	
	$pur_contact      = $_POST['pur_contact'];
	$pur_mail         = $_POST['pur_mail'];	
	$fin_name         = $_POST['fin_name'];
	$fin_designation  = $_POST['fin_designation'];	
	$fin_contact      = $_POST['fin_contact'];
	$fin_mail         = $_POST['fin_mail'];	

	$client_mobile1   = $_POST['txt_mobile1'];
	$client_mobile2   = $_POST['txt_mobile2'];
	$client_mail1     = $_POST['txt_mail_id1'];
	$client_mail2     = $_POST['txt_mail_id2'];
	$website     = $_POST['txt_website'];
	$enquiry_id     = $_POST['cus_id'];
	$Product     = $_POST['Product'];
	$services     = $_POST['services'];
	$Feedback     = $_POST['Feedback'];
	$Follup     = $_POST['Follup'];


	
	
	$clie_ins=$con->query("update new_plant_master set pan_no='$pan_no',mobile2='$client_mobile2',email2='$client_mail2',area='$area',pincode='$pincode',it_name='$iit_names',it_designation='$iit_desgs',it_mob1='$it_mob1',it_mob2='$it_mob2',it_mail1='$it_mail1',it_mail2='$it_mail2',it_landno='$it_landno',pur_name='$pur_name',pur_designation='$pur_designation',pur_contact='$pur_contact',pur_mail='$pur_mail',fin_name='$fin_name',fin_designation='$fin_designation',fin_contact='$fin_contact',fin_mail='$fin_mail',status='1',modified_by='$candidateid',modified_on=now() where id='$plant_id'");
	
	 echo "update new_plant_master set pan_no='$pan_no',mobile2='$client_mobile2',email2='$client_mail2',area='$area',pincode='$pincode',it_name='$iit_names',it_designation='$iit_desgs',it_mob1='$it_mob1',it_mob2='$it_mob2',it_mail1='$it_mail1',it_mail2='$it_mail2',it_landno='$it_landno',pur_name='$pur_name',pur_designation='$pur_designation',pur_contact='$pur_contact',pur_mail='$pur_mail',fin_name='$fin_name',fin_designation='$fin_designation',fin_contact='$fin_contact',fin_mail='$fin_mail',status='1',modified_by='$candidateid',modified_on=now() where id='$plant_id'";
	
	$pla_ins=$con->query("update new_client_master set status='1',modified_by='$candidateid',modified_on=now() where id='$client_id'");
	
}
?>