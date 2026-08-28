<?php
require '../../connect.php';

$id=$_REQUEST['get_id'];

$appsts=$_REQUEST['appsts'];

$sql=$con->query("Update claim_request set status='$appsts' where id='$id'");


/* $sql=$con->query("Update manual_att set emp_code='$Employee_name',customer_name='$Customer_name',location='$Location',date='$date',purpose='$Purpose',distance='$Distance',amount='$Amount' where id='$id'"); */ 


/* echo "Update manual_att set emp_id='$Employee_name',customer_name='$Customer_name',location='$Location',date='$date',purpose='$Purpose' where id='$id'";
 */
?>