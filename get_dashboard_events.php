<?php
session_start();
require 'connect.php';

header('Content-Type: application/json');

$events = array();

// If user is not logged in, return empty
if(!isset($_SESSION['candidateid'])) {
    echo json_encode($events);
    exit;
}

$userrole = isset($_SESSION['userrole']) ? $_SESSION['userrole'] : '';
$is_hr_management = in_array($userrole, ['R001', 'R003', 'R005']);

if($is_hr_management) {
    // HR & Management sees ALL approved leaves
    $leave_stmt = $con->query("SELECT emp_name, emp_code, leave_type, from_date, to_date, leave_reason FROM leave_apply_masters WHERE status = 2");
} else {
    // Normal manager sees recursive chain of subordinates
    $candid_id = isset($_SESSION['candidateid']) ? $_SESSION['candidateid'] : '';
    $stmt = $con->query("SELECT id, dep_id, head_status FROM staff_master WHERE candid_id = '$candid_id' LIMIT 1");
    $my_staff = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : false;

    if($my_staff) {
        $my_staff_id = $my_staff['id'];
        $my_dep_id = $my_staff['dep_id'];
        $my_head_status = $my_staff['head_status']; 

        $all_subordinates = array();
        $visited_managers = array();

        function get_all_subordinates($con, $manager_id, &$all_subordinates, &$visited_managers) {
            if(in_array($manager_id, $visited_managers)) return;
            $visited_managers[] = $manager_id;

            $stmt = $con->query("SELECT id, candid_id FROM staff_master WHERE reporting_person = '$manager_id' AND id != '$manager_id'");
            if($stmt) {
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if(!empty($row['candid_id']) && !in_array($row['candid_id'], $all_subordinates)) {
                        $all_subordinates[] = $row['candid_id'];
                        get_all_subordinates($con, $row['id'], $all_subordinates, $visited_managers);
                    }
                }
            }
        }

        get_all_subordinates($con, $my_staff_id, $all_subordinates, $visited_managers);

        // If they are a Head, also include their department
        if($my_head_status == 1) {
            $dept_stmt = $con->query("SELECT candid_id FROM staff_master WHERE dep_id = '$my_dep_id'");
            if($dept_stmt) {
                while($row = $dept_stmt->fetch(PDO::FETCH_ASSOC)) {
                    if(!empty($row['candid_id']) && !in_array($row['candid_id'], $all_subordinates)) {
                        $all_subordinates[] = $row['candid_id'];
                    }
                }
            }
        }

        if(count($all_subordinates) > 0) {
            $in_clause = implode(',', $all_subordinates);
            $leave_stmt = $con->query("SELECT emp_name, emp_code, leave_type, from_date, to_date, leave_reason FROM leave_apply_masters WHERE status = 2 AND candid_id IN ($in_clause)");
        } else {
            $leave_stmt = false;
        }
    } else {
        $leave_stmt = false;
    }
}

if(isset($leave_stmt) && $leave_stmt) {
    while($leave = $leave_stmt->fetch(PDO::FETCH_ASSOC)) {
        $start = $leave['from_date'];
        $end = $leave['to_date'];
        
        if($start != '' && $end != '') {
            $end_date = new DateTime($end);
            $end_date->modify('+1 day'); 
            
            $l_type = trim($leave['leave_type']);
            $color = '#e74c3c'; // Professional Red color
            
            $events[] = array(
                'title' => $leave['emp_name'] . ' - ' . $l_type,
                'start' => $start,
                'end'   => $end_date->format('Y-m-d'),
                'allDay' => true,
                'backgroundColor' => $color,
                'borderColor' => $color,
                'textColor' => '#ffffff',
                'extendedProps' => array(
                    'emp_code' => $leave['emp_code'],
                    'emp_name' => $leave['emp_name'],
                    'leave_type' => $l_type,
                    'reason' => $leave['leave_reason']
                )
            );
        }
    }
}

echo json_encode($events);
?>
