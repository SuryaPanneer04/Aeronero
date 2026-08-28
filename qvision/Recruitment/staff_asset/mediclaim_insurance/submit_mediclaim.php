<?php 
include('../../../../connect.php');
include('../../../../user.php');
$userid=$_SESSION['userid'];
$uploadDir = 'documentUpload/'; 


if(isset($_POST['emp_name']) || isset($_POST['insurance_name']) || isset($_POST['insurance_number']) || isset($_POST['validate_from']) || isset($_POST['validate_to']) || isset($_POST['premium_insurance_policy']) || isset($_POST['resume'])){

$employee_name=$_REQUEST['emp_name'];
$Insurance_Name=$_REQUEST['insurance_name'];
$Insurance_Number=$_REQUEST['insurance_number'];
$Validate_Form=$_REQUEST['validate_from'];
$Validate_To=$_REQUEST['validate_to'];
$Premium_Insurance_Policy=$_REQUEST['premium_insurance_policy'];
$filesArr3=$_FILES['resume'];

//Resume
	 $uploadedFile = ''; 
	      
			      $fileNames = array_filter($filesArr3['name']); 

     // Upload file 
       
        
            // File upload path  
			foreach($filesArr3['name'] as $key=>$val)
			{
                $fileName = basename($filesArr3['name'][$key]);  
                $targetFilePath = $uploadDir . $fileName; 
                  
                // Check whether file type is valid  
                 $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                
                    // Upload file to server  
                    if(move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath)){  
                        $uploadedFile .= $fileName.','; 
                    
                }
			}

$status=1;



$sql=$con->query("insert into mediclamim_insurance ( `emp_name`, `insurance_name`, `insurance_number`,`validate_from`,`validate_to`,`premium_insurance_policy`, `document_approved`)values('$employee_name','$Insurance_Name','$Insurance_Number','$Validate_Form','$Validate_To','$Premium_Insurance_Policy','$fileName')");

// echo  "insert into mediclamim_insurance ( `emp_name`, `insurance_name`, `insurance_number`,`validate_from`,`validate_to`,`premium_insurance_policy`, `document_approved`)values('$employee_name','$Insurance_Name','$Insurance_Number','$Validate_Form','$Validate_To','$Premium_Insurance_Policy','$fileName')";


if ($sql)
{
	echo 1;
}

else
{
	echo 0;
}

}//isset END 

?>