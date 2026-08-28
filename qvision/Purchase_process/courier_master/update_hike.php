<?php
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];
$candidate_id = $_SESSION['candidateid'];

$fid = $_REQUEST['id'];
$department = $_REQUEST['department'];
//$value = $_REQUEST['rating_score'];
$percent = $_REQUEST['percentage'];
$status = $_REQUEST['status'];

$sql=$con->query("UPDATE `hike_master` SET `dept_id`='$department',`status`='$status',`modified_by`='$candidate_id',`modified_on`= now() WHERE id = '$fid'");
// echo "UPDATE `hike_master` SET `dept_id`='$department',`status`='$status',`modified_by`='$candidate_id',`modified_on`= now() WHERE id = '$fid'";echo '<br>';


for($i=0; $i<5; $i++)
{

	$get_id=$_REQUEST['get_id'.$i];
	//$rating_score = $value[$i];
	$percentage = $percent[$i];
	

  $sql1=$con->query("UPDATE `hike_value_percent` SET `percentage_hike`='$percentage'  WHERE id='$get_id' ");  
  //echo "UPDATE `hike_value_percent` SET `rating_point`='$rating_score',`percentage_hike`='$percentage'  WHERE id='$get_id' "; echo '<br>';
}


if($sql)
{
	echo 1;
}
else
{
	echo 0;
}
?>