<?php
/*
 * BEspace - Daily Work Reports (filter page)
 * Search and Reset both stay on THIS page. Results are loaded from bespace_reports_data.php
 * without reloading, so the Aeronero menu and page never change.
 *
 * Use inside Aeronero layout:
 *   define('BESPACE_EMBEDDED', true);
 *   include 'bespace_reports.php';
 */
date_default_timezone_set('Asia/Kolkata');

/* ---------- DATABASE SETTINGS (BEspace form database) ---------- */
$BE_HOST = 'localhost';
$BE_NAME = 'demobluebase_aeronero';
$BE_USER = 'root';
$BE_PASS = '';

/* Address of the data file, as seen from the browser.
 * Worked out automatically from where THIS file is saved, so keep
 * bespace_reports_data.php in the same folder as bespace_reports.php.
 * Example result: /Aeronero/qvision/reports/bespace/bespace_reports_data.php */
$docRoot = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'] ?? ''), '/');
$thisDir = str_replace('\\', '/', __DIR__);
if ($docRoot !== '' && stripos($thisDir, $docRoot) === 0) {
    $BE_BASE_URL = substr($thisDir, strlen($docRoot));
} else {
    // Fallback: type the folder address by hand if the line above does not work
    $BE_BASE_URL = '/Aeronero/qvision/reports/bespace';
}
$BE_DATA_URL   = $BE_BASE_URL . '/bespace_reports_data.php';
$BE_EXPORT_URL = $BE_BASE_URL . '/bespace_reports_export.php';

