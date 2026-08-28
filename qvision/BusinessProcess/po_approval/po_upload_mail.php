<?php require '../../connect.php'; 
require '../../user.php'; 
require '../../PHPMailer/PHPMailerAutoload.php';

$enquiry_id=$_REQUEST['enquiry_id'];  
$userrole=$_SESSION['userrole'];
$deatsils=$con->query("SELECT fecrm.feedback_date,fecrm.feedback,fecrm.Feedback,fecrm.feedback_id, zud.full_name FROM `feedback_enquiry_crm` fecrm join z_user_master zud on fecrm.creaded_by=zud.candidate_id where fecrm.enquiry_id='$enquiry_id'");
$data=$deatsils->fetch();
$user_id=$data['enquiry_id'];
   $user_name=$data['full_name'];
   $Feedback=$data['Feedback']; 
   $username=$data['user_name']; 

$mail = new PHPMailer;
$mail->IsSMTP(); 
$mail->Mailer = "smtp";
$mail->Host = "smtp.zoho.com";                                    // Set mailer to use SMTP
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'laxmipriya@bluebase.in';                 // SMTP username
$mail->Password = 'Laxmi@2021#';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
$mail->Port = 465;
$mail->From = 'laxmipriya@bluebase.in';
$mail->FromName = 'Marketing Head Approval';
$mail->AddAddress($sendmail , $username);		//Adds a "To" addresss
//$mail->addAddress("laxmipriya@bluebase.in");     // Add a recipient
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                 // Set email format to HTML
$subject="PO Approved by Marketing Head..";			
	$html_table = 'Dear&nbsp;&nbsp;'. $user_name.',  <br> 
		&nbsp;&nbsp;	This Mail regarding your PO approved.';
		
	$html_table .=' </table>';
	$html_table .=' <h4>Thanks & Regards,</h4><br>
	<p>Recruitment</p>';
	$mail->Subject =$subject;
	$mail->Body =$html_table;
	
	$mail_recruiter=18;
$sql2= $con->query("Update emp_personal_details set status='$mail_recruiter' where emp_id='$user_id'");
$sql2= $con->query("Update technical_team_details set head_status='$mail_recruiter' where candidate_id='$user_id'");
$sql2= $con->query("Update z_user_master set user_group_code='ROLE-007' where candidate_id='$user_id'");
$sql1= $con->query("Update recruiter_details set status_recruiter='$mail_recruiter' where candidate_id='$user_id'");
$sql3= $con->query("Update candidate_form_details set status='$mail_recruiter' where id='$user_id'");
$sql4= $con->query("Update ctc_approval_table set status='$mail_recruiter' where candidate_id='$user_id'");
$sql4= $con->query("Update md_commands set status='$mail_recruiter' where candidate_id='$user_id'");

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
	echo "0";
} 
else {
    echo 'Message has been sent';
	echo "1";
}
?>