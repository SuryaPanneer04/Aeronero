<?php
require '../../connect.php'; 
require '../../user.php'; 
require '../../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

$id=$_REQUEST['get_id'];
echo $id;  
$userrole=$_SESSION['userrole'];
$deatsils=$con->query("SELECT e.id,e.date,e.company_name,e.client,e.mail as email,e.created_by, zud.full_name,zud.candidate_id,zud.user_name as mail FROM `enquiry` e left join z_user_master zud on (e.created_by=zud.candidate_id) where e.id='$id'");
/* echo "SELECT e.id,e.date,e.company_name,e.client,e.mail as email,e.created_by, zud.full_name,zud.candidate_id,zud.user_name as mail FROM `enquiry` e left join z_user_master zud on (e.created_by=zud.candidate_id) where e.id='$id'"; */

	$data=$deatsils->fetch();
	$enquiry_id=$data['id'];
	$client=$data['client'];
	$mailerID=$data['mail'];
	$full_name=$data['full_name']; //echo $full_name;
	$company_name=$data['company_name']; 
	$candidateid=$_SESSION['candidateid'];
	


$id=$_REQUEST['get_id'];


$status=2;
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
$mail->FromName = 'New Lead Alert..';
$mail->AddAddress($mailerID , $full_name);		//Adds a "To" address
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                 // Set email format to HTML
$subject="Lead Generated..";			
	$html_table =  'Dear&nbsp;&nbsp;'.$client.'<br>
		&nbsp;&nbsp;	This Mail regarding your New Lead.';
		
	$html_table .=' </table>';
	$html_table .=' <h4>Thanks & Regards,</h4><br>
	'.$full_name.',
	<p>SS Information Systems Pvt. Ltd.</p>';
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



$sql2= $con->query("Update enquiry set status='$status' where id='$id'");
	echo "Update enquiry set status='$status' where id='$id'";

 

?>
<script>

function mail_send()
{
	var data  = $('form').serialize();
	
	var id    = document.getElementById("costsheet_id").value;
    $('.wage_content').html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');
	document.getElementById('content').style.display = "none";
	$.ajax({
	type:'GET',
	data:"id="+id, 
//	url:"qvision/BusinessProcess/quotation/quotation_mail_post.php",
	success:function(data)
	{      
		alert("Quote Details has been send successfully...");
		Quotation_send()
				  
	}       
	});
}
</script>