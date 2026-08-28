<?php
require '../../connect.php';


$ids = $_REQUEST['ids'];
$Leave = $_REQUEST['Leave'];
$no_of_days = $_REQUEST['no_of_days'];
$status = $_REQUEST['status']; 

// Ellaa fields-um update aagura maari query ezhuthirukkom
$statement = $con->query("UPDATE master_leave SET leave_name='$Leave', no_of_days='$no_of_days', status='$status' WHERE id='$ids'");

if($statement)
{
	echo 0;
}
else
{
	echo 1; 
}
?>