<?php
require '../../../../connect.php';
$uploadDir = 'lifeInsuranceDoc/';

$id = $_REQUEST['lid']; 
$emp_name = $_REQUEST['emp_name']; 
$life_insurance_name = $_REQUEST['life_insurance_name']; 
$life_insurance_number = $_REQUEST['life_insurance_number']; 
$validity_from = $_REQUEST['validity_from']; 
$validity_to = $_REQUEST['validity_to']; 
$policy_period = $_REQUEST['policy_period']; 
$eligiblity = $_REQUEST['eligiblity']; 
$life_insure_attach = $_REQUEST['life_insure_attach']; 

$filesArr3 = $_FILES['policy_doc'];

//Insurance Document
$uploadedFile = '';

$fileNames = array_filter($filesArr3['name']);

// Upload file 


// File upload path  
foreach ($filesArr3['name'] as $key => $val) {
	$fileName = basename($filesArr3['name'][$key]);
	$targetFilePath = $uploadDir . $fileName;

	// Check whether file type is valid  
	$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

	// Upload file to server  
	if (move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath)) {
		$uploadedFile .= $fileName . ',';
	}
}


if($fileName != ''){	
	$sql = $con->query("UPDATE `life_insurance` SET `emp_id`='$emp_name',`insurance_name`='$life_insurance_name',`insurance_no`='$life_insurance_number',`validity_from`='$validity_from',`validity_to`='$validity_to',`policy_period`='$policy_period',`eligiblity`='$eligiblity',`Insurance_doc`='$fileName' WHERE `id`='$id'");

}else{

	$sql = $con->query("UPDATE `life_insurance` SET `emp_id`='$emp_name',`insurance_name`='$life_insurance_name',`insurance_no`='$life_insurance_number',`validity_from`='$validity_from',`validity_to`='$validity_to',`policy_period`='$policy_period',`eligiblity`='$eligiblity',`Insurance_doc`='$life_insure_attach' WHERE `id`='$id'");
  }

if($sql){
	echo 1;
}
else{
	echo 0;
}
?>