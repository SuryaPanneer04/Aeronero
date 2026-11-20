<?php
/*
 * Employee Contact Details - shared settings and functions
 * Used by: contact_reports.php, contact_reports_data.php, contact_reports_export.php
 * Reads from: work_records.employee_contact_details
 */
date_default_timezone_set('Asia/Kolkata');

/* ---------- DATABASE SETTINGS (change here only, one place) ---------- */
if (!defined('CD_DB_HOST')) {
    define('CD_DB_HOST', 'localhost');
    define('CD_DB_NAME', 'demobluebase_aeronero');
    define('CD_DB_USER', 'root');
    define('CD_DB_PASS', '');
}

if (!function_exists('cd_e')) {
    function cd_e($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
}

if (!function_exists('cd_validDate')) {
    function cd_validDate($d) {
        $x = DateTime::createFromFormat('Y-m-d', $d);
        return $x && $x->format('Y-m-d') === $d;
    }
}

if (!function_exists('cd_pdo')) {
    function cd_pdo() {
        return new PDO('mysql:host=' . CD_DB_HOST . ';dbname=' . CD_DB_NAME . ';charset=utf8mb4', CD_DB_USER, CD_DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
}

/* Read and check the filters. Returns [filters, errors] */
if (!function_exists('cd_filters')) {
    function cd_filters(array $src) {
        $f = [
            'employee'   => trim($src['employee']   ?? ''),   // employee ID
            'department' => trim($src['department'] ?? ''),
            'join_from'  => trim($src['join_from']  ?? ''),
            'join_to'    => trim($src['join_to']    ?? ''),
        ];
        $err = [];
        if ($f['join_from'] !== '' && !cd_validDate($f['join_from'])) { $err[] = 'Enter a valid Joining From date.'; }
        if ($f['join_to']   !== '' && !cd_validDate($f['join_to']))   { $err[] = 'Enter a valid Joining To date.'; }
        if (!$err && $f['join_from'] !== '' && $f['join_to'] !== '' && $f['join_from'] > $f['join_to']) {
            $err[] = 'Joining From date cannot be after Joining To date.';
        }
        return [$f, $err];
    }
}

/* Get the records for the filters */
if (!function_exists('cd_fetch')) {
    function cd_fetch(PDO $pdo, array $f) {
        $sql = 'SELECT employee_id, employee_name, email, department, designation, mobile_number,emg_mobile,
                       blood_group, address, date_of_joining, created_at
                FROM employee_contact_details WHERE 1=1';
        $p = [];
        if ($f['employee']   !== '') { $sql .= ' AND employee_id = :emp';        $p[':emp']  = $f['employee']; }
        if ($f['department'] !== '') { $sql .= ' AND department = :dept';        $p[':dept'] = $f['department']; }
        if ($f['join_from']  !== '') { $sql .= ' AND date_of_joining >= :jfrom'; $p[':jfrom'] = $f['join_from']; }
        if ($f['join_to']    !== '') { $sql .= ' AND date_of_joining <= :jto';   $p[':jto']   = $f['join_to']; }
        $sql .= ' ORDER BY employee_name ASC, employee_id ASC';
        $st = $pdo->prepare($sql);
        $st->execute($p);
        return $st->fetchAll();
    }
}