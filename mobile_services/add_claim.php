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

        $imageName = '';

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

            $tmpName = $_FILES['image']['tmp_name'];
            $original = $_FILES['image']['name'];

            $ext = strtolower(pathinfo($original, PATHINFO_EXTENSION));

            $allowed = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array($ext, $allowed, true)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid image format'
                ]);
                exit;
            }

            // Upload directory
            $uploadDir = rtrim($_SERVER['DOCUMENT_ROOT'], '/\\')
                . '/Aeronero/qvision/claim/Uploads/';

            // Create directory
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0775, true);
            }

            if (!is_dir($uploadDir) || !is_writable($uploadDir)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Upload folder not writable',
                    'path' => $uploadDir
                ]);
                exit;
            }

            // Unique filename
            $imageName = 'IMG_' . time() . '_' .
                rand(1000, 9999) . '.' . $ext;

            $destination = $uploadDir . $imageName;

            // Move uploaded file
            if (move_uploaded_file($tmpName, $destination)) {

                if (!file_exists($destination)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'File not found after upload'
                    ]);
                    exit;
                }
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Image upload failed',
                    'destination' => $destination
                ]);
                exit;
            }
        }


        $sql = $con->prepare("INSERT INTO claim_request (
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
