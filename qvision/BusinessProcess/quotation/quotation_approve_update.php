<?php
require '../../../connect.php';
require '../../../user.php';
$user_id =$_SESSION['userid'];

//$id=$_REQUEST['get_id'];
echo $quote_id_count = $_REQUEST['id'];
 $row_count   = count($quote_id_count);

 for($i=0;$i<$row_count;$i++)
{
  $quote = $quote_id_count[$i];
  $update_query = $con->query("update quotation_entry set approved_by ='$user_id', status ='2', modified_by ='$user_id',modified_on =NOW() WHERE cost_sheet_no='$quote_id_count'");  
 echo "update quotation_entry set approved_by ='$user_id', status = '2',	modified_by ='$user_id',modified_on =NOW() WHERE cost_sheet_no= '$quote_id_count'";
}

?>






