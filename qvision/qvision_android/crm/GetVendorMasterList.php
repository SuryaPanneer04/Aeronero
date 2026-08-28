<?php
include("../config.php");

if(!$mysqlit){
die("Connection failed:".mysqli_connect_error());
}
			
$sqlcheckusr = "SELECT * FROM `doller_vendor_mastor` order by id DESC"; 
				 
$rslt = mysqli_query($mysqlit, $sqlcheckusr);

if(mysqli_num_rows($rslt)>0){ 
	
	if(mysqli_num_rows($rslt)!=0){
	
		while($row=mysqli_fetch_assoc($rslt)){
		 $result['VendorList'][]=$row;
		}
	}else{
		$result['error'][]=$row;
		$result['status']="bad request"; 
		$result['status_message']="Vendor List does not exist";
		echo json_encode($result);
	}
}

if(!empty($result["VendorList"])){	
    $result["status"] = "true";
    $result["status_message"]="Vendor List";
}	
		
echo json_encode($result);

?>