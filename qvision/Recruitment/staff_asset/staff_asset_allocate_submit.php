<?php
// Note: Ensure the path to your config/connect file is correct
require '../../config.php'; 
include("../../user.php");
$userrole = $_SESSION['userrole'];
$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : 0; 

$reqid = isset($_REQUEST['reqid']) ? $_REQUEST['reqid'] : '';
$staffid = isset($_REQUEST['sid']) ? $_REQUEST['sid'] : '';
$asset_names = isset($_REQUEST['asset_name']) ? $_REQUEST['asset_name'] : []; // Fixed: Array expectation
$mail_id = isset($_REQUEST['mail_id']) ? trim($_REQUEST['mail_id']) : '';

// Staff ID fallback from DB if empty
if(empty($staffid) && !empty($reqid)) {
    $staff_sql = $con->query("SELECT staff_id FROM staff_access_request WHERE id='$reqid'");
    if($staff_sql) {
        $staff_row = $staff_sql->fetch(PDO::FETCH_ASSOC);
        $staffid = isset($staff_row['staff_id']) ? $staff_row['staff_id'] : 0;
    }
}

if(!empty($reqid) && !empty($staffid) && is_array($asset_names)) {
    
    // Step 1: Main Request Status Update (Pending -> Allocated)
    $con->query("UPDATE staff_access_request SET status = 2 WHERE id = '$reqid'");
    
    // Step 2: Update Mail ID in Staff Master 
    if(!empty($mail_id)) {
        try {
            $con->query("UPDATE staff_master SET mail_id = '$mail_id' WHERE id = '$staffid'");
        } catch (Exception $e) { }
    }
    
    // Step 3: Array Loop for multiple assets insertion and precise status update
    $cou = count($asset_names);
    for($i = 0; $i < $cou; $i++) {
        $current_asset_id = trim($asset_names[$i]);
        
        if(!empty($current_asset_id) && $current_asset_id != 0) {
            
            // Insert into Asset List mapping table
            $con->query("INSERT INTO staff_asset_list (asset_request_id, staff_id, asset_id, mail_id, status, created_by, created_on) VALUES ('$reqid', '$staffid', '$current_asset_id', '$mail_id', 1, '$userid', now())");
            
            // Update physical asset availability status to 2
            $con->query("UPDATE assets_form_detail SET status = 2 WHERE id = '$current_asset_id'");
        }
    }
    
    echo "success";
} else {
    echo "error";
}
?>