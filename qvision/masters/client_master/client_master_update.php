<?php
require '../../../connect.php';
Session_start();
?>

<?php
$user_id =$_SESSION['userid'];
if(isset($_REQUEST['submit']))
{   
    $id=$_REQUEST['id'];
	$company_id    = $_REQUEST['company_name'];
	$department_id = $_REQUEST['Department'];
	$employee_id   = $_REQUEST['employee'];
	$org_name      = $_REQUEST['txt_org_name'];
	$org_type      = $_REQUEST['client_type'];
	$client_name   = $_REQUEST['txt_client_name'];
	$client_desig  = $_REQUEST['txt_client_desig'];
	$mobile1       = $_REQUEST['txt_mobile1'];
	$mobile2       = $_REQUEST['txt_mobile2'];
	$land_lineno   = $_REQUEST['txt_landno'];
	$mailid1       = $_REQUEST['txt_mail_id1'];
	$mailid2       = $_REQUEST['txt_mail_id2'];
	$address1      = $_REQUEST['txt_address1'];
	$address2      = $_REQUEST['txt_address2'];
	$area          = $_REQUEST['txt_area'];
	$town_city     = $_REQUEST['txt_town'];
	$pincode       = $_REQUEST['txt_pincode'];
	$district      = $_REQUEST['txt_district'];
	$state         = $_REQUEST['txt_state'];
	$country       = $_REQUEST['txt_country'];
	$gst_no        = $_REQUEST['txt_gst_no'];
	$website       = $_REQUEST['txt_website'];
	$status        = $_REQUEST['status'];
	
	$update_sql=$con->query("update client_master set 
	company_id='$company_id',department_id='$department_id',employee_id='$employee_id',client_name='$client_name',org_name='$org_name',org_type='$org_type',designation='$client_desig',mobile_no1='$mobile1',mobile_no2='$mobile2',land_line_no='$land_lineno',email_id1='$mailid1',email_id2='$mailid2',address1='$address1',
	address2='$address2',area='$area',town_city='$town_city',pincode='$pincode',district='$district',state='$state',country='$country',gst_no='$gst_no',website ='$website',status='$status',flow='1',created_by='$user_id',modified_on=NOW(),modified_by='$user_id' where id='$id' ");
	  
	  echo "update client_master set 
	company_id='$company_id',department_id='$department_id',employee_id='$employee_id',client_name='$client_name',org_name='$org_name',org_type='$org_type',designation='$client_desig',mobile_no1='$mobile1',mobile_no2='$mobile2',land_line_no='$land_lineno',email_id1='$mailid1',email_id2='$mailid2',address1='$address1',
	address2='$address2',area='$area',town_city='$town_city',pincode='$pincode',district='$district',state='$state',country='$country',gst_no='$gst_no',website ='$website',status='$status',flow='1',created_by='$user_id',modified_on=NOW(),modified_by='$user_id' where id='$id' ";exit;
	
	
if($update_sql)
{
	echo "<script>alert('Client Details Updated Successfuly');</script>";
	header("location:index.php");
	
	
}
}
?>