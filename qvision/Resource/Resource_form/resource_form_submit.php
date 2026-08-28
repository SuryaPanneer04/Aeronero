<?php
include('../../../connect.php');
include('../../../user.php');

$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : 0;

$uploadDir = 'resume_upload/';

$org_name = isset($_REQUEST['Client_Org_Name']) ? $_REQUEST['Client_Org_Name'] : ''; 
$location = isset($_REQUEST['location']) ? $_REQUEST['location'] : ''; 

$source = isset($_REQUEST['source']) ? $_REQUEST['source'] : '';
$consl_name = isset($_REQUEST['consl_name']) ? $_REQUEST['consl_name'] : '';
$referal_type = isset($_REQUEST['referal_type']) ? $_REQUEST['referal_type'] : '';

$ref_name = isset($_REQUEST['get_ref_name']) ? $_REQUEST['get_ref_name'] : '';
$ref_name2 = isset($_REQUEST['get_ref_name2']) ? $_REQUEST['get_ref_name2'] : '';

$consl_date = isset($_REQUEST['consl_date']) ? $_REQUEST['consl_date'] : '';
$pos = isset($_REQUEST['position']) ? $_REQUEST['position'] : '';
$pos_get = explode(".", $pos);
$position = isset($pos_get[0]) ? $pos_get[0] : '';
$jdcode = isset($pos_get[1]) ? $pos_get[1] : '';

$first_name = isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : '';
$last_name = isset($_REQUEST['last_name']) ? $_REQUEST['last_name'] : '';
$full_name = trim($first_name . " " . $last_name);
$gender = isset($_REQUEST['gender']) ? $_REQUEST['gender'] : '';
$phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : '';
$whatsapp = isset($_REQUEST['whatsapp']) ? $_REQUEST['whatsapp'] : '';
$mail = isset($_REQUEST['mail']) ? $_REQUEST['mail'] : '';
$adharnumber = isset($_REQUEST['adharnumber']) ? $_REQUEST['adharnumber'] : '';
$degree = isset($_REQUEST['degree']) ? $_REQUEST['degree'] : '';
$university = isset($_REQUEST['university']) ? $_REQUEST['university'] : '';
$year_of_pass = isset($_REQUEST['year_of_pass']) ? $_REQUEST['year_of_pass'] : '';
$percentage = isset($_REQUEST['percentage']) ? $_REQUEST['percentage'] : '';
$EmployeeStatus = isset($_REQUEST['EmployeeStatus']) ? $_REQUEST['EmployeeStatus'] : '';
$companyname = isset($_REQUEST['companyname']) ? $_REQUEST['companyname'] : '';
$no_of_year_exp = isset($_REQUEST['no_of_year']) ? $_REQUEST['no_of_year'] : '';
$cer_status = isset($_REQUEST['cer_status']) ? $_REQUEST['cer_status'] : '';
$certificate = isset($_REQUEST['certificate']) ? $_REQUEST['certificate'] : '';
$validity_to = isset($_REQUEST['validity']) ? $_REQUEST['validity'] : '';
$cer_from = isset($_REQUEST['cer_from']) ? $_REQUEST['cer_from'] : '';

$filesArr3 = isset($_FILES['file']) ? $_FILES['file'] : [];

$status = 1;

if ($referal_type == "Internal Referal") {
	$sql_asset = $ref_name;
} else if ($referal_type == "External Referal") {
	$sql_asset = $ref_name2;
} else {
	$sql_asset = '';
}

//Resume
$uploadedFile = '';
// File upload path  
if (!empty($filesArr3) && isset($filesArr3['name']) && is_array($filesArr3['name'])) {
	foreach ($filesArr3['name'] as $key => $val) {
		$fileName = basename($filesArr3['name'][$key]);
		$targetFilePath = $uploadDir . $fileName;

		// Check whether file type is valid  
		$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

		// Upload file to server  
		if (move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath)) {
			$uploadedFile .= $fileName . ',';
		}
	}
}

$fileName = rtrim($uploadedFile, ','); // Just in case to remove trailing comma or use the last one

$interview_round = '';
if ($con) {
	$candidate = $con->query("SELECT interview_round_level FROM jobdescription_form_details WHERE jdcode = '$jdcode'");
	if ($candidate) {
		$approve_round = $candidate->fetch();
		$interview_round = isset($approve_round['interview_round_level']) ? $approve_round['interview_round_level'] : '';
	}
}

$sql = false;

