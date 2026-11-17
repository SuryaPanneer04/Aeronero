<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);
header('Content-Type: application/json');

require('../../connect.php');

//update the status variable
$projectId =  $_GET['projectId'] ?? $_POST['projectId'] ?? '';

try {

    if ($projectId != "") {
        $stmt = $con->prepare("SELECT 
                sm.emp_name,
                pt.*
            FROM y_project_tasks pt
            LEFT JOIN staff_master sm 
                ON sm.emp_code = pt.employee_id
            WHERE pt.project_id = :projectId
            ORDER BY pt.employee_id, pt.day_number
        ");

        $stmt->bindValue(':projectId', $projectId, PDO::PARAM_INT);


        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode([
                'status' => 'success',
                'data'   => $rows,
            ]);
            exit();
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'No data found'
            ]);
            exit();
        }
    }
    $stmt = $con->prepare("SELECT sm.emp_name, pd.* FROM 
        `y_project_details` pd
        left JOIN staff_master sm ON sm.emp_code = pd.assigner_id
        ORDER by pd.project_id DESC;");

    if ($stmt->execute()) {
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'status' => 'success',
            'data'   => $rows,
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
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
    exit();
}
