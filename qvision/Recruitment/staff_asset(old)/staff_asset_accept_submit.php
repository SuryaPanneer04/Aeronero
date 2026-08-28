<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = $_SESSION['userrole'];

$reqid = isset($_POST['reqid']) ? $_POST['reqid'] : '';
$sid = isset($_POST['sid']) ? $_POST['sid'] : '';

if(!empty($reqid)) {
     $con->query("UPDATE staff_access_request SET status = 3 WHERE id = '$reqid'");
    
    if(!empty($sid)) {
        $con->query("UPDATE staff_asset_list SET status = 1 WHERE asset_request_id = '$reqid'");
    }
    
    echo "success";
} else {
    echo "error";
}
?>