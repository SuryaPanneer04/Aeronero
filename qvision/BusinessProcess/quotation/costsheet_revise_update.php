<?php
require '../../../connect.php';
require '../../../user.php';
$user_id =$_SESSION['userid'];
echo $user_id ;
//$id=$_REQUEST['get_id'];
$cost_sheet_no = $_REQUEST['cost_sheet_no'];
 $remarks = $_REQUEST['remark'];
 $enquiry_id = $_REQUEST['enquiry_id'];
 $row_count   = count($cost_sheet_no);

 for($i=0;$i<$row_count;$i++)
{
  //$id = $cost_sheet_no[$i];
  $update_query = $con->query("update cost_sheet_entry set remark='$remarks',status ='0',modified_on=NOW(), modified_by='$user_id' WHERE cost_sheet_no='$cost_sheet_no'");  
  //$update_query = $con->query("update cost_sheet_entry set remark='$remarks', status = '0',modified_by ='$user_id',modified_on =NOW() WHERE id='$cost_sheet_no'");  
 //echo "update cost_sheet_entry set remark='$remarks',status ='0',modified_on=NOW(), modified_by='$user_id' WHERE cost_sheet_no='$cost_sheet_no'";
}

$update_query2 = $con->query("update enquiry set status = '11',modified_by ='$user_id',modified_on =NOW() WHERE id='$enquiry_id'");  
?>






