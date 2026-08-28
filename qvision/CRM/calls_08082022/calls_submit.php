<?php
require '../../config.php';
include("../../user.php");
$user=$_SESSION['userid'];
$uploadDir = 'uploads/';
if(isset($_POST['Call_type'])|| isset($_POST['Client_type'])|| isset($_POST['client_name'])|| isset($_POST['contact'])|| isset($_POST['whatsapp'])|| isset($_POST['email'])|| isset($_POST['website']) || isset($_POST['address'])|| isset($_POST['Product'])|| isset($_POST['services']) || isset($_POST['mail']) || isset($_POST['client_org']) || isset($_POST['client_org1'])  || isset($_POST['pan']) || isset($_POST['attachfile']) || isset($_POST['feedback']) || isset($_POST['feedback_date'])  || isset($_POST['fed_date']))
{
//$date = $_REQUEST['date'];
$Call_type=$_REQUEST['Call_type'];
 $Client_type=$_REQUEST['Client_type'];
$client_name=$_REQUEST['client_name'];
$contact=$_REQUEST['contact'];
$whatsapp=$_REQUEST['whatsapp'];
$email=$_REQUEST['email'];
$website=$_REQUEST['website'];
$address=$_REQUEST['address'];

$Product=$_REQUEST['Product'];
$services=$_REQUEST['services'];
$filesArr3=$_FILES['attachfile'];

$feedback=$_REQUEST['feedback'];
$feedback_date=$_REQUEST['feedback_date'];
$fed_date=$_REQUEST['fed_date'];
/* 
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
 */


$mail=$_REQUEST['mail'];
$flag = '1';
if($Client_type==1)
{
	
	 $Company_name=$_REQUEST['client_org'];

	$aa = $con->query("select id from new_client_master where org_name='$Company_name'");
$a1 = $aa->fetch();
	 $client_orgid=$a1['id'];
$sql11=$con->query("insert into crm_calls(call_type,client_type,client_org,client_id,client_name,contact,whatsapp,email,alternative_mail,website,address,Product,services,created_by,created_on,status,flag) values('$Call_type','$Client_type','$Company_name','$client_orgid','$client_name','$contact','$whatsapp','$email','$mail','$website','$address','$Product','$services','$user',now(),1,'$flag')"); 
/* echo "insert into crm_calls(call_type,client_type,client_org,client_id,client_name,contact,whatsapp,email,alternative_mail,website,address,Product,services,created_by,created_on,status,flag,image) values('$Call_type','$Client_type','$Company_name','$client_orgid','$client_name','$contact','$whatsapp','$email','$mail','$website','$address','$Product','$services','$user',now(),1,'$flag','$fileName')"; */
//echo "insert into crm_calls(call_type,client_type,client_org,client_name,contact,whatsapp,email,alternative_mail,website,address,Product,services,created_by,created_on,status,flag) values('$Call_type','$Client_type','$Company_name','$client_name','$contact','$whatsapp','$email','$mail','$website','$address','$Product','$services','$user',now(),1,'$flag')";

//echo "insert into products_master(`Product_name`) values('$product_name')";



}else if($Client_type==2){
	
	echo $Company_name=$_REQUEST['client_org1'];
	$sql11=$con->query("insert into crm_calls(call_type,client_type,client_org,client_name,contact,whatsapp,email,alternative_mail,website,address,Product,services,created_by,created_on,status,flag) values('$Call_type','$Client_type','$Company_name','$client_name','$contact','$whatsapp','$email','$mail','$website','$address','$Product','$services','$user',now(),1,'$flag')"); 
/* echo "insert into crm_calls(call_type,client_type,client_org,client_name,contact,whatsapp,email,alternative_mail,website,address,Product,services,created_by,created_on,status,flag,image) values('$Call_type','$Client_type','$Company_name','$client_name','$contact','$whatsapp','$email','$mail','$website','$address','$Product','$services','$user',now(),1,'$flag','$fileName')"; */



	
}
/* else if($Client_type==3){
	
	 $Company_name11='Individual Customer';
	 $pan=$_REQUEST['pan'];
	$sql11=$con->query("insert into crm_calls(call_type,client_type,client_org,client_name,contact,whatsapp,email,alternative_mail,address,Product,services,created_by,created_on,status,flag,pan_card,image) values('$Call_type','$Client_type','$Company_name11','$client_name','$contact','$whatsapp','$email','$mail','$address','$Product','$services','$user',now(),1,'$flag','$pan','$fileName')"); 
echo "insert into crm_calls(call_type,client_type,client_org,client_name,contact,whatsapp,email,alternative_mail,address,Product,services,created_by,created_on,status,flag,pan_card,image) values('$Call_type','$Client_type','$Company_name11','$client_name','$contact','$whatsapp','$email','$mail','$address','$Product','$services','$user',now(),1,'$flag','$pan','$fileName')";



	
}
 */
$ss = $con->query("select max(id) as idddd from crm_calls");
							$ssid = $ss->fetch();
							$idd = $ssid['idddd'];
							//  $con->exec($sql11);
							//$last_id = $con->lastInsertId();
for($i=0;$i<count($feedback);$i++){
	
	$feedback1=$feedback[$i];
$feedback_date1=$feedback_date[$i];
$fed_date1=$fed_date[$i];
$id1=$idd;



$sql11=$con->query("insert into crm_calls_feedback(calls_id,feedback,feedback_date,date,created_by,created_on) values('$id1','$feedback1','$feedback_date1','$fed_date1','$user',now())"); 
echo "insert into crm_calls_feedback(calls_id,feedback,feedback_date,date,created_by,created_on) values($id1','$feedback1','$feedback_date1','$fed_date1','$user',now())";

}

}
?>