	<?php 
require '../../../connect.php';
require '../../../user.php';
require '../../../PHPMailer/PHPMailerAutoload.php';
$candidateid=$_SESSION['candidateid'];
$qid=$_REQUEST['id'];
$enquiry_id=$_REQUEST['enquiry_id'];
$cost_sheet_no=$_REQUEST['cost_sheet_no'];
$sel=$con->query("update po_generate set finance_status='1',finance_approved_by='$candidateid',po_upload_status='2' where cost_sheet_no='$cost_sheet_no'");

$update_query = $con->query("update cost_sheet_entry set status ='10' WHERE cost_sheet_no= '$cost_sheet_no'");  
$insert_query2= $con->query("UPDATE enquiry SET status='10' WHERE id='$enquiry_id' OR id=(SELECT enquiry_id FROM cost_sheet_entry WHERE cost_sheet_no='$cost_sheet_no' LIMIT 1)");

if($sel)
{
	
	echo 1;
}
else
{
	echo 0;
}

?>