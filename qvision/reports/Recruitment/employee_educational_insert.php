<?php
require '../../connect.php';
require '../../user.php';
$uploadDir = 'education_certificate/'; 
$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
$response = array( 
    //'status' => 0, 
    //'message' => 'Form submission failed, please try again.' 
); 
 
// If form is submitted 
//$errMsg = ''; 
$valid = 1; 

if( isset($_POST['employeeid']) || isset($_POST['examination_passed']) || isset($_POST['instute']) || isset($_POST['degree']) || isset($_POST['field']) || isset($_POST['passing'])  || isset($_POST['percentage']) || isset($_POST['attachment']) || isset($_POST['attach']) ){ 

$candidateid=$_POST['cid'];
$id=$_POST['employeeid'];
$examination_passed=$_POST['examination_passed'];
$examination_passed_count= count($examination_passed);
$instute=$_POST['instute'];
$degree=$_POST['degree'];
$field=$_POST['field'];
$passing=$_POST['passing'];
$percentage=$_POST['percentage'];
$filesArr3 = $_FILES["attachment"];
$edu_attach = $_POST["attach"];
 
 for($i=0;$i<$examination_passed_count;$i++)
{

$empid = $id[$i];
$examination= $examination_passed[$i];
$college= $instute[$i];
$course= $degree[$i];
$fields= $field[$i];
$passings= $passing[$i];
$percentages= $percentage[$i];
$education_attach= $edu_attach[$i];

$status=1;
$today = date("Y-m-d H:i:s"); 
     
    // Check whether submitted data is not empty 
    if($valid == 1){ 
     // $uploadStatus = 1; 
        $fileNames = array_filter($filesArr3['name']); 

     // Upload file 
        $uploadedFile = ''; 
        if(!empty($fileNames))
		{  
            foreach($filesArr3['name'] as $key=>$val){  
                // File upload path  
                 $fileName = basename($filesArr3['name'][$key]);  
                $targetFilePath = $uploadDir . $fileName;  
                  
                // Check whether file type is valid  
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                if(in_array($fileType, $allowTypes)){  
                    // Upload file to server  
                    if(move_uploaded_file($filesArr3['tmp_name'][$key], $targetFilePath)){  
                        $uploadedFile .= $fileName.','; 
                    } 
                }
            }  
        } 

            $uploadedFileStr3 = trim($uploadedFile, ',');
			
   // Insert form data in the database 	
   
  if($empid!=''){
    if($fileNames[$i]!=''){
      $sql=$con->query("UPDATE `emp_qualification` SET emp_id='$candidateid',education='$examination' ,institution_name='$college' ,degree='$course' ,field_of_specialization='$fields' ,year_of_passing='$passings' ,percentage='$percentages',attachment='$fileNames[$i]' ,status='$status',modified_on=now(),modified_by='$candidateid' WHERE id ='$empid' ");
    }else{
	  $sql=$con->query("UPDATE `emp_qualification` SET emp_id='$candidateid',education='$examination' ,institution_name='$college' ,degree='$course' ,field_of_specialization='$fields' ,year_of_passing='$passings' ,percentage='$percentages',attachment='$education_attach' , status='$status', modified_on=now(),modified_by='$candidateid' WHERE id = '$empid' "); 
    }  
  }
   else{						
      $sql=$con->query("insert into `emp_qualification`(emp_id, education, institution_name, degree, field_of_specialization, year_of_passing, percentage,attachment,created_on,created_by)  values('$candidateid','$examination','$college','$course','$fields','$passings','$percentages','$fileNames[$i]',now(),'$candidateid')");
   }

 }

}

if($sql)
{
	echo 1;
}
else
{
	echo 0;
}

  $sql2=$con->query("update candidate_form_details set status='20' where id='$candidateid'");

}

?>