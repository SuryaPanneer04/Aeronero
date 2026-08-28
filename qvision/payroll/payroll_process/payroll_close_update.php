<?php
require '../../../connect.php';

$id = $_REQUEST['payroll_master_id'];

// Step 1: Close current payroll
$close = $con->query("UPDATE payroll_master SET flag=3 WHERE id='$id'");

if ($close) {
    // Step 2: (Optional) set next payroll to active
    $next = $con->query("SELECT id FROM payroll_master WHERE id > '$id' ORDER BY id ASC LIMIT 1");
    $next_res = $next->fetch();

    if ($next_res) {
        $next_id = $next_res['id'];
        $con->query("UPDATE payroll_master SET flag=1 WHERE id='$next_id'");
    }

    // Always return success if close worked
    echo 0;
} else {
    echo 1;
}
?>
