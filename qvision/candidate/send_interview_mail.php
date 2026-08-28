<?php
require '../../connect.php';
include('../../user.php');


require '../../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

$userid=$_SESSION['userid'];


$position = $_REQUEST['position']; //Position for candidate.
$venue=$_REQUEST['venue'];  //Address for interview.
$application_name=$_REQUEST['app_name']; //Application Name for interview. 
$meetLink=$_REQUEST['meetLink']; //Link for interview.

$feedback=$_REQUEST['feedback']; //Type of Interview i.e., virtual or FTF.

$intrvw_date=$_REQUEST['interview_date'];  //Date for interview.

$date=date_create($_REQUEST['interview_date']);
$interview_date=date_format($date,"d/m/Y");

$interview_time=$_REQUEST['i_time']; //Time for interview.

$FULLNAME       =  $_REQUEST['first_name'].' '. $_REQUEST['last_name'];
$SENDMAIL       =  $_REQUEST['mail'];
$allocate_person       =  $_REQUEST['allocate_person'];
$round_type       =  $_REQUEST['round_type'];
echo $accept_id       =  $_REQUEST['accept_id'];

$update_accept = $con -> query("UPDATE `candidate_accept_reject` SET status=2 WHERE id = '$accept_id'"); //MAIL SENT after Manager Accept the candidate for interview.

$staff_detail = $con ->query("select emp_name from staff_master where id ='$allocate_person'");
$staff = $staff_detail->fetch();
$reporting_person = $staff['emp_name'];

$stmt22 = $con->query("SELECT name FROM interview_rounds where id='$round_type'");
$row22 = $stmt22->fetch();
$dept = $row22['name'];

/*require '../../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';*/

  
$mail = new PHPMailer;
$mail->SMTPDebug = 2; 
$mail->Mailer = "smtp";
$mail->IsSMTP(true); 
$mail->Port = 465;
$mail->Host = 'mail.quadsel.in';        
$mail->SMTPAuth = true;                              // Enable SMTP authentication
$mail->Username = 'hr@quadsel.in';
$mail->Password = 'Qspl@2024#';                         // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
$mail->SMTPOptions = [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
		'allow_self_singed' => true,
    ]
];
$mail->From = 'hr@quadsel.in';		//Sets the From email address for the message
$mail->FromName = 'Quadsel  Systems Pvt Ltd';
$mail->AddAddress($SENDMAIL, $FULLNAME);		//Adds a "To" address
// $mail->AddCC('ENTER MAIL ID');         //Adds a "CC" address.
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                 // Set email format to HTML



if($feedback==1){ //Virtual interview

	$subject= 'Recruitment - Virtual interview';

	$html_table = '<div style="color: #178ae3;">Dear&nbsp;&nbsp;'. $FULLNAME.',  <br> <br>
		&nbsp;&nbsp;  Your Profile got shortlisted for the  '. $dept .'  Round of Virtual interview for the position of  '. $position .' and the interview is through <b>'. $application_name  .'</b> On &nbsp;' .$interview_date.','.$interview_time.'. <br><br> The reporting person is  '. $reporting_person.'.  &nbsp;&nbsp; <br> Below the Meeting Link is Given.
			 <table class="table table-hover table-bordered"  border=1 style="margin: 15px 0 98px 0px!important;">   
			<thead style="color:#178ae3;">					
			<tr style="text-align:center;">			
			<th style="font-size:15px;">#</th>
			<th style="font-size:15px;">Application</th>
			<th style="font-size:15px;">Link</th> 
			
			</tr>	
			</thead>';
    $html_table .='<tr>
				<td>' . "1".'</td>
			    <td>' . $application_name.'</td>
			    <td>' . $meetLink .'</td> 
			    </tr>'; 
	$html_table .=' </table> </div>';

}else if($feedback==2){ // FTF interview.
    
	$subject='Recruitment - FACE TO FACE interview';

    $html_table = '<div style="color: #178ae3;">Dear&nbsp;&nbsp;'. $FULLNAME.',  <br> <br>
		&nbsp;&nbsp;  Your Profile got shortlisted for the  '. $dept .' Round of FACE TO FACE interview for the position of  '. $position .' at <b> '.$venue.'  </b>&nbsp; On &nbsp;' .$interview_date.','.$interview_time.'. <br> <br> The reporting person is  '. $reporting_person.'. &nbsp;&nbsp;<br> </div>';
}
	$html_table .= "<div style='color: #178ae3;'><h4>Thanks & Regards,</h4>"."\r\n\r\n<br/>"."
	Human Resource"."\r\n\r\n<br/>"."
	Quadsel  Systems Pvt Ltd.,"."\r\n\r\n<br/>"."
					  An ISO 27001:2013 Certified Company| ISO 9001:2015 CERTIFIED"."\r\n\r\n<br/>"."
					  Old No.80,New No.118,  Anna Salai,Manikkam Lane,Guindy,Chennai-600 032."."\r\n\r\n<br/>"."
					  Landline:044 2250 2277 "."\r\n\r\n<br/>"."
					  | enquiry@quadsel.in| URL: www.quadsel.in"."\r\n\r\n<br/></div>";
					
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
?>