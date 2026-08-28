<?php
include("../config.php");

$user_name = $_POST["user_name"];
$password = $_POST["password"];

$sqlcheckusr = "SELECT * FROM z_user_master
				WHERE user_name = '".$user_name."' AND password = '".$password."'"; 
				
 
$rslt = mysqli_query($mysqlit, $sqlcheckusr);
 
if(mysqli_num_rows($rslt)>0){ 
	
	if(mysqli_num_rows($rslt)!=0){
	
	while($row=mysqli_fetch_assoc($rslt)){
		
		$result['signIn']=$row;
		
	}
	
	$result['statusCode']="200"; 
	$result['statusMessage']="true"; 
    echo json_encode($result);
	
}else{
	$result['statusCode']="401"; 
	$result['statusMessage']="Login failed!"; 
	echo json_encode($result);
   }
	
 }else{

	$result['statusCode']="400"; 
	$result['statusMessage']="User does not exist"; 
	echo json_encode($result);
	
   }

?>