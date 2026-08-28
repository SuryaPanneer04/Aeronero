<?php
require '../../connect.php';
Session_start();
 $id = $_REQUEST['status'];
 $leave_type= $_REQUEST['leave'];
 $candid_id= $_REQUEST['candid_id'];

	$user_id=$_SESSION['userid'];

	$sql=$con->query("Update leave_apply_masters set status=2, modified_on=NOW(), modified_by='$user_id'  where id='$id'");

	$query1= $con->query("select id,no_of_days,emp_code from leave_apply_masters where id='$id'");  
	$query1->execute(); 
    $row1 = $query1->fetch();
	$no_of_leave=$row1['no_of_days'];
	$emp_code=$row1['emp_code'];
	
	$query= $con->query("select leave_type,candid_id,total_leave,balance_leave from leave_masters where candid_id='$candid_id' and leave_type='$leave_type'");  

	$query->execute(); 
    $row = $query->fetch();
	$total_leave=$row['total_leave'];
	$balances_leave=$row['balance_leave'];
	$balance_leave=(($balances_leave)-($no_of_leave));

	$sql1=$con->query("Update leave_masters set total_leave='$total_leave',balance_leave='$balance_leave',modified_on=NOW(), modified_by='$user_id'  where candid_id='$candid_id' and leave_type='$leave_type'");
 echo "Update leave_masters set total_leave='$total_leave',balance_leave='$balance_leave',modified_on=NOW(), modified_by='$user_id'  where candid_id='$candid_id' and leave_type='$leave_type'";
?>






