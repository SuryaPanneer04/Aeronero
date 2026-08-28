
<?php
require '../../../connect.php';
include("../../../user.php");
$uploadDir = 'uploads/';
$userrole=$_SESSION['userrole'];
$user=$_SESSION['userid'];
$candidateid=$_SESSION['candidateid'];
if(isset($_POST['idd']) || isset($_POST['attachfile'])){
  $id=$_REQUEST['idd'];

	$enquiry_id    = $_REQUEST['idd'];
	$filesArr3=$_FILES['attachfile'];
	$sco    = $_REQUEST['sco'];
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

$flow = 1;
	
	$aa = $con->query("select a.*,a.department as dd,a.employee as em,b.*,b.id as idd from crm_calls a join crm_calls_feedback b on a.id=b.calls_id where a.id='$enquiry_id'");
$a1 = $aa->fetch();

$feedbackid=$a1['idd'];
$cust_type=$a1['cust_type'];
$client_id=$a1['client_id'];
$ind_client_id=$a1['ind_client_id'];
$feedback=$a1['feedback'];
$feedback_date=$a1['feedback_date'];
$Follup=$a1['date'];
$date=$a1['date'];
$Call_type=$a1['call_type'];
$Client_type=$a1['client_type'];
$client_name=$a1['client_name'];
$contact=$a1['contact'];
$whatsapp=$a1['whatsapp'];
$email=$a1['email'];
$website=$a1['website'];
 
 
$address=$a1['address'];
$cust_type=$a1['cust_type'];

$Product=$a1['Product'];
$list=$a1['services'];
$dep = $con->query("select * from staff_master where candid_id='$candidateid'");
$depp = $dep->fetch();
$department_id = $depp['dep_id'];

$employee_id=$candidateid;
$Company_name=$a1['client_org'];

$alternate_mail=$a1['alternate_mail'];
$flag = '2';



if($Client_type==1)
{
$enq=$con->query("SELECT * FROM enquiry WHERE `enquiry_code` LIKE 'E%'");
$enq_count=$enq->rowCount();


if($enq_count == 0)
{
	$enquiry_code='E0001';
	//echo $customer_code;
}
else
{
	$add=$enq_count+1;
   //$customer_code="CT000".$add;
   
   $stmte=$con->prepare("SELECT MAX(ID)as max_id FROM enquiry where `enquiry_code` LIKE 'E%'"); 
					$stmte->execute(); 
					$rowe = $stmte->fetch();
					$maxi_id=$rowe['max_id'];
$stmtv=$con->prepare("SELECT id,enquiry_code FROM enquiry where id='$maxi_id'"); 
//echo "SELECT id,client_code FROM new_client_master where id='$maxi_id'";
					$stmtv->execute(); 
					$rowv = $stmtv->fetch();
					$enq_codes=$rowv['enquiry_code'];

					$find_fe = substr($rowv['enquiry_code'], 0, 2);
					$find_se = substr($rowv['enquiry_code'], 2, 4);
					//echo $find_fi;echo "<br/>";
					//echo $find_si;echo "<br/>";
					$final_enqno = str_pad($find_se + 1, 3, 0, STR_PAD_LEFT);
					//echo $final_csno;echo "<br/>";
					//echo $c_value= $find_s+1;
					$enquiry_code=$find_fe.$final_enqno;

}


}
else if($Client_type==2)
{




	$enq=$con->query("SELECT * FROM enquiry WHERE `enquiry_code` LIKE 'N%'");
	$enq_count=$enq->rowCount();
	echo "SELECT * FROM enquiry WHERE `enquiry_code` LIKE 'N%'";
	
	if($enq_count == 0)
	{
		$enquiry_code='N0001';
		echo $enquiry_code;
	}
	else
	{
		$add=$enq_count+1;
	   //$customer_code="CT000".$add;
	   
	   $stmte=$con->prepare("SELECT MAX(ID)as max_id FROM enquiry where `enquiry_code` LIKE 'N%'"); 
						$stmte->execute(); 
						$rowe = $stmte->fetch();
						$maxi_id=$rowe['max_id'];
	$stmtv=$con->prepare("SELECT id,enquiry_code FROM enquiry where id='$maxi_id'"); 
	//echo "SELECT id,client_code FROM new_client_master where id='$maxi_id'";
						$stmtv->execute(); 
						$rowv = $stmtv->fetch();
						$enq_codes=$rowv['enquiry_code'];
	
						$find_fe = substr($rowv['enquiry_code'], 0, 2);
						$find_se = substr($rowv['enquiry_code'], 2, 4);
						//echo $find_fi;echo "<br/>";
						//echo $find_si;echo "<br/>";
						$final_enqno = str_pad($find_se + 1, 3, 0, STR_PAD_LEFT);
						//echo $final_csno;echo "<br/>";
						//echo $c_value= $find_s+1;
						$enquiry_code=$find_fe.$final_enqno;
	
	}



}



  $sql33=$con->query("insert into enquiry(`enquiry_code`,`Call_type`,`cust_type`,`Calls_id`,`Calls_feedbackid`, `date`, `Client_type`, `Company_name`, `Address`,
	`it_name`,`Client_id`,`Product`,`list`,`feedback`, `Follup`,`Department`, `employee`,  `created_by`, `created_on`,`ind_client_id`,`verified_file`,`requirement`)
	values('$enquiry_code','$Call_type','$cust_type','$enquiry_id','$feedbackid','$date','$Client_type','$Company_name','$address','$client_name','$client_id','$Product','$list','$feedback','$Follup','$department_id','$employee_id','$user',now(),'$ind_client_id','$uploadedFile','$sco')"); 

echo "insert into enquiry(`enquiry_code`,`Call_type`,`cust_type`,`Calls_id`,`Calls_feedbackid`, `date`, `Client_type`, `Company_name`, `Address`,
`it_name`,`Client_id`,`Product`,`list`,`feedback`, `Follup`,`Department`, `employee`,  `created_by`, `created_on`,`ind_client_id`,`verified_file`,`requirement`)
values('$enquiry_code','$Call_type','$cust_type','$enquiry_id','$feedbackid','$date','$Client_type','$Company_name','$address','$client_name','$client_id','$Product','$list','$feedback','$Follup','$department_id','$employee_id','$user',now(),'$ind_client_id','$uploadedFile','$sco')";
	
	$aa1 = $con->query("select id from enquiry order by id desc");
	$a11 = $aa1->fetch();
	$enqid=$a11['id'];


