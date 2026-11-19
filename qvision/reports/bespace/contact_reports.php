<?php
/*
 * Employee Contact Details - Report page
 * Filters: Employee, Department, Joining From, Joining To (all optional)
 * Search, Reset and Export Excel all stay on THIS page.
 *
 * Use inside Aeronero layout:
 *   define('BESPACE_EMBEDDED', true);
 *   include 'contact_reports.php';
 */
require_once __DIR__ . '/contact_reports_lib.php';

/* Addresses of the data and export files, worked out from where THIS file is saved.
 * Keep contact_reports_data.php and contact_reports_export.php in the same folder. */
$docRoot = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'] ?? ''), '/');
$thisDir = str_replace('\\', '/', __DIR__);
if ($docRoot !== '' && stripos($thisDir, $docRoot) === 0) {
    $CD_BASE_URL = substr($thisDir, strlen($docRoot));
} else {
    // Fallback: type the folder address by hand if the line above does not work
    $CD_BASE_URL = '/Aeronero/qvision/reports/bespace';
}
$CD_DATA_URL   = $CD_BASE_URL . '/contact_reports_data.php';
$CD_EXPORT_URL = $CD_BASE_URL . '/contact_reports_export.php';

$employees = [];
$departments = [];
$dbError = '';
try {
    $pdo = cd_pdo();
    $employees   = $pdo->query('SELECT employee_id, employee_name FROM employee_contact_details ORDER BY employee_name, employee_id')
                       ->fetchAll();
    $departments = $pdo->query('SELECT DISTINCT department FROM employee_contact_details ORDER BY department')
                       ->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $ex) {
    error_log($ex->getMessage());
    $dbError = 'Could not connect to the database.';
}

