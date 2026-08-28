<?php
// Load the database configuration file
include_once '../../config.php';
include("../../user.php");
$user=$_SESSION['userid'];
if(isset($_POST['importSubmit'])){
	

    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
 // Validate whether selected file is a CSV file
  
        
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $client_org   = $line[0];
                $client_name  = $line[1];
                $contact  = $line[2];
                $email = $line[3];
                $website = $line[4];
                $address = $line[5];
                $city = $line[6];
                $state = $line[7];
                $country = $line[8];
               
            
                
$sql99=$con->query("insert into crm_calls(client_org,client_name,contact,email,website,address,city,state,country,created_by,created_on,status) values('$client_org','$client_name','$contact','$email','$website','$address','$city','$state','$country','$user',now(),1)"); 

$a1=$con->query("SELECT id FROM `crm_calls` ORDER BY id DESC");
$a = $a1->fetch();
  $id = $a['id'];
	

$feedback=$line[9];
$newDate=$line[10];
 $feedback_date = date("Y-m-d", strtotime($newDate));
$newDate1=$line[11];
 $fed_date= date("Y-m-d", strtotime($newDate1));


$sql98 =$con->query("insert into crm_calls_feedback(calls_id,feedback,feedback_date,date,created_by,created_on) values('$id','$feedback','$feedback_date','$fed_date','$user',now())"); 

$sql97 =$con->query("Update crm_calls set status='2' where id='$id'"); 
 
?>
  <script>alert("File Uploaded");</script>
<script>window.location.href='../../index.php';</script>
  <?php
             
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
        }else{
           ?>
		   <script>alert("File Not Upload");</script>
		   <script>window.location.href='../../index.php';</script>
		   <?php
        }
   
}
else{
        ?>
		   <script>alert("File Not Upload");</script>
		   <script>window.location.href='../../index.php';</script>
		   <?php
    }
	?>

