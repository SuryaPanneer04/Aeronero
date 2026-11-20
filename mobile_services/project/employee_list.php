<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);
header('Content-Type: application/json');

require('../../connect.php');

try {

    $stmt = $con->prepare("SELECT user_id,user_name,user_group_code,full_name FROM `z_user_master`");
    $roles = $con->prepare("SELECT id,code,role_name FROM `z_role_master`");

    if ($stmt->execute() && $roles->execute()) {
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $rolerows = $roles->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'status' => 'success',
            'data'   => $rows,
            'roles'   => $rolerows,
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