if ($con) {
	if ($interview_round != '' && $interview_round != '0') //interview round not empty
	{
		$sql = $con->query("insert into resource_form_detail (source,jdid,client_org_name,location,consultant_name,referal_type,referal_name,date, position, first_name, last_name, gender, mobile, whatsapp,mail,aadhar_no, degree, university, year_of_pass, percentage, employement_status, company_name, year_experience,certification_status, certification, validity, certified_from,resume,status, created_by, created_on,interview_round,old_status)values('$source','$jdcode','$org_name','$location','$consl_name','$referal_type','$sql_asset','$consl_date','$position','$first_name','$last_name','$gender','$phone','$whatsapp','$mail','$adharnumber','$degree','$university','$year_of_pass','$percentage','$EmployeeStatus','$companyname','$no_of_year_exp','$cer_status','$certificate','$validity_to','$cer_from','$fileName',1,'$userid',now(),'$interview_round',0)");

		if ($sql) {
			$resources_id = $con->query("SELECT id from resource_form_detail ORDER BY id DESC LIMIT 1");
			$res_id = $resources_id ? $resources_id->fetch() : false;
			$resourceID = $res_id ? $res_id['id'] : 0;

			if ($EmployeeStatus == "Fresher") {
				$inserts = $con->query("INSERT INTO candidate_form_details(`resource_id`,`position`,`first_name`,`client_org_name`,`location`,`last_name`, `gender`, `phone`,`alternative_phone`,`mail`, `adharnumber`, `educationalDetails`, `EmployeeStatus`, `year_of_pass`,`resume`, `status`, `created_by`, `created_on`, `interview_round_level`,`old_status`) VALUES ('$resourceID','$position','$first_name','$org_name','$location', '$last_name', '$gender', '$phone', '$whatsapp','$mail', '$adharnumber', '$degree', '$EmployeeStatus', '$year_of_pass','$fileName',1,'$userid',now(),'$interview_round',0)");
			} else {
				$inserts = $con->query("INSERT INTO candidate_form_details(resource_id, position,first_name,client_org_name,location,last_name,gender,phone,alternative_phone,mail,adharnumber,educationalDetails, EmployeeStatus,companyname,no_of_year,resume,status,created_by, created_on, interview_round_level,old_status)VALUES ('$resourceID','$position','$first_name','$org_name','$location','$last_name', '$gender','$phone','$whatsapp', '$mail', '$adharnumber', '$degree', '$EmployeeStatus','$companyname', '$no_of_year_exp','$fileName', 1 ,'$userid',now(),'$interview_round',0)");
			}

			if ($inserts) {
				$edit_id = $con->query("SELECT id FROM candidate_form_details order by id desc limit 1");
				$res = $edit_id ? $edit_id->fetch() : false;
				$candidate_id = $res ? $res['id'] : 0;

				$password = md5("Welcome@123");
				$ingenter = ($gender == 'female') ? 2 : 1;
				
				$insert = $con->query("insert into z_user_master(candidate_id,user_name,password,full_name,status,email_id,user_group_code,mobile_no,gender,created_by,created_on)
				values('$candidate_id','','','$full_name','1','$mail','ROLE-006','$phone','$ingenter','$userid',now())");
			}
		}
	}
	else // interview round is an empty
	{
		$sql = $con->query("insert into resource_form_detail (source,jdid,client_org_name,location,consultant_name,referal_type,referal_name,date, position, first_name, last_name, gender, mobile, whatsapp,mail,aadhar_no, degree, university, year_of_pass, percentage, employement_status, company_name, year_experience,certification_status, certification, validity, certified_from,resume,status, created_by, created_on,interview_round,old_status)values('$source','$jdcode','$org_name','$location','$consl_name','$referal_type','$sql_asset','$consl_date','$position','$first_name','$last_name','$gender','$phone','$whatsapp','$mail','$adharnumber','$degree','$university','$year_of_pass','$percentage','$EmployeeStatus','$companyname','$no_of_year_exp','$cer_status','$certificate','$validity_to','$cer_from','$fileName',1,'$userid',now(),'2',0)");
		
		if ($sql) {
			$resources_id = $con->query("SELECT id from resource_form_detail ORDER BY id DESC LIMIT 1");
			$res_id = $resources_id ? $resources_id->fetch() : false;
			$resourceID = $res_id ? $res_id['id'] : 0;

			if ($EmployeeStatus == "Fresher") {
				$inserts = $con->query("INSERT INTO candidate_form_details(resource_id,position,first_name,client_org_name,location,last_name, gender, phone,alternative_phone, mail, adharnumber, educationalDetails, EmployeeStatus, year_of_pass, resume, status, created_by, created_on, interview_round_level,old_status) VALUES ('$resourceID','$position','$first_name','$org_name','$location', '$last_name', '$gender', '$phone', '$whatsapp','$mail', '$adharnumber', '$degree', '$EmployeeStatus', '$year_of_pass','$fileName',1,'$userid',now(),'2',0)");
			} else {
				$inserts = $con->query("INSERT INTO candidate_form_details(resource_id,position,first_name,client_org_name,location,last_name,gender,phone,alternative_phone,mail,adharnumber, educationalDetails, EmployeeStatus, companyname, no_of_year, resume, status, created_by, created_on, interview_round_level,old_status)VALUES ('$resourceID','$position', '$first_name','$org_name','$location','$last_name', '$gender','$phone','$whatsapp', '$mail', '$adharnumber', '$degree', '$EmployeeStatus', '$companyname', '$no_of_year_exp','$fileName', 1 ,'$userid',now(),'2',0)");
			}

			if ($inserts) {
				$edit_id = $con->query("SELECT id FROM candidate_form_details order by id desc limit 1");
				$res = $edit_id ? $edit_id->fetch() : false;
				$candidate_id = $res ? $res['id'] : 0;

				$password = md5("Welcome@123");
				$ingenter = ($gender == 'female') ? 2 : 1;
				
				$insert = $con->query("insert into z_user_master(candidate_id,user_name,password,full_name,status,email_id,user_group_code,mobile_no,gender,created_by,created_on)
				values('$candidate_id','','','$full_name','1','$mail','ROLE-006','$phone','$ingenter','$userid',now())");
			}
		}
	}
}

if ($sql) {
	echo 1;
} else {
	echo 0;
}
?>