<?php
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];
$candidate_id = $_SESSION['candidateid'];
if(isset($_POST['uploadfile']) ||isset($_POST['lr_id'])) 
{	
       $lr_id = $_REQUEST['lr_id'];
       $challanId = $_REQUEST['challanId'];
       $filename = $_FILES["uploadfile"]["name"];
       $tempname = $_FILES["uploadfile"]["tmp_name"];    
       $folder = "courier_file/".$filename;

$sql=$con->query("UPDATE lr_courier_details SET `status`='1',`file_upload`='$filename',`modified_by`='$candidate_id',`modified_on`= now() WHERE id = '$lr_id'");

$poUpdate = $con -> query("update challan_entry set status= 4 where id ='$challanId' "); // when Challan upload then challan_entry table status will update to "4" .///

if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
      }

}
else
{
	echo 0;
}

?>