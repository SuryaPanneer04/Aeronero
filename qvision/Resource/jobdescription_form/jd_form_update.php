<?php 
include('../../../connect.php');
include('../../../user.php');
$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : 0;
$candidid = isset($_SESSION['candidateid']) ? $_SESSION['candidateid'] : 0;

$jid = isset($_REQUEST['jid']) ? $_REQUEST['jid'] : '';
$jd_title = isset($_REQUEST['jd_title']) ? $_REQUEST['jd_title'] : '';
$location = isset($_REQUEST['location']) ? $_REQUEST['location'] : '';
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
$status = 0;

$upd = false;
if ($con) {
	$upd = $con->query("update jobdescription_form_details set jobdescription_id='$jd_title',location='$location',experience='$experience',education='$education',certifications='$certificate',roles='$roles',skills='$skills',joining_date='$date_joining',closed_date='$date_close',replacement='$replacement',ctc='$ctc',no_of_position='$no_of_postion',status='$status',modified_by='$userid',modified_on=now() where id='$jid'");
}

if($upd)
{
	echo 1;
}
else
{
	echo 0;
}
?>