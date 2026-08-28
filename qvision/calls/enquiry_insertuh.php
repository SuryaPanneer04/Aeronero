
<?php
require '../../connect.php';
include("../../user.php");
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
	//exit;
	
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
 $department_id=$a1['dd'];
 $employee_id=$a1['em'];
$address=$a1['address'];
$cust_type=$a1['cust_type'];

$Product=$a1['Product'];
$list=$a1['services'];


$Company_name=$a1['client_org'];

$alternate_mail=$a1['alternate_mail'];
$flag = '2';

  $sql33=$con->query("insert into enquiry(`Call_type`,`cust_type`,`Calls_id`,`Calls_feedbackid`, `date`, `Client_type`, `Company_name`, `Location`,`Address`,`area`,`pincode`,`client_department`,
	`it_name`,`it_designation`,`it_mob1`,`it_mob2`,`it_mail1`,`it_mail2`,`it_landno`,`Client_id`,`Product`,`list`,`feedback`, `Follup`, `companys`, `Department`, `employee`,  `created_by`, `created_on`,`ind_client_id`,`verified_file`,`requirement`)
	values('$Call_type','$cust_type','$enquiry_id','$feedbackid','$date','$Client_type','$Company_name','$Location','$address','$area','$pincode','$client_depart','$client_name','$it_designation','$it_mob1','$it_mob2','$it_mail1','$it_mail2','$it_landno','$client_id','$Product','$list','$feedback','$Follup','$companys','$department_id','$employee_id','$user',now(),'$ind_client_id','$uploadedFile','$sco')"); 

/* echo "insert into enquiry(`Call_type`,`cust_type`,`Calls_id`,`Calls_feedbackid`, `date`, `Client_type`, `Company_name`, `Location`,`Address`,`area`,`pincode`,`client_department`,
	`it_name`,`it_designation`,`it_mob1`,`it_mob2`,`it_mail1`,`it_mail2`,`it_landno`,`Client_id`,`Product`,`list`,`feedback`, `Follup`, `companys`, `Department`, `employee`,  `created_by`, `created_on`,`ind_client_id`,`verified_file`,`requirement`)
	values('$Call_type','$cust_type','$enquiry_id','$feedbackid','$date','$Client_type','$Company_name','$Location','$address','$area','$pincode','$client_depart','$client_name','$it_designation','$it_mob1','$it_mob2','$it_mail1','$it_mail2','$it_landno','$client_id','$Product','$list','$feedback','$Follup','$companys','$department_id','$employee_id','$user',now(),'$ind_client_id','$uploadedFile','$sco')";
	 */
	
	
	$aa1 = $con->query("select id from enquiry order by id desc");
	$a11 = $aa1->fetch();
	$enqid=$a11['id'];
	


$sql12=$con->query("Update crm_calls set enquiry_id='$enqid',status='3',verified_file='$uploadedFile',requirement='$sco' where id='$id'"); 
//echo "Update crm_calls set enquiry_id='$enqid',status='3',verified_file='$uploadedFile',requirement='$sco' where id='$id'";

if($cust_type == 1){
	
	$bb = $con->query("select * from new_client_master a join new_plant_master b on (a.id=b.client_id) where a.id='$client_id'");
	$bb1 = $bb->rowCount();
	if($bb1 == 0){
		$flag = '2';
	$sql11=$con->query("UPDATE `enquiry` SET `flag`='$flag',`status`='2',`Client_id`='$client_id' WHERE calls_id='$enquiry_id'");
	echo "UPDATE `enquiry` SET `flag`='$flag',`status`='2',`Client_id`='$client_id' WHERE calls_id='$enquiry_id'";
	}else{
		$flag = '2';
	$sql11=$con->query("UPDATE `enquiry` SET `flag`='$flag',`status`='3',`Client_id`='$client_id' WHERE calls_id='$enquiry_id'");
	echo "UPDATE `enquiry` SET `flag`='$flag',`status`='3',`Client_id`='$client_id' WHERE calls_id='$enquiry_id'";
	}
}else if($cust_type == 2){
	$cc = $con->query("select * from individual_form where id='$ind_client_id'");
	$cc1 = $cc->rowCount();
	if($cc1 == 0){
		$flag = '2';
	$sql22=$con->query("UPDATE `enquiry` SET `flag`='$flag',`status`='2' WHERE calls_id='$enquiry_id'");
	echo "UPDATE `enquiry` SET `flag`='$flag',`status`='2' WHERE calls_id='$enquiry_id'";
	}else{
		$flag = '2';
	$sql22=$con->query("UPDATE `enquiry` SET `flag`='$flag',`status`='3' WHERE calls_id='$enquiry_id'");
	echo "UPDATE `enquiry` SET `flag`='$flag',`status`='3' WHERE calls_id='$enquiry_id'";
	}
}





			
}
?>