<?php
require '../../../connect.php';
require '../../../user.php';


require '../../../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';

$staff_id=$_REQUEST['id'];
?>
<?php 
	//$staff_query= $con->query("select a.id as staff_id,b.full_name,b.user_name,b.password,b.email_id,c.mail from staff_master a inner join z_user_master b on (b.candidate_id=a.candid_id) join candidate_form_details c on b.candidate_id=c.id  where a.id = '$staff_id' "); 

$staff_query= $con->query("select b.full_name,b.user_name,b.password,b.email_id from  z_user_master b where b.candidate_id = '$staff_id' "); 

	$staff_query->execute(); 
	$row            = $staff_query->fetch();	
 	$FULLNAME       = $row['full_name']; 
    $SENDMAIL       = $row['email_id'];
    $USERNAME       = $row['user_name'];
    $PASSWORD       = "Welcome@123";

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
	$mail->FromName = 'QUADSEL INFORMATION';////FROM NAME TO SEN MAIL
    $mail->AddAddress($SENDMAIL, $FULLNAME);		//Adds a "To" address		
	$mail->WordWrap = 50;			//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML		

	$mail->Subject = 'Login Details';			//Sets the Subject of the message
					//An HTML or plain text message body
	
	$mail->Body = "Dear \r\n".$FULLNAME.""." ,"."\r\n\r\n<br/>";	
	$mail->Body .= "&nbsp;&nbsp;&nbsp;  Kindly find the below link and credential for  Employee login in SS Information Systems Pvt Ltd Application."."\r\n\r\n<br/><br/>";
	//$mail->Body .= "Url : http://115.243.95.118:8081/ss-information/"."\r\n\r\n<br/><br/>";	

	$mail->Body    .= "USERNAME : ".$USERNAME."\r\n\r\n<br/>"; 
	$mail->Body   .= "PASSWORD : ".$PASSWORD."\r\n\r\n<br/><br/>";
	$mail->Body .= '<button class="btn btn-primary"><a href="http://bsplassetsrv.bluebase.in:8084/ssinfo1/index.php">Login Portal</a></button>';
	
	if(!$mail->send()) {
       echo 'Message could not be sent.';
       echo 'Mailer Error: ' . $mail->ErrorInfo;
	   echo "0";
   } 
    else {
        $message = '<label class="text-success">UserName and PassWord has been send successfully...</label>';echo $message;
	} 
?>