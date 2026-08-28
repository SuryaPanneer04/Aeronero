<?php require '../../../connect.php'; 
require '../../../user.php'; 
require '../../../PHPMailer/PHPMailerAutoload.php';

$candidateid=$_SESSION['candidateid'];
$qid=$_SESSION['id'];
$userrole=$_SESSION['userrole'];
$deatsils=$con->query("SELECT pg.so_number,pg.quote_no,pg.cost_sheet_no,pg.po_date,pg.po_upload_status,zum.full_name,zum.user_name,cse.enquiry_id,cse.specification,cm.client_name FROM `po_generate` pg JOIN z_user_master zum ON pg.created_by = zum.candidate_id JOIN client_master cm on pg.created_by = cm.created_by join cost_sheet_entry cse on pg.created_by=cse.candid_id where cse.cost_sheet_no=pg.cost_sheet_no and zum.user_id='$candidateid'");
	$data=$deatsils->fetch();
	//$user_id=$data['enquiry_id'];
	$user_name=$data['full_name'];
    $username=$data['user_name']; 
	$client_name=$data['client_name'];
	$qid=$data['id'];
	//$cost_sheet_no=$data['cost_sheet_no'];
	
	
	
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
$mail->FromName = 'Service Head Approval';
$mail->AddAddress('subramanian.r@bluebase.in');		//Adds a "To" addresss
//$mail->addAddress("laxmipriya@bluebase.in");     // Add a recipient
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                 // Set email format to HTML
$subject="PO Approved by Service Head..";			
	$html_table = 'Dear&nbsp;&nbsp;'. $client_name.',  <br> 
		&nbsp;&nbsp;	This Mail regarding your PO approval.';
		
	$html_table .=' </table>';
	$html_table .=' <h4>Thanks & Regards,</h4><br>
	'. $user_name.'  <br> 
	<p>Service Head</p>';
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