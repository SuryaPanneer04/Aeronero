<?php 
require '../../connect.php';
include('../../user.php');
$userrole=$_SESSION['userrole'];
$candidateid=$_REQUEST['id'];
$reject_remark=$_REQUEST['reject_remark'];

$supdate=$con->query("update candidate_form_details set reject_remark='$reject_remark',status='32' where id='$candidateid'");
echo "update candidate_form_details set reject_remark='$reject_remark',status='32' where id='$candidateid'";

$sql2=$con->query("update emp_personal_details SET status= 0 where emp_id='$candidateid' && status=1 ");

$sql3=$con->query("update  emp_qualification SET status=0 where emp_id='$candidateid' && status=1 ");

$sql4=$con->query("update emp_certification SET status=0 where emp_id='$candidateid' && status=1 ");

$sql5=$con->query("update  emp_exp_detail SET status=0  where ed.emp_id='$candidateid' && ed.status=1 ");

if($supdate)
{
	echo "Query updated";
}
else
{
	echo "Query not updated";
}


require '../../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';
//include ('pdf.php');

 $staff_query= $con->query("select c.*,u.user_name,u.password,u.full_name as fullname from candidate_form_details c left join z_user_master u on c.id=u.candidate_id where c.id='$candidateid'");
  
    $staff_query->execute(); 
	$row            = $staff_query->fetch();	
	
	$FULLNAME       = $row['fullname'];
    $SENDMAIL       = $row['mail'];
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
$mail->FromName = 'Recruitment Job Portal';
$mail->AddAddress($SENDMAIL, $FULLNAME);		//Adds a "To" address
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                 // Set email format to HTML

$subject="Recruitment - Candidate document Reject";			
	$html_table = 'Dear&nbsp;&nbsp;'. $user_name.',  <br> 
		&nbsp;&nbsp;  Your Document was rejected when the document verified so ReUpload the document as soon as possible for further process. <br> &nbsp;&nbsp;   Below Given Login credentials and User Details to login the application Kindly upload the document.
			 <table class="table table-hover table-bordered"  border=1 style="margin: 15px 0 98px 0px!important;">   
			<thead style="color:#0033FF;">					
			<tr style="text-align:center;">			
			<th style="font-size:15px;">#</th>
			<th style="font-size:15px;">User Name</th>
			<th style="font-size:15px;">Password</th> 
			
			</tr>	
			</thead>';
		$html_table .='<tr>
									<td>' . "1".'</td>
									<td>' . $USERNAME.'</td>
									<td>' . $PASSWORD.'</td> 
									
							  </tr>'; 
	$html_table .=' </table>';
	$html_table .='<button class="btn btn-primary"><a href="http://bsplassetsrv.bluebase.in:8084/ssinfo1/index.php">Login Portal</a></button>';

	$html_table .=' <h4>Thanks & Regards,</h4><br>
	<p>SS Information Systems Pvt Ltd.,'.'\r\n\r\n<br/>'.'
	 An ISO 9001:2015 Certified Company'.'\r\n\r\n<br/>'.'
     No.1/102 ,  Periyar Pathai West, 100 Feet Road, Arumbakkam,Chennai - 600106.'.'\r\n\r\n<br/>'.'
     M +91-8939871607   T 044-23623544   Toll Free 18008893244'.'\r\n\r\n<br/>'.'
     Extn: 211 E hr@ssinformation.in| URL: www.ssinformation.in [1]'.'\r\n\r\n<br/>'.'</p>';
	$mail->Subject =$subject;
	$mail->Body =$html_table;
	

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