if (!defined('BESPACE_EMBEDDED')) {
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8">'
       . '<meta name="viewport" content="width=device-width, initial-scale=1">'
       . '<title>Employee Contact Details Report</title></head>'
       . '<body style="margin:0;font-family:Segoe UI,Arial,sans-serif;">';
}
?>
<style>
  .cd-report { --blue: #009fe3; --dark: #1f2d3d; --line: #d9e2ea; --soft: #f2f8fc;
               padding: 20px; color: var(--dark); font-family: "Segoe UI", Arial, sans-serif; }
  .cd-report h2 { margin: 0 0 16px; font-size: 1.4rem; color: var(--blue); }
  .cd-report .filters { display: flex; flex-wrap: wrap; gap: 14px; align-items: flex-end;
                        background: var(--soft); border: 1px solid var(--line);
                        border-radius: 8px; padding: 16px; }
  .cd-report .filters > div { display: flex; flex-direction: column; min-width: 170px; }
  .cd-report label { font-weight: 600; margin-bottom: 6px; font-size: .9rem; }
  .cd-report input, .cd-report select {
    padding: 9px 10px; font: inherit; border: 1px solid var(--line); border-radius: 6px; background: #fff; }
  .cd-report input:focus, .cd-report select:focus { outline: 2px solid rgba(0,159,227,.4); border-color: var(--blue); }
  .cd-report .btn { padding: 10px 22px; font: inherit; font-weight: 600; border-radius: 6px; cursor: pointer; }
  .cd-report .btn-primary { background: var(--blue); color: #fff; border: 1px solid var(--blue); }
  .cd-report .btn-primary:hover { background: #0080b9; }
  .cd-report .btn-light { background: #fff; color: var(--blue); border: 1px solid var(--blue); }
  .cd-report .btn-green { background: #1d7a46; color: #fff; border: 1px solid #1d7a46; }
  .cd-report .btn-green:hover { background: #155c34; }
  .cd-report .err { margin-top: 14px; padding: 10px 14px; background: #fbe7e5; color: #b3261e; border-radius: 6px; }
  .cd-report .summary { display: flex; flex-wrap: wrap; gap: 10px; margin: 18px 0 10px; }
  .cd-report .chip { padding: 6px 14px; border: 1px solid var(--line); border-radius: 20px; background: #fff; font-size: .9rem; }
  .cd-report .chip b { color: var(--blue); }
  .cd-report .table-wrap { overflow-x: auto; border: 1px solid var(--line); border-radius: 8px; }
  .cd-report table { border-collapse: collapse; width: 100%; min-width: 1100px; font-size: .92rem; }
  .cd-report th { background: var(--blue); color: #fff; text-align: left; padding: 10px 12px; white-space: nowrap; }
  .cd-report td { padding: 9px 12px; border-top: 1px solid var(--line); vertical-align: top; }
  .cd-report tbody tr:nth-child(even) { background: var(--soft); }
  .cd-report .empty { padding: 26px; text-align: center; color: #6b7a89; }
  .cd-report #cd_results { transition: opacity .15s; }
  .cd-report #cd_results.loading { opacity: .45; }
</style>

<div class="cd-report">
  <h2>Employee Contact Details Report</h2>

  <?php if ($dbError): ?><div class="err" role="alert"><?= cd_e($dbError) ?></div><?php endif; ?>

  <form id="cd_form" class="filters" autocomplete="off">
    <div>
      <label for="cd_emp">Employee</label>
      <select id="cd_emp">
        <option value="">All employees</option>
        <?php foreach ($employees as $emp): ?>
          <option value="<?= cd_e($emp['employee_id']) ?>"><?= cd_e($emp['employee_name']) ?> (<?= cd_e($emp['employee_id']) ?>)</option>
        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label for="cd_dept">Department</label>
      <select id="cd_dept">
        <option value="">All departments</option>
        <?php foreach ($departments as $d): ?>
          <option value="<?= cd_e($d) ?>"><?= cd_e($d) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label for="cd_from">Joining from</label>
      <input type="date" id="cd_from">
    </div>
    <div>
      <label for="cd_to">Joining to</label>
      <input type="date" id="cd_to">
    </div>
    <div style="min-width:0; flex-direction:row; gap:10px; flex-wrap:wrap;">
      <button type="submit" class="btn btn-primary">Search</button>
      <button type="button" id="cd_reset" class="btn btn-light">Reset</button>
      <button type="button" id="cd_export" class="btn btn-green">Export Excel</button>
    </div>
  </form>

  <div id="cd_results" aria-live="polite"></div>
</div>

<script>
(function () {
  var DATA_URL   = <?= json_encode($CD_DATA_URL) ?>;
  var EXPORT_URL = <?= json_encode($CD_EXPORT_URL) ?>;

  var form    = document.getElementById('cd_form');
  var emp     = document.getElementById('cd_emp');
  var dept    = document.getElementById('cd_dept');
  var from    = document.getElementById('cd_from');
  var to      = document.getElementById('cd_to');
  var results = document.getElementById('cd_results');
  var exportBtn = document.getElementById('cd_export');

  function query() {
    return 'employee='   + encodeURIComponent(emp.value) +
           '&department=' + encodeURIComponent(dept.value) +
           '&join_from=' + encodeURIComponent(from.value) +
           '&join_to='   + encodeURIComponent(to.value);
  }

  function load() {
    results.classList.add('loading');
    fetch(DATA_URL + '?' + query(), { credentials: 'same-origin' })
      .then(function (r) {
        if (!r.ok) { throw new Error('Request failed'); }
        return r.text();
      })
      .then(function (html) { results.innerHTML = html; })
      .catch(function () {
        results.innerHTML = '<div class="err">Could not load the report. Check that contact_reports_data.php and contact_reports_lib.php are in the same folder as contact_reports.php.</div>';
      })
      .then(function () { results.classList.remove('loading'); });
  }

  // Search: stay on this page
  form.addEventListener('submit', function (e) { e.preventDefault(); load(); });

  // Reset: clear all filters, still on this page
  document.getElementById('cd_reset').addEventListener('click', function () {
    emp.value = ''; dept.value = ''; from.value = ''; to.value = '';
    load();
  });

  // Export Excel: downloads what is currently selected
  exportBtn.addEventListener('click', function () {
    if (from.value && to.value && from.value > to.value) {
      alert('Joining from date cannot be after Joining to date.'); return;
    }
    exportBtn.disabled = true;
    var oldText = exportBtn.textContent;
    exportBtn.textContent = 'Exporting...';

    fetch(EXPORT_URL + '?' + query(), { credentials: 'same-origin' })
      .then(function (r) {
        if (!r.ok) { return r.text().then(function (t) { throw new Error(t || 'Export failed'); }); }
        var cd = r.headers.get('Content-Disposition') || '';
        var m  = /filename="([^"]+)"/.exec(cd);
        var name = m ? m[1] : 'Employee_Contact_Details.xlsx';
        return r.blob().then(function (b) { return { blob: b, name: name }; });
      })
      .then(function (f) {
        var url = URL.createObjectURL(f.blob);
        var a = document.createElement('a');
        a.href = url; a.download = f.name;
        document.body.appendChild(a); a.click(); a.remove();
        setTimeout(function () { URL.revokeObjectURL(url); }, 1000);
      })
      .catch(function (err) { alert(err.message.substring(0, 300)); })
      .then(function () { exportBtn.disabled = false; exportBtn.textContent = oldText; });
  });

  load();   // first load
})();
</script>
<?php
if (!defined('BESPACE_EMBEDDED')) { echo '</body></html>'; }