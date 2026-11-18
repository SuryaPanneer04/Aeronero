<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);
header('Content-Type: application/json');

require('../connect.php');

try {
    //get the payroll details
    $payroll = $con->prepare('SELECT id,month,year,flag from payroll_master where flag in (2,3)');
    if ($payroll->execute()) {
        $payrollRow = $payroll->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo  json_encode([
            'status' => 'error',
            'message' => 'Payroll Data Not found'
        ]);
        exit();
    }

    //get the department details
    $dep = $con->prepare('SELECT id, dept_name, status FROM z_department_master');
    if ($dep->execute()) {
        $depRow = $dep->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo  json_encode([
            'status' => 'error',
            'message' => 'Department Data Not found'
        ]);
        exit();
    }

    //get the staff details
    $staff = $con->prepare('SELECT id,candid_id,emp_code as emp_no, emp_name, dep_id  FROM staff_master ');
    if ($staff->execute()) {
        $staffRow = $staff->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo  json_encode([
            'status' => 'error',
            'message' => 'Staff Data Not found'
        ]);
        exit();
    }
    echo  json_encode([
        'status' => 'success',
        'payroll' => $payrollRow,
        'department' => $depRow,
        'staff' => $staffRow,
    ]);
    exit();
} catch (Exception $e) {
    echo  json_encode([
        'status' => 'error',
        'message' => 'DB Error' . $e
    ]);
}
