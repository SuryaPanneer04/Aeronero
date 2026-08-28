<?php
require '../../../connect.php';
include("../../../user.php");


$product_name=$_REQUEST['product_name'];
$status=$_REQUEST['status'];







$sql11=$con->query("insert into products_master(`Product_name`,status) values('$product_name','$status')"); 

echo "insert into products_master(`Product_name`) values('$product_name')";
?>