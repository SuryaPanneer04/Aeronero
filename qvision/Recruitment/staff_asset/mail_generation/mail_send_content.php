<?php
require '../../../../connect.php';
include('../../../../user.php');
$candidateid = $_SESSION['candidateid'];

$emp_name = $_REQUEST['emp_name']; // Mail for this employee.
$it_person = $_REQUEST['it_person']; //Mail Created by this employee.
$mail_content = $_REQUEST['mail_content']; //content for the mail.
$mail_cc = $_REQUEST['mail_cc']; //cc for the mail.

if(empty($emp_name) || $emp_name == '0' || empty($it_person) || $it_person == '0') {
    echo "Error: Please select Valid Employee and IT Person.";
    exit(); 
}

    $sql=$con->query("INSERT INTO `emp_mail_details`(`emp_name`, `IT_person`, `status`, `created_by`) VALUES ('$emp_name','$it_person', 0 ,'$candidateid')");
require '../../../../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../../PHPMailer/src/Exception.php';
require '../../../../PHPMailer/src/PHPMailer.php';
require '../../../../PHPMailer/src/SMTP.php';

if($sql){
$staff_query = $con->query("select full_name,email_id from z_user_master where candidate_id='$it_person' "); 

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
$mail->FromName = 'Bluebase Software services Pvt Ltd';	//Sets the From name of the message
$mail->AddAddress($SENDMAIL, $FULLNAME);		//Adds a "To" address
//$mail->AddAddress('rabi.p@bluebase.in', $FULLNAME);		//Adds a "To" address
$mail->AddCC($mail_cc);           //Adds a "CC" address.
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                 // Set email format to HTML



//Mail Content.

	$subject= 'Company Mail ID Creation ';

	$html_table = '<div style="color: #178ae3;">Dear&nbsp;&nbsp;'. $FULLNAME.',  <br> <br> &nbsp;&nbsp;';

	$html_table .= $mail_content ;

	$html_table .= "<div style='color: #178ae3;'><h4>Thanks & Regards,</h4>"."\r\n\r\n<br/>"."
	Human Resource"."\r\n\r\n<br/>"."
	SS Information Systems Pvt Ltd.,"."\r\n\r\n<br/>"."
	An ISO 9001:2015 Certified Company"."\r\n\r\n<br/>"."
	No.1/102 ,  Periyar Pathai West, 100 Feet Road, Arumbakkam,Chennai - 600106."."\r\n\r\n<br/>"."
	M +91-8939871607   T 044-23623544   Toll Free 18008893244"."\r\n\r\n<br/>"."
	Extn: 211 E hr@ssinformation.in| URL: www.ssinformation.in"."\r\n\r\n<br/></div>";
	
	$mail->Subject =$subject;
	$mail->Body =$html_table;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
	echo "0";
} 
else {
    echo 'Message has been sent.','<br>';
	echo '1';
}

}
?>