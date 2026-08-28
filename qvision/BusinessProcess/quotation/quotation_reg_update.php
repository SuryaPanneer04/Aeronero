<?php
require '../../../connect.php';
require '../../../user.php';
$user_id =$_SESSION['userid'];
$candidateid=$_SESSION['candidateid'];
$cost_sheet_no = $_REQUEST['cost_sheet_no'];
$quote_no      = $_REQUEST['quote_no'];

  $update_query  = $con->query("update cost_sheet_entry set status ='2',modified_on=NOW(), modified_by='$candidateid' WHERE cost_sheet_no='$cost_sheet_no'");  
  $update_query = $con->query("update quote_generate set status ='3',modified_on=NOW(), modified_by='$candidateid' WHERE quote_no='$quote_no'");  


?>






