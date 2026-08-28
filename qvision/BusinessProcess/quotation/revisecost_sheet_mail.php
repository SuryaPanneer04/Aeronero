<?php
require '../../../connect.php'; 
require '../../../user.php'; 
require '../../../PHPMailer/PHPMailerAutoload.php';
$userrole = $_SESSION['userrole']; 
//$costsheet_id=$_REQUEST['id']; echo $costsheet_id;
$candidateid=$_SESSION['candidateid'];
$cost_sheet_no=$_REQUEST['cost_sheet_no'];

$deatsils = $con->prepare("SELECT cse.cost_sheet_no,e.company_name,cse.client_id,zum.full_name,zum.user_name FROM `cost_sheet_entry` cse 
INNER JOIN enquiry e on e.id=cse.enquiry_id 
INNER JOIN z_user_master zum ON zum.candidate_id=e.created_by 
WHERE cse.cost_sheet_no ='$cost_sheet_no' and zum.candidate_id='$candidateid'");



/* SELECT a.id as costsheet_id,a.*,b.*,e.*,f.*,g.* from cost_sheet_entry a 
		 inner join client_master b on(b.id=a.client_id) 
		 inner join product_services f on (f.id = a.business_id)
		INNER JOIN staff_master e ON e.candid_id=a.candid_id 
		inner join z_user_master g ON (g.candidate_id = e.id)
		where a.candid_id='$candidateid' and a.status ='0'"); 
	
/* echo "SELECT fecrm.enquiry_id,e.client,e.company_name,fecrm.Feedback,fecrm.feedback_id, zud.full_name FROM `feedback_enquiry_crm` fecrm right JOIN enquiry e ON e.id = fecrm.enquiry_id right join z_user_master zud on fecrm.created_by=zud.candidate_id where fecrm.enquiry_id='$id'"; */

$deatsils->execute(); 
$data = $deatsils->fetch();

	//$data=$deatsils->fetch();
	$enquiry_id=$data['enquiry_id'];
	$full_name=$data['full_name'];
	$Feedback=$data['Feedback']; 
	$client=$data['client'];
	//$company_name=$data['Company_name'];echo $company_name;
	$candidateid=$_SESSION['candidateid'];
	//$feedback=$_REQUEST['feedback'];
	//$feedback_count=count($feedback);

//$date=$_REQUEST['date'];
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
$mail->FromName = 'Revise Cosheet Alert..';
$mail->AddAddress("subramanian.r@bluebase.in");		//Adds a "To" address
//$mail->addAddress("laxmipriya@bluebase.in");     // Add a recipient
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                 // Set email format to HTML
$subject="Enquiry remainder..";			

$html_table = 'Dear&nbsp;&nbsp;'. $client.',  <br> 
		&nbsp;&nbsp;	This Mail regarding your cost sheet rejected.';
		
	$html_table .=' </table>';
	$html_table .=' <h4>Thanks & Regards,</h4><br>
	'.$full_name.'  <br> 
	<p>SS Information</p>';
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