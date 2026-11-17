<?php 
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];

$qid=$_REQUEST['id']; 
$enquiry_id=$_REQUEST['enquiry_id']; 
$cost_sheet_no=$_REQUEST['cost_sheet_no']; 

$sel=$con->query("update po_generate set md_status='1',md_approved_by='$candidateid',po_upload_status='1' where cost_sheet_no='$cost_sheet_no'");

$update_query = $con->query("update cost_sheet_entry set status ='9' WHERE cost_sheet_no= '$cost_sheet_no'");  
$insert_query2= $con->query("Update enquiry set status='9' where id='$enquiry_id'");

require '../../../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';
	
$mail = new PHPMailer;

// DEBUG OFF and Timeout Added
$mail->SMTPDebug = 0; 
$mail->Timeout = 5;

$mail->Mailer = "smtp";
$mail->IsSMTP(true); 
$mail->Port = 587;
$mail->Host = 'mail2.ssinformation.in';        
$mail->SMTPAuth = true;                              
$mail->Username = 'test1@ssinformation.in';
$mail->Password = 'dqR8mdSzsb';                           
$mail->SMTPSecure = 'tls';                            
$mail->SMTPOptions = [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
		'allow_self_singed' => true,
    ]
];
$mail->From = 'test1@ssinformation.in';
$mail->FromName = 'Marketing Head Approval..';
$mail->AddAddress('karthick@ssinformation.in', 'Karthick');		
$mail->WordWrap = 50;                                 
$mail->isHTML(true);                                 
$subject="PO Approved by Marketing Head.";			
$html_table = 'Dear&nbsp;&nbsp; Karthick,  <br> 
    &nbsp;&nbsp;	This Mail regarding Marketing Level 2 PO approved and waiting for Finance Approve.';
    
$html_table .=' </table>';
$html_table .=' <h4>Thanks & Regards,</h4><br>
<p>SS Information Services Pvt Ltd</p>';
$mail->Subject =$subject;
$mail->Body =$html_table;

// Mail Sent silently
$mail->send();

if($sel) {
	echo 1;
} else {
	echo 0;
}
?>