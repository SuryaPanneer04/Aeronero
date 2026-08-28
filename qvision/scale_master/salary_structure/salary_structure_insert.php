<?php

require '../../../connect.php';
$Earnings=$_REQUEST['Earnings'];
$amount=$_REQUEST['amount'];
$percentage=$_REQUEST['percentage'];
$status=$_REQUEST['status'];
 
$statement = $con->query("INSERT INTO payroll_structure(name, amount, percentage,status, created_by, created_on) 
	VALUES ('$Earnings', '$amount', '$percentage', '$status', '1', now())");	

if($statement)
{
 echo 	1;
}
else
{
 echo 	0;
}

?>