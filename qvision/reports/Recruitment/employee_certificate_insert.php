<?php
require '../../connect.php';
require '../../user.php';
$uploadDir = 'certificates/'; 
$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
$response = array( 
    //'status' => 0, 
    //'message' => 'Form submission failed, please try again.' 
); 
 
// If form is submitted 
//$errMsg = ''; 
$valid = 1; 

if( isset($_POST['emp_id']) || isset($_POST['certifcatename']) || isset($_POST['certifcatenumber']) || isset($_POST['validityfrom']) || isset($_POST['validityto']) || isset($_POST['certifcatefile']) || isset($_POST['candidid']) || isset($_POST['certificate_attach']) ){ 


$candidateid=$_POST['cid'];
$id=$_POST['candidid'];
$certifcatename=$_POST['certifcatename'];
$certifcatename_count= count($certifcatename);
$certifcatenumber=$_POST['certifcatenumber'];
$validityfrom=$_POST['validityfrom'];
$validityto=$_POST['validityto'];
$filesArr3 = $_FILES["certifcatefile"];
$certfce_attach = $_POST["certificate_attach"];

 //$countfiles = count($_FILES['certifcatefile']['name']);

 for($i=0;$i<$certifcatename_count;$i++)
{
$e_id= $id[$i];
$certifcate= $certifcatename[$i];
$number= $certifcatenumber[$i];
$vfrom= $validityfrom[$i];
$vto= $validityto[$i];
$filesArr3 = $_FILES["certifcatefile"];
$c_attach=$certfce_attach[$i];
$status=1;

$today = date("Y-m-d H:i:s"); 

if($valid == 1){ 
       // $uploadStatus = 1; 
        $fileNames = array_filter($filesArr3['name']); 
         
        // Upload file 
        $uploadedFile = ''; 
        if(!empty($fileNames)){  
            foreach($filesArr3['name'] as $key=>$val){  
                // File upload path  
                 $fileName = basename($filesArr3['name'][$key]);  
                $targetFilePath = $uploadDir . $fileName;  
                  
                // Check whether file type is valid  
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                if(in_array($fileType, $allowTypes)){  
                    // Upload file to server  
                    if(move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath)){  
                        $uploadedFile .= $fileName.','; 
                    } 
                }
            }  
        } 
            $uploadedFileStr3 = trim($uploadedFile, ',');
			
 // Insert form data in the database 		
			
  if($e_id!=''){
    if($fileNames[$i]!=''){	
	  $sql=$con->query("UPDATE `emp_certification` SET emp_id='$candidateid' ,certification_name='$certifcate' ,certification_number='$number' ,validity_from='$vfrom' ,validity_to='$vto' ,attachment='$fileNames[$i]' ,status='$status',modified_by='$candidateid',modified_on=now() WHERE id='$e_id'");
    }else{
	  $sql=$con->query("UPDATE `emp_certification` SET emp_id='$candidateid' ,certification_name='$certifcate' ,certification_number='$number' ,validity_from='$vfrom' ,validity_to='$vto' ,attachment='$c_attach' ,status='$status',modified_by='$candidateid',modified_on=now() WHERE id='$e_id'");	 
    }
  } 
  else{	
      $sql=$con->query("insert into `emp_certification`(emp_id, certification_name, certification_number, validity_from, validity_to, attachment, status,created_on,created_by)values('$candidateid','$certifcate','$number','$vfrom','$vto','$fileNames[$i]','$status',now(),'$candidateid')");
	//echo $sql;
	}
   
}

}
if($sql){
	 echo 1;
 }
 
 $sql2=$con->query("update candidate_form_details set status='20' where id='$candidateid'");
 
}



?>






