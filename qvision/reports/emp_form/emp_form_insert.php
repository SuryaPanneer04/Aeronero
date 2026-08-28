<?php
require '../../../connect.php';
Session_start();

?>
<?php
$user_id =$_SESSION['userid'];
if(isset($_POST['emp_dob_as_per_aadhar']) || isset($_POST['personal_contact_no']) || isset($_POST['emergency_contact_no']) || isset($_POST['present_address']) || isset($_POST['permanent_address']) || isset($_POST['pan_no']) || isset($_POST['aadhar_no']) || isset($_POST['driving_license_no']) || isset($_POST['father_name_with_initial']) || isset($_POST['father_dob_per_aadhar']) || isset($_POST['mother_name']) || isset($_POST['mother_dob_per_aadhar']) || isset($_POST['first_child']) || isset($_POST['first_child_dob']) || isset($_POST['second_child_name']) || isset($_POST['second_child_dob']) || isset($_POST['emp_code']) || isset($_POST['emp_name']) || isset($_POST['emp_doj']) || isset($_POST['emp_designation']) || isset($_POST['sid']) || isset($_POST['emp_doj_exp']) ){	
	// $department_id = $_REQUEST['department_id'];
	// $employee_id   = $_REQUEST['employee_id'];
	 //$org_name      = $_REQUEST['org_name'];
	// $org_type      = $_REQUEST['org_type'];
	 //$website       = $_REQUEST['website'];
	 //$client_code   = $_REQUEST['client_code'];
$sid   = $_REQUEST['sid'];
$emp_dob_as_per_aadhar   = $_REQUEST['emp_dob_as_per_aadhar'];
$personal_contact_no   = $_REQUEST['personal_contact_no'];
$emergency_contact_no   = $_REQUEST['emergency_contact_no'];
$present_address   = $_REQUEST['present_address'];
$permanent_address   = $_REQUEST['permanent_address'];
$pan_no   = $_REQUEST['pan_no'];
$aadhar_no   = $_REQUEST['aadhar_no'];
$driving_license_no   = $_REQUEST['driving_license_no'];
$father_name_with_initial   = $_REQUEST['father_name_with_initial'];
$father_dob_per_aadhar   = $_REQUEST['father_dob_per_aadhar'];
$mother_name   = $_REQUEST['mother_name'];
$mother_dob_per_aadhar   = $_REQUEST['mother_dob_per_aadhar'];
$first_child   = $_REQUEST['first_child'];
$first_child_dob   = $_REQUEST['first_child_dob'];
$second_child_name   = $_REQUEST['second_child_name'];
$second_child_dob   = $_REQUEST['second_child_dob'];
$emp_code   = $_REQUEST['emp_code'];
$emp_name   = $_REQUEST['emp_name'];
$emp_doj   = $_REQUEST['emp_doj'];
$emp_designation   = $_REQUEST['emp_designation'];
$emp_doj_exp   = $_REQUEST['emp_doj_exp'];
	
	$insert_sql=$con->query("insert into employee_master_data(staff_id,emp_dob_as_per_aadhar,personal_contact_no,emergency_contact_no,present_address,permanent_address,pan_no,aadhar_no,driving_license_no,father_name_with_initial,father_dob_per_aadhar,mother_name,mother_dob_per_aadhar,first_child,first_child_dob,second_child_name,second_child_dob,status,created_by,created_on,emp_code,emp_name,emp_doj,emp_designation,employee_date_of_confirmation_doj)
	values('$sid','$emp_dob_as_per_aadhar','$personal_contact_no','$emergency_contact_no','$present_address','$permanent_address','$pan_no','$aadhar_no','$driving_license_no','$father_name_with_initial','$father_dob_per_aadhar','$mother_name','$mother_dob_per_aadhar','$first_child','$first_child_dob','$second_child_name','$second_child_dob',1,'$user_id',NOW(),'$emp_code','$emp_name','$emp_doj','$emp_designation','$emp_doj_exp')");

	
	if($insert_sql)
	{
		echo "1";
		
	}else{
	echo "2";
	}
}
?>
