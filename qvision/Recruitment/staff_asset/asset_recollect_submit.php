<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = isset($_SESSION['userrole']) ? $_SESSION['userrole'] : '';

$reqid = isset($_REQUEST['reqid']) ? $_REQUEST['reqid'] : '';
$views = isset($_REQUEST['View']) ? $_REQUEST['View'] : array();

if(!empty($views) && is_array($views)) {
    foreach($views as $val) {
        $val = trim($val);
        if(!empty($val)) {
            $con->query("UPDATE assets_form_detail SET status = 1 WHERE id IN (SELECT asset_id FROM staff_asset_list WHERE id = '$val' OR asset_id = '$val')");
            
            $con->query("UPDATE staff_asset_list SET status = 3 WHERE (id = '$val' OR asset_id = '$val') AND (asset_request_id = '$reqid' OR staff_id = (SELECT staff_id FROM staff_access_request WHERE id='$reqid')) AND status = 2");
        }
    }
    
    // ✅ Oruvelai antha request la irukka ellam asset-um collect aayiruntha, main request status-aiyum 6 (Closed) nu update pandrom
    $check_rem = $con->query("SELECT id FROM staff_asset_list WHERE asset_request_id = '$reqid' AND (status = 1 OR status = 2)");
    if($check_rem && $check_rem->rowCount() == 0) {
        $con->query("UPDATE staff_access_request SET status = 6 WHERE id = '$reqid'");
    }
    
    echo "success";
} else {
    echo "error";
}
?>