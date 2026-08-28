<?php
require '../../connect.php';
require '../../user.php';
require '../../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

 $candidateid=$_SESSION['candidateid'];
$id=$_REQUEST['id'];
	
//$eq_id=$_REQUEST['enquiry_id'];

$userrole=$_SESSION['userrole'];
$deatsils=$con->query("SELECT e.id,e.date,e.company_name,e.mail as email,e.created_by, zud.full_name,zud.candidate_id,zud.user_name as mail FROM `enquiry` e left join z_user_master zud on (e.created_by=zud.candidate_id) where e.id='$id'");
/* echo "SELECT e.id,e.date,e.company_name,e.client,e.mail as email,e.created_by, zud.full_name,zud.candidate_id,zud.user_name as mail FROM `enquiry` e left join z_user_master zud on (e.created_by=zud.candidate_id) where e.id='$id'"; */




$select=$con->query("SELECT a.id as enquiry_id,a.status as enquiry_status,a.created_by as enquiry_created,b.id as client_id ,c.id as plant_id,a.*,b.*,c.* from enquiry a left join new_client_master b on (a.id=b.enquiry_id) left join new_plant_master c on (b.id=c.client_id)  where a.id='$id'"); 
$rowwww=$select->fetch();


$client_d=$rowwww['client_id'];

	$data=$deatsils->fetch();
	$enquiry_id=$data['id'];
	//$client=$data['client'];
	$mailerID=$data['mail'];
	$full_name=$data['full_name']; //echo $full_name;
	$company_name=$data['company_name']; 
	$candidateid=$_SESSION['candidateid'];
	




$status=2;
$mail = new PHPMailer;
$mail->SMTPDebug = 2; 
$mail->Mailer = "smtp";
$mail->IsSMTP(true); 
$mail->Port = 587;
$mail->Host = 'webmail.quadsel.in';        
$mail->SMTPAuth = true;                              // Enable SMTP authentication
$mail->Username = 'finance@quadsel.in';
$mail->Password = 'Fin@2024#';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->SMTPOptions = [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
		'allow_self_singed' => true,
    ]
];
$mail->From = 'finance@quadsel.in';
$mail->FromName = 'New Client Approved Alert..';
$mail->AddAddress($mailerID , $full_name);		//Adds a "To" address
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                 // Set email format to HTML
$subject="New Client Approved..";			
	$html_table =  'Dear&nbsp;&nbsp;'.$full_name.'<br>
		&nbsp;&nbsp;	This Mail regarding your New Client Approved.';
		
	$html_table .=' </table>';
	$html_table .=' <h4>Thanks & Regards,</h4><br>'.$full_name.';

	<p>Quadsel Systems Pvt. Ltd.</p>';
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


$status=2;

$sql2= $con->query("Update new_client_master set status='$status',flow='$status' where enquiry_id='$enquiry_id'");

//echo "Update new_client_master set status='$status',flow='$status',approved_by='$candidateid' where id='$id'";

$plnt= $con->query("Update new_plant_master set status='$status',flow='$status' where client_id='$client_d'");
	//echo "Update client_master set status='$status' where id='$id'";
 $sql2= $con->query("Update enquiry set status=3,flag=2 where id='$id'");
 
/*$exps=$con->query("SELECT id, from enquiry where id='$enquiry_id'");

	$derf=$exps->fetch();
	$custoo_id=$derf['customer_id'];
	echo $custoo_id;
	
	$sql5= $con->query("Update customer_details set status=6 where id='$custoo_id'");
	echo "Update customer_details set status=6 where id='$custoo_id'";
	*/
?>






