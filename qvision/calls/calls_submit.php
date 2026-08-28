
<?php
require '../../connect.php';
include("../../user.php");
$uploadDir = 'uploads/';
$user=$_SESSION['userid'];
if(isset($_POST['cust_type'])|| isset($_POST['Call_type'])|| isset($_POST['client_type'])|| isset($_POST['client_name'])|| isset($_POST['contact'])|| isset($_POST['whatsapp'])|| isset($_POST['email'])|| 
isset($_POST['website']) || isset($_POST['Product']) || isset($_POST['services']) || isset($_POST['feedback_date']) || isset($_POST['fed_date']) || isset($_POST['client_orgg']) || isset($_POST['client_org1']) || isset($_POST['client_type1']) || isset($_POST['client_org']) ||
isset($_POST['address']) || isset($_POST['mail'])   || isset($_POST['attachfile']) || isset($_POST['feedback']) || isset($_POST['remarks']))
{
//$date = $_REQUEST['date'];
 $cust_type=$_REQUEST['cust_type'];
$Call_type=$_REQUEST['Call_type'];
 $Client_type=$_REQUEST['client_type'];
 
 $client_name=$_REQUEST['client_name'];
  
$contact=$_REQUEST['contact'];
$whatsapp=$_REQUEST['whatsapp'];
$email=$_REQUEST['email'];
$website=$_REQUEST['website'];
$address=$_REQUEST['address'];

$Product=$_REQUEST['Product'];
 $services1=$_REQUEST['services'] ?? null;
if($services1 == null){
	 $services = 12;
}else if($services1 != null){
	 $services = $_REQUEST['services'];
}

$remarks=$_REQUEST['remarks'];


 $feedback=$_REQUEST['feedback1'];
 $feedback_date=$_REQUEST['feedback_date1'];
 $fed_date=$_REQUEST['fed_date1'];
$filesArr3=$_FILES['attachfile'];

$mail=$_REQUEST['mail'];
$flag = '1';
$role_id='R018';


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


if($Client_type==1)
{
	
	 $Company_name1=$_REQUEST['client_orgg'];
	 if($Company_name1== ""){
		 echo "0";
	 }else{
		 $Company_name=$_REQUEST['client_orgg'];

		 $str_arr = preg_split ("/\-/", $Company_name); 
		$client_org_id         =$str_arr[0];
		$client_org_name         =$str_arr[1];

	
   $sql11=$con->query("insert into crm_calls(cust_type,call_type,client_type,client_org,client_id,client_name,role_id,contact,whatsapp,email,
alternative_mail,website,address,Product,services,created_by,created_on,status,flag,image,remarks) values('$cust_type','$Call_type','$Client_type',
'$client_org_name','$client_org_id','$client_name','$role_id','$contact','$whatsapp','$email','$mail','$website','$address','$Product',
'$services','$user',now(),1,'$flag','$uploadedFile','$remarks')"); 
echo "1";
	 }

	
 

}else if($Client_type==2){
	
	 $Company_name1=$_REQUEST['client_org1'];
	  if($Company_name1== ""){
		 echo "0";
	 }else{
		 $Company_name=$_REQUEST['client_org1'];
		  $sql11=$con->query("insert into crm_calls(cust_type,call_type,client_type,client_org,client_name,role_id,contact,whatsapp,email,
	alternative_mail,website,address,Product,services,created_by,created_on,status,flag,image,remarks) values('$cust_type','$Call_type','$Client_type',
	'$Company_name','$client_name','$role_id','$contact','$whatsapp','$email','$mail','$website','$address','$Product','$services',
	'$user',now(),1,'$flag','$uploadedFile','$remarks')"); 
	echo "1";
	 }
	
	


}
 $client_type1=$_REQUEST['client_type1']; 
if($client_type1==3)
{
	  if($client_name== ""){
		 echo "0";
	 }else{
		  $Company_name11='Individual Customer';
	 $client_name1=$_REQUEST['client_name'];
	
	 $sql11=$con->query("insert into crm_calls(client_org,cust_type,Call_type,client_type,client_name,role_id,contact,whatsapp,email,
alternative_mail,address,Product,services,created_by,created_on,status,flag,image,remarks) values('$Company_name11','$cust_type','$Call_type','$client_type1',
'$client_name1','$role_id','$contact','$whatsapp','$email','$mail','$address','$Product',
'$services','$user',now(),1,'$flag','$uploadedFile','$remarks')");  
 echo "1";
	 }
}
if($client_type1==4)
{
	 $Company_name11='Individual Customer';
	 $client_name2=$_REQUEST['client_org'];
	  if($client_name2== ""){
		 echo "0";
	 }else{
		 $client_name3=$_REQUEST['client_org'];
	$aa = $con->query("select id from individual_form where client_name='$client_name3'");
$a1 = $aa->fetch();
	 $client_orgid=$a1['id'];
	
	 $sql11=$con->query("insert into crm_calls(client_org,cust_type,Call_type,client_type,client_name,role_id,contact,whatsapp,email,
alternative_mail,address,Product,services,created_by,created_on,status,flag,ind_client_id,image,remarks) values('$Company_name11','$cust_type','$Call_type','$client_type1',
'$client_name2','$role_id','$contact','$whatsapp','$email','$mail','$address','$Product',
'$services','$user',now(),1,'$flag','$client_orgid','$uploadedFile','$remarks')"); 


echo "1";
}
}

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

//echo "insert into crm_calls_feedback(calls_id,feedback,feedback_date,date,created_by,created_on) values($id1','$feedback1','$feedback_date1','$fed_date1','$user',now())";

}

}

?>