<?php
session_start();
date_default_timezone_set('Asia/Kolkata');

/* ---------- 1. DATABASE SETTINGS (change these) ---------- */
$DB_HOST = 'localhost';
$DB_NAME = 'demobluebase_aeronero';
$DB_USER = 'root';
$DB_PASS = '';

/* ---------- 2. ALLOWED VALUES (used to validate the form) ---------- */
$departments = ['Production', 'Service'];
$attendances = ['Present', 'Absent', 'Half Day', 'Leave'];
$activities  = ['Cleaning', 'Assembling', 'Welding', 'Fixing', 'Gas Charging', 'Testing',
                'Final Assembly', 'Moving to Dispatch', 'Maintenance', 'Packing', 'Service', 'Other'];
$statuses    = ['Completed', 'In Progress', 'Pending', 'On Hold'];

/* Date is ALWAYS taken from the server, never from the form */
$today        = date('Y-m-d');   // saved in database
$todayDisplay = date('d/m/Y');   // shown on screen

$errors = [];
$old = [
    'name' => '', 'department' => '', 'attendance' => '',
    'halfReason' => '', 'workDone' => [], 'machines' => '', 'status' => '', 'remarks' => ''
];

/* ---------- 3. HANDLE SUBMIT ---------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $old['name']       = trim($_POST['name'] ?? '');
    // $old['email']      = trim($_POST['email'] ?? '');
    $old['department'] = $_POST['department'] ?? '';
    $old['attendance'] = $_POST['attendance'] ?? '';
    $old['halfReason'] = ($old['attendance'] === 'Half Day')
                         ? mb_substr(trim($_POST['halfReason'] ?? ''), 0, 500) : '';
    $old['workDone']   = array_values(array_intersect($activities, (array)($_POST['workDone'] ?? [])));
    $old['machines']   = trim($_POST['machines'] ?? '');
    $old['status']     = $_POST['status'] ?? '';
    $old['remarks']    = trim($_POST['remarks'] ?? '');

    if ($old['name'] === '' || mb_strlen($old['name']) > 100)
        $errors[] = 'Enter your name.';
    // if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL))
    //     $errors[] = 'Enter a valid email address.';
    if (!in_array($old['department'], $departments, true))
        $errors[] = 'Choose a department.';
    if (!in_array($old['attendance'], $attendances, true))
        $errors[] = 'Select your attendance.';
    if (!ctype_digit($old['machines']))
        $errors[] = 'Enter the number of machines as a whole number.';
    if (!in_array($old['status'], $statuses, true))
        $errors[] = 'Select the work status.';

    if (!$errors) {
        try {
            $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
            $stmt = $pdo->prepare(
                'INSERT INTO daily_work_records
                 (worker_name, work_date, department, attendance, half_day_reason, work_done, machines, work_status, remarks)
                 VALUES (?,?, ?, ?, ?, ?, ?, ?, ?)'
            );
            $stmt->execute([
                $old['name'], $today, $old['department'], $old['attendance'],
                $old['halfReason'], implode(', ', $old['workDone']), (int)$old['machines'],
                $old['status'], $old['remarks']
            ]);

            $_SESSION['success'] = 'Your response has been recorded.';
            header('Location: ' . $_SERVER['PHP_SELF']);   // stops double-submit on refresh
            exit;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $errors[] = 'Could not save your response. Please try again.';
        }
    }
}

$success = $_SESSION['success'] ?? '';
unset($_SESSION['success']);

function e($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BE Space Advisors - Daily Production Work Record</title>
<style>
  :root {
    --purple: #8C3D98;   /* Primary Purple */
    --dark: #343434;     /* Primary Dark */
    --bg: #f3f1f4; --card: #ffffff; --ink: var(--dark); --muted: #6b6670;
    --line: #d6d1d9; --accent: var(--purple); --accent-dark: var(--dark);
    --locked: #e9e7ea; --error: #b3261e;
  }
  * { box-sizing: border-box; }
  body { margin: 0; background: var(--bg); color: var(--ink);
         font-family: "Segoe UI", system-ui, -apple-system, Roboto, Arial, sans-serif; line-height: 1.5; }
  .wrap { max-width: 680px; margin: 0 auto; padding: 24px 16px 48px; }
  .logo-bar { background: #fff; border: 1px solid var(--line); border-bottom: 0;
              border-radius: 8px 8px 0 0; padding: 16px 28px; text-align: center; }
  .logo-bar img { height: 56px; width: auto; max-width: 100%; display: block; margin: 0 auto; }
  header { background: var(--accent); color: #fff; padding: 24px 28px; }
  header h1 { margin: 0 0 6px; font-size: 1.5rem; }
  header p { margin: 0; opacity: .9; }
  form { background: var(--card); padding: 8px 28px 28px; border: 1px solid var(--line);
         border-top: 0; border-radius: 0 0 8px 8px; }
  .field { margin-top: 22px; border: 0; padding: 0; }
  label, legend { display: block; font-weight: 600; margin-bottom: 8px; padding: 0; }
  .req::after { content: " *"; color: var(--purple); font-weight: 700; }
  input[type="text"]:required, input[type="email"]:required,
  input[type="number"]:required, select:required { border-color: var(--purple); }
  .hint { font-weight: 400; color: var(--muted); font-size: .9rem; }
  input[type="text"], input[type="email"], input[type="number"], select, textarea {
    width: 100%; padding: 10px 12px; font: inherit; color: var(--ink);
    background: #fff; border: 1px solid var(--line); border-radius: 6px; }
  textarea { min-height: 90px; resize: vertical; }
  input:focus, select:focus, textarea:focus, .opt input:focus-visible {
    outline: 3px solid rgba(140, 61, 152, .35); border-color: var(--accent); }
  #date { background: var(--locked); color: var(--muted); cursor: not-allowed; pointer-events: none; }
  .options { display: grid; grid-template-columns: repeat(auto-fill, minmax(190px, 1fr)); gap: 8px 16px; }
  .opt { display: flex; align-items: center; gap: 8px; font-weight: 400; margin: 0; cursor: pointer; }
  .opt input { width: 18px; height: 18px; accent-color: var(--accent); }
  .actions { display: flex; gap: 12px; margin-top: 30px; flex-wrap: wrap; }
  .btn { font: inherit; font-weight: 600; padding: 11px 26px; border-radius: 6px; cursor: pointer; }
  .primary { background: var(--accent); color: #fff; border: 1px solid var(--accent); }
  .primary:hover { background: var(--accent-dark); }
  .secondary { background: #fff; color: var(--accent); border: 1px solid var(--line); }
  .secondary:hover { background: var(--bg); }
  .msg { margin-top: 18px; padding: 12px 14px; border-radius: 6px; }
  .msg.ok { background: #e3f3e8; color: #17572b; }
  .msg.err { background: #fbe7e5; color: var(--error); }
  .msg.err ul { margin: 0; padding-left: 18px; }
  [hidden] { display: none !important; }
  .note { margin-top: 20px; color: var(--muted); font-size: .85rem; }
</style>
</head>
<body>
<div class="wrap">
  <div class="logo-bar">
    <img src="bespace-logo.jpeg" alt="BE Space Advisors">
  </div>
  <header>
    <h1>Daily Production Work Record</h1>
    <p>Daily work and attendance form. Submit once every working day.</p>
  </header>

  <form method="post" action="<?= e($_SERVER['PHP_SELF']) ?>" id="workForm">

    <?php if ($success): ?>
      <div class="msg ok" role="status"><?= e($success) ?></div>
    <?php endif; ?>

    <?php if ($errors): ?>
      <div class="msg err" role="alert">
        <ul><?php foreach ($errors as $err): ?><li><?= e($err) ?></li><?php endforeach; ?></ul>
      </div>
    <?php endif; ?>

    <div class="field">
      <label class="req" for="name">Worker Name</label>
      <input type="text" id="name" name="name" value="<?= e($old['name']) ?>"
             autocomplete="name" placeholder="Type your full name" maxlength="100" required>
    </div>

    <!-- <div class="field">
      <label class="req" for="email">Email</label>
      <input type="email" id="email" name="email" value="<?= e($old['email']) ?>"
             autocomplete="email" placeholder="you@example.com" required>
    </div> -->

    <div class="field">
      <label class="req" for="date">Date <span class="hint">(set automatically, cannot be changed)</span></label>
      <input type="text" id="date" value="<?= e($todayDisplay) ?>" readonly tabindex="-1" aria-readonly="true">
      <!-- no name attribute: the date is never sent from the browser, the server sets it -->
    </div>

    <div class="field">
      <label class="req" for="department">Department</label>
      <select id="department" name="department" required>
        <option value="">Choose</option>
        <?php foreach ($departments as $d): ?>
          <option <?= $old['department'] === $d ? 'selected' : '' ?>><?= e($d) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <fieldset class="field">
      <legend class="req">Attendance</legend>
      <div class="options">
        <?php foreach ($attendances as $a): ?>
          <label class="opt"><input type="radio" name="attendance" value="<?= e($a) ?>"
            <?= $old['attendance'] === $a ? 'checked' : '' ?> required> <?= e($a) ?></label>
        <?php endforeach; ?>
      </div>
    </fieldset>

    <div class="field" id="halfDayBox" <?= $old['attendance'] === 'Half Day' ? '' : 'hidden' ?>>
      <label for="halfReason">Reason (Optional)</label>
      <textarea id="halfReason" name="halfReason" maxlength="500"><?= e($old['halfReason']) ?></textarea>
    </div>

    <fieldset class="field">
      <legend>Work Done <span class="hint">(select all applicable activities)</span></legend>
      <div class="options">
        <?php foreach ($activities as $act): ?>
          <label class="opt"><input type="checkbox" name="workDone[]" value="<?= e($act) ?>"
            <?= in_array($act, $old['workDone'], true) ? 'checked' : '' ?>> <?= e($act) ?></label>
        <?php endforeach; ?>
      </div>
    </fieldset>

    <div class="field">
      <label class="req" for="machines">Number of Machines Worked On</label>
      <input type="number" id="machines" name="machines" min="0" step="1"
             value="<?= e($old['machines']) ?>" inputmode="numeric" required>
    </div>

    <fieldset class="field">
      <legend class="req">Work Status</legend>
      <div class="options">
        <?php foreach ($statuses as $s): ?>
          <label class="opt"><input type="radio" name="status" value="<?= e($s) ?>"
            <?= $old['status'] === $s ? 'checked' : '' ?> required> <?= e($s) ?></label>
        <?php endforeach; ?>
      </div>
    </fieldset>

    <div class="field">
      <label for="remarks">Remarks / Additional Details</label>
      <textarea id="remarks" name="remarks"><?= e($old['remarks']) ?></textarea>
    </div>

    <div class="actions">
      <button type="submit" class="btn primary">Submit</button>
      <a href="<?= e($_SERVER['PHP_SELF']) ?>"><button type="button" class="btn secondary">Clear form</button></a>
    </div>

    <p class="note">Never submit passwords through this form.</p>
  </form>
</div>

<script>
  // Show the "Reason (Optional)" box only when Half Day is selected
  var box = document.getElementById('halfDayBox');
  var reason = document.getElementById('halfReason');
  document.querySelectorAll('input[name="attendance"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
      var isHalf = this.value === 'Half Day';
      box.hidden = !isHalf;
      if (!isHalf) reason.value = '';
    });
  });
</script>
</body>
</html>