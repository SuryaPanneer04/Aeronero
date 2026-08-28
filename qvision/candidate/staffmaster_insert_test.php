<?php
require '../../connect.php';
include('../../user.php');


$staff_type=$_REQUEST['staff_type'];
$status=1;

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

$ins=$con->query("insert into staff_master (candid_id,prefix_code,emp_code,emp_name,dep_id,status,created_by,created_on) values('$candidateid','$pref','$emp_code','$empname',$department,1,'$userid',now())"); 
echo "<br/>";


?>  






