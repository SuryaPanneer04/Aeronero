<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);
header('Content-Type: application/json');

require('../connect.php');

try {
    $user_id   = $_REQUEST['userId'] ?? null;
    $status   = $_REQUEST['status'] ?? null;
    $id        = $_REQUEST['tableId'] ?? null;
    $leave_type = $_REQUEST['leave'] ?? null;
    $candid_id = $_REQUEST['candid_id'] ?? null;


    if ($status == 'approve') {
        if (!$user_id || !$id) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Missing required parameters'
            ]);
            exit;
        }

        $con->query("
            UPDATE leave_apply_masters 
            SET status = 2, modified_on = NOW(), modified_by = '$user_id'
            WHERE id = '$id'
        ");

        // $query1 = $con->query("SELECT * FROM leave_apply_masters WHERE id='$id'");
        // $row1 = $query1->fetch(PDO::FETCH_ASSOC);

        // $no_of_leave = $row1['no_of_days'];

        // $query = $con->query("
        //     SELECT * FROM leave_masters 
        //     WHERE candid_id='$candid_id' AND leave_type='$leave_type'
        // ");
        // $row = $query->fetch(PDO::FETCH_ASSOC);

        // $balance_leave = $row['balance_leave'] - $no_of_leave;

        // $con->query("
        //     UPDATE leave_masters 
        //     SET balance_leave='$balance_leave',
        //         modified_on=NOW(),
        //         modified_by='$user_id'
        //     WHERE candid_id='$candid_id' AND leave_type='$leave_type'
        // ");


        echo json_encode([
            'status' => 'success',
            'message' => 'Leave approved successfully'
        ]);
        exit;
    }

    if ($status == 'reject') {
        if (!$user_id || !$id) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Missing required parameters'
            ]);
            exit;
        }

        $con->query("
            UPDATE leave_apply_masters 
            SET status = 3, modified_on = NOW(), modified_by='$user_id'
            WHERE id='$id'
        ");

        echo json_encode([
            'status' => 'success',
            'message' => 'Leave rejected successfully'
        ]);
        exit;
    }

    // $query = $con->prepare("SELECT 
    //     ml.leave_name,lap.* FROM leave_apply_masters lap
    //     LEFT JOIN master_leave ml ON ml.id =lap.leave_type 
    //     where lap.status=1 ORDER BY id;
    // ");
    if (!isset($user_id) || empty($user_id)) {
        echo json_encode(["error" => "User ID missing"]);
        exit;
    }

    $query = $con->prepare("SELECT 
        ml.leave_name,lap.* FROM leave_apply_masters lap 
        LEFT JOIN master_leave ml ON ml.id =lap.leave_type 
        where (lap.candid_id= $user_id OR lap.reporting_person = $user_id)
        ORDER BY lap.req_date DESC;
    ");
    if ($query->execute()) {
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode([
            'status' => 'success',
            'data' => $row
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Data Not found'
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e
    ]);
}
