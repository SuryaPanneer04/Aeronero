
<?php
require_once '../../../connect.php';
include_once('../../../user.php');
$candidid = $_SESSION['candidateid'];

$jid = $_REQUEST['jid'];
$remark = $_REQUEST['remark'];
$approve = $_REQUEST['approve'];

$reportingPerson = $con->query("SELECT id FROM staff_master WHERE candid_id = '$candidid'");
$report = $reportingPerson->fetch();
$reportingID = $report['id'];

if ($remark != '') {
   $insert_query2 = $con->query("UPDATE jobdescription_form_details SET reject_remark='$remark', status='4' WHERE id='$jid'");
    // echo "UPDATE jobdescription_form_details SET reject_remark='$remark', status='4' WHERE id='$jid'";
} elseif ($approve == 2 && $candidid == 1) {
    $insert_query2 = $con->query("UPDATE jobdescription_form_details SET level_2_reject_remark='$remark', status='4' WHERE id='$jid'");
}
?>
