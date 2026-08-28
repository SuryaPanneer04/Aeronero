<?php 
require '../../../connect.php'; 
require '../../../user.php'; 
require '../../../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';

/* $enquiry_id=$_REQUEST['enquiry_id'];  
$userrole=$_SESSION['userrole'];
$deatsils=$con->query("SELECT fecrm.feedback_date,fecrm.feedback,fecrm.Feedback,fecrm.feedback_id, zud.full_name FROM `feedback_enquiry_crm` fecrm join z_user_master zud on fecrm.creaded_by=zud.candidate_id where fecrm.enquiry_id='$enquiry_id'");
$data=$deatsils->fetch();
$user_id=$data['enquiry_id'];
   $user_name=$data['full_name'];
   $Feedback=$data['Feedback']; 
   $username=$data['user_name'];  */


$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];

$costsheet_no=$_REQUEST['costsheet_no'];

$deatsils=$con->query("SELECT pg.so_number,pg.quote_no,pg.cost_sheet_no,pg.po_date,pg.po_upload_status,e.mail,zum.full_name,zum.user_name,cse.enquiry_id,cse.specification,cm.client_name,pg.marketing_approved_by FROM `po_generate` pg 
left JOIN z_user_master zum ON pg.created_by = zum.candidate_id 
left JOIN client_master cm on pg.created_by = cm.created_by 
left join cost_sheet_entry cse on pg.created_by=cse.candid_id 
left join enquiry e on e.id=cse.enquiry_id
where cse.cost_sheet_no=pg.cost_sheet_no and pg.cost_sheet_no = '$costsheet_no'");

// echo "SELECT pg.so_number,pg.quote_no,pg.cost_sheet_no,pg.po_date,pg.po_upload_status,zum.full_name,zum.user_name,cse.enquiry_id,cse.specification,cm.client_name,pg.md_approved_by FROM `po_generate` pg JOIN z_user_master zum ON pg.created_by = zum.candidate_id JOIN client_master cm on pg.created_by = cm.created_by join cost_sheet_entry cse on pg.created_by=cse.candid_id where cse.cost_sheet_no=pg.cost_sheet_no and pg.cost_sheet_no = '$costsheet_no'";
/* 
SELECT pg.so_number,pg.quote_no,pg.cost_sheet_no,pg.po_date,pg.po_upload_status,zum.full_name,zum.user_name,cse.enquiry_id,cse.specification,cm.client_name FROM `po_generate` pg JOIN z_user_master zum ON pg.created_by = zum.candidate_id JOIN client_master cm on pg.created_by = cm.created_by join cost_sheet_entry cse on pg.created_by=cse.candid_id where cse.cost_sheet_no=pg.cost_sheet_no and zum.user_id='$candidateid'"); */
	$data=$deatsils->fetch();
	//$user_id=$data['enquiry_id'];
	$user_name1=$data['full_name'];
    $username=$data['user_name']; 
	$client_name=$data['client_name'];
	$md_approve=$data['md_approved_by'];
	$mailerID=$data['mail'];
	$sel=$con->query("select * from z_user_master where candidate_id='$md_approve'");
	echo "select * from z_user_master where candidate_id='$md_approve'";
	$sfet=$sel->fetch();
	echo $approve_name=$sfet['full_name'];
	echo $client_name;
	echo $username;
	
$mail = new PHPMailer;
$mail->SMTPDebug = 2; 
$mail->Mailer = "smtp";
$mail->IsSMTP(true); 
$mail->Port = 587;
$mail->Host = 'mail2.ssinformation.in';        
$mail->SMTPAuth = true;                              // Enable SMTP authentication
$mail->Username = 'test1@ssinformation.in';
$mail->Password = 'dqR8mdSzsb';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->SMTPOptions = [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
		'allow_self_singed' => true,
    ]
];
$mail->From = 'test1@ssinformation.in';	
$mail->FromName = 'Finance Head Approval..';
$mail->AddAddress($username , $user_name1);		//Adds a "To" addresss
//$mail->addAddress("laxmipriya@bluebase.in");     // Add a recipient
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                 // Set email format to HTML
$subject="PO Approved by Finance Head.";			
	$html_table = 'Dear&nbsp;&nbsp;'. $user_name1.',  <br> 
		&nbsp;&nbsp;	This Mail regarding your PO approved.';
		
	$html_table .=' </table>';
	$html_table .=' <h4>Thanks & Regards,</h4><br>
	'. $username.'  <br> 
	<p>SS Information Services Pvt Ltd</p>';
	$mail->Subject =$subject;
	$mail->Body =$html_table;
	
	
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
	echo "0";
} 
else {
	

    echo 'Mail has been sent';
	//echo "1";
}
?>