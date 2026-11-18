<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);
header('Content-Type: application/json');

require('../connect.php');

//update the status variable
$id =  $_REQUEST['id'] ?? '';
$status = 2;

$userGroupCode =  $_REQUEST['userGroupCode'] ?? '';

try {
    if (!empty($id)) {
        $query = $con->prepare("Update vms set status='$status' where id='$id'");
        if ($query->execute()) {
            echo  json_encode([
                'status' => 'success',
                'message' => 'Status updated successfully'
            ]);
            exit();
        } else {
            echo  json_encode([
                'status' => 'error',
                'message' => 'Status Not updated'
            ]);
            exit();
        }
    }
    if ($userGroupCode == 'R001') {
        $stmt = $con->prepare("SELECT 
                vms.*,
                d.dept_name     AS department_name,
                s.emp_name      AS employee_name,
                t.travel_type   AS vehicle_name
            FROM vms
            LEFT JOIN z_department_master d ON d.id = vms.Department
            LEFT JOIN staff_master s        ON s.id = vms.employee
            LEFT JOIN travel_master t       ON t.id = vms.vehicle
            ORDER BY vms.id DESC
        ");
    } else {
        $stmt = $con->prepare("SELECT 
                vms.*,
                d.dept_name     AS department_name,
                s.emp_name      AS employee_name,
                t.travel_type   AS vehicle_name
            FROM vms
            LEFT JOIN z_department_master d ON d.id = vms.Department
            LEFT JOIN staff_master s        ON s.id = vms.employee
            LEFT JOIN travel_master t       ON t.id = vms.vehicle
            ORDER BY vms.id DESC
        ");
    }
    if ($stmt->execute()) {
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'status' => 'success',
            'data'   => $rows
        ]);
        exit();
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'No data found'
        ]);
        exit();
    }
} catch (Exception $e) {
    echo json_encode([
        'status' => 'success',
        'data' => $e->getMessage()
    ]);
    exit();
}
