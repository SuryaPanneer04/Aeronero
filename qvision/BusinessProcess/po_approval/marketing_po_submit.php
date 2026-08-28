<?php 
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
$qid=$_REQUEST['id']; echo $qid; echo '**';
$enquiry_id=$_REQUEST['enquiry_id']; echo $enquiry_id;echo '*2*';
$cost_sheet_no=$_REQUEST['cost_sheet_no']; echo $cost_sheet_no;echo '*3*';
$sel=$con->query("update po_generate set marketing_status='1',marketing_approved_by='$candidateid' where id='$qid'");
//echo "update po_generate set finance_status='1',finance_approved_by='$candidateid' where id='$qid'";
$update_query = $con->query("update po_generate set po_upload_status='1' WHERE cost_sheet_no='$cost_sheet_no'");  
$update_query = $con->query("update cost_sheet_entry set status ='7' WHERE cost_sheet_no='$cost_sheet_no'");  
$insert_query2= $con->query("Update enquiry set status='8' where id='$enquiry_id'");
if($sel)
{
	
	echo 1;
		
}
else
{
	echo 0;
}




require '../../../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';
	
	
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
$mail->FromName = 'Marketing Head Approval..';
$mail->AddAddress('purushothaman_l@ssinformation.in', 'Purushothaman');		//Adds a "To" addresss
//$mail->addAddress("laxmipriya@bluebase.in");     // Add a recipient
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                 // Set email format to HTML
$subject="PO Approved by Marketing Head.";			
	$html_table = 'Dear&nbsp;&nbsp; Purushothaman,  <br> 
		&nbsp;&nbsp;	This Mail regarding Marketing Level 1 PO approved and waiting for Marketing Level 2 Approve.';
		
	$html_table .=' </table>';
	$html_table .=' <h4>Thanks & Regards,</h4><br>
	<p>SS Information Services Pvt Ltd</p>';
	$mail->Subject =$subject;
	$mail->Body =$html_table;
	
	
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
	echo "0";
} 
else {
	

    echo 'Mail has been sent';
	//echo "1";
}
?>
