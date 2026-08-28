<?php
include("../config.php");

if(!$mysqlit){
die("Connection failed:".mysqli_connect_error());
}
			
$sqlcheckusr = "SELECT id, customer_code, customer_name, customer_address, customer_person, customer_contact, customer_mail, customer_website, create_date, status, cus_follo_date, cus_remark, created_by, created_on FROM customer_details order by id DESC"; 
				 
$rslt = mysqli_query($mysqlit, $sqlcheckusr);
 
$result["status"] = "false";
$result["status_message"] = "No Entry Found";
	
if(mysqli_num_rows($rslt)>0){ 
	
	if(mysqli_num_rows($rslt)!=0){
	
		while($row=mysqli_fetch_assoc($rslt)){
		 $result['CustomerInformation'][]=$row;
		 
		}
	}else{
		$result['error'][]=$row;
		$result['status']="bad request"; 
		$result['status_message']="customer details does not exist";
		echo json_encode($result);
	}
}

if(!empty($result["CustomerInformation"])){	
    $result["status"] = "true";
    $result["status_message"]="Customer details";
}
	
echo json_encode($result);

?>