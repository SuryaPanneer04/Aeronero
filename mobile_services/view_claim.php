<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);
header('Content-Type: application/json');

require('../connect.php');

$id = $_REQUEST['user_id'];
$groupCode = $_REQUEST['group_code'];

$table_id = $_REQUEST['table_id'];
$status = $_REQUEST['status'];

try {
    if (isset($table_id) && isset($status)) {
        // $query = $con->prepare("UPDATE claim_request SET status = :status WHERE id = :id");
        $query = $con->prepare("Update claim_request set status ='$status' where id='$table_id'");
        if ($query->execute()) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Updated   '
            ]);
            exit();
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Some want error'
            ]);
            exit();
        }
    }

    if (!isset($id) || empty($id)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'ID is required'
        ]);
        exit();
    }


    if ($groupCode == 'R016') {
        $query = $con->prepare("SELECT 
            cr.*,
            um.full_name,
            um.user_group_code,
            sm.emp_code
        FROM claim_request cr
        LEFT JOIN z_user_master um 
            ON um.candidate_id = cr.candidate_id
        LEFT JOIN staff_master sm 
            ON sm.candid_id = um.user_id
        WHERE cr.status='2' or cr.status=1
        ORDER BY cr.id DESC;
    ");
        $query->execute();

        $rows = $query->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) > 0) {
            echo json_encode([
                'status' => 'success',
                'data' => $rows
            ]);
            exit();
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'R016 GROUP CODE Data Not Found'
            ]);
            exit();
        }
    }

    $query = $con->prepare("SELECT 
            cr.*,
            um.full_name,
            um.user_group_code,
            sm.emp_code,
            tt.travel_type as travel_name
        FROM claim_request cr
        LEFT JOIN z_user_master um 
            ON um.candidate_id = cr.candidate_id
        LEFT JOIN staff_master sm 
            ON sm.candid_id = um.user_id
         LEFT JOIN travel_master tt
        	ON tt.id = cr.travel_type
        WHERE cr.candidate_id = :candidate_id
        ORDER BY cr.id DESC
    ");

    $query->bindParam(':candidate_id', $id, PDO::PARAM_INT);
    $query->execute();

    $rows = $query->fetchAll(PDO::FETCH_ASSOC);

    if (count($rows) > 0) {
        echo json_encode([
            'status' => 'success',
            'data' => $rows
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Data Not Found'
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'DB error' . $e
    ]);
}
