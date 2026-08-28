<?php 
include('../../../../connect.php');
include('../../../../user.php');
$userid=$_SESSION['userid'];
$uploadDir = 'documentUpload/'; 


$medi_id = $_REQUEST['medi_id'];
$employee_name=$_REQUEST['emp_name'];
$Insurance_Name=$_REQUEST['insurance_name'];
$Insurance_Number=$_REQUEST['insurance_number'];
$Validate_Form=$_REQUEST['validate_from'];
$Validate_To=$_REQUEST['validate_to'];
$Premium_Insurance_Policy=$_REQUEST['premium_insurance_policy'];
$Medi_insure_attach=$_REQUEST['Medi_insure_attach'];
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


if($fileName != ''){	
	$sql=$con->query("UPDATE mediclamim_insurance SET insurance_name='$Insurance_Name', insurance_number='$Insurance_Number',validate_from='$Validate_Form',validate_to ='$Validate_To',premium_insurance_policy='$Premium_Insurance_Policy', document_approved='$fileName' where id='$medi_id'");


}else{

	$sql=$con->query("UPDATE mediclamim_insurance SET insurance_name='$Insurance_Name', insurance_number='$Insurance_Number',validate_from='$Validate_Form',validate_to ='$Validate_To',premium_insurance_policy='$Premium_Insurance_Policy', document_approved='$Medi_insure_attach' where id='$medi_id'");

  }



if ($sql)
{
	echo 1;
}

else
{
	echo 0;
}


?>
