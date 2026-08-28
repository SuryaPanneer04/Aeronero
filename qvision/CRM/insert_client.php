<?php
require '../config.php';
Session_start();
$user_id =$_SESSION['userid'];
//$account_manager_id    = $_REQUEST['ac_managerid'];
    $enquiry_id    = $_REQUEST['id'];
	$department_id    = $_REQUEST['Department_id'];
	$employee_id   	  = $_REQUEST['employee_id'];
	$org_type         = $_REQUEST['client_type'];
	$website          = $_REQUEST['txt_website'];
	$client_org_name  = $_REQUEST['txt_org_name'];
	$location         = $_REQUEST['Location'];
	$state            = $_REQUEST['state_1'];
	$city             = $_REQUEST['city_1'];
	$gst_no           = $_REQUEST['txt_gst_no'];
	$pan_no           = $_REQUEST['txt_pan_no_1'];
	$address          = $_REQUEST['txt_address_1'];
	$area             = $_REQUEST['txt_area_1'];
	$pincode          = $_REQUEST['txt_pincode_1'];
	$client_depart    = $_REQUEST['client_depart'];
	$it_name          = $_REQUEST['txt_client_name_1'];
	$it_desg          = $_REQUEST['txt_client_desig_1'];	
	$it_mob1          = $_REQUEST['txt_mobileone_1'];
	$it_mob2          = $_REQUEST['txt_mobiletwo_1'];
	$it_mail1         = $_REQUEST['txt_mail_idone_1'];
	$it_mail2         = $_REQUEST['txt_mail_idtwo_1'];	
	$it_landno        = $_REQUEST['txt_landno_1'];			
	$status           = $_REQUEST['status_1'];
	$flow = 1;
	
	
	if($client_depart=="IT Department")
	{
		$client_value=1;
	}elseif($client_depart=="Purchase Department")
	{
		$client_value=2;
	}elseif($client_depart=="Finance Department")
	{
		$client_value=3;
	}elseif($client_depart=="Others")
	{
		$client_value=4;
	}
	

	$insert_query1=$con->query("insert into new_client_master (department_id,employee_id,org_name,org_type,website,status,flow,created_by,created_on)values('$department_id','$employee_id','$client_org_name','$org_type','$website','$status','$flow','$user_id',NOW())");
	
	
	if($insert_query1){
		
		$stmt=$con->query("select a.id as last_client_id from new_client_master a ORDER BY id DESC LIMIT 1");	
		$stmt->execute();
		$row=$stmt->fetch();
		$client_id=$row['last_client_id'];
		
		$insert_query2=$con->query("insert into new_plant_master (client_id,client_org_name,location,state,city,gst_no,pan_no,address,area,pincode,client_department,it_name,it_designation,it_mob1,it_mob2,it_mail1,	it_mail2,it_landno,status,flow,created_by,created_on)values('$client_id','$client_org_name','$location','$state','$city','$gst_no','$pan_no',
		'$address','$area','$pincode','$client_value','$it_name','$it_desg','$it_mob1','$it_mob2','$it_mail1','$it_mail2','$it_landno','$status',
		'1','$user_id',NOW())");
		
         /*  echo "insert into new_plant_master (client_id,client_org_name,location,state,city,gst_no,pan_no,address,area,pincode,client_department,it_name,it_designation,it_mob1,it_mob2,it_mail1,	it_mail2,it_landno,status,flow,created_by,created_on)values('$client_id','$client_org_name','$location','$state','$city','$gst_no','$pan_no',
		'$address','$area','$pincode','$client_value','$it_name','$it_desg','$it_mob1','$it_mob2','$it_mail1','$it_mail2','$it_landno','$status',
		'1','$user_id',NOW())"; 
		exit; */
		
	$update_sql=$con->query("UPDATE `enquiry` SET `flag`='$flow',`client_id`='$client_id' WHERE id='$enquiry_id'");
	
	//echo "UPDATE `enquiry` SET `flag`='$flag',`client_id`='$client_id' WHERE id='$enquiry_id'";
	
	echo "1";
	
	}else{
		
		echo "2";
		
	}
		
?>