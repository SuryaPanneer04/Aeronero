<?php
require '../../config.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$user=$_SESSION['userid'];
$candidateid=$_SESSION['candidateid'];
//$feedback=$_REQUEST['feedback'];
//$feedback_date=$_REQUEST['feedback_date'];
//$fed_date=$_REQUEST['fed_date'];
$id=$_REQUEST['id'];
//$remark=$_REQUEST['remark'];
  $enquiry_id    = $_REQUEST['id'];
	//$area             = $_REQUEST['txt_area_1'];
	//$pincode          = $_REQUEST['txt_pincode_1'];
//	$client_depart    = $_REQUEST['client_depart'];
//	$it_name          = $_REQUEST['txt_client_name_1'];
	/* $it_desg          = $_REQUEST['txt_client_desig_1'];	
	$it_mob1          = $_REQUEST['txt_mobileone_1'];
	$it_mob2          = $_REQUEST['txt_mobiletwo_1'];
	$it_mail1         = $_REQUEST['txt_mail_idone_1'];
	$it_mail2         = $_REQUEST['txt_mail_idtwo_1'];	
	$it_landno        = $_REQUEST['txt_landno_1'];	 */		
	//$status           = $_REQUEST['status_1'];
	$flow = 1;
	
	/* 
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
	} */
	$aa = $con->query("select a.*,b.*,b.id as idd from crm_calls a join crm_calls_feedback b on a.id=b.calls_id where a.id='$enquiry_id'");
$a1 = $aa->fetch();

$feedbackid=$a1['idd'];
$client_id=$a1['client_id'];
$feedback=$a1['feedback'];
$feedback_date=$a1['feedback_date'];
$Follup=$a1['date'];
$date=$a1['date'];
$Call_type=$a1['call_type'];
$Client_type=$a1['client_type'];
$client_name=$a1['client_name'];
$contact=$a1['contact'];
$whatsapp=$a1['whatsapp'];
$email=$a1['email'];
$website=$a1['website'];
$department_id=$a1['department'];
$employee_id=$a1['employee'];
$address=$a1['address'];

$Product=$a1['Product'];
$list=$a1['services'];


$Company_name=$a1['client_org'];

$alternate_mail=$a1['alternate_mail'];
$flag = '2';

  $sql11=$con->query("insert into enquiry(`Call_type`,`Calls_id`,`Calls_feedbackid`, `date`, `Client_type`, `Company_name`, `Location`,`Address`,`area`,`pincode`,`client_department`,
	`it_name`,`it_designation`,`it_mob1`,`it_mob2`,`it_mail1`,`it_mail2`,`it_landno`,`Client_id`,`Product`,`list`,`feedback`, `Follup`, `companys`, `Department`, `employee`,  `created_by`, `created_on`)
	values('$Call_type','$enquiry_id','$feedbackid','$date','$Client_type','$Company_name','$Location','$address','$area','$pincode','$client_depart','$client_name','$it_designation','$it_mob1','$it_mob2','$it_mail1','$it_mail2','$it_landno','$client_id','$Product','$list','$feedback','$Follup','$companys','$department_id','$employee_id','$user',now())"); 

echo "insert into enquiry(`Call_type`,`Calls_id`,`Calls_feedbackid`, `date`, `Client_type`, `Company_name`, `Location`,`Address`,`area`,`pincode`,`client_department`,
	`it_name`,`it_designation`,`it_mob1`,`it_mob2`,`it_mail1`,`it_mail2`,`it_landno`,`Client_id`,`Product`,`list`,`feedback`, `Follup`, `companys`, `Department`, `employee`,  `created_by`, `created_on`)
	values('$Call_type','$enquiry_id','$feedbackid','$date','$Client_type','$Company_name','$Location','$address','$area','$pincode','$client_depart','$client_name','$it_designation','$it_mob1','$it_mob2','$it_mail1','$it_mail2','$it_landno','$client_id','$Product','$list','$feedback','$Follup','$companys','$department_id','$employee_id','$user',now())";
	
	
	
	$aa1 = $con->query("select id from enquiry order by id desc");
$a11 = $aa1->fetch();
	$enqid=$a11['id'];
	

//$sql12=$con->query("Update crm_calls set status='3' where id='$id'"); 
$sql12=$con->query("Update crm_calls set enquiry_id='$enqid',status='3' where id='$id'"); 
/* echo "insert into Enquiry(`Call_type`, `date`, `Client_type`, `consultant`,`Company_name`, `Location`, `Address`, `Client`, `Designation`, `Mobile`, `mail`, `Product`,`Feedback`, `Follup`,`Department`, `employee`,  `created_by`, `created_on`) values('$Call_type',now(),'','','$Company_name','$Location','$Address','$Client','','$contact','$email','','','','','','$candidateid',now())"; */
/* $sql11=$con->query("insert into Enquiry(`Call_type`, `date`, `Client_type`, `Company_name`, `Location`, `Address`, `Client`, `Designation`, `Mobile`, `mail`, `Product`,`list`,`Feedback`, `Follup`, `Department`, `employee`,  `created_by`, `created_on`) values('$Call_type','$date','','$Company_name','$Location','$Address','$Client','','$contact','$email','','','','','','$employee','1',now())");  */

$sql11=$con->query("UPDATE `enquiry` SET `flag`='$flag',`status`='3',`client_id`='$client_id' WHERE calls_id='$enquiry_id'");
	//echo "UPDATE `enquiry` SET `flag`='$flag',`status`='3',`client_id`='$client_id' WHERE calls_id='$enquiry_id'";
?>