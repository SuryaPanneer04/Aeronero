<?php 
require '../../../connect.php';
require '../../../user.php';
$user=$_SESSION['userid'];
$candidateid = $_SESSION['candidateid'];

$hod = $con->query("select emp_name from staff_master where candid_id='$candidateid'"); //To find emp name.
$hod_name = $hod->fetch();
$emp_name = $hod_name['emp_name'];


require '../../../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';



$reason=$_REQUEST['reason'];
$notice_period=$_REQUEST['notice_period'];
$notice_date = date('Y-m-d',strtotime($_REQUEST['notice_period']));
$notice_days=$_REQUEST['notice_days'];
$projects=$_REQUEST['projects'];
$confirm=$_REQUEST['confirm'];
$remarks=$_REQUEST['remarks'];
$cid=$_REQUEST['cid'];
$resignid=$_REQUEST['resignid'];
if($confirm=="Yes")
{
	$status=2;
	$upd=$con->query("update resignation_form_details set hod_reason='$reason',notice_period='$notice_date',handling_projects='$projects',hod_accept_status='$confirm',hod='$candidateid',approved_date=now() ,notice_days='$notice_days',status='$status',modified_by='$candidateid',modified_on= now() where id='$resignid'");

}
else
{
	$status=3;
	$upd=$con->query("update resignation_form_details set hod_accept_status='$confirm', hod_rejoin_remark='$remarks', hod='$candidateid', status='$status',modified_by='$candidateid',modified_on= now() where id='$resignid'");

}

if($upd)
{

$staff_query= $con->query("select full_name,email_id from z_user_master where candidate_id='$cid'"); 
$staff_query->execute(); 

	$row            =  $staff_query->fetch();	
    $FULLNAME       =  $row['full_name'];
    $SENDMAIL       =  $row['email_id'];
  
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
$mail->From = 'test1@ssinformation.in';		//Sets the From email address for the message
$mail->FromName = 'SS Information Systems Pvt Ltd.';
$mail->AddAddress($SENDMAIL, $FULLNAME);		//Adds a "To" address
$mail->AddCC('hr@ssinformation.in');  // CC to HR to know about the Resignation.
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                 // Set email format to HTML

$subject="Resignation Update";	

if($confirm=="Yes"){
	$resignation = "Accepted"; 
	$resignation_remark = $reason;
	
	$html_table = '<div style="color: #178ae3;">Dear&nbsp;&nbsp;'. $FULLNAME.',  <br> <br>
		&nbsp;&nbsp;  Your Resignation Request is &nbsp;' .$resignation .'&nbsp; And your Notice period till &nbsp;'
		.$notice_period .'.<br><br> ';
		$html_table .='&nbsp;&nbsp;'.$resignation_remark; 
		
	

	$html_table .=' <h4>Thanks & Regards,</h4><br>
	<p>'.$emp_name.'</p>
	<p>SS Information Systems Pvt Ltd.</p> </div>';
}else{
	$resignation = "Rejected"; 
    $resignation_remark = $remarks;
	
	$html_table = '<div style="color: #178ae3;">Dear&nbsp;&nbsp;'. $FULLNAME.',  <br> <br>
		&nbsp;&nbsp;  Your Resignation Request is &nbsp;' .$resignation .'.<br><br> ';
	$html_table .='&nbsp;&nbsp;'.$resignation_remark; 
		
	$html_table .=' <h4>Thanks & Regards,</h4><br>
	<p>'.$emp_name.'</p>
	<p>SS Information Systems Pvt Ltd.</p> </div>';
}	
	
	$mail->Subject =$subject;
	$mail->Body =$html_table;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
	echo 0;
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