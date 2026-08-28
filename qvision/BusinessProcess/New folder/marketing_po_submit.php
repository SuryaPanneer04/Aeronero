<?php 
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
$qid=$_REQUEST['id']; echo $qid; echo '**';
$enquiry_id=$_REQUEST['enquiry_id']; echo $enquiry_id;echo '*2*';
$cost_sheet_no=$_REQUEST['cost_sheet_no']; echo $cost_sheet_no;echo '*3*';
$sel=$con->query("update po_generate set marketing_status='1',marketing_approved_by='$candidateid' where id='$qid'");
//echo "update po_generate set finance_status='1',finance_approved_by='$candidateid' where id='$qid'";
$update_query = $con->query("update po_generate set po_upload_status='1' WHERE cost_sheet_no= '$cost_sheet_no'");  
$update_query = $con->query("update cost_sheet_entry set status ='7' WHERE cost_sheet_no= '$cost_sheet_no'");  
$insert_query2= $con->query("Update enquiry set status='10' where id='$enquiry_id'");
if($sel)
{
	
	echo 1;
		
}
else
{
	echo 0;
}
?>
