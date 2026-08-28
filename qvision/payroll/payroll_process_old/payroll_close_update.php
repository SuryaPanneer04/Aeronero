<?php

require '../../../connect.php';
$id = $_REQUEST['payroll_master_id'];
$status = 3;
$sql2 = $con->query("Update payroll_master set flag='$status' where id='$id'");

if ($sql2) {
    $next_id = $id + 1;
    $sql3 = $con->query("Update payroll_master set flag=1 where id='$next_id'");
    if ($sql3) {
        echo 0;
    }
} else {
    echo 1;
}
?>


