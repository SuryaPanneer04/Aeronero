<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = isset($_SESSION['userrole']) ? $_SESSION['userrole'] : '';

$reqid = isset($_REQUEST['reqid']) ? $_REQUEST['reqid'] : '';
$views = isset($_REQUEST['View']) ? $_REQUEST['View'] : array();
$cug = isset($_REQUEST['cug']) ? $_REQUEST['cug'] : '';

// ✅ STRICT CHECK: Checkbox edhuvum select aagalaina udane 'empty' nu error anupidum!
if(empty($views) || !is_array($views) || count($views) == 0) {
    echo "empty";
    exit;
}

$updated_count = 0;
foreach($views as $val) {
    $val = trim($val);
    if(!empty($val)) {
        // Safe Update
        $stmt = $con->query("UPDATE staff_asset_list SET status = 2 WHERE (id = '$val' OR asset_id = '$val') AND (asset_request_id = '$reqid' OR staff_id = (SELECT staff_id FROM staff_access_request WHERE id='$reqid')) AND status = 1");
        if($stmt) {
            $updated_count++;
        }
    }
}

// Oru asset kooda update aagalaina error thrown
if($updated_count == 0) {
    echo "error";
    exit;
}

// Oruvelai antha employee oda ellam asset-um return aayiruntha, main request status-aiyum 5 (Returned) nu update pandrom
$check_pending = $con->query("SELECT id FROM staff_asset_list WHERE asset_request_id = '$reqid' AND status = 1");
if($check_pending && $check_pending->rowCount() == 0) {
    $con->query("UPDATE staff_access_request SET status = 5 WHERE id = '$reqid'");
}

if(!empty($cug)) {
    $con->query("UPDATE staff_access_request SET cug_status = '$cug' WHERE id = '$reqid'");
}

echo "success";
?>