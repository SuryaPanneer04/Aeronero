<?php 
include('../../../connect.php');
include('../../../user.php');
$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : 0;
$candidid = isset($_SESSION['candidateid']) ? $_SESSION['candidateid'] : 0;

$reportingPerson = '';
if ($con) {
	$reportingId = $con->query("Select reporting_person from staff_master where candid_id='$candidid'");
	if ($reportingId) {
		$staffId = $reportingId->fetch();
		$reportingPerson = isset($staffId['reporting_person']) ? $staffId['reporting_person'] : ''; 
	}
}

$txt_org_name = isset($_REQUEST['org_name']) ? $_REQUEST['org_name'] : '';
$explodevalorgname = explode("-", $txt_org_name);
$org_name = isset($explodevalorgname[1]) ? $explodevalorgname[1] : $txt_org_name;

$jd_title = isset($_REQUEST['jd_title']) ? $_REQUEST['jd_title'] : '';
$location = isset($_REQUEST['location']) ? $_REQUEST['location'] : '';
$shift_timing = isset($_REQUEST['shift_timing']) ? $_REQUEST['shift_timing'] : '';
$weekly_off = isset($_REQUEST['weekly_off']) ? $_REQUEST['weekly_off'] : '';
$experience = isset($_REQUEST['experience']) ? $_REQUEST['experience'] : '';
$education = isset($_REQUEST['education']) ? $_REQUEST['education'] : '';
$certificate = isset($_REQUEST['certificate']) ? $_REQUEST['certificate'] : '';
$roles = isset($_REQUEST['roles']) ? $_REQUEST['roles'] : '';
$skills = isset($_REQUEST['skills']) ? $_REQUEST['skills'] : '';
$date_joining = isset($_REQUEST['date_joining']) ? $_REQUEST['date_joining'] : '';
$date_close = isset($_REQUEST['date_close']) ? $_REQUEST['date_close'] : '';
$replacement = isset($_REQUEST['replacement']) ? $_REQUEST['replacement'] : '';
$ctc = isset($_REQUEST['ctc']) ? $_REQUEST['ctc'] : '';
$no_of_postion = isset($_REQUEST['no_of_postion']) ? $_REQUEST['no_of_postion'] : '';
$round = isset($_REQUEST['round']) ? $_REQUEST['round'] : '';
$status = 6;

$sql = false;
if ($con) {
	$sql = $con->query("insert into jobdescription_form_details (jobdescription_id,client_org_name,location,shift_timing,weekly_off,experience,education,certifications,roles,skills,joining_date,closed_date,replacement,ctc,no_of_position, status,created_by,created_on,interview_round_level,reportingPerson) values('$jd_title','$org_name','$location','$shift_timing','$weekly_off','$experience','$education','$certificate','$roles','$skills','$date_joining','$date_close','$replacement','$ctc','$no_of_postion','$status','$userid',now(),'0','$reportingPerson')");
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