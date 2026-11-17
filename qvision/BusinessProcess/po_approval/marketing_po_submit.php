<?php 
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];

// ECHO DELETED: Clean variables without echoing debug symbols
$qid=$_REQUEST['id']; 
$enquiry_id=$_REQUEST['enquiry_id']; 
$cost_sheet_no=$_REQUEST['cost_sheet_no']; 

// First, fetch the Product from enquiry table
$check_prod = $con->query("SELECT Product FROM enquiry WHERE id='$enquiry_id' OR id=(SELECT enquiry_id FROM cost_sheet_entry WHERE cost_sheet_no='$cost_sheet_no' LIMIT 1)");
$prod_row = $check_prod->fetch();
$product_val = $prod_row['Product'];

// Condition for Software Bypass
if($product_val == '4' || $product_val == 'Software' || strtolower($product_val) == 'software') {
    
    // Software Bypass Logic: Auto-Approve Level 2, Finance & Purchase
    $sel = $con->query("UPDATE po_generate SET marketing_status='1', marketing_approved_by='$candidateid', md_status='1', md_approved_by='$candidateid', finance_status='1', finance_approved_by='$candidateid', purchase_invoice_sts='1', po_upload_status='2' WHERE cost_sheet_no='$cost_sheet_no'");
    
    $update_query = $con->query("UPDATE cost_sheet_entry SET status ='11' WHERE cost_sheet_no='$cost_sheet_no'");  
    $insert_query2 = $con->query("UPDATE enquiry SET status='11' WHERE id='$enquiry_id' OR id=(SELECT enquiry_id FROM cost_sheet_entry WHERE cost_sheet_no='$cost_sheet_no' LIMIT 1)");

} else {

    // Normal Product Logic: Go to Marketing Level 2
    $sel = $con->query("UPDATE po_generate SET marketing_status='1', marketing_approved_by='$candidateid', po_upload_status='1' WHERE cost_sheet_no='$cost_sheet_no'");
    
    $update_query = $con->query("UPDATE cost_sheet_entry SET status ='8' WHERE cost_sheet_no='$cost_sheet_no'");  
    $insert_query2 = $con->query("UPDATE enquiry SET status='8' WHERE id='$enquiry_id' OR id=(SELECT enquiry_id FROM cost_sheet_entry WHERE cost_sheet_no='$cost_sheet_no' LIMIT 1)");
}

require '../../../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';
	
$mail = new PHPMailer;

// DEBUG OFF: Set to 0 to prevent raw text from corrupting AJAX
$mail->SMTPDebug = 0; 
// TIMEOUT ADDED: Fail fast if SMTP server takes too long (5 seconds max)
$mail->Timeout = 5;   

$mail->Mailer = "smtp";
$mail->IsSMTP(true); 
$mail->Port = 587;
$mail->Host = 'mail2.ssinformation.in';        
$mail->SMTPAuth = true;                             
$mail->Username = 'test1@ssinformation.in';
$mail->Password = 'dqR8mdSzsb';                           
$mail->SMTPSecure = 'tls';                            
$mail->SMTPOptions = [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
		'allow_self_singed' => true,
    ]
];
$mail->From = 'test1@ssinformation.in';
$mail->FromName = 'Marketing Head Approval..';
$mail->AddAddress('purushothaman_l@ssinformation.in', 'Purushothaman');		
$mail->WordWrap = 50;                                 
$mail->isHTML(true);                                 
$subject="PO Approved by Marketing Head.";			
$html_table = 'Dear&nbsp;&nbsp; Purushothaman,  <br> 
    &nbsp;&nbsp;	This Mail regarding Marketing Level 1 PO approved and waiting for Marketing Level 2 Approve.';
$html_table .=' </table>';
$html_table .=' <h4>Thanks & Regards,</h4><br>
<p>SS Information Services Pvt Ltd</p>';
$mail->Subject =$subject;
$mail->Body =$html_table;
	
// Send Mail silently, then output clean status for AJAX
$mail->send();

if($sel) {
	echo 1;
} else {
	echo 0;
}
?>