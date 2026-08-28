<?php
require '../config.php';
Session_start();

?>
<?php
	$user_id = isset($_SESSION['userid']) ? $_SESSION['userid'] : (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0);


	$org_type         = $_REQUEST['txt_org_name'];
	$str_arr = preg_split ("/\-/", $org_type); 
	$org_type_val     = $str_arr[0];
	$client_id        = array_pop($str_arr);
	array_shift($str_arr);
	$client_org_name  = implode("-", $str_arr);
	$location         = $_REQUEST['Locationz'];
	$state            = $_REQUEST['state_id'];
	$city             = $_REQUEST['city_1'];
	$gst_no           = $_REQUEST['txt_gst_no'];
	$pan_no           = $_REQUEST['sec'];
	$address          = $_REQUEST['txt_address_1'];
	$area             = $_REQUEST['txt_area_1'];
	$pincode          = $_REQUEST['txt_pincode_1'];
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
	$status           = $_REQUEST['status_1'];
	$ship_address     = $_REQUEST['ship_address'];
	$ship_location    = $_REQUEST['ship_location'];
	$ship_pincode     = $_REQUEST['ship_pincode'];
	$bill_address     = $_REQUEST['bill_address'];
	$bill_location     = $_REQUEST['bill_location'];
	$bill_pincode     = $_REQUEST['bill_pincode'];
	
		if($org_type == '' || $location == '' || $city == '' || ($org_type_val != '7' && $gst_no == '') || $status == ''){
			echo "0";
		}elseif($org_type != '' && $location != '' && $city != '' && ($org_type_val == '7' || $gst_no != '') && $status != ''){
			
	$query = "insert into new_plant_master(client_org_name,client_id,client_code,contact_person,designation,mobile1,mobile2,email1,email2,location,state,city,gst_no,pan_no,address,area,pincode,it_name,it_designation,it_mob1,it_mob2,it_mail1,it_mail2,it_landno,pur_name,pur_designation,pur_contact,pur_mail,fin_name,fin_designation,fin_contact,fin_mail,status,flow,created_by,created_on)
	values('$client_org_name','$client_id','','','','','','','','$location','$state','$city','$gst_no','$pan_no','$address','$area','$pincode','$it_name','$it_desg','$it_mob1','$it_mob2','$it_mail1','$it_mail2','$it_landno','$pur_name','$pur_designation','$pur_contact','$pur_mail','$fin_name',
	'$fin_designation','$fin_contact','$fin_mail','$status','1','$user_id',NOW())";

	$insert_sql = $con->query($query);

	if($insert_sql) {
		echo "1";
	} else {
		echo "2";
	}
		} else {
			echo "0";
		}


?>