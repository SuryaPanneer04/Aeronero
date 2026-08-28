<?php
require '../../../connect.php';
include("../../../user.php");

$userrole=$_SESSION['userrole'];
$user_id =$_SESSION['userid'];


 $product_id = $_REQUEST['product_id'];
 $product_name = $_REQUEST['product_name'];
 $model_name = $_REQUEST['model_name'];
 $description = $_REQUEST['description'];
 $product_type= $_REQUEST['product_type'];
 $hsn_code = $_REQUEST['hsn_code'];
 $gst_code=$_REQUEST['gst_code'];
 $status = $_REQUEST['statusz'];
 
if($product_type=="1")
	{ 
$product_value="It Asset"; 
	}elseif($product_type=="2"){
	$product_value="Non It Asset";
	}else{
	$product_value="";	
	}
	
$insert_sql=$con->query("insert into product_master(product_id,name,model_name,description,hsn_code,gst_code,type,status,created_by,created_on)
	values('$product_id','$product_name','$model_name','$description','$hsn_code','$gst_code','$product_value','$status','$user_id',NOW())");
	
	/* echo "insert into product_master(product_id,name,description,hsn_code,type,status,created_by,created_on)
	values('$product_id','$product_name','$description','$hsn_code','$product_value','$status','$user_id',NOW())"; */
	if($insert_sql)
	{
		echo "1";
		
	}else{
	echo "2";
	}
?>