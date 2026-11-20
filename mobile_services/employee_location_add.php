<?php
session_start();

header('Content-Type: application/json');

require('../connect.php');

date_default_timezone_set('Asia/Kolkata');

try {

    // Check database connection
    if (!$con) {
        echo json_encode([
            "status" => false,
            "message" => "Database connection failed"
        ]);
        exit;
    }

    /*
    |--------------------------------------------------------------------------
    | CHECK-OUT
    | GET request:
    | employee_location_add.php?tableId=3
    |--------------------------------------------------------------------------
    */

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $tableId = $_GET['tableId'] ?? "";

        if (empty($tableId)) {
            echo json_encode([
                "status" => false,
                "message" => "Table ID is required"
            ]);
            exit;
        }

        $update = $con->prepare("UPDATE employee_attendance_mob
            SET out_time = NOW(), log_device = 1
            WHERE id = :table_id
            AND (
                out_time IS NULL
                OR out_time = '0000-00-00 00:00:00'
            )
        ");

        $update->bindValue(
            ':table_id',
            $tableId,
            PDO::PARAM_INT
        );

        $update->execute();

        if ($update->rowCount() > 0) {

            echo json_encode([
                "status" => true,
                "message" => "Logout time updated successfully",
                "table_id" => (int)$tableId,
                "out_time" => date("Y-m-d H:i:s")
            ]);
        } else {

            echo json_encode([
                "status" => false,
                "message" => "Attendance already logged out or record not found"
            ]);
        }

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | CHECK-IN
    | POST JSON request
    |--------------------------------------------------------------------------
    */

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Get JSON body
        $input = json_decode(
            file_get_contents("php://input"),
            true
        );

        if (!$input) {
            echo json_encode([
                "status" => false,
                "message" => "Invalid JSON data"
            ]);
            exit;
        }

        $employeeId = $input['employee_id'] ?? null;
        $latitude   = $input['latitude'] ?? null;
        $longitude  = $input['longitude'] ?? null;
        $area       = $input['area'] ?? null;
        $city       = $input['city'] ?? null;
        $logDevice  = 1;


        // Validate required fields
        if (
            empty($employeeId) ||
            $latitude === null ||
            $longitude === null
        ) {
            echo json_encode([
                "status" => false,
                "message" => "Employee ID, latitude and longitude are required"
            ]);
            exit;
        }


        // Insert attendance
        $sql = "INSERT INTO employee_attendance_mob (
                employee_id,
                latitude,
                longitude,
                area,
                city,
                in_time,
                created_at,
                log_device
            ) VALUES (
                :employee_id,
                :latitude,
                :longitude,
                :area,
                :city,
                NOW(),
                NOW(),
                :log_device
            )
        ";

        $stmt = $con->prepare($sql);

        $stmt->bindValue(
            ':employee_id',
            $employeeId,
            PDO::PARAM_STR
        );

        $stmt->bindValue(
            ':latitude',
            $latitude
        );

        $stmt->bindValue(
            ':longitude',
            $longitude
        );

        $stmt->bindValue(
            ':area',
            $area
        );

        $stmt->bindValue(
            ':city',
            $city
        );

        $stmt->bindValue(
            ':log_device',
            $logDevice
        );


        if ($stmt->execute()) {

            echo json_encode([
                "status" => true,
                "message" => "Attendance marked successfully",
                "location_id" => $con->lastInsertId(),
                "in_time" => date("Y-m-d H:i:s")
            ]);
        } else {

            echo json_encode([
                "status" => false,
                "message" => "Failed to mark attendance"
            ]);
        }

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | INVALID METHOD
    |--------------------------------------------------------------------------
    */

    echo json_encode([
        "status" => false,
        "message" => "Invalid request method"
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
        "message" => "Something went wrong",
        "error" => $e->getMessage()
    ]);
}
