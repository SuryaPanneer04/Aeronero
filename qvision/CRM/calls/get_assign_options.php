<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../../connect.php';

$db = $con ?? $conn ?? null;
if (!$db) {
    echo json_encode(['status' => 0, 'message' => 'Database connection not found.']);
    exit;
}

$action = $_GET['action'] ?? '';

try {
    if ($action === 'departments') {
        $sql = "SELECT id, dept_name
                FROM z_department_master
                WHERE status = 1
                ORDER BY dept_name ASC";

        $rows = [];
        if ($db instanceof PDO) {
            $stmt = $db->query($sql);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $res = mysqli_query($db, $sql);
            while ($r = mysqli_fetch_assoc($res)) {
                $rows[] = $r;
            }
        }

        echo json_encode(['status' => 1, 'data' => $rows]);
        exit;
    }

    if ($action === 'members') {
        $deptId = (int)($_GET['department_id'] ?? 0);
        if ($deptId <= 0) {
            echo json_encode(['status' => 1, 'data' => []]);
            exit;
        }

        $sql = "SELECT user_id,
                       COALESCE(NULLIF(TRIM(full_name), ''), user_name) AS display_name
                FROM z_user_master
                WHERE department = ?
                ORDER BY display_name ASC";

        $rows = [];
        if ($db instanceof PDO) {
            $stmt = $db->prepare($sql);
            $stmt->execute([$deptId]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $stmt = mysqli_prepare($db, $sql);
            mysqli_stmt_bind_param($stmt, 'i', $deptId);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            while ($r = mysqli_fetch_assoc($res)) {
                $rows[] = $r;
            }
            mysqli_stmt_close($stmt);
        }

        echo json_encode(['status' => 1, 'data' => $rows]);
        exit;
    }

    echo json_encode(['status' => 0, 'message' => 'Invalid action.']);
} catch (Throwable $e) {
    echo json_encode(['status' => 0, 'message' => $e->getMessage()]);
}