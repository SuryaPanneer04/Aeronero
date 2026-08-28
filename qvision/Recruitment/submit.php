
<?php 
require '../../connect.php';
require "../../user.php";
$uploadDir = 'uploads/'; 
$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
$response = array( 
    //'status' => 0, 
    //'message' => 'Form submission failed, please try again.' 
); 
// If form is submitted 
//$errMsg = ''; 
$valid = 1; 
if( isset($_POST['emp_id']) || isset($_POST['position']) || isset($_POST['name']) || isset($_POST['fathers_name']) 
	|| isset($_POST['DOB']) || isset($_POST['communication_address']) || isset($_POST['permanent_address'])
	|| isset($_POST['mobile_num']) || isset($_POST['email_id']) || isset($_POST['adharnumber']) || isset($_POST['pannumber']) || isset($_POST['voternumber']) || isset($_POST['files']) || isset($_POST['files1']) || isset($_POST['files2']) || isset($_POST['cpn']) || isset($_POST['cpr']) || isset($_POST['cpm']) || isset($_POST['cid']) || isset($_POST['emp_status']) || isset($_POST['id']) || isset($_POST['aadharattach']) || isset($_POST['panattach']) || isset($_POST['voterattach']) ){ 
    // Get the submitted form data 
	$id                    = $_POST['id'];
	$candidateid           = $_POST['cid'];
    $position              = $_POST['position']; 
    $name                  = $_POST['name']; 
    $fathers_name          = $_POST['fathers_name']; 
    $DOB                   = $_POST['DOB']; 
    $communication_address = $_POST['communication_address']; 
    $permanent_address     = $_POST['permanent_address']; 
    $mobile_num            = $_POST['mobile_num']; 
    $email_id              = $_POST['email_id']; 
	$adharnumber           = $_POST['adharnumber'];
	$pannumber             = $_POST['pannumber'];
	$voternumber           = $_POST['voternumber'];
    $filesArr              = $_FILES["files"];
    $filesArr1             = $_FILES["files1"];
    $filesArr2             = $_FILES["files2"];
    $contact_name          = $_POST['cpn'];
    $contact_relation      = $_POST['cpr'];
    $contact_no            = $_POST['cpm'];
    $emp_status            = $_POST['emp_status'];
	$aadarcard_attach      = $_POST['aadharattach']; 
	$pancard_attach        = $_POST['panattach']; 
 	$votercard_attach      = $_POST['voterattach']; 
	
   $status=1;
   $today = date("Y-m-d H:i:s"); 
   
 
    // Check whether submitted data is not empty 
    if($valid == 1){ 
       // $uploadStatus = 1; 
        $fileNames = array_filter($filesArr['name']); 
         
        // Upload file 
        $uploadedFile = ''; 
        if(!empty($fileNames)){  
            foreach($filesArr['name'] as $key=>$val){  
                // File upload path  
                 $fileName = basename($filesArr['name'][$key]);  
                $targetFilePath = $uploadDir . $fileName;  
                  
                // Check whether file type is valid  
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                if(in_array($fileType, $allowTypes)){  
                    // Upload file to server  
                    if(move_uploaded_file($filesArr["tmp_name"][$key], $targetFilePath)){  
                        $uploadedFile .= $fileName.','; 
                    } 
                }
            }  
        } 
            // Insert form data in the database 
            $uploadedFileStr = trim($uploadedFile, ','); 
			
			
			
			/* PAN UPLOAD */
			$fileNames = array_filter($filesArr1['name']);  
        // Upload file 
        $uploadedFile = ''; 
        if(!empty($fileNames)){  
            foreach($filesArr1['name'] as $key=>$val){  
                // File upload path  
                $fileName = basename($filesArr1['name'][$key]);  
                $targetFilePath = $uploadDir . $fileName;  
                  
                // Check whether file type is valid  
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                if(in_array($fileType, $allowTypes)){  
                    // Upload file to server  
                    if(move_uploaded_file($filesArr1["tmp_name"][$key], $targetFilePath)){  
                        $uploadedFile .= $fileName.','; 
                    } 
                }
            }  
        } 
		$uploadedFileStr1 = trim($uploadedFile, ','); 
			/* END PAN UPLOAD */
			
			
			
			
			/* voter upload */
			$fileNames = array_filter($filesArr2['name']); 
         
        // Upload file 
        $uploadedFile = ''; 
        if(!empty($fileNames)){  
            foreach($filesArr2['name'] as $key=>$val){  
                // File upload path  
                $fileName = basename($filesArr2['name'][$key]);  
                $targetFilePath = $uploadDir . $fileName;  
                  
                // Check whether file type is valid  
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                if(in_array($fileType, $allowTypes)){  
                    // Upload file to server  
                    if(move_uploaded_file($filesArr2["tmp_name"][$key], $targetFilePath)){  
                        $uploadedFile .= $fileName.','; 
                    } 
                }
            }  
        } 
		
		
		$uploadedFileStr2 = trim($uploadedFile, ','); 
			/* end voter upload */
			
	if($uploadedFileStr!=''){  //Aadhar Attach 
	   $aadhar_attach = $uploadedFileStr;
    }else{
	   $aadhar_attach = $aadarcard_attach;
	}		
	

    if($uploadedFileStr1!=''){ //Pan Attach
	   $pan_attach = $uploadedFileStr1;
    }else{
	   $pan_attach = $pancard_attach;
	}

    if($uploadedFileStr2!=''){ //voter Attach
	   $voter_attach = $uploadedFileStr2;
    }else{
	   $voter_attach = $votercard_attach;
	}
			
	if($id!=''){
		////echo "ifcondition";
		$sql=$con->query("UPDATE `emp_personal_details` SET emp_id='$candidateid' ,position='$position' ,name='$name' ,fathers_name='$fathers_name' ,DOB='$DOB' ,communication_address='$communication_address' ,permanent_address='$permanent_address' ,mobile_num='$mobile_num' ,emergency_contact_relationship='$contact_relation' ,contact_person='$contact_name' ,emergency_num='$contact_no' ,email_id='$email_id' ,adharcard_number='$aadhar_attach' ,pan_number='$pan_attach' ,Voter_no='$voternumber' ,aadhar_num='$adharnumber' ,pan_num='$pannumber' ,voter_id='$voter_attach' ,status= 1 ,modified_by='$candidateid' ,modified_on=now() WHERE id = '$id'");
		
	}else{	
        	
        $sql=$con->query("INSERT INTO emp_personal_details (emp_id,position,name,fathers_name,DOB,communication_address,permanent_address,mobile_num,emergency_contact_relationship,contact_person,emergency_num,email_id,adharcard_number,pan_number,Voter_no,aadhar_num,pan_num,voter_id,status,created_by,created_on) VALUES ('$candidateid', '$position', '$name', '$fathers_name', '$DOB', '$communication_address', '$permanent_address', '$mobile_num','$contact_relation','$contact_name','$contact_no', '$email_id', '$uploadedFileStr', '$uploadedFileStr1', '$voternumber', '$adharnumber', '$pannumber', '$uploadedFileStr2', '$status', '$candidateid', now())");
		
       ////  echo $sql;   
   }
  }
  
  $sql2=$con->query("update candidate_form_details set status='20' where id='$candidateid'");
} 
 if($sql){
	 echo 1;
 
 }
 else {
	 echo 0;
 }
// Return response 
//echo json_encode($response);
?>
