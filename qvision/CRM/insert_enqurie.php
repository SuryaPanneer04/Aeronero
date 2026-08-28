<?php
require '../config.php';
require '../../user.php';
$candidateid=$_SESSION['candidateid'];

$Call_type=$_REQUEST['Call_type'];
$date=$_REQUEST['date'];
$Client_type=$_REQUEST['Client_type'];
$Address=$_REQUEST['Address'];
$area=$_REQUEST['txt_area_1'];
$pincode=$_REQUEST['txt_pincode_1'];
$client_depart=$_REQUEST['client_depart'];

$it_name=$_REQUEST['txt_client_name_1'];
$it_designation=$_REQUEST['txt_client_desig_1'];
$it_mob1=$_REQUEST['txt_mobileone_1'];
$it_mob2=$_REQUEST['txt_mobiletwo_1'];
$it_mail1=$_REQUEST['txt_mail_idone_1'];
$it_mail2=$_REQUEST['txt_mail_idtwo_1'];
$it_landno=$_REQUEST['txt_landno_1'];
$Product=$_REQUEST['Product'];
$list=$_REQUEST['services'];
$Feedback=$_REQUEST['Feedback'];
$Follup=$_REQUEST['Follup'];
$companys=$_REQUEST['companys'];
$Department=$_REQUEST['Department'];


$Department1=$_REQUEST['Departments_id'];
$employee1=$_REQUEST['employees_id'];
$client_id=$_REQUEST['client_exist_id'];

echo$client_depart;
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

if($Client_type==1)
{

$employee=$_REQUEST['employees'];

$Location=$_REQUEST['location'];
$Company_name=$_REQUEST['Company_name'];

$sql11=$con->query("insert into enquiry(`Call_type`, `date`, `Client_type`, `Company_name`, `Location`,`Address`,`area`,`pincode`,`client_department`,
	`it_name`,`it_designation`,`it_mob1`,`it_mob2`,`it_mail1`,`it_mail2`,`it_landno`,`Client_id`,`Product`,`list`,`Feedback`, `Follup`, `companys`, `Department`, `employee`,  `created_by`, `created_on`)
	values('$Call_type','$date','$Client_type','$Company_name','$Location','$Address','$area','$pincode','$client_depart','$it_name','$it_designation','$it_mob1','$it_mob2','$it_mail1','$it_mail2','$it_landno','$client_id','$Product','$list','$Feedback','$Follup','$companys','$Department1','$employee1','$candidateid',now())");
	
	
	/* echo  "insert into Enquiry(`Call_type`, `date`, `Client_type`, `Company_name`, `Location`,`Address`,`area`,`pincode`,`client_department`,
	`it_name`,`it_designation`,`it_mob1`,`it_mob2`,`it_mail1`,`it_mail2`,`it_landno`,`Client_id`,`Product`,`list`,`Feedback`, `Follup`, `companys`, `Department`, `employee`,  `created_by`, `created_on`)
	values('$Call_type','$date','$Client_type','$Company_name','$Location','$Address','$area','$pincode','$client_depart','$it_name','$it_designation','$it_mob1','$it_mob2','$it_mail1','$it_mail2','$it_landno','$client_id','$Product','$list','$Feedback','$Follup','$companys','$Department1','$employee1','$candidateid',now())"; */
	 
	
	
/* 	echo "exisiting";
	
	echo "insert into Enquiry(`Call_type`, `date`, `Client_type`, `Company_name`, `Location`,`Address`,`area`,`pincode`,`client_department`,
	`it_name`,`it_designation`,`it_mob1`,`it_mob2`,`it_mail1`,`it_mail2`,`it_landno`,`Client_id`,`Product`,`list`,`Feedback`, `Follup`, `companys`, `Department`, `employee`,  `created_by`, `created_on`) values('$Call_type','$date','$Client_type','$Company_name','$Location','$Address','$area','$pincode','$client_depart','$it_name','$it_designation','$it_mob1','$it_mob2','$it_mail1','$it_mail2','$it_landno','$client_id','$Product','$list','$Feedback','$Follup','$companys','$Department1','$employee1','1',now())"; */
	
}else if($Client_type==2){
$employee=$_REQUEST['employee'];
$Location=$_REQUEST['newlocation'];	
$Company_name=$_REQUEST['new_company_name'];

$sql11=$con->query("insert into enquiry(`Call_type`,`date`,`Client_type`,`Company_name`, `Location`,`Address`,`area`,`pincode`,
`client_department`,`it_name`,`it_designation`,`it_mob1`,`it_mob2`,`it_mail1`,`it_mail2`,`it_landno`,`Product`,`list`,`Feedback`,`Follup`, `companys`, `Department`,`employee`,`created_by`,`created_on`) 
 values('$Call_type','$date','$Client_type','$Company_name','$Location','$Address','$area','$pincode','$client_depart',
 '$it_name','$it_designation','$it_mob1','$it_mob2','$it_mail1','$it_mail2','$it_landno','$Product','$list','$Feedback','$Follup',
 '$companys','$Department','$employee','$candidateid',now())");
 
/*  echo  "insert into Enquiry(`Call_type`,`date`,`Client_type`,`Company_name`, `Location`,`Address`,`area`,`pincode`,
`client_department`,`it_name`,`it_designation`,`it_mob1`,`it_mob2`,`it_mail1`,`it_mail2`,`it_landno`,`Product`,`list`,`Feedback`,`Follup`, `companys`, `Department`,`employee`,`created_by`,`created_on`) 
 values('$Call_type','$date','$Client_type','$Company_name','$Location','$Address','$area','$pincode','$client_depart',
 '$it_name','$it_designation','$it_mob1','$it_mob2','$it_mail1','$it_mail2','$it_landno','$Product','$list','$Feedback','$Follup',
 '$companys','$Department','$employee','$candidateid',now())"; */
 
/*  echo "new";
 echo "insert into Enquiry(`Call_type`,`date`,`Client_type`,`Company_name`, `Location`,`Address`,`area`,`pincode`,
`client_department`,`it_name`,`it_designation`,`it_mob1`,`it_mob2`,`it_mail1`,`it_mail2`,`it_landno`,`Product`,`list`,`Feedback`,`Follup`, `companys`, `Department`,`employee`,`created_by`,`created_on`) 
 values('$Call_type','$date','$Client_type','$Company_name','$Location','$Address','$area','$pincode','$client_depart',
 '$it_name','$it_designation','$it_mob1','$it_mob2','$it_mail1','$it_mail2','$it_landno','$Product','$list','$Feedback','$Follup',
 '$companys','$Department','$employee','1',now())"; */
}


?>