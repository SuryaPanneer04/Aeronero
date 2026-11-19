<?php
/*
 * BEspace - report data (called by bespace_reports.php without reloading the page)
 * Returns only the summary chips + table HTML for the chosen filters.
 */
date_default_timezone_set('Asia/Kolkata');

/* ---- Add your Aeronero login check here so only logged-in staff can open this file ----
 * Example (change the session key to the one your Aeronero login uses):
 * session_start();
 * if (empty($_SESSION['user_id'])) { http_response_code(403); exit('Not allowed'); }
 */

/* ---------- DATABASE SETTINGS (BEspace form database) ---------- */
$BE_HOST = 'localhost';
$BE_NAME = 'demobluebase_aeronero';
$BE_USER = 'root';
$BE_PASS = '';

function e($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function validDate($d) {
    $x = DateTime::createFromFormat('Y-m-d', $d);
    return $x && $x->format('Y-m-d') === $d;
}

header('Content-Type: text/html; charset=utf-8');

$fromDate = $_GET['from_date'] ?? date('Y-m-01');
$toDate   = $_GET['to_date']   ?? date('Y-m-d');
$employee = trim($_GET['employee'] ?? '');

if (!validDate($fromDate)) { exit('<div class="err">Enter a valid From date.</div>'); }
if (!validDate($toDate))   { exit('<div class="err">Enter a valid To date.</div>'); }
if ($fromDate > $toDate)   { exit('<div class="err">From date cannot be after To date.</div>'); }

try {
    $pdo = new PDO("mysql:host=$BE_HOST;dbname=$BE_NAME;charset=utf8mb4", $BE_USER, $BE_PASS, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    $sql = 'SELECT work_date, worker_name, department, attendance, half_day_reason,
                   work_done, machines, work_status, remarks
            FROM daily_work_records
            WHERE work_date BETWEEN :from AND :to';
    $params = [':from' => $fromDate, ':to' => $toDate];

    if ($employee !== '') {
        $sql .= ' AND worker_name = :emp';
        $params[':emp'] = $employee;
    }
    $sql .= ' ORDER BY work_date DESC, worker_name ASC';

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $rows = $stmt->fetchAll();
} catch (PDOException $ex) {
    error_log($ex->getMessage());
    exit('<div class="err">Could not connect to the BEspace database.</div>');
}

$summary = ['Present' => 0, 'Absent' => 0, 'Half Day' => 0, 'Leave' => 0];
foreach ($rows as $r) {
    if (isset($summary[$r['attendance']])) { $summary[$r['attendance']]++; }
}
?>
<div class="summary">
  <span class="chip">Total records: <b><?= count($rows) ?></b></span>
  <?php foreach ($summary as $label => $count): ?>
    <span class="chip"><?= e($label) ?>: <b><?= $count ?></b></span>
  <?php endforeach; ?>
</div>

<div class="table-wrap">
  <table>
    <thead>
      <tr>
        <th>S.No</th><th>Date</th><th>Employee</th>
        <!-- <th>Email</th> -->
        <th>Department</th>
        <th>Attendance</th><th>Half day reason</th><th>Work done</th>
        <th>Machines</th><th>Work status</th><th>Remarks</th>
      </tr>
    </thead>
    <tbody>
    <?php if (!$rows): ?>
      <tr><td colspan="11" class="empty">No reports found for these dates and employee.</td></tr>
    <?php else: foreach ($rows as $i => $r): ?>
      <tr>
        <td><?= $i + 1 ?></td>
        <td><?= e(date('d/m/Y', strtotime($r['work_date']))) ?></td>
        <td><?= e($r['worker_name']) ?></td>
        <!-- <td><?= e($r['email']) ?></td> -->
        <td><?= e($r['department']) ?></td>
        <td><?= e($r['attendance']) ?></td>
        <td> <?= !empty($r['half_day_reason']) ? e($r['half_day_reason']) : 'Null' ?></td>
        <td><?= e($r['work_done']) ?></td>
        <td><?= e($r['machines']) ?></td>
        <td><?= e($r['work_status']) ?></td>
        <td><?= e($r['remarks']) ?></td>
      </tr>
    <?php endforeach; endif; ?>
    </tbody>
  </table>
</div>