$sql12=$con->query("Update crm_calls set department='$department_id',employee='$employee_id',enquiry_id='$enqid',status='3',verified_file='$uploadedFile',requirement='$sco' where id='$id'"); 



if($cust_type == 1){
	
	$bb = $con->query("select * from new_client_master a join new_plant_master b on (a.id=b.client_id) where a.id='$client_id'");
	$bb1 = $bb->rowCount();
	if($bb1 == 0){
	$sql11=$con->query("UPDATE `enquiry` SET `flag`='$flag',`status`='2',`Client_id`='$client_id' WHERE calls_id='$enquiry_id'");
	//echo "UPDATE `enquiry` SET `flag`='$flag',`status`='2',`Client_id`='$client_id' WHERE calls_id='$enquiry_id'";
	}else{
	$sql11=$con->query("UPDATE `enquiry` SET `flag`='$flag',`status`='3',`Client_id`='$client_id' WHERE calls_id='$enquiry_id'");
	//echo "UPDATE `enquiry` SET `flag`='$flag',`status`='3',`Client_id`='$client_id' WHERE calls_id='$enquiry_id'";
	}
}else if($cust_type == 2){
	$cc = $con->query("select * from individual_form where id='$ind_client_id'");
	$cc1 = $cc->rowCount();
	if($cc1 == 0){
	$sql22=$con->query("UPDATE `enquiry` SET `flag`='$flag',`status`='2' WHERE calls_id='$enquiry_id'");
	}else{
	$sql22=$con->query("UPDATE `enquiry` SET `flag`='$flag',`status`='3' WHERE calls_id='$enquiry_id'");
	}
}





			
}
?>