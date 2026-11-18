<?php
session_start();

header('Content-Type: application/json');

require('../connect.php');

date_default_timezone_set('Asia/Kolkata');

try {

    if (!$con) {
        echo json_encode([
            "status" => false,
            "message" => "Database connection failed"
        ]);
        exit;
    }

    // Today's date
    $date = date("Y-m-d");

    // Get empId from GET or POST
    $empId = $_POST['empId'] ?? $_GET['empId'] ?? "";

    if (empty($empId)) {
        echo json_encode([
            "status" => false,
            "message" => "Employee ID is required"
        ]);
        exit;
    }

    /*
     * Check today's attendance
     *
     * log = 0 -> No attendance record
     * log = 1 -> Attendance marked, out_time not marked
     * log = 2 -> Attendance completed
     */

    $res = $con->prepare("SELECT *
        FROM employee_attendance_mob
        WHERE employee_id = :empId
        AND DATE(created_at) = :date
        ORDER BY created_at DESC
        LIMIT 1
    ");

    $res->bindParam(':empId', $empId, PDO::PARAM_STR);
    $res->bindParam(':date', $date, PDO::PARAM_STR);

    $res->execute();

    $row = $res->fetch(PDO::FETCH_ASSOC);

    // ----------------------------------------
    // LOG 0 - No attendance record
    // ----------------------------------------
    if ($row === false) {

        echo json_encode([
            "status" => true,
            "log" => 0,
            "tableId" => null,
            "message" => "Attendance not marked"
        ]);

        // ----------------------------------------
        // LOG 1 - Attendance marked but no out time
        // ----------------------------------------
    } elseif (
        $row['out_time'] === null ||
        $row['out_time'] === '' ||
        $row['out_time'] === '0000-00-00 00:00:00'
    ) {

        echo json_encode([
            "status" => true,
            "log" => 1,
            "tableId" => $row["id"],
            "message" => "Attendance already marked. Out time not marked"
        ]);

        // ----------------------------------------
        // LOG 2 - Attendance completed
        // ----------------------------------------
    } else {

        echo json_encode([
            "status" => true,
            // "log" => 0,
            "log" => 2,
            "tableId" => $row["id"],
            "message" => "Attendance completed"
        ]);
    }
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
