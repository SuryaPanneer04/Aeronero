<?php 
require '../../connect.php'; 

require '../../user.php'; 

require '../../PHPMailer/PHPMailerAutoload.php';

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';

require '../../PHPMailer/src/PHPMailer.php';

require '../../PHPMailer/src/SMTP.php';

$id=$_SESSION['get_id']; echo $id;
$userrole=$_SESSION['userrole'];
$deatsils = $con->prepare("SELECT fecrm.enquiry_id,e.client,e.company_name,e.mail,fecrm.feedback,fecrm.feedback_id, zud.full_name FROM `feedback_enquiry_crm` fecrm right JOIN enquiry e ON e.id = fecrm.enquiry_id right join z_user_master zud on fecrm.created_by=zud.candidate_id where fecrm.enquiry_id='$id'");

echo "SELECT fecrm.enquiry_id,e.client,e.company_name,fecrm.feedback,fecrm.feedback_id, zud.full_name FROM `feedback_enquiry_crm` fecrm right JOIN enquiry e ON e.id = fecrm.enquiry_id right join z_user_master zud on fecrm.created_by=zud.candidate_id where fecrm.enquiry_id='$id'";
$deatsils->execute(); 
$data = $deatsils->fetch();

	//$data=$deatsils->fetch();
	$enquiry_id=$data['enquiry_id'];//echo $enquiry_id;
	$full_name=$data['full_name'];//echo '$$';echo $full_name;
	$Feedback=$data['Feedback']; 
	$client=$data['client']; //echo $client; echo '**';
	$mailer=$data['mail'];
	//$company_name=$data['Company_name'];echo $company_name;
	$candidateid=$_SESSION['candidateid'];
	$feedback=$_REQUEST['feedback'];
	$feedback_count=count($feedback);

//$date=$_REQUEST['date'];
$mail = new PHPMailer;
$mail->SMTPDebug = 2; 
$mail->Mailer = "smtp";
$mail->IsSMTP(true); 
$mail->Port = 587;
$mail->Host = 'webmail.quadsel.in';                                    // Set mailer to use SMTP
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'quote@quadsel.in';
$mail->Password = 'Q@2023';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->SMTPOptions = [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
		'allow_self_singed' => true,
    ]
];

$mail->From = 'quote@quadsel.in';
$mail->FromName = 'Enquiry Remainder Alert..';
$mail->AddAddress($mailer , $full_name);	
//$mail->AddAddress("subramanian.r@bluebase.in");		//Adds a "To" address
//$mail->addAddress("laxmipriya@bluebase.in");     // Add a recipient
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                 // Set email format to HTML
$subject="Enquiry remainder..";			

$html_table = 'Dear&nbsp;&nbsp;'. $client.',  <br> 
		&nbsp;&nbsp;	This Mail regarding your Enquiry remainder.';
		
	$html_table .=' </table>';
	$html_table .=' <h4>Thanks & Regards,</h4><br>
	'.$full_name.'  <br> 
	<p>Quadsel Systems Pvt. Ltd.</p>';
	$mail->Subject =$subject;
	$mail->Body =$html_table;
	

 if($candidateid=='')
{
	$candidateid=0;//admin
}
/* 
 for($i=0;$i<$feedback_count;$i++)
{

$feedbacks= $feedback[$i];
$dates= $date[$i];
  $sql1=$con->query("insert into `feedback_enquiry_crm`(`enquiry_id`, `Feedback`, `feedback_date`, `created_by`)  values('$id','$feedbacks','$dates','$candidateid')");  


} */
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
	//echo "0";
} 
else {
    echo 'Message has been sent';
	//echo "1";
}

?>