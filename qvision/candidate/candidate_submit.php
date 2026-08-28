<?php
include('../../connect.php');
include('../../user.php');
$uploadDir = 'uploads/'; 
$uploadDir1 = 'photo/'; 
$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
$response = array( 
    //'status' => 0, 
    //'message' => 'Form submission failed, please try again.' 
); 

$userid=$_SESSION['resource_id'];

$position=$_REQUEST['position'];
$first_name=$_REQUEST['first_name'];
$last_name=$_REQUEST['last_name'];
$full_name = $first_name." ".$last_name;
$gender=$_REQUEST['gender'];
$father_name=$_REQUEST['father_name'];
$dob=date('Y-m-d',strtotime($_REQUEST['dob']));
$address=$_REQUEST['address'];
$paddress=$_REQUEST['paddress'];
$phone=$_REQUEST['phone'];
$z_phone= substr($phone, 4);
$a_phone=$_REQUEST['a_phone'];
$mail=$_REQUEST['mail'];
$adharnumber=$_REQUEST['adharnumber'];
$educationalDetails=$_REQUEST['educationalDetails'];
$pannumber=$_REQUEST['pannumber'];
$voternumber=$_REQUEST['voternumber'];
$driving_license=$_REQUEST['dl'];
$EmployeeStatus=$_REQUEST['EmployeeStatus'];
$filesArr3 = $_FILES['file'];
$photo = $_FILES["photo"];


//Resume
	 $uploadedFile = ''; 
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
	
	    //photo
                 foreach($photo['name'] as $key=>$val)
			{          
             // File upload path  
                $fileName1 = basename($photo['name'][$key]);  
                $targetFilePath1 = $uploadDir1 . $fileName1;  
                  
                // Check whether file type is valid  
                 $fileType = pathinfo($targetFilePath1, PATHINFO_EXTENSION);  
                
                    // Upload file to server  
                    if(move_uploaded_file($photo["tmp_name"][$key], $targetFilePath1)){  
                        $uploadedFile .= $fileName.',';        
                }
			}
			
$status=2;
$date=date('Y-m-d');
if($EmployeeStatus=="Fresher")
{
	$year_of_pass=$_REQUEST['year_of_pass'];
	
	$inserts=$con->query("INSERT INTO candidate_form_details(resource_id,position, first_name, last_name, father_name, gender, dob, address, paddress, phone,alternative_phone, mail, adharnumber, pannumber, voternumber,driving_license, educationalDetails, EmployeeStatus, year_of_pass, resume,  photo, status, created_by, created_on) 
	VALUES ('$userid','$position','$first_name', '$last_name', '$father_name', '$gender', '$dob', '$address', '$paddress', '$phone', '$a_phone','$mail', '$adharnumber', '$pannumber', '$voternumber','$driving_license', '$educationalDetails', '$EmployeeStatus', '$year_of_pass','$fileName','$fileName1', '$status','$userid','$date')");

	
	/* echo "INSERT INTO candidate_form_details(resource_id,position, first_name, last_name, father_name, gender, dob, address, paddress, phone,alternative_phone, mail, adharnumber, pannumber, voternumber, educationalDetails, EmployeeStatus, year_of_pass, resume,  photo, status, created_by, created_on) 
	VALUES ('$userid','$position','$first_name', '$last_name', '$father_name', '$gender', '$dob', '$address', '$paddress', '$phone', '$a_phone','$mail', '$adharnumber', '$pannumber', '$voternumber', '$educationalDetails', '$EmployeeStatus', '$year_of_pass','$fileName','$fileName1', '$status','$userid','$date')"; */
	

 $edit_id=$con->query("SELECT id FROM candidate_form_details order by id desc limit 1");
 $res = $edit_id->fetch();
 $candidate_id=$res['id']; 
 
// 	if($inserts)
// 	{
// 	$password=md5("Welcome@123");
// 		$insert = $con->query("insert into z_user_master(candidate_id,user_name,password,full_name,status,email_id,user_group_code,mobile_no,gender,created_by,created_on)values('$candidate_id','','','$full_name','1','$mail','ROLE-006','$phone','$gender','$userid','$date')");
		
// 		$upd = $con->query("update interview_schedule_detail set status='2' where resource_id='$userid'");
// 	}
if($inserts)
	{
	$password=md5("Welcome@123");
	$user_id = "ANSPL". $candidate_id;
		
		 $insert = $con->query("INSERT INTO z_user_master
		(candidate_id, user_name, password, full_name, status, email_id, user_group_code, mobile_no, gender, created_by, created_on)
		VALUES
		('$candidate_id', '$user_id', '$password', '$full_name', '1', '$mail', 'ROLE-006', '$phone', '$gender', '$userid', '$date')");

		$upd = $con->query("update interview_schedule_detail set status='2' where resource_id='$userid'");
	}
}
else
{
$companyname=$_REQUEST['companyname'];
$no_of_year=$_REQUEST['no_of_year'];

$inserts = $con->query("INSERT INTO candidate_form_details(resource_id, position, first_name, last_name, father_name, gender, dob, address, paddress, phone, alternative_phone,mail, adharnumber, pannumber, voternumber,driving_license, educationalDetails, EmployeeStatus,  companyname, no_of_year, resume, photo, status, created_by, created_on)
 VALUES ('$userid','$position', '$first_name', '$last_name', '$father_name','$gender',  '$dob', '$address', '$paddress', '$phone','$a_phone', '$mail', '$adharnumber', '$pannumber', '$voternumber','$driving_license','$educationalDetails', '$EmployeeStatus',  '$companyname', '$no_of_year','$fileName','$fileName1', '$status','$userid','$date')");


$edit_id=$con->query("SELECT id FROM candidate_form_details order by id desc limit 1");
$res = $edit_id->fetch();
$candidate_id=$res['id'];
 
if($inserts)
	{
	    $password = md5("Welcome@123");
		$user_id = "ANSPL". $candidate_id;
		$insert = $con->query("insert into z_user_master(candidate_id,user_name,password,full_name,status,email_id,user_group_code,mobile_no,gender,created_by,created_on)
		values('$candidate_id','$user_id','$password','$full_name','1','$mail','ROLE-006','$phone','$gender','$userid','$date')");
		
		$upd = $con->query("update interview_schedule_detail set status='2' where resource_id='$userid'");
	}
}
if($insert)
{
	echo "<script> alert('Candidate Form is Submitted') </script>";
	echo "<script> window.location.href= '/ssinfo1/login/login.php'; </script>";	
}
else
{
	echo "<script> alert('Candidate Form is not Submitted') </script>";
	echo "<script> window.location.href= '/ssinfo1/login/login.php'; </script>";
}
?>