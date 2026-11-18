<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);
header('Content-Type: application/json');

require('../../connect.php');

try {
    if (!$con) {
        echo json_encode([
            "status" => false,
            "message" => "Database connection failed"
        ]);
        exit;
    }

    $stmt = $con->prepare("SELECT 
        sm.candid_id,
        sm.emp_code,
        sm.emp_name,
        sm.dep_id,
        sm.div_id,
        dm.div_name,
        zdm.dept_name,
        des.designation_name FROM `staff_master` sm
        LEFT JOIN division_master dm ON dm.id = sm.div_id
        LEFT JOIN z_department_master zdm ON zdm.id = sm.dep_id
        LEFT JOIN designation_master des ON des.id = sm.design_id;");

    if ($stmt->execute()) {
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode([
            "status" => true,
            "message" => "success",
            "data" => $rows
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Query Error"
        ]);
    }


    exit;
} catch (Exception $e) {
    json_encode([
        "message" => "file error",
        "Error" => $e
    ]);
}
