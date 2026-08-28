<?php  
 require '../../../connect.php';
include("../../../user.php");
if(isset($_POST['extra_file']) || isset($_POST['costsheet_id']) ) 
{	 
	   
	    $costsheet_id = $_POST["costsheet_id"];
       $filename = $_FILES["extra_file"]["name"];
       $tempname = $_FILES["extra_file"]["tmp_name"];    
       $folder = "uploads/".$filename;
	  
			
	    $update_query = $con->query("update cost_sheet_entry set extra_file ='$filename' WHERE id= '$costsheet_id'");  

	if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
      }
} 
 ?> 
