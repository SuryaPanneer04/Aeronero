<?php
require '../../../connect.php';

$id=$_REQUEST['id'];
$scale=$_REQUEST['scale'];
$status=$_REQUEST['status']; 

 $sql=$con->query("Update payroll_scale_master set name='$scale',status='$status'  where id='$id'");
 
 if($sql){
	 echo 0;
 }
 else{
	 
	echo 1; 
 }
?>