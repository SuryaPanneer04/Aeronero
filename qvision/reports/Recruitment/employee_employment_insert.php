<?php
require '../../connect.php';
require '../../user.php';
$uploadDir = 'experience_certificate/'; 
$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
$response = array( 
    //'status' => 0, 
    //'message' => 'Form submission failed, please try again.' 
);
$valid = 1; 

if( isset($_POST['emp_id']) || isset($_POST['organization']) || isset($_POST['designation']) || isset($_POST['from']) || isset($_POST['to']) || isset($_POST['yearofexperience']) || isset($_POST['expid']) || isset($_POST['exp']) || isset($_POST['exp_attach'])){ 


$candidateid=$_POST['cid'];
$id=$_POST['expid'];
$organization=$_POST['organization'];
$organization_count= count($organization);
$designation=$_POST['designation'];
$from=$_POST['from'];
$to=$_POST['to'];
$yearofexperience=$_POST['yearofexperience'];
$filesArr3 = $_FILES["exp"];
$exp_attach = $_POST["exp_attach"]; 
$status=1;


 for($i=0;$i<$organization_count;$i++)
{

$exp_id= $id[$i];
$organizations= $organization[$i];
$desig= $designation[$i];
$vfrom= $from[$i];
$vto= $to[$i];
$yoe= $yearofexperience[$i];
$exp_att= $exp_attach[$i];

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
                    if(move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath)){  
                        $uploadedFile .= $fileName.','; 
                    } 
                }
            }  
        } 

            $uploadedFileStr3 = trim($uploadedFile, ',');

 // Insert form data in the database 		
			
  if($exp_id!=''){
	 if($fileNames[$i]!=''){  
	$sql=$con->query("UPDATE `emp_exp_detail` SET emp_id='$candidateid' ,organization_name='$organizations' ,designation='$desig' ,from_date='$vfrom' ,to_date='$vto' ,total_experience='$yoe' ,modified_by='$candidateid' ,modified_on=now(),status='$status',exp_attachment='$fileNames[$i]' WHERE id='$exp_id'");
     }
	 else{
		 $sql=$con->query("UPDATE `emp_exp_detail` SET emp_id='$candidateid' ,organization_name='$organizations' ,designation='$desig' ,from_date='$vfrom' ,to_date='$vto' ,total_experience='$yoe' ,modified_by='$candidateid' ,modified_on=now(),status='$status',exp_attachment='$exp_att' WHERE id='$exp_id'");
	 }
	
  } 
  else{	
     $sql=$con->query("insert into `emp_exp_detail`(emp_id, organization_name, designation, from_date, to_date, total_experience,created_by,status,exp_attachment)  values('$candidateid','$organizations','$desig','$vfrom','$vto','$yoe','$candidateid','$status','$fileNames[$i]')"); 
  }
   
}

  $sql2=$con->query("update candidate_form_details set status='20' where id='$candidateid'");

if($sql){
	 echo 1;
 }
 else{
	 echo 0;
 }
 }
?>






