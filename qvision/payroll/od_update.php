<?php
require '../../connect.php';
$uploadDir = 'uploads/';
if(isset($_POST['date']) || isset($_POST['Employee_name'])|| isset($_POST['get_id'])|| isset($_POST['travel'])|| isset($_POST['Customer_name'])|| isset($_POST['Location'])|| isset($_POST['Purpose'])|| isset($_POST['amount'])|| isset($_POST['kms'])|| isset($_POST['attachfile']))
{
$id = $_REQUEST['get_id'];
$date = $_REQUEST['date'];
$Employee_name = $_REQUEST['Employee_name'];
$Customer_name = $_REQUEST['Customer_name'];
$travel = $_REQUEST['travel'];
$Location = $_REQUEST['Location'];
$Purpose = $_REQUEST['Purpose'];
//$Distance = $_REQUEST['distance'];
$Amount = $_REQUEST['amount'];
$kms = $_REQUEST['kms'];
$filesArr3 = $_FILES['attachfile'];

$status =1;

$fileNames = array_filter($filesArr3['name']); 
			 
         
        // Upload file 
        $uploadedFile = ''; 
                                  
            foreach($filesArr3['name'] as $key=>$val)
			{  
                // File upload path  
                $fileName = basename($filesArr3['name'][$key]);  
                $targetFilePath = $uploadDir . $fileName;  
                  
                // Check whether file type is valid  
                 $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                
                    // Upload file to server  
                    if(move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath)){  
                        $uploadedFile = $fileName; 
                     
                }
            }  
			
		
/* $sql =$con->query("insert into manual_att(emp_code,customer_name,travel_type,location,date,purpose,kms,amount,file,status,created_on) values('$Employee_name','$Customer_name','$travel','$Location','$date','$Purpose','$kms','$Amount','$fileName','$status',now())");

echo "insert into manual_att(emp_code,customer_name,location,date,purpose,distance,kms,amount,file,status,created_on) values('$Employee_name','$Customer_name','$Location','$date','$Purpose','$Distance','$kms','$Amount','$fileName','$status',now())"; */


$sql=$con->query("Update claim_request set customer_name='$Customer_name',travel_type='$travel',location='$Location',purpose='$Purpose',kms='$kms',amount='$Amount' where id='$id'");

}
?>



