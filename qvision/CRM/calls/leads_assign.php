<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../../connect.php';
include_once __DIR__ . '/../../../user.php';

$db = $con ?? $conn ?? null;
if (!$db) {
    echo json_encode(['status' => 0, 'message' => 'Database connection not found.']);
    exit;
}

$assignedBy = (int)($_SESSION['userid'] ?? 0);
if ($assignedBy <= 0) {
    echo json_encode(['status' => 0, 'message' => 'Session expired. Please log in again.']);
    exit;
}

$ids = $_POST['ids'] ?? [];
$departmentId = (int)($_POST['department_id'] ?? 0);
$memberId = (int)($_POST['member_id'] ?? 0);

if (!is_array($ids) || empty($ids) || $departmentId <= 0 || $memberId <= 0) {
    echo json_encode(['status' => 0, 'message' => 'Invalid selection.']);
    exit;
}

$cleanIds = array_values(array_filter(array_map('intval', $ids), function ($v) {
    return $v > 0;
}));

if (empty($cleanIds)) {
    echo json_encode(['status' => 0, 'message' => 'No valid lead IDs selected.']);
    exit;
}

$placeholders = implode(',', array_fill(0, count($cleanIds), '?'));

$sql = "UPDATE crm_leads
        SET assigned_dept = ?,
            assigned_to = ?,
            assigned_by = ?,
            assigned_at = NOW()
        WHERE id IN ($placeholders)";

try {
    if ($db instanceof PDO) {
        $stmt = $db->prepare($sql);
        $params = array_merge([$departmentId, $memberId, $assignedBy], $cleanIds);
        $stmt->execute($params);
    } else {
        $stmt = mysqli_prepare($db, $sql);
        $types = 'iii' . str_repeat('i', count($cleanIds));
        $params = array_merge([$departmentId, $memberId, $assignedBy], $cleanIds);
        mysqli_stmt_bind_param($stmt, $types, ...$params);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    echo json_encode([
        'status' => 1,
        'message' => count($cleanIds) . ' lead(s) assigned successfully.'
    ]);
} catch (Throwable $e) {
    echo json_encode(['status' => 0, 'message' => 'Error: ' . $e->getMessage()]);
}