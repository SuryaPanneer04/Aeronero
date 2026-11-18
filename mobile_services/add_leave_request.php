<?php

session_start();
ini_set('display_errors', 0);
header('Content-Type: application/json');

require('../connect.php');

$type = $_REQUEST['type'] ?? '';

if ($type == 'leave_details') {
    $query = $con->prepare('SELECT * FROM master_leave where status=1 ORDER BY id ASC');

    if ($query->execute()) {
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode([
            'status' => 'success',
            'data' => $row
        ]);
        exit();
    } else {
        echo json_encode([
            'status' => 'error',
            'data' => 'Data Not Found'
        ]);
        exit();
    }
} else if ($type == 'submit') {
    try {
        if (
            isset($_POST['candids_id']) &&
            isset($_POST['full_name']) &&
            isset($_POST['leave_type']) &&
            isset($_POST['from_date']) &&
            isset($_POST['to_date']) &&
            isset($_POST['reason'])
            // &&
            // isset($_FILES['uploadfile'])
        ) {
            $candids_id = $_POST['candids_id'];
            $full_name = $_POST['full_name'];
            $leave_type = $_POST['leave_type'];
            $from_date = $_POST['from_date'];
            $to_date = $_POST['to_date'];
            $reason = $_POST['reason'];

            //$count=$_POST['count'];

            //approve_date NOT USE SO WE NOT SEND

            // $approve_date = $_POST['lveapp'];

            //$balance_leave=$_POST['balance_leave'];

            $stmtz = $con->prepare(
                "SELECT prefix_code, emp_code, candid_id, reporting_person
                    FROM staff_master
                    WHERE candid_id = ?"
            );

            $stmtz->execute([$candids_id]);

            $rowz = $stmtz->fetch(PDO::FETCH_ASSOC);

            if (!$rowz) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Employee Id Not Found'
                ]);
                exit;
            }

            $rowz = $stmtz->fetch();

            $prefix_code = $rowz['prefix_code'];
            $emp_code = $rowz['emp_code'];
            $reporting_person = $rowz['reporting_person'];
            $emply_code = $emp_code;


            $date1 = date_create("$from_date");
            $date2 = date_create("$to_date");
            $diff = date_diff($date1, $date2);
            // %a outputs the total number of days

            $no_of_days = $diff->format('%a');

            $no_of_day = $no_of_days + 1;
            $curn_month = date('m');

            $jan_month = "1";

            $leaves_avails = $curn_month + $jan_month;
            $leave_avail = ($leaves_avails) - 1;

            if ($leave_avail >= $no_of_day) {
                $date = date('Y-m-d');

                // if (!isset($_FILES['uploadfile']) || $_FILES['uploadfile']['error'] !== UPLOAD_ERR_OK) {
                //     echo json_encode([
                //         'status' => 'error',
                //         'message' => 'File not uploaded'
                //     ]);
                //     exit;
                // }
                $filename = '';

                if (
                    isset($_FILES['uploadfile']) &&
                    $_FILES['uploadfile']['error'] === UPLOAD_ERR_OK
                ) {

                    $filename = $_FILES['uploadfile']['name'];
                    $tempname = $_FILES['uploadfile']['tmp_name'];

                    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                    $allowed = ['jpg', 'jpeg', 'png', 'webp'];

                    if (!in_array($ext, $allowed)) {
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Invalid image format'
                        ]);
                        exit;
                    }

                    $uploadDir = $_SERVER['DOCUMENT_ROOT'] .
                        "/qvision/Leave_Management/leave_request/files/";

                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $imageName = 'IMG_' . time() . '_' .
                        rand(1000, 9999) . '.' . $ext;

                    $folder = $uploadDir . $imageName;

                    if (move_uploaded_file($tempname, $folder)) {
                        $filename = $imageName;
                    } else {
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Failed to upload image'
                        ]);
                        exit;
                    }
                }


                // $filename = $_FILES["uploadfile"]["name"];
                // $tempname = $_FILES["uploadfile"]["tmp_name"];

                // $folder = "files/" . $filename;
                // if (move_uploaded_file($tempname, $folder)) {
                //     $msg = "Image uploaded successfully";
                // } else {
                //     $msg = "Failed to upload image";
                // }


                $stmt = $con->prepare("INSERT INTO leave_apply_masters
                        (
                            reporting_person_id,
                            candid_id,
                            emp_code,
                            emp_name,
                            leave_type,
                            req_date,
                            leave_date,
                            from_date,
                            to_date,
                            no_of_days,
                            leave_reason,
                            sick_doc,
                            status,
                            created_by,
                            created_on
                        )
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
                    ");

                $insert = $stmt->execute([
                    $reporting_person,
                    $candids_id,
                    $emply_code,
                    $full_name,
                    $leave_type,
                    $date,
                    $from_date,
                    $from_date,
                    $to_date,
                    $no_of_day,
                    $reason,
                    $filename,
                    1,
                    $candids_id
                ]);

                if ($insert) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Leave request submitted successfully'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Insert failed',
                        'details' => $stmt->errorInfo()
                    ]);
                }

                exit();
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Leave not available'
                ]);
                exit();
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Request fileds error'
            ]);
            exit();
        }
    } catch (PDOException $e) {
        error_log("Leave Insert Error: " . $e->getMessage());

        echo json_encode([
            'status' => 'error',
            'message' => 'Database insert failed',
            'details' => $e->getMessage()
        ]);
        exit();
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'DB Error'
    ]);
}
