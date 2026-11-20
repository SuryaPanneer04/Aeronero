<?php
session_start();

header('Content-Type: application/json');

require('../connect.php');

try {

    // Check database connection
    if (!$con) {
        echo json_encode(["Database connection failed."]);
        exit;
    }
    $empId = $_POST['empId'] ?? $_GET['empId'] ?? "";
    $fromDate = $_POST['fromDate'] ?? $_GET['fromDate'] ?? "";
    $toDate = $_POST['toDate'] ?? $_GET['toDate'] ?? "";

    $sql = "SELECT 
        a.*,
        u.user_name,
        u.full_name
        FROM employee_attendance_mob AS a
        LEFT JOIN z_user_master AS u 
        ON a.employee_id = u.user_id
        WHERE 1=1";

    $params = [];

    if ($empId != "") {
        $sql .= " AND a.employee_id = :empId";
        $params[':empId'] = $empId;
    }

    if ($fromDate != "" && $toDate != "") {

        $fromDateOnly = date('Y-m-d', strtotime($fromDate));
        $toDateOnly = date('Y-m-d', strtotime($toDate));

        $sql .= " AND a.created_at >= :fromDate
              AND a.created_at < :toDate";

        $params[':fromDate'] = $fromDateOnly . " 00:00:00";

        $params[':toDate'] = date(
            'Y-m-d 00:00:00',
            strtotime($toDateOnly . ' +1 day')
        );
    } else {

        // Default: Today's attendance
        $sql .= " AND a.date >= CURDATE()
              AND a.date < CURDATE() + INTERVAL 1 DAY";
    }

    $sql .= " ORDER BY a.id DESC";

    $res = $con->prepare($sql);

    foreach ($params as $key => $value) {
        $res->bindValue($key, $value, PDO::PARAM_STR);
    }

    if ($res->execute()) {

        $row = $res->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'status' => 'success',
            'from' => $fromDate,
            'to' => $toDate,
            'data' => $row
        ]);

        exit();
    } else {

        echo json_encode([
            'status' => 'error',
            'message' => 'Payroll Data Not found'
        ]);

        exit();
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
