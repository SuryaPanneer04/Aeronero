<?php 
require '../../../connect.php';
require '../../../user.php';
require '../../../PHPMailer/PHPMailerAutoload.php';
$candidateid=$_SESSION['candidateid']; echo $candidateid;echo '##';
$qid=$_REQUEST['id'];echo $qid; echo '&##&';
$enquiry_id=$_REQUEST['enquiry_id']; echo $enquiry_id; echo '&&##&&';
$cost_sheet_no=$_REQUEST['cost_sheet_no']; echo $cost_sheet_no;


$deatsils=$con->query("SELECT pg.so_number,pg.quote_no,pg.cost_sheet_no,pg.po_date,pg.po_upload_status,zum.full_name,zum.user_name,cse.enquiry_id,cse.specification,cm.client_name FROM `po_generate` pg JOIN z_user_master zum ON pg.created_by = zum.candidate_id JOIN client_master cm on pg.created_by = cm.created_by join cost_sheet_entry cse on pg.created_by=cse.candid_id where cse.cost_sheet_no=pg.cost_sheet_no and pg.id = '$qid'");

/* $deatsils=$con->query("SELECT pg.so_number,pg.quote_no,pg.cost_sheet_no,pg.po_date,pg.po_upload_status,zum.full_name,zum.user_name,cse.enquiry_id,cse.specification,cm.client_name FROM `po_generate` pg JOIN z_user_master zum ON pg.created_by = zum.candidate_id JOIN client_master cm on pg.created_by = cm.created_by join cost_sheet_entry cse on pg.created_by=cse.candid_id where cse.cost_sheet_no=pg.cost_sheet_no and zum.user_id='$qid'"); */
	$data=$deatsils->fetch();
	//$user_id=$data['enquiry_id'];
	$user_name=$data['full_name']; echo $user_name;echo '*&&*&&*&&*';
    $username=$data['user_name']; 
	$client_name=$data['client_name'];
//	$qid=$data['id'];
	//$cost_sheet_no=$data['cost_sheet_no'];
	
$sel=$con->query("update po_generate set service_status='1',service_approved_by='$candidateid' where id='$qid'");
//echo "update po_generate set finance_status='1',finance_approved_by='$candidateid' where id='$qid'";
$update_query = $con->query("update cost_sheet_entry set status ='6' WHERE cost_sheet_no= '$cost_sheet_no'");  
$insert_query2= $con->query("Update enquiry set status='9' where id='$enquiry_id'");
$update_query = $con->query("update po_generate set po_upload_status='2' WHERE cost_sheet_no= '$cost_sheet_no'"); 
echo $candidateid;
echo '**';
echo $qid;
echo '***';
echo $enquiry_id;echo '****';
echo $cost_sheet_no;echo '*****';
echo "update po_generate set service_status='1',service_approved_by='$candidateid' where id='$qid'";
echo '**$**';

	
	
	
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

if($sel)
{
	echo 1;
}
else
{
	echo 0;
}
?>