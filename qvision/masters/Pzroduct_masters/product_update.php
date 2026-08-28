<?php
require '../../../connect.php';
include("../../../user.php");

//echo "<pre>";print_r($candidate_id);exit();
 $id=$_REQUEST['get_id'];
$product_name=$_REQUEST['product_name'];
$status=$_REQUEST['status'];


	$sql2= $con->query("Update products_master set Product_name='$product_name',status='$status' where Product_id='$id'");
	echo "Update products_master set Product_name='$product_name' where Product_id='$id'";
	
	?>