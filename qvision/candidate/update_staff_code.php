<?php 
require '../../connect.php';
include('../../user.php');
$userrole=$_SESSION['userrole'];
$userid=$_SESSION['userid'];

$fname=$_REQUEST['first_name'];
$lname=$_REQUEST['last_name'];


$candidateid=$_REQUEST['cid'];
$staff_type=$_REQUEST['staff_type'];
//$site=$_REQUEST['site'];
//$location=$_REQUEST['location'];
$emp_code=$_REQUEST['staffcode'];
$dept = $_REQUEST['department'];
$dep=$con->query("select * from candidate_form_details where id='$candidateid'");
//echo "select * from candidate_form_details where id='$candidateid'";
$dep_data=$dep->fetch();
//$dept=$dep_data['department'];
$desgn = $dep_data['position'];
$fistnameget=$dep_data['first_name'];
$lastnaemget=$dep_data['last_name'];
$location=$dep_data['location'];
$empname=$fistnameget."".$lastnaemget;

//$approved_ctc=$_REQUEST['approved_ctc'];

$sel=$con->query("select name,code from  prefixcode_master where id='$staff_type'");
$data=$sel->fetch();
$pref = $data['code'];

//Get salary data from Joining_sal_structure table.
$salary = $con->query("select fixedgross_month from  joining_detail_sal_structure where candid_id='$candidateid'");
$monthlySalary = $salary->fetch();
$monthlySal = $monthlySalary ? $monthlySalary['fixedgross_month'] : '0';


$sql2=$con->query("SELECT * FROM `staff_master`");
 $cou=$sql2->rowCount();
if($cou == 0)
{
	//$emp_code='00001';
}
else
{
	//$add=$cou+1;
   //$stmtz=$con->prepare("SELECT MAX(emp_code)as max_id FROM `staff_master`"); 
					//$stmtz->execute(); 
					//$rowz = $stmtz->fetch();
				   // $max_id=$rowz['max_id']; 
				    //$code =$pref.$max_id; 

			
			    // $find_f = substr($code, 0, 3);
			    // $find_s = substr($code, 3, 5);	
			     //$emp_code = str_pad($find_s + 1, 5, 0, STR_PAD_LEFT);
				 
			// echo		$find_f = substr($rowz['max_id'], 0, 2);echo"<br>";
			// echo		$find_s = substr($rowz['max_id'], 2, 3);echo"<br>";
					// $final_jdno = str_pad($find_s + 1, 3, 0, STR_PAD_LEFT);
			// echo	$emp_code=$find_f.$final_jdno;echo"<br>";
					
				//echo	$find_s = $max_id + 1; echo"<br>";
					//$empp_code = $find_s;				
}
$depemty=0;
$doj = $dep_data['joining_date'];
if ($dept != 0) {
    $ins = $con->query("insert into staff_master (candid_id,prefix_code,emp_code,emp_name,dep_id,design_id,salary_amount,status,created_by,created_on,DOJ) values('$candidateid','$pref','$emp_code','$empname','$dept','$desgn','$monthlySal',1,'$userid',now(),'$doj')");
} else {
    $ins = $con->query("insert into staff_master (candid_id,prefix_code,emp_code,emp_name,dep_id,design_id,salary_amount,status,created_by,created_on,DOJ) values('$candidateid','$pref','$emp_code','$empname','$depemty','$desgn','$monthlySal',1,'$userid',now(),'$doj')");
}

if (!$ins) {
    echo "DB Error: " . implode(" - ", $con->errorInfo());
}


 

//Update user role against candidate in z_user_master
$roleupdate=$con->query("update z_user_master set user_group_code='ROLE-007' where candidate_id='$candidateid'"); 

//Update status in candidate form table
$supdate=$con->query("update candidate_form_details set staff_type='$staff_type',department='$dept',status='23' where id='$candidateid' and status='22'"); 
//echo $supdate;
if($supdate && $ins && $roleupdate)
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
    $details=$con->query("select c.joining_date from candidate_form_details c join staff_master s on c.id=s.candid_id where c.id='$candidateid' && s.status='1'");
	$det=$details->fetch();
	$dojs=$det['joining_date'];
	$cl_from = date('Y-m-d', strtotime($dojs. ' + 8 months'));
	$pl_from = date('Y-m-d', strtotime($dojs. ' + 8 months'));
	//$leave_balance='0.5';
	
	
	$insert_sql1=$con->query("insert into leave_masters (candid_id,emp_name,doj,sl_from,cl_from,el_from,leave_type,total_leave,balance_leave,status,created_by,created_on) values ('$candidateid','$empname','$dojs','$cl_from','$cl_from','$pl_from','1','0.5','0.5','1','1',NOW())"); //Sick leave
	$insert_sql2=$con->query("insert into leave_masters (candid_id,emp_name,doj,sl_from,cl_from,el_from,leave_type,total_leave,balance_leave,status,created_by,created_on) values ('$candidateid','$empname','$dojs','$cl_from','$cl_from','$pl_from','2','1','1','1','1',NOW())"); //Eligible leave
	$insert_sql3=$con->query("insert into leave_masters (candid_id,emp_name,doj,sl_from,cl_from,el_from,leave_type,total_leave,balance_leave,status,created_by,created_on) values ('$candidateid','$empname','$dojs','$cl_from','$cl_from','$pl_from','3','0.5','0.5','1','1',NOW())"); //Casual Leave
	$insert_sql4=$con->query("insert into leave_masters (candid_id,emp_name,doj,sl_from,cl_from,el_from,leave_type,total_leave,balance_leave,status,created_by,created_on) values ('$candidateid','$empname','$dojs','$cl_from','$cl_from','$pl_from','4','1','1','1','1',NOW())"); //LOP
	$insert_sql4=$con->query("insert into leave_masters (candid_id,emp_name,doj,sl_from,cl_from,el_from,leave_type,total_leave,balance_leave,status,created_by,created_on) values ('$candidateid','$empname','$dojs','$dojs','$dojs','$dojs','5','1','1','1','1',NOW())"); //Emergency leave
	 }
?>