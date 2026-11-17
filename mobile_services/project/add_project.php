<?php
require('../../connect.php');

$json = file_get_contents("php://input");
$data = json_decode($json, true);
date_default_timezone_set('Asia/Kolkata');

if (!$data) {
    echo json_encode([
        "status" => false,
        "message" => "Invalid JSON"
    ]);
    exit;
}

$assignerId = $data['assigner_Id'];
$projectName = $data['project_name'];
$role = $data['role'];
$days = $data['days'];

$employees = $data['employees'];
$tasks = $data['tasks'];

$con->beginTransaction();

try {

    // insert project

    $stmt = $con->prepare("INSERT INTO y_project_details
        (assigner_id,project_name,role_name,total_days)
        VALUES
        (?,?,?,?)
    ");

    $stmt->execute([
        $assignerId,
        $projectName,
        $role,
        $days
    ]);

    $projectId = $con->lastInsertId();

    // $empStmt = $con->prepare("INSERT INTO y_project_employees
    //     (project_id,employee_id)
    //     VALUES
    //     (?,?)
    // ");

    // foreach ($employees as $emp) {

    //     $empStmt->execute([
    //         $projectId,
    //         $emp['user_name']
    //     ]);
    // }

    $taskStmt = $con->prepare("INSERT INTO y_project_tasks
        (project_id,employee_id,day_number,task,created_on)
        VALUES
        (?,?,?,?,?)
    ");

    foreach ($tasks as $task) {

        $taskStmt->execute([
            $projectId,
            $task['employee_id'],
            $task['day'],
            $task['task'],
            date('Y-m-d H:i:s'),
        ]);
    }
    $con->commit();

    echo json_encode([
        "status" => true,
        "message" => "Project Assigned Successfully"
    ]);
} catch (Exception $e) {

    $con->rollBack();

    echo json_encode([
        "status" => false,
        "message" => $e->getMessage()
    ]);
}
