<?php 
require '../../connect.php';
include('../../user.php');
$userrole=$_SESSION['userrole'];
$userid=$_SESSION['userid'];

$fname=$_REQUEST['first_name'];
$lname=$_REQUEST['last_name'];
$empname=$fname." ".$lname;

$candidateid=$_REQUEST['cid'];
$staff_type=$_REQUEST['staff_type'];
//$site=$_REQUEST['site'];
//$location=$_REQUEST['location'];

$dep=$con->query("select * from candidate_form_details where id='$candidateid'");
$dep_data=$dep->fetch();
$dept = $dep_data['department'];
$desgn = $dep_data['position'];

$sel=$con->query("select name,code from  prefixcode_master where id='$staff_type'");
$data=$sel->fetch();
$pref = $data['code'];


$sql2=$con->query("SELECT * FROM `staff_master`");
$cou=$sql2->rowCount();
if($cou == 0)
{
	$emp_code='00001';
}
else
{
	$add=$cou+1;
   $stmtz=$con->prepare("SELECT MAX(emp_code)as max_id FROM `staff_master`"); 
					$stmtz->execute(); 
					$rowz = $stmtz->fetch();
				    $max_id=$rowz['max_id']; 
				    $code =$pref.$max_id; 

			
			     $find_f = substr($code, 0, 3);
			     $find_s = substr($code, 3, 5);	
			     $emp_code = str_pad($find_s + 1, 5, 0, STR_PAD_LEFT);
				 
			// echo		$find_f = substr($rowz['max_id'], 0, 2);echo"<br>";
			// echo		$find_s = substr($rowz['max_id'], 2, 3);echo"<br>";
					// $final_jdno = str_pad($find_s + 1, 3, 0, STR_PAD_LEFT);
			// echo	$emp_code=$find_f.$final_jdno;echo"<br>";
					
				//echo	$find_s = $max_id + 1; echo"<br>";
					//$empp_code = $find_s;				
}

$ins=$con->query("insert into staff_master (candid_id,prefix_code,emp_code,emp_name,dep_id,design_id,status,created_by,created_on) values('$candidateid','$pref','$emp_code','$empname','$dept','$desgn',1,'$userid',now())"); 
echo "insert into staff_master (candid_id,prefix_code,emp_code,emp_name,dep_id,design_id,status,created_by,created_on) values('$candidateid','$pref','$emp_code','$empname','$dept','$desgn',1,'$userid',now())";

echo "<br/>";



/* $supdate=$con->query("update candidate_form_details set staff_type='$staff_type',site='$site',location='$location',status='23' where id='$candidateid'"); */

$supdate=$con->query("update candidate_form_details set staff_type='$staff_type',status='23' where id='$candidateid'");

if($supdate && $ins)
{
	echo "Query updated";
	
}
else
{
	echo "Query not Updated";
}
?>