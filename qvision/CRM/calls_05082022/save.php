<?php
	include 'config.php';
if(isset($_POST['stud_department']) || isset($_POST['stud_name']) || isset($_POST['degree']) || isset($_POST['specialization']) || isset($_POST['passout']) || isset($_POST['percentage']) || isset($_POST['certifications']) || isset($_POST['certificationzoho']))
{	
	$stud_department=$_REQUEST['stud_department'];
	$stud_name=$_REQUEST['stud_name'];
	$degree=$_REQUEST['degree'];
	$specialization=$_REQUEST['specialization'];
	$passout=$_REQUEST['passout'];
	$percentage=$_REQUEST['percentage'];
	$certifications=$_REQUEST['certifications'];

	 //$record=count($_REQUEST['record']);
	//echo $record;
	for($i=0;$i<count($stud_name);$i++){
		  $department = $stud_department[$i];
		  $name = $stud_name[$i];
		  $degree1 = $degree[$i];
		  $specialization1 = $specialization[$i];
		  $passout1 = $passout[$i];
		  $percentage1 = $percentage[$i];
		  $certifications1 = $certifications[$i];

		 
		 $filename = $_FILES["certificationzoho"]["name"][$i];
		// echo  $filename;exit;
      $tempname = $_FILES["certificationzoho"]["tmp_name"][$i];    
     
	  $folder = "passport_images/".$filename;
	  
	  
	  if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
      }
	  
	  
		 //echo $name = $stud_name[$i];
	   $insert_sql=mysqli_query($mysqli,"INSERT INTO user_data(stud_department,stud_name,degree,specialization,passout,percentage,certifications,upload) 
		VALUES ('$department','$name','$degree1','$specialization1','$passout1','$percentage1','$certifications1','$filename')");
	/* echo "INSERT INTO user_data(stud_department,stud_name,degree,specialization,passout,percentage,certifications,upload) 
		VALUES ('$department','$name','$degree1','$specialization1','$passout1','$percentage1','$certifications1','$filename')"; */
		//mysqli_query($conn, $insert_sql);
        
		
}
}
	
		
	
?>