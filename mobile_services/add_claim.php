<?php

session_start();
ini_set('display_errors', 0);
header('Content-Type: application/json');

require('../connect.php');

$type = $_POST['type'] ?? '';

try {

    if ($type == 'submit') {
        $Employee_name = $_POST['emp_id'];
        $date = $_POST['date'];
        $travel = $_POST['travel_id'];
        $Customer_name = $_POST['cus_name'];
        $Location = $_POST['location'];
        $Purpose = $_POST['purpose_visit'];
        //$Distance = $_POST['distance'];
        $Amount = $_POST['amount'];
        $kms = $_POST['kms'];
        $imageName = '';
        $status = 1;

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/qvision/claim/Uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $tmpName = $_FILES['image']['tmp_name'];
            $original = $_FILES['image']['name'];

            //extension
            $ext = pathinfo($original, PATHINFO_EXTENSION);
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array(strtolower($ext), $allowed)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid image format'
                ]);
                exit;
            }

            //unique name
            $imageName = 'IMG_' . time() . '_' . rand(1000, 9999) . "." . $ext;

            //move file
            move_uploaded_file($tmpName, $uploadDir . $imageName);
        }

        $sql = $con->prepare("
            INSERT INTO claim_request (
                candidate_id,
                customer_name,
                travel_type,
                location,
                date,
                purpose,
                kms,
                amount,
                file,
                status,
                created_on
            ) VALUES (
                :candidate_id,
                :customer_name,
                :travel_type,
                :location,
                :date,
                :purpose,
                :kms,
                :amount,
                :file,
                :status,
                NOW()
            )
        ");

        $sql->execute([
            ':candidate_id' => $Employee_name,
            ':customer_name' => $Customer_name,
            ':travel_type' => $travel,
            ':location' => $Location,
            ':date' => $date,
            ':purpose' => $Purpose,
            ':kms' => $kms,
            ':amount' => $Amount,
            ':file' => $imageName,
            ':status' => $status
        ]);

        echo json_encode([
            'status' => 'success',
            'message' => 'Data inserted successfully'
        ]);
        exit;
    }

    $result = $con->prepare('SELECT id,travel_type FROM travel_master');
    $result->execute();

    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    if (count($row) > 0) {
        echo json_encode([
            'status' => 'success',
            'data' => $row
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Travel master not found'
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'DB Error' . $e
    ]);
}
