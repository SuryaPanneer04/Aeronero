<?php 
include('../../../connect.php');
include('../../../user.php');
$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : 0;

$resourceid = isset($_REQUEST['rid']) ? $_REQUEST['rid'] : '';

$consl_date = isset($_REQUEST['consl_date']) ? $_REQUEST['consl_date'] : '';
$first_name = isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : '';
$last_name = isset($_REQUEST['last_name']) ? $_REQUEST['last_name'] : '';
$gender = isset($_REQUEST['gender']) ? $_REQUEST['gender'] : '';
$phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : '';
$whatsapp = isset($_REQUEST['whatsapp']) ? $_REQUEST['whatsapp'] : '';
$mail = isset($_REQUEST['mail']) ? $_REQUEST['mail'] : '';
$adharnumber = isset($_REQUEST['adharnumber']) ? $_REQUEST['adharnumber'] : '';
$degree = isset($_REQUEST['degree']) ? $_REQUEST['degree'] : '';
$university = isset($_REQUEST['university']) ? $_REQUEST['university'] : '';
$year_of_pass = isset($_REQUEST['year_of_pass']) ? $_REQUEST['year_of_pass'] : '';
$percentage = isset($_REQUEST['percentage']) ? $_REQUEST['percentage'] : '';
 
$sql = false;

if ($con) {
	$sql = $con->query("update resource_form_detail set `date`='$consl_date', `first_name`='$first_name', `last_name`='$last_name', `gender`= '$gender', `mobile`='$phone', `whatsapp`='$whatsapp',`mail`='$mail',`aadhar_no`='$adharnumber', `degree`='$degree', `university`='$university', `year_of_pass`='$year_of_pass', `percentage`='$percentage' where id='$resourceid'");

	$candidateUpdate = $con->query("UPDATE `candidate_form_details` SET `first_name`='$first_name',`last_name`='$last_name',`gender`='$gender',`phone`='$phone',`alternative_phone`='$whatsapp',`mail`='$mail',`adharnumber`='$adharnumber',`educationalDetails`='$degree',`year_of_pass`='$year_of_pass' WHERE `resource_id`='$resourceid'");
}

if ($sql)
{
	echo 1;
}
else
{
	echo 0;
}
?>