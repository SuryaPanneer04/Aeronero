<?php
require '../../../connect.php';
include('../../../user.php');

// session_start();

$candidid = $_SESSION['candidateid'];
$userid = $_SESSION['userid'];
$jid = $_REQUEST['jid'];
$location = $_REQUEST['location'];
$shift_timing = $_REQUEST['shift_timing'];
$weekly_off = $_REQUEST['weekly_off'];
$experience = $_REQUEST['experience'];
$education = $_REQUEST['education'];  // Fixed missing `$`
$certificate = $_REQUEST['certificate'];
$roles = $_REQUEST['roles'];
$skills = $_REQUEST['skills'];
$date_joining = $_REQUEST['date_joining'];  // Fixed missing `$`
$date_close = $_REQUEST['date_close'];  // Fixed missing `$`
$ctc = $_REQUEST['ctc'];
$no_of_position = $_REQUEST['no_of_postion'];
$round = $_REQUEST['round'] ?? 0;
$status = 1;

// Fetch existing job details
$sql = $con->prepare("SELECT * FROM jobdescription_form_details WHERE id = ?");

// print_r($candidid);
// die();
$sql->execute([$jid]);
$job = $sql->fetch();

$jd_title = $job['jobdescription_id'];
$replacement = $job['replacement'];
$flag_canid_id = $job['flag'];

$approvedby = empty($flag_canid_id) ? "0" : "$flag_canid_id,$candidid";


if ($candidid == 44) { // Approval by MD (Second level)
    for ($i = 0; $i < $no_of_position; $i++) {
        $stmtz = $con->prepare("SELECT MAX(jdcode) AS max_id FROM jobdescription_form_details");
        $stmtz->execute();
        $rowz = $stmtz->fetch();
        $max_id = $rowz['max_id'];

        if ($max_id) {
            $find_f = substr($max_id, 0, 2);
            $find_s = substr($max_id, 2, 4);
            $final_jdno = str_pad($find_s + 1, 4, '0', STR_PAD_LEFT);
            $jdcode = $find_f . $final_jdno;
        } else {
            $jdcode = 'JD0001';
        }

        // Insert new job description
        $sql = $con->prepare(
            "INSERT INTO jobdescription_form_details 
            (jdcode, jobdescription_id, location, shift_timing, weekly_off, experience, education, certifications, roles, skills, joining_date, closed_date, replacement, ctc, no_of_position, status, created_by, created_on, interview_round_level, flag) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?)"
        );
        $sql->execute([
            $jdcode, $jd_title, $location, $shift_timing, $weekly_off, $experience, $education, $certificate, 
            $roles, $skills, $date_joining, $date_close, $replacement, $ctc, 1, $status, $candidid, $round, $candidid
        ]);
    }
    
    // Update the existing job status
    $update_query = $con->prepare("UPDATE jobdescription_form_details SET status = ?, flag = ? WHERE id = ?");
    $update_query->execute([5, $approvedby, $jid]);
    
    echo "Update jobdescription_form_details set status='5', flag='$approvedby' where id='$jid'";
}else{
    echo('Md only update');
}
?>
