<?php
require '../../../../config.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
		/*$project_name=$_REQUEST['project_name'];
	$modules=$_REQUEST['modules'];
	$no_of_working_hours=$_REQUEST['no_of_working_hours'];
	$date=$_REQUEST['date'];*/

	$status=$_REQUEST['status'];
		
	//$sql=$con->query("insert into completed_task(project_name,modules,no_of_working_hours,date,status)values('$project_name','$modules','$no_of_working_hours','$date''$status')");
	$sql=$con->query("insert into completed_task(status)values('$status')");
	echo "insert into completed_task(status)values('$status')";
	//echo "insert into completed_task(project_name,modules,no_of_working_hours,date,status)values('$project_name','$modules','$no_of_working_hours','$date''$status')";
if($sql)
{
	echo "<script>alert('Inserted Updated');</script>";
	header("location:/qvision/index.php");
}
}
?>