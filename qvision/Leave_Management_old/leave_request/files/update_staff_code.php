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
$site=$_REQUEST['site'];
$location=$_REQUEST['location'];

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
					
     $stmtw=$con->prepare("SELECT id,emp_code FROM `staff_master` where emp_code='$max_id'"); 
					$stmtw->execute(); 
					$roww = $stmtw->fetch();
					
					//$find_f = substr($roww['emp_code'], 0, 2);
					//$find_s = substr($roww['emp_code'], 2, 4);
					//$final_jdno = str_pad($find_s + 1, 4, 0, STR_PAD_LEFT);
					//$emp_code=$find_f.$final_jdno;
					
					$find_s = $max_id + 1;
					$emp_code = $find_s;					
}

$ins=$con->query("insert into staff_master (candid_id,prefix_code,emp_code,emp_name,dep_id,design_id,status,created_by,created_on) values('$candidateid','$pref','$emp_code','$empname','$dept','$desgn',1,'$userid',now())"); 

echo "<br/>";



$supdate=$con->query("update candidate_form_details set staff_type='$staff_type',site='$site',location='$location',status='23' where id='$candidateid'");

if($supdate)
{
	echo "Query updated";
	
}
else
{
	echo "Query not Updated";
}

$stmt = $con->prepare("SELECT COUNT(*) as count FROM leave_masters where candid_id='$candidateid'");

	$stmt->execute(); 
     $row = $stmt->fetch();
	 $count=$row['count'];
	
	if($count==0)
	{	
	$emergency=$con->query("insert into emergency_leave(candidate_id,1,2,3,4,5,6,7,8)values('$candidateid','1','1','1','1','1,'1','1','1')");
	$details=$con->query("select c.joining_date from candidate_form_details c join staff_master s on c.id=s.candid_id where s.status='1'");
	$det=$details->fetch();
	$dojs=$det['joining_date'];
	
	$insert_sql1=$con->query("insert into leave_masters (candid_id,emp_name,doj,cl_from,pl_from,leave_type,total_leave,balance_leave,status,created_by,created_on) values ('$candidateid','$empname','$dojs','$cl_from','$pl_from','1','','$leave_balance','1','1',NOW())");
	
	$insert_sql2=$con->query("insert into leave_masters (candid_id,emp_name,doj,cl_from,pl_from,leave_type,total_leave,balance_leave,status,created_by,created_on) values ('$candidateid','$empname','$dojs','$cl_from','$pl_from','2','','$leave_balance','1','1',NOW())");
	$insert_sql3=$con->query("insert into leave_masters (candid_id,emp_name,doj,cl_from,pl_from,leave_type,total_leave,balance_leave,status,created_by,created_on) values ('$candidateid','$empname','$dojs','$cl_from','$pl_from','3','','$leave_balance','1','1',NOW())");
	$insert_sql4=$con->query("insert into leave_masters (candid_id,emp_name,doj,cl_from,pl_from,leave_type,total_leave,balance_leave,status,created_by,created_on) values ('$candidateid','$empname','$dojs','$cl_from','$pl_from','4','','$leave_balance','1','1',NOW())");
	}
?>