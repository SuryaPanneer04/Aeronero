
<?php
require '../../config.php';
include("../../user.php");
$user=$_SESSION['userid'];
/* $uploadDir = 'uploads/';
if(isset($_POST['Call_type'])|| isset($_POST['Client_type'])|| isset($_POST['client_name'])|| isset($_POST['contact'])|| isset($_POST['whatsapp'])|| isset($_POST['email'])|| isset($_POST['address']) || isset($_POST['mail'])   || isset($_POST['pan']) || isset($_POST['attachfile']) || isset($_POST['feedback']))
{
	 */

//$date = $_REQUEST['date'];
/* $Call_type=$_REQUEST['Call_type'];
 $Client_type=$_REQUEST['Client_type']; */
$client_name=$_REQUEST['client_name'];
$contact=$_REQUEST['contact'];
$whatsapp=$_REQUEST['whatsapp'];
$email=$_REQUEST['email'];
//$website=$_REQUEST['website'];
$address=$_REQUEST['address'];
$idee=$_REQUEST['id'];
$state=$_REQUEST['state'];
$city=$_REQUEST['city'];
/* $Product=$_REQUEST['Product'];
$services=$_REQUEST['services']; */
//$filesArr3=$_FILES['attachfile'];


/* $fileNames = array_filter($filesArr3['name']); 
			 
         
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
 */


$flag = '1';


	 $Company_name11='Individual Customer';
	 	$pan=$_REQUEST['pan'];
	
	$pan_check=$con->query("select * from individual_form where pan_card='$pan'");
	$pans=$pan_check->rowCount();
	$pan_check1=$con->query("select * from new_client_master where pan_number='$pan'");
	$pans1=$pan_check1->rowCount();
	if($pans>0 || $pans1>0){
		echo 0;
		//echo '<script>alert("Pan Number already exists..")</script>';
	}elseif($contact != '' && $email != '' && $address != '' && $pan != ''){
	$sql11=$con->query("insert into individual_form(client_org,client_name,contact,whatsapp,email,state,city,address,created_by,created_on,status,flag,pan_card) values('$Company_name11','$client_name','$contact','$whatsapp','$email','$state','$city','$address','$user',now(),1,'$flag','$pan')"); 

	$stmt=$con->query("select a.id as last_client_id from individual_form a ORDER BY id DESC LIMIT 1");	
		$stmt->execute();
		$row=$stmt->fetch();
		$client_id=$row['last_client_id'];
		$sql12=$con->query("UPDATE `crm_calls` SET `ind_client_id`='$client_id' WHERE enquiry_id='$idee'");
	$sql16=$con->query("UPDATE `enquiry` SET `ind_client_id`='$client_id' WHERE id='$idee'");
	if($sql11)
	{
		echo "1";
		
	}else{
	echo "2";
	}
	}
	else{
		echo "3";
	}

// }
?>