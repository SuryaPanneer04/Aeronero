<?php
require '../../../connect.php';

	$department=$_REQUEST['department'];
	$status=$_REQUEST['status'];
	$sql=$con->query("insert into z_department_master(dept_name,status,created_by,created_on)values('$department','$status','2',now())");
if($sql)
{
	echo "1";
	
}

?>