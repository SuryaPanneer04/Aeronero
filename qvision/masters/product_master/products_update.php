<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];

$id_value = $_REQUEST['id_value'];
$product_name = $_REQUEST['product_name'];
$model_name = $_REQUEST['model_name'];
$product_id = $_REQUEST['product_id'];
$product_type = $_REQUEST['product_type'];
$hsn_code = $_REQUEST['hsn_code'];
$gst_code=$_REQUEST['gst_code'];
$status_value = $_REQUEST['statusz'];
$desc = $_REQUEST['desc'];



	if($product_type=="1")
	{ 
$pro_value="It Asset"; 
	}elseif($product_type=="2"){
	$pro_value="NonIt Asset";
	}else{
	$pro_value="";	
	}
	
	$update_sql=$con->query("update product_master set product_id='$product_id',name='$product_name',model_name='$model_name',hsn_code='$hsn_code',gst_code='$gst_code',type='$pro_value',description='$desc',status='$status_value' 
	where id='$id_value'");
	
	 if($update_sql)
{
	echo "1";
	
}else{
echo "2";
}
?>