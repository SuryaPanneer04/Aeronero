<?php
require '../../connect.php';
include("../../user.php");

$candidateidget=$_REQUEST['id'];
//echo $candidateid;
$sepval=explode("[s~1]",$candidateidget);
$user_id=$sepval[1];
$candidateid=$sepval[0];
//echo $user_id."ooooooooooooooooooooooooooooooooooooooooooooo";
$interviewround=$_REQUEST['round'];
$hod_recruiter=$_REQUEST['hod_recruiter'];
$count=$_REQUEST['count'];
$count_name_count= count($count);
 
for($i=0;$i<$count_name_count;$i++)
{
	
$interviewroundids= $_REQUEST['interviewroundid'.$i];
$intername_ids= $_REQUEST['intername_id'.$i];
$section_names= $_REQUEST['section_name'.$i];
$sql1 = $con->query("INSERT INTO `domain_entries_hod`(`candids_id`, `hire_id`, `round_id`, `round_name_id`, `feedback`) VALUES ('$candidateid','$user_id','$interviewroundids','$intername_ids','$section_names')");
} 
$ins=$con->query("insert into candidate_round_details(candid_id,round_id,person_id,status,created_by,created_on)values('$candidateid','$interviewroundids','$user_id','$hod_recruiter','$user_id',now())");


$round = $con -> query("INSERT INTO `interview_round_level`(`candidate_id`, `interview_round_level`, `approval_level`, `status`, `created_by`, `created_on`) VALUES ('$candidateid','$interviewround','$approve',1,'$user_id',now())");

$interview_round = $con->query("SELECT count(*) as round_count FROM `interview_round_level` WHERE candidate_id='$candidateid'");
$round = $interview_round->fetch();
$no_of_row = $round['round_count'];

if($interviewround==$no_of_row){
	 //echo $candidateid."".$hod_recruiter;
     $sql3 = $con->query("Update candidate_form_details set status=41 where id='$candidateid'"); 
}else{
		// echo $candidateid."".$hod_recruiter;

	$sql3 = $con->query("Update candidate_form_details set status='$hod_recruiter' where id='$candidateid'"); 
}

if($sql1 && $ins && $sql3 && $round){
	echo 1;
}
else{
	echo 0;
}
?>
