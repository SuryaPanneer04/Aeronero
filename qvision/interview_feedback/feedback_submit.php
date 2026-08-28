<?php
require '../../connect.php';
include('../../user.php');
$candid_id=$_REQUEST['id'];
$user_id=$_REQUEST['user_id'];
$status_recruiter=$_REQUEST['status_recruiter'];
$interviewround=$_REQUEST['round'];
$count=$_REQUEST['count'];
$count_name_count= count($count);

if($status_recruiter==5 || $status_recruiter==7){
for($i=0;$i<$count_name_count;$i++)
{
	
$interviewroundids= $_REQUEST['interviewroundid'.$i];
$intername_ids= $_REQUEST['intername_id'.$i];
$section_names= $_REQUEST['section_name'.$i];
$sql1 = $con->query("INSERT INTO `domain_entries`(`candids_id`, `hire_id`, `round_id`, `round_name_id`, `feedback`) VALUES ('$candid_id','$user_id','$interviewroundids','$intername_ids','$section_names')");

echo "INSERT INTO `domain_entries`(`candids_id`, `hire_id`, `round_id`, `round_name_id`, `feedback`) VALUES ('$candid_id','$user_id','$interviewroundids','$intername_ids','$section_names')";
} 
}else{
	
	for($i=0;$i<$count_name_count;$i++)
{
	
$interviewroundids= $_REQUEST['interviewroundid'.$i];
$intername_ids= $_REQUEST['intername_id'.$i];
$section_names= $_REQUEST['section_name'.$i];
$sql1 = $con->query("INSERT INTO `accounts_domain_entries`(`candids_id`, `hire_id`, `round_id`, `round_name_id`, `feedback`) VALUES ('$candid_id','$user_id','$interviewroundids','$intername_ids','$section_names')"); 
}
}


 $sql2 = $con->query("Update candidate_round_details set status='$status_recruiter' where candid_id='$candid_id' and person_id='$user_id'");
echo "Update candidate_round_details set status='$status_recruiter' where candid_id='$candid_id' and person_id='$user_id'";

//$sql3 = $con->query("Update candidate_form_details set status='$status_recruiter' where id='$candid_id'"); 
//echo "Update candidate_form_details set status='$status_recruiter' where id='$candid_id'"; 

$interview_round = $con->query("SELECT count(*) as round_count FROM `interview_round_level` WHERE candidate_id='$candid_id'");
$round = $interview_round->fetch();
$no_of_row = $round['round_count'];

if($interviewround==$no_of_row){
	$sql3 = $con->query("Update candidate_form_details set status=41 where id='$candid_id'"); 

}else{
	$sql3 = $con->query("Update candidate_form_details set status='$status_recruiter' where id='$candid_id'"); 
}


?>

