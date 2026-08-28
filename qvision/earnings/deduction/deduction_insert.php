<?php
require '../../../connect.php';

if(isset($_POST['month']) || isset($_POST['emp_name']) || isset($_POST['tds']) || isset($_POST['sad']) ){

//$month = $_POST['month'];
//$year  = date("Y"); 
$emp   = $_POST['emp_name']; 
$cnt   = count($emp);
$tds   = $_POST['tds'];
$sad   = $_POST['sad'];

for($i=0;$i<$cnt;$i++)
{
	$employee_no  = $emp[$i];
	$employee_tds = $tds[$i];
	$employee_sad = $sad[$i];
    $emp_name_sql = "SELECT id,emp_name,emp_code,prefix_code,dep_id,design_id,candid_id FROM staff_master where id='$employee_no'";
	$emp_name_list = $con->query($emp_name_sql);
    $emp_name_data = $emp_name_list->fetch(PDO::FETCH_ASSOC);
    $emp_name = $emp_name_data['emp_name'];
	$emp_id = $emp_name_data['id'];
	$dep_id = $emp_name_data['dep_id'];
	$design_id = $emp_name_data['design_id'];
	$candid_id = $emp_name_data['candid_id'];


	$salary_deduction = $con->query("INSERT INTO salary_monthly_deduction(emp_code,candid_id,emp_name,dep_id,design_id,TDS,SAD,status) VALUES ('$emp_id','$candid_id','$emp_name','$dep_id','$design_id','$employee_tds','$employee_sad','1')");
}

if($salary_deduction)
{
	echo 1;
}
else
{
	echo 0;
}
}	
?>
