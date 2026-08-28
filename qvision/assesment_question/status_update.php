<?php
require '../../connect.php';

$id = $_REQUEST['id'];
$sta = $_REQUEST['sta'];

// Update emp_assessment_login_detail for UI reflection
$sql = $con->query("UPDATE emp_assessment_login_detail SET status='$sta' WHERE staff_id='$id'");

if ($sql) {
    // Update candidate_form_details for Candidate Reject List
    $staff = $con->query("SELECT candid_id FROM staff_master WHERE id='$id'");
    if ($staff && $staff->rowCount() > 0) {
        $staff_row = $staff->fetch(PDO::FETCH_ASSOC);
        $candidate_id = $staff_row['candid_id'];
        
        if ($sta == 3) {
            // Status 32 makes it show in candidate_reject_list.php
            $con->query("UPDATE candidate_form_details SET status='32' WHERE id='$candidate_id'");
        } else if ($sta == 2) {
            // Status 11 for accepted in assessment
            $con->query("UPDATE candidate_form_details SET status='11' WHERE id='$candidate_id'");
        }
    }
    
    echo 1;
} else {
    echo 0;
}
?>
