<?php
require '../../../connect.php';
Session_start();

?>
<?php
$userrole=$_SESSION['userrole'];
$user_id=$_SESSION['userid'];
$id=$_REQUEST['get_id'];


	$location         = $_REQUEST['Location'];
	$state            = $_REQUEST['state_1'];
    $city             = $_REQUEST['city_1'];
	$gst_no           = $_REQUEST['txt_gst_no'];
	$pan_no           = $_REQUEST['txt_pan_no_1'];
	$address          = $_REQUEST['txt_address_1'];
	$area             = $_REQUEST['txt_area_1'];
	$pincode          = $_REQUEST['txt_pincode_1'];
	$contact_person          = $_REQUEST['txt_client_name'];
	$designation          = $_REQUEST['txt_client_desig'];
	$mobile1          = $_REQUEST['txt_mobile1'];
	$mobile2          = $_REQUEST['txt_mobile2'];
	$email1          = $_REQUEST['txt_mail_id1'];
	$email2          = $_REQUEST['txt_mail_id2'];
	$it_name          = $_REQUEST['txt_client_name_1'];
	$it_desg          = $_REQUEST['txt_client_desig_1'];	
	$it_mob1          = $_REQUEST['txt_mobileone_1'];
	$it_mob2          = $_REQUEST['txt_mobiletwo_1'];
	$it_mail1         = $_REQUEST['txt_mail_idone_1'];
	$it_mail2         = $_REQUEST['txt_mail_idtwo_1'];	
	$it_landno        = $_REQUEST['txt_landno_1'];	
	$pur_name         = $_REQUEST['pur_name_1'];	
	$pur_designation  = $_REQUEST['pur_designation_1'];	
	$pur_contact      = $_REQUEST['pur_contact_1'];
	$pur_mail         = $_REQUEST['pur_mail_1'];	
	$fin_name         = $_REQUEST['fin_name_1'];
	$fin_designation  = $_REQUEST['fin_designation_1'];	
	$fin_contact      = $_REQUEST['fin_contact_1'];
	$fin_mail         = $_REQUEST['fin_mail_1'];	
	$status           = $_REQUEST['status'];

	$status_value=$status;
	if($status_value=="Active" || $status_value=="1"){ $value="1"; 
	}else{ $value="2";}

	$update_sql=$con->query("update new_plant_master set 
	location='$location',state='$state',city='$city',gst_no='$gst_no',pan_no='$pan_no',contact_person='$contact_person',designation='$designation',mobile1='$mobile1',mobile2='$mobile2',email1='$email1',email2='$email2',address='$address',area='$area',pincode='$pincode',it_name='$it_name',it_designation='$it_desg',it_mob1='$it_mob1',it_mob2='$it_mob2',it_mail1='$it_mail1',it_mail2='$it_mail2',
	it_landno='$it_landno',pur_name='$pur_name',pur_designation='$pur_designation',pur_contact='$pur_contact',pur_mail='$pur_mail',fin_name='$fin_name',fin_designation='$fin_designation',fin_contact='$fin_contact',fin_mail='$fin_mail',status='$value',flow='1',modified_on=NOW(),modified_by='$user_id' where id='$id'");
	

	
 if($update_sql)
{
	echo "1";
	
}
else{
echo "2";
} 

?>