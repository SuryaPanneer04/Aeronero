<?php
ini_set('display_errors', 0);     
error_reporting(E_ALL);
session_start();
header('Content-Type: application/json');
include 'connect.php';                       
$con->exec("SET NAMES utf8mb4");
function respond($data)
{
    echo json_encode($data);
    exit;
}
function isEmptyTime($value)
{
    return $value === null || $value === '' || $value === '0000-00-00 00:00:00';
}
function isValidDateTime($value)
{
    $d = DateTime::createFromFormat('Y-m-d H:i:s', (string) $value);
    return $d && $d->format('Y-m-d H:i:s') === $value;
}
function isValidDate($value)
{
    $d = DateTime::createFromFormat('Y-m-d', (string) $value);
    return $d && $d->format('Y-m-d') === $value;
}
// ---------- Logged-in user ----------
$username = $_SESSION['username'] ?? '';
if ($username === '') {
    respond(['success' => false, 'message' => 'Session expired. Please log in again.']);
}
// username -> staff_master.emp_code -> staff id
$stmt = $con->prepare("SELECT user_id FROM z_user_master WHERE user_name = ? LIMIT 1");
if (!$stmt || !$stmt->execute([$username])) {
    error_log('attendance: z_user_master query failed ' . json_encode($con->errorInfo()));
    respond(['success' => false, 'message' => 'Unable to load staff details.']);
}
$staff = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$staff) {
    respond(['success' => false, 'message' => 'Staff record not found.']);
}
$employee_id = (string) $staff['user_id'];
// ---------- Date / time sent from the user's device ----------
$action = $_POST['action'] ?? $_GET['action'] ?? '';
if ($action === 'check') {
    $workDate = $_GET['client_date'] ?? '';
    if (!isValidDate($workDate)) {
        respond(['success' => false, 'message' => 'Invalid date.']);
    }
} elseif ($action === 'punchin' || $action === 'punchout') {
    $clientDateTime = $_POST['client_datetime'] ?? '';
    if (!isValidDateTime($clientDateTime)) {
        respond(['success' => false, 'message' => 'Invalid date and time.']);
    }
    $workDate = substr($clientDateTime, 0, 10);
} else {
    respond(['success' => false, 'message' => 'Invalid request.']);
}
// ---------- Attendance row for that date ----------
$stmt = $con->prepare("SELECT id, in_time, out_time FROM employee_attendance_mob
                       WHERE employee_id = ? AND DATE(in_time) = ?
                       ORDER BY id DESC LIMIT 1");
if (!$stmt || !$stmt->execute([$employee_id, $workDate])) {
    error_log('attendance: select failed ' . json_encode($con->errorInfo()));
    respond(['success' => false, 'message' => 'Unable to load attendance details.']);
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);
// ---------- CHECK STATUS ----------
if ($action === 'check') {
    if (!$row) {
        respond(['state' => 'punch_in']);
    }
    if (isEmptyTime($row['out_time'])) {
        respond([
            'state' => 'punch_out',
            'in_time' => date('h:i A', strtotime($row['in_time']))
        ]);
    }
    respond([
        'state' => 'completed',
        'in_time' => date('h:i A', strtotime($row['in_time'])),
        'out_time' => date('h:i A', strtotime($row['out_time']))
    ]);
}
$log_device = (($_SERVER['HTTP_X_CLIENT_TYPE'] ?? '') === 'app') ? 1 : 0;

// $log_device = (isset($_POST['log_device']) && $_POST['log_device'] == 1) ? 1 : 0;
// ---------- PUNCH IN ----------
if ($action === 'punchin') {
    if ($row) {
        respond(['success' => false, 'message' => 'You have already punched in today.']);
    }
    $lat = (float) ($_POST['latitude'] ?? 0);
    $lng = (float) ($_POST['longitude'] ?? 0);
    $area = trim($_POST['area'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $stmt = $con->prepare("INSERT INTO employee_attendance_mob
        (employee_id, latitude, longitude, area, city, in_time, out_time, created_at, updated_at, log_device, status)
        VALUES (?, ?, ?, ?, ?, ?, NULL, ?, NULL, ?, 0)");
    $ok = $stmt && $stmt->execute([
        $employee_id,
        $lat,
        $lng,
        $area,
        $city,
        $clientDateTime,      // in_time
        $clientDateTime,      // created_at
        $log_device
    ]);
    if (!$ok) {
        error_log('attendance: punch in failed ' . json_encode($stmt ? $stmt->errorInfo() : $con->errorInfo()));
    }
    respond([
        'success' => (bool) $ok,
        'message' => $ok ? 'Punched in successfully.' : 'Punch in failed. Please try again.'
    ]);
}
// ---------- PUNCH OUT ----------
if ($action === 'punchout') {
    if (!$row) {
        respond(['success' => false, 'message' => 'No punch in found for today.']);
    }
    if (!isEmptyTime($row['out_time'])) {
        respond(['success' => false, 'message' => 'You have already punched out today.']);
    }
    if (strtotime($clientDateTime) < strtotime($row['in_time'])) {
        respond(['success' => false, 'message' => 'Punch out time cannot be earlier than punch in time.']);
    }
    // log_device is updated here too (e.g. punched in on web, punched out on mobile)
    $stmt = $con->prepare("UPDATE employee_attendance_mob
                           SET out_time = ?, updated_at = ?, log_device = ?
                           WHERE id = ?");
    $ok = $stmt && $stmt->execute([$clientDateTime, $clientDateTime, $log_device, $row['id']]);
    if (!$ok) {
        error_log('attendance: punch out failed ' . json_encode($stmt ? $stmt->errorInfo() : $con->errorInfo()));
    }
    respond([
        'success' => (bool) $ok,
        'message' => $ok ? 'Punched out successfully.' : 'Punch out failed. Please try again.'
    ]);
}
respond(['success' => false, 'message' => 'Invalid request.']);