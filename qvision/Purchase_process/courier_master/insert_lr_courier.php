<?php
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];
$candidate_id = $_SESSION['candidateid'];
if( isset($_POST['lr_details'])) 
{	
       $lr_details = $_REQUEST['lr_details'];
       $invoice_no = $_REQUEST['invoice_no'];
       $Challan_id = $_REQUEST['id'];
       
$sql = $con->query("INSERT INTO lr_courier_details (lr_details,invoice_no,challan_id,status,created_by,created_on) VALUES ('$lr_details','$invoice_no','$Challan_id','0','$candidate_id',now())");

echo "INSERT INTO lr_courier_details (lr_details,invoice_no,challan_id,status,created_by,created_on) VALUES ('$lr_details','$invoice_no','$Challan_id','0','$candidate_id',now())";

$poUpdate = $con -> query("update challan_entry set status= 3 where id ='$Challan_id' "); // when Challan Details upload then challan_entry table status will update to "3" for Upload LR/Courier against invoice Number.///

}
else
{
	echo 0;
}

?>