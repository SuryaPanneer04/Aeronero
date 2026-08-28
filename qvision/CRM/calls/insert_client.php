
<?php
require '../../../connect.php';
Session_start();

?>
<?php
$user_id =$_SESSION['userid'];


	
	 $idee = $_REQUEST['idee'];
	 $department_id1 = $_REQUEST['department_id'];
	
	 $employee_id1   = $_REQUEST['employee_id'];
	
	
	 $org_name      = $_REQUEST['org_name'];
	 $org_type      = $_REQUEST['org_type'];
	 $website       = $_REQUEST['website'];
	$pan=$_REQUEST['pan'];
	$calls_id=$_REQUEST['calls_id'];
	$ims_status     = $_REQUEST['ims_status'];
	$pan_check=$con->query("select * from new_client_master where pan_number='$pan'");
	$pans=$pan_check->rowCount();
	if ($pan == '' || $org_type == '' || $website == ''){
		echo 0;
		//echo '<script>alert("Pan Number already exists..")</script>';
	}
	elseif($pans>0){
			echo "2";
	}
	else{
	 $insert_sql=$con->query("insert into new_client_master(calls_id,department_id,employee_id,org_name,org_type,pan_number,website,ims_status,status,flow,created_by,created_on)
	values('$calls_id','$department_id1','$employee_id1','$org_name','$org_type','$pan','$website','$ims_status','1','1','$user_id',NOW())"); 
	

	
	
	$aa = $con->query("select a.*,b.*,c.it_name as it_name,b.id as idd from crm_calls a join crm_calls_feedback b on (a.id=b.calls_id) join enquiry c on (a.enquiry_id=c.id) where a.enquiry_id='$idee'");
	
$a1 = $aa->fetch();

$feedbackid=$a1['idd'];
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

$Product=$a1['Product'];
$list=$a1['services'];


$Company_name=$a1['client_org'];
$it_name=$a1['it_name'];

$flag = '2';
$status = '1';

$stmt=$con->query("select a.id as last_client_id from new_client_master a ORDER BY id DESC LIMIT 1");	
		$stmt->execute();
		$row=$stmt->fetch();
		$client_id=$row['last_client_id'];
		
		/*  $insert_query2=$con->query("insert into new_plant_master (client_id,client_org_name,pan_no,address,it_name,status,flow,created_by,created_on)values('$client_id','$org_name','$pan',
		'$address','$it_name','$status',
		'1','$user_id',NOW())");  */
		
			$sql11=$con->query("UPDATE `crm_calls` SET `client_id`='$client_id' WHERE enquiry_id='$idee'");
	$sql16=$con->query("UPDATE `enquiry` SET `client_id`='$client_id' WHERE id='$idee'");
	
	if($insert_sql)
	{
		echo "1";
		
	}else{
	echo "3";
	}
	
	}
	
?>
