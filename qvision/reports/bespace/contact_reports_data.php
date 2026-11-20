<?php
/*
 * Employee Contact Details - report data (called by contact_reports.php without reloading the page)
 */
require_once __DIR__ . '/contact_reports_lib.php';

/* ---- Add your Aeronero login check here so only logged-in staff can open this file ----
 * Example (change the session key to the one your Aeronero login uses):
 * session_start();
 * if (empty($_SESSION['user_id'])) { http_response_code(403); exit('Not allowed'); }
 */

header('Content-Type: text/html; charset=utf-8');

list($f, $errors) = cd_filters($_GET);
if ($errors) { exit('<div class="err">' . cd_e($errors[0]) . '</div>'); }

try {
    $rows = cd_fetch(cd_pdo(), $f);
} catch (PDOException $ex) {
    error_log($ex->getMessage());
    exit('<div class="err">Could not connect to the database.</div>');
}
?>
<div class="summary">
  <span class="chip">Total records: <b><?= count($rows) ?></b></span>
</div>

<div class="table-wrap">
  <table>
    <thead>
      <tr>
        <th>S.No</th><th>Employee ID</th><th>Employee Name</th><th>Email</th><th>Department</th>
        <th>Designation</th><th>Mobile</th><th>Emergency Number</th><th>Blood group</th><th>Address</th>
        <th>Date of Joining</th><th>Submitted on</th>
      </tr>
    </thead>
    <tbody>
    <?php if (!$rows): ?>
      <tr><td colspan="11" class="empty">No records found for these filters.</td></tr>
    <?php else: foreach ($rows as $i => $r): ?>
      <tr>
        <td><?= $i + 1 ?></td>
        <td><?= cd_e($r['employee_id']) ?></td>
        <td><?= cd_e($r['employee_name']) ?></td>
        <td><?= cd_e($r['email']) ?></td>
        <td><?= cd_e($r['department']) ?></td>
        <td><?= cd_e($r['designation']) ?></td>
        <td><?= cd_e($r['mobile_number']) ?></td>
        <td><?= cd_e($r['emg_mobile']) ?></td>
        <td><?= cd_e($r['blood_group']) ?></td>
        <td><?= cd_e($r['address']) ?></td>
        <td><?= cd_e(date('d/m/Y', strtotime($r['date_of_joining']))) ?></td>
        <td><?= cd_e(date('d/m/Y H:i', strtotime($r['created_at']))) ?></td>
      </tr>
    <?php endforeach; endif; ?>
    </tbody>
  </table>
</div>