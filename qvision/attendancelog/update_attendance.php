<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . '/../../connect.php';   // $con (PDO)
date_default_timezone_set("Asia/Kolkata");
header('Content-Type: application/json; charset=utf-8');
function respond($arr)
{
    echo json_encode($arr);
    exit;
}
$session_username = trim($_SESSION['username'] ?? '');
if ($session_username === '') {
    respond(['success' => false, 'message' => 'Please login first.']);
}
try {
    // ---- Admin check (server side) ----
    $stmt = $con->prepare("SELECT user_id, user_group_code FROM z_user_master
                           WHERE user_name = :uname LIMIT 1");
    $stmt->execute([':uname' => $session_username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        respond(['success' => false, 'message' => 'User not found.']);
    }
    $groups = array_map('trim', explode(',', (string) $user['user_group_code']));
    $admin_groups = ['R003', 'R001', 'R008'];
    if (empty(array_intersect($admin_groups, $groups))) {
        respond(['success' => false, 'message' => 'You are not allowed to edit.']);
    }
    // ---- Inputs ----
    $id = (int) ($_POST['id'] ?? 0);
    $out_raw = trim($_POST['out_time'] ?? '');
    $remark = trim($_POST['remark'] ?? '');
    if (function_exists('mb_substr')) {
        $remark = mb_substr($remark, 0, 200);
    } else {
        $remark = substr($remark, 0, 200);
    }
    if ($id <= 0) {
        respond(['success' => false, 'message' => 'Invalid record.']);
    }
    // ---- Existing row ----
    $s = $con->prepare("SELECT in_time FROM employee_attendance_mob WHERE id = :id LIMIT 1");
    $s->execute([':id' => $id]);
    $row = $s->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        respond(['success' => false, 'message' => 'Record not found.']);
    }
    // ---- Out time (optional) ----
    $out_db = null;
    if ($out_raw !== '') {
        $dt = DateTime::createFromFormat('Y-m-d\TH:i', $out_raw);
        if (!$dt) {
            respond(['success' => false, 'message' => 'Invalid Out Time.']);
        }
        $out_db = $dt->format('Y-m-d H:i:00');
        if (!empty($row['in_time']) && strtotime($out_db) < strtotime($row['in_time'])) {
            respond(['success' => false, 'message' => 'Out Time cannot be earlier than In Time.']);
        }
    }
    // ---- Update ----
    $now = date('Y-m-d H:i:s');
    $upd = $con->prepare("UPDATE employee_attendance_mob
                          SET out_time  = :out_time,
                              remark    = :remark,
                              modify_at = :modify_at,
                              modify_by = :modify_by
                          WHERE id = :id");
    $upd->execute([
        ':out_time' => $out_db,                       // NULL if empty
        ':remark' => ($remark === '' ? null : $remark),
        ':modify_at' => $now,
        ':modify_by' => $session_username,
        ':id' => $id,
    ]);
    // ---- Modified By full name ----
    $modify_name = $session_username;
    $mn = $con->prepare("SELECT full_name FROM z_user_master WHERE user_name = :uname LIMIT 1");
    $mn->execute([':uname' => $session_username]);
    $mn_row = $mn->fetch(PDO::FETCH_ASSOC);
    if ($mn_row && !empty($mn_row['full_name'])) {
        $modify_name = $mn_row['full_name'];
    }
    // ---- Going calculation (same logic as main page) ----
    $OFFICE_OUT = 17 * 60 + 30;
    $out_status = '';
    $out_label = '';
    $early_going = '-';
    $late_going = '-';
    if ($out_db) {
        $t = strtotime($out_db);
        $m = ((int) date('G', $t)) * 60 + (int) date('i', $t);
        $fmt = function ($x) {
            return sprintf('%02d:%02d', intdiv($x, 60), $x % 60);
        };
        if ($m < $OFFICE_OUT) {
            $out_status = 'early';
            $out_label = 'Early Going';
            $early_going = $fmt($OFFICE_OUT - $m);
        } elseif ($m == $OFFICE_OUT) {
            $out_status = 'ontime';
            $out_label = 'On Time';
        } else {
            $out_status = 'late';
            $out_label = 'Late Going';
            $late_going = $fmt($m - $OFFICE_OUT);
        }
    }
    respond([
        'success' => true,
        'out_display' => $out_db ? date('d-m-Y h:i A', strtotime($out_db)) : '-',
        'out_value' => $out_db ? date('Y-m-d\TH:i', strtotime($out_db)) : '',
        'out_status' => $out_status,
        'out_label' => $out_label,
        'early_going' => $early_going,
        'late_going' => $late_going,
        'remark' => $remark,
        'modify_at' => date('d-m-Y h:i A', strtotime($now)),
        'modify_name' => $modify_name,
    ]);
} catch (Exception $e) {
    respond(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}