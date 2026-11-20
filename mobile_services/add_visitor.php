<?php

session_start();
ini_set('display_errors', 0);
header('Content-Type: application/json');

require('../connect.php');

$type = $_REQUEST['type'] ?? '';

try {
    if ($type == 'department') {
        $query = $con->prepare('SELECT * FROM z_department_master ');
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($row)) {
            echo json_encode([
                'status' => 'success',
                'data' => $row
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'No department data found'
            ]);
        }
    }

    if ($type == 'staff') {

        $department_id = $_REQUEST['departmentId'] ?? '';

        if (empty($department_id)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Department ID is required'
            ]);
            exit;
        }

        $query = $con->prepare(
            "SELECT id,emp_name,emp_code FROM staff_master WHERE dep_id = :dep_id"
        );
        $query->bindParam(':dep_id', $department_id, PDO::PARAM_INT);
        $query->execute();

        $row = $query->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($row)) {
            echo json_encode([
                'status' => 'success',
                'data' => $row
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'No staff found for this department'
            ]);
        }
    }

    if ($type == 'travel') {
        $query = $con->prepare('SELECT id,travel_type FROM travel_master');
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($row)) {
            echo json_encode([
                'status' => 'success',
                'data' => $row
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Travel data not found'
            ]);
        }
    }

    if ($type == 'submit') {
        $date        = $_POST['date'] ?? '';
        $first_name  = $_POST['first_name'] ?? '';
        $email       = $_POST['email'] ?? '';
        $mob_num     = $_POST['mob_num'] ?? '';
        $coming_from = $_POST['coming_from'] ?? '';
        $companys    = $_POST['companys'] ?? '';
        $purpose     = $_POST['purpose'] ?? '';
        $department  = $_POST['department'] ?? '';
        $employee    = $_POST['employee'] ?? '';
        $vehicle     = $_POST['travel'] ?? '';
        $vehicle_no  = $_POST['vehicle_No'] ?? '';
        $remarks     = $_POST['remarks'] ?? '';


        $stmt = $con->query("
            INSERT INTO vms
            (`Date`, `first_name`, `email`, `mob_num`, `Coming_from`, `companys`,
            `Purpose`, `Department`, `employee`, `vehicle`, `veh_no`, `Remarks`, `status`)
            VALUES
            (
            '$date',
            '$first_name',
            '$email',
            '$mob_num',
            '$coming_from',
            '$companys',
            '$purpose',
            '$department',
            '$employee',
            '$vehicle',
            '$vehicle_no',
            '$remarks',
            1
            )
        ");

        if ($stmt) {
            // ✅ Success response
            echo json_encode([
                "status" => "success",
                "message" => "Data inserted successfully"
            ]);
        } else {
            // ❌ Execution error
            echo json_encode([
                "status" => "error",
                "message" => $stmt->error
            ]);
        }
    }
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
