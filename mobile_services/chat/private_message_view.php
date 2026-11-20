
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

    // Get sender and receiver
    $senderId = $_GET['sender_id']
        ?? $_POST['sender_id']
        ?? '';

    $receiverId = $_GET['receiver_id']
        ?? $_POST['receiver_id']
        ?? '';

    // Validate
    if (
        empty($senderId) ||
        empty($receiverId)
    ) {
        echo json_encode([
            "status" => false,
            "message" => "Sender ID and Receiver ID are required"
        ]);
        exit;
    }

    /*
    |--------------------------------------------------------------------------
    | Get messages between two users
    |--------------------------------------------------------------------------
    |
    | We need both directions:
    |
    | sender -> receiver
    | receiver -> sender
    |
    */

    $sql = "SELECT *
        FROM y_private_messages
        WHERE
            (
                sender_id = :sender_id
                AND receiver_id = :receiver_id
            )
            OR
            (
                sender_id = :receiver_id
                AND receiver_id = :sender_id
            )
        ORDER BY created_at ASC, id ASC
    ";

    $stmt = $con->prepare($sql);

    $stmt->execute([
        ':sender_id' => $senderId,
        ':receiver_id' => $receiverId
    ]);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "status" => true,
        "message" => "Messages fetched successfully",
        "data" => $rows
    ]);

    exit;
} catch (PDOException $e) {

    echo json_encode([
        "status" => false,
        "message" => "Database error",
        "error" => $e->getMessage()
    ]);
} catch (Exception $e) {

    echo json_encode([
        "status" => false,
        "message" => "Something went wrong",
        "error" => $e->getMessage()
    ]);
}
