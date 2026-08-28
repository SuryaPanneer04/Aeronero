<?php

require '../../../../connect.php';
require '../../../../user.php';


$staff_id=$_REQUEST['staff_id'];
$staff_salary_amount=$_REQUEST['staff_salary_amount'];
$check_list=$_REQUEST['check_list'];
if(empty($check_list))
{
	$deductions =0;
}
else
{
	$deductions = implode(',',$check_list);
}

$statement = $con->query("UPDATE staff_master SET payroll_deduction_id='$deductions' WHERE candid_id='$staff_id'");
 //echo "UPDATE staff_master SET payroll_deduction_id='$deductions' WHERE candid_id='$staff_id'";
if($statement)
{
	echo 1;
}

?>