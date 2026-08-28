<?php
require '../../connect.php';

if(isset($_POST['month']) || isset($_POST['emp_name']) || isset($_POST['spa']) || isset($_POST['lta']) ){

$month = $_POST['month'];
$year  = date("Y"); 
$emp   = $_POST['emp_name']; echo "<br>";
$cnt   = count($emp);
$spa   = $_POST['spa'];
$lta   = $_POST['lta'];

for($i=0;$i<$cnt;$i++)
{
	$employee_no  = $emp[$i];
	$employee_spa = $spa[$i];
	$employee_lta = $lta[$i];
    $emp_name_sql = "SELECT id,emp_name,emp_code,prefix_code,dep_id,design_id,candid_id FROM staff_master where id='$employee_no'";
	
	$emp_name_list = $con->query($emp_name_sql);
    $emp_name_data = $emp_name_list->fetch(PDO::FETCH_ASSOC);
    $emp_name = $emp_name_data['emp_name'];
	$emp_id = $emp_name_data['id'];
	$dep_id = $emp_name_data['dep_id'];
	$design_id = $emp_name_data['design_id'];
	$candid_id = $emp_name_data['candid_id'];


	$salary_earnings = $con->query("INSERT INTO salary_monthly_earning(emp_code,candid_id,emp_name,dep_id,design_id,payroll_month,payroll_year,Special_Allowance, LTA,status) VALUES ('$emp_id','$candid_id','$emp_name','$dep_id','$design_id','$month','$year','$employee_spa','$employee_lta','1')");
}

if($salary_earnings)
{
	echo 1;
}
else
{
	echo 0;
}
}	
?>
