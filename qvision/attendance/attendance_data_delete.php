<?php
require '../../connect.php';
date_default_timezone_set("Asia/Kolkata");

if (isset($_REQUEST['attendance_id']) && !empty($_REQUEST['attendance_id'])) {
    $ids = $_REQUEST['attendance_id'];
    $attendance_ids = implode(',', array_map('intval', $ids)); 

    // 1. Fetch emp_id and date from bb_attendance BEFORE deleting to clear daily_attendance
    $fetch_sql = "SELECT emp_code, in_log_date FROM bb_attendance WHERE id IN ($attendance_ids)";
    $fetch_res = $con->query($fetch_sql);
    
    while ($row = $fetch_res->fetch(PDO::FETCH_ASSOC)) {
        $staff_id = $row['emp_code'];
        $log_date = $row['in_log_date'];
        
        // Match staff_master to get real emp_code string for daily_attendance table
        $get_code = $con->query("SELECT emp_code FROM staff_master WHERE id = '$staff_id'");
        $staff = $get_code->fetch(PDO::FETCH_ASSOC);
        
        if ($staff) {
            $real_emp_code = $staff['emp_code'];
            $con->query("DELETE FROM daily_attendance WHERE emp_code = '$real_emp_code' AND date = '$log_date'");
        }
    }

    // 2. Now cleanly delete from bb_attendance table
    $attendance_delete_sql = "DELETE FROM bb_attendance WHERE id IN ($attendance_ids)";
    $attendance_delete = $con->query($attendance_delete_sql);

    if ($attendance_delete) {
        echo 1;
    } else {
        echo 0;
    }
} else {
    echo 0;
}
?>