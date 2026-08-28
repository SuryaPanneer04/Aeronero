<?php
require '../../connect.php';
include('../../user.php');

$candid_id = isset($_REQUEST['cid']) ? $_REQUEST['cid'] : 0;
$user_id = isset($_REQUEST['sid']) && $_REQUEST['sid'] !== '' ? $_REQUEST['sid'] : 0;
$approve = isset($_REQUEST['approve']) && $_REQUEST['approve'] !== '' ? $_REQUEST['approve'] : 0;
$interviewround = isset($_REQUEST['round']) && $_REQUEST['round'] !== '' ? $_REQUEST['round'] : 0;
$status_recruiter = isset($_REQUEST['status_recruiter']) ? $_REQUEST['status_recruiter'] : 0;

$count = isset($_REQUEST['count']) && is_array($_REQUEST['count']) ? $_REQUEST['count'] : [];
$count_name_count = count($count);
$sql1_success = true;
$interviewroundids = 0; // initialize to prevent undefined variable

for($i=0; $i<$count_name_count; $i++)
{
	$interviewroundids = isset($_REQUEST['interviewroundid'.$i]) ? $_REQUEST['interviewroundid'.$i] : 0;
	$intername_ids = isset($_REQUEST['intername_id'.$i]) ? $_REQUEST['intername_id'.$i] : 0;
	$section_names = isset($_REQUEST['section_name'.$i]) ? $_REQUEST['section_name'.$i] : '';
	
	if($con) {
		$sql1 = $con->query("INSERT INTO `hr_domain_entries`(`candids_id`, `hire_id`, `round_id`, `round_name_id`, `feedback`) VALUES ('$candid_id','$user_id','$interviewroundids','$intername_ids','$section_names')");
		if(!$sql1) {
			$sql1_success = false;
		}
	}
} 

$ins = false;
$round_ins = false;
$sql3 = false;

if($con) {
	// If loop didn't run, fallback to the generic interviewroundid from request
	if ($interviewroundids == 0 && isset($_REQUEST['interviewroundid'])) {
		$interviewroundids = $_REQUEST['interviewroundid'];
	}

	$ins = $con->query("INSERT INTO candidate_round_details(candid_id,round_id,person_id,status,created_by,created_on) VALUES ('$candid_id','$interviewroundids','$user_id','$status_recruiter','$user_id',now())");

	$round_ins = $con->query("INSERT INTO `interview_round_level`(`candidate_id`, `interview_round_level`, `approval_level`, `status`, `created_by`, `created_on`) VALUES ('$candid_id','$interviewround','$approve',1,'$user_id',now())");

	$interview_round = $con->query("SELECT count(*) as round_count FROM `interview_round_level` WHERE candidate_id='$candid_id'");
	
	$no_of_row = 0;
	if($interview_round) {
		$round_data = $interview_round->fetch();
		$no_of_row = isset($round_data['round_count']) ? $round_data['round_count'] : 0;
	}

	if($interviewround == $no_of_row){
		$sql3 = $con->query("UPDATE candidate_form_details SET status=41 WHERE id='$candid_id'"); 
	} else {
		$sql3 = $con->query("UPDATE candidate_form_details SET status='$status_recruiter' WHERE id='$candid_id'"); 
	}
}

if($sql1_success && $ins && $sql3 && $round_ins){
	echo 1;
} else {
	echo 0;
}
?>
