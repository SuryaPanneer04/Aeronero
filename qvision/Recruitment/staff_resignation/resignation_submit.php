<?php
require '../../../connect.php';
include("../../../user.php");
$user = isset($_SESSION['userid']) ? $_SESSION['userid'] : 0;
$candidateid = isset($_SESSION['candidateid']) ? $_SESSION['candidateid'] : 0;

$uploadDir = 'resignation_file_upload/';  //File Upload Path.

require '../../../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';


$filesArr3 = isset($_FILES["resignation_letter"]) ? $_FILES["resignation_letter"] : null; //Resignation Letter upload.

//Resignation Letter
$uploadedFile = ''; 
$fileName = '';
// File upload path  
if ($filesArr3 && isset($filesArr3['name']) && is_array($filesArr3['name'])) {
	foreach($filesArr3['name'] as $key=>$val)
	{
		if (!empty($filesArr3['name'][$key])) {
			$fileName = basename($filesArr3['name'][$key]);  
			$targetFilePath = $uploadDir . $fileName; 
			  
			// Check whether file type is valid  
			$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
			
			// Upload file to server  
			if(move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath)){  
				$uploadedFile .= $fileName.',';  
			}
		}
	}
}


$emp_name = '';
$dep = 0;
$reportingPerson = 0;
$FULLNAME = '';
$report_per_candid = 0;
$SENDMAIL = '';
$FROMADDRESS = '';

$upd = false;

try {
	if ($con) {
		$candidateid = intval($candidateid);
		$dep_ids = $con->query("select emp_name,dep_id,reporting_person from staff_master where candid_id='$candidateid'");
		if ($dep_ids) {
			$dep_id = $dep_ids->fetch();
			$emp_name = isset($dep_id['emp_name']) ? $dep_id['emp_name'] : '';
			$dep = isset($dep_id['dep_id']) ? intval($dep_id['dep_id']) : 0;
			$reportingPerson = isset($dep_id['reporting_person']) ? intval($dep_id['reporting_person']) : 0; 
		}

		$reporting_per = $con->query("select id,candid_id,emp_name from staff_master where id='$reportingPerson'");
		if ($reporting_per) {
			$report = $reporting_per->fetch();
			$FULLNAME = isset($report['emp_name']) ? $report['emp_name'] : ''; 
			$report_per_candid = isset($report['candid_id']) ? intval($report['candid_id']) : 0;  
		}

		$reporting_canid_id = $con->query("select email_id from z_user_master where candidate_id='$report_per_candid'");
		if ($reporting_canid_id) {
			$can_id_report = $reporting_canid_id->fetch();
			$SENDMAIL = isset($can_id_report['email_id']) ? $can_id_report['email_id'] : '';
		}

		$emp_mailId = $con->query("select email_id from z_user_master where candidate_id='$candidateid'");
		if ($emp_mailId) {
			$emp_mail = $emp_mailId->fetch();
			$FROMADDRESS = isset($emp_mail['email_id']) ? $emp_mail['email_id'] : '';
		}
		
		$relieve_reason = isset($_REQUEST['relieve_reason']) ? $_REQUEST['relieve_reason'] : '';
		$status = 1;
		
		$upd = $con->query("insert into resignation_form_details (candidate_id,candidate_dep_id,reason,remarks,applied_date,reporting_person,status)values('$candidateid','$dep','$relieve_reason','$fileName',now(),'$reportingPerson','$status')");
	}
} catch (Exception $e) {
	// Suppress crash, let $upd remain false
	// echo $e->getMessage();
}

if($upd)
{
	$mail = new PHPMailer;
	$mail->SMTPDebug = 0; // Disabled debug for AJAX compatibility
	$mail->Mailer = "smtp";
	$mail->IsSMTP(true); 
	$mail->Port = 587;
	$mail->Host = 'webmail.quadsel.in';        
	$mail->SMTPAuth = true;                              // Enable SMTP authentication
	$mail->Username = 'hr@quadsel.in';
	$mail->Password = 'Hr@2024#';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
	$mail->SMTPOptions = [
		'ssl' => [
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_singed' => true,
		]
	];
	$mail->From = 'hr@quadsel.in';		//Sets the From email address for the message
	$mail->FromName = $emp_name ;
	
	if (!empty($SENDMAIL)) {
		$mail->AddAddress($SENDMAIL, $FULLNAME);		//Adds a "To" address
	}
	$mail->AddCC('hr@ssinformation.in'); // CC to HR to know about the Resignation.
	$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
	$mail->isHTML(true);                                 // Set email format to HTML

	$subject="Applying for Resignation ";	
		
	$html_table = '<div style="color: #178ae3;">Dear&nbsp;&nbsp;'. htmlspecialchars($FULLNAME).',  <br> <br>
		&nbsp;&nbsp;' . htmlspecialchars($relieve_reason) .'.<br><br> ';
		
	$html_table .=' <h4>Thanks & Regards,</h4><br>
	<p>'.htmlspecialchars($emp_name).'</p>
	<p>SS Information Systems Pvt Ltd.</p></div>';

	$mail->Subject =$subject;
	$mail->Body =$html_table;

	if(!empty($SENDMAIL) && !$mail->send()) {
		// Mail sending failed, but update succeeded
		echo 1;
	} 
	else {
		echo 1;
	} 
}
else
{
	echo 0;
}
?>
