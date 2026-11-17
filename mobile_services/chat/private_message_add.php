<?php

session_start();

error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);

header('Content-Type: application/json');

require('../../connect.php');

try {

    // Check database connection
    if (!$con) {
        echo json_encode([
            "status" => false,
            "message" => "Database connection failed"
        ]);
        exit;
    }

    // Get request parameters
    $depId = $_GET['depId'] ?? $_POST['depId'] ?? '';
    $divId = $_GET['divId'] ?? $_POST['divId'] ?? '';
    $senderId = $_GET['senderId'] ?? $_POST['senderId'] ?? '';
    $receiverId = $_GET['receiverId'] ?? $_POST['receiverId'] ?? '';
    $fullName = $_GET['fullName'] ?? $_POST['fullName'] ?? '';
    $message = $_GET['message'] ?? $_POST['message'] ?? '';
    $message_type = $_GET['message_type'] ?? $_POST['message_type'] ?? '';
    $file_url = $_GET['file_url'] ?? $_POST['file_url'] ?? '';

    // Required fields
    if (
        empty($depId) ||
        empty($divId) ||
        empty($senderId) ||
        empty($receiverId) ||
        empty($fullName) ||
        empty($message_type)
    ) {
        echo json_encode([
            "status" => false,
            "message" => "Required fields are missing"
        ]);
        exit;
    }

    // Insert message
    $stmt = $con->prepare("INSERT INTO y_private_messages(
            department_id,
            division_id,
            sender_id,
            receiver_id,
            fullname,
            message,
            message_type,
            file_url
        )
        VALUES
        (
            :department_id,
            :division_id,
            :sender_id,
            :receiver_id,
            :fullname,
            :message,
            :message_type,
            :file_url
        )
    ");

    $stmt->execute([
        ':department_id' => $depId,
        ':division_id' => $divId,
        ':sender_id' => $senderId,
        ':receiver_id' => $receiverId,
        ':fullname' => $fullName,
        ':message' => $message,
        ':message_type' => $message_type,
        ':file_url' => $file_url
    ]);
    // Return inserted data
    echo json_encode([
        "status" => true,
        "message" => "Message inserted successfully",
    ]);
} catch (PDOException $e) {

    echo json_encode([
        "status" => false,
        "message" => "Database error",
        "error" => $e->getMessage()
    ]);
} catch (Exception $e) {

    echo json_encode([
        "status" => false,
        "message" => "File error",
        "error" => $e->getMessage()
    ]);
}