function e($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

$defaultFrom = date('Y-m-01');
$defaultTo   = date('Y-m-d');

$names = [];
$dbError = '';
try {
    $pdo = new PDO("mysql:host=$BE_HOST;dbname=$BE_NAME;charset=utf8mb4", $BE_USER, $BE_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    $names = $pdo->query('SELECT DISTINCT worker_name FROM daily_work_records ORDER BY worker_name')
                 ->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $ex) {
    error_log($ex->getMessage());
    $dbError = 'Could not connect to the BEspace database.';
}

if (!defined('BESPACE_EMBEDDED')) {
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8">'
       . '<meta name="viewport" content="width=device-width, initial-scale=1">'
       . '<title>BEspace - Daily Work Reports</title></head>'
       . '<body style="margin:0;font-family:Segoe UI,Arial,sans-serif;">';
}
?>
<style>
  .be-report { --blue: #009fe3; --dark: #1f2d3d; --line: #d9e2ea; --soft: #f2f8fc;
               padding: 20px; color: var(--dark); font-family: "Segoe UI", Arial, sans-serif; }
  .be-report h2 { margin: 0 0 16px; font-size: 1.4rem; color: var(--blue); }
  .be-report .filters { display: flex; flex-wrap: wrap; gap: 14px; align-items: flex-end;
                        background: var(--soft); border: 1px solid var(--line);
                        border-radius: 8px; padding: 16px; }
  .be-report .filters > div { display: flex; flex-direction: column; min-width: 180px; }
  .be-report label { font-weight: 600; margin-bottom: 6px; font-size: .9rem; }
  .be-report input, .be-report select {
    padding: 9px 10px; font: inherit; border: 1px solid var(--line); border-radius: 6px; background: #fff; }
  .be-report input:focus, .be-report select:focus { outline: 2px solid rgba(0,159,227,.4); border-color: var(--blue); }
  .be-report .btn { padding: 10px 22px; font: inherit; font-weight: 600; border-radius: 6px; cursor: pointer; }
  .be-report .btn-primary { background: var(--blue); color: #fff; border: 1px solid var(--blue); }
  .be-report .btn-primary:hover { background: #0080b9; }
  .be-report .btn-light { background: #fff; color: var(--blue); border: 1px solid var(--blue); }
  .be-report .btn-green { background: #1d7a46; color: #fff; border: 1px solid #1d7a46; }
  .be-report .btn-green:hover { background: #155c34; }
  .be-report .err { margin-top: 14px; padding: 10px 14px; background: #fbe7e5; color: #b3261e; border-radius: 6px; }
  .be-report .summary { display: flex; flex-wrap: wrap; gap: 10px; margin: 18px 0 10px; }
  .be-report .chip { padding: 6px 14px; border: 1px solid var(--line); border-radius: 20px; background: #fff; font-size: .9rem; }
  .be-report .chip b { color: var(--blue); }
  .be-report .table-wrap { overflow-x: auto; border: 1px solid var(--line); border-radius: 8px; }
  .be-report table { border-collapse: collapse; width: 100%; min-width: 1000px; font-size: .92rem; }
  .be-report th { background: var(--blue); color: #fff; text-align: left; padding: 10px 12px; white-space: nowrap; }
  .be-report td { padding: 9px 12px; border-top: 1px solid var(--line); vertical-align: top; }
  .be-report tbody tr:nth-child(even) { background: var(--soft); }
  .be-report .empty { padding: 26px; text-align: center; color: #6b7a89; }
  .be-report #be_results { transition: opacity .15s; }
  .be-report #be_results.loading { opacity: .45; }
</style>

<div class="be-report">
  <h2>BEspace - Daily Work Reports</h2>

  <?php if ($dbError): ?><div class="err" role="alert"><?= e($dbError) ?></div><?php endif; ?>

  <form id="be_form" class="filters" autocomplete="off">
    <div>
      <label for="be_from">From date</label>
      <input type="date" id="be_from" value="<?= e($defaultFrom) ?>" required>
    </div>
    <div>
      <label for="be_to">To date</label>
      <input type="date" id="be_to" value="<?= e($defaultTo) ?>" required>
    </div>
    <div>
      <label for="be_emp">Employee name</label>
      <select id="be_emp">
        <option value="">All employees</option>
        <?php foreach ($names as $n): ?>
          <option value="<?= e($n) ?>"><?= e($n) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div style="min-width:0; flex-direction:row; gap:10px;">
      <button type="submit" class="btn btn-primary">Search</button>
      <button type="button" id="be_reset" class="btn btn-light">Reset</button>
      <button type="button" id="be_export" class="btn btn-green">Export Excel</button>
    </div>
  </form>

  <div id="be_results" aria-live="polite"></div>
</div>

<script>
(function () {
  var DATA_URL     = <?= json_encode($BE_DATA_URL) ?>;
  var EXPORT_URL   = <?= json_encode($BE_EXPORT_URL) ?>;
  var DEFAULT_FROM = <?= json_encode($defaultFrom) ?>;
  var DEFAULT_TO   = <?= json_encode($defaultTo) ?>;

  var form    = document.getElementById('be_form');
  var from    = document.getElementById('be_from');
  var to      = document.getElementById('be_to');
  var emp     = document.getElementById('be_emp');
  var results = document.getElementById('be_results');

  function load() {
    var qs = 'from_date=' + encodeURIComponent(from.value) +
             '&to_date='  + encodeURIComponent(to.value) +
             '&employee=' + encodeURIComponent(emp.value);

    results.classList.add('loading');
    fetch(DATA_URL + '?' + qs, { credentials: 'same-origin' })
      .then(function (r) {
        if (!r.ok) { throw new Error('Request failed'); }
        return r.text();
      })
      .then(function (html) { results.innerHTML = html; })
      .catch(function () {
        results.innerHTML = '<div class="err">Could not load the report. Check that bespace_reports_data.php is in the same folder as index.php.</div>';
      })
      .then(function () { results.classList.remove('loading'); });
  }

  // Search: show only the chosen employee/dates, stay on this page
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    load();
  });

  // Reset: back to this month + all employees, still on this page
  document.getElementById('be_reset').addEventListener('click', function () {
    from.value = DEFAULT_FROM;
    to.value   = DEFAULT_TO;
    emp.value  = '';
    load();
  });

  // Export Excel: downloads what is currently selected (dates + employee), page stays as it is
  var exportBtn = document.getElementById('be_export');
  exportBtn.addEventListener('click', function () {
    if (!from.value || !to.value) { alert('Choose From date and To date.'); return; }
    if (from.value > to.value)    { alert('From date cannot be after To date.'); return; }

    var qs = 'from_date=' + encodeURIComponent(from.value) +
             '&to_date='  + encodeURIComponent(to.value) +
             '&employee=' + encodeURIComponent(emp.value);

    exportBtn.disabled = true;
    var oldText = exportBtn.textContent;
    exportBtn.textContent = 'Exporting...';

    fetch(EXPORT_URL + '?' + qs, { credentials: 'same-origin' })
      .then(function (r) {
        if (!r.ok) { return r.text().then(function (t) { throw new Error(t || 'Export failed'); }); }
        var cd = r.headers.get('Content-Disposition') || '';
        var m  = /filename="([^"]+)"/.exec(cd);
        var name = m ? m[1] : 'BEspace_Work_Report.xlsx';
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