<?php
require '../../../connect.php';

    $id=$_REQUEST['id'];
	$name=$_REQUEST['name'];
	$status=$_REQUEST['status'];
		
	$sql=$con->query("update appraisal_rounds set name='$name',status='$status' where id='$id'");
?>
