<?php
session_start();
require('connect.php');
date_default_timezone_set('Asia/Kolkata');
 
/* ---------- 1. DATABASE SETTINGS (change these) ---------- */
// $DB_HOST = 'localhost';
// $DB_NAME = 'work_records';
// $DB_USER = 'root';
// $DB_PASS = '';
$SHOW_ERROR_DETAILS = false;   // set to true while testing to see the real error on the page
 
/* ---------- 2. ALLOWED VALUES ---------- */
// $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
$today = date('Y-m-d');
 
$errors = [];
$old = [
    'email' => '', 'name' => '', 'empId' => '', 'department' => '', 'designation' => '',
    'mobile' => '', 'emg_mobile' =>'', 'blood' => '', 'address' => '', 'joining' => ''
];
 
function e($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function validDate($d) {
    $x = DateTime::createFromFormat('Y-m-d', $d);
    return $x && $x->format('Y-m-d') === $d;
}
 
/* ---------- 3. HANDLE SUBMIT ---------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    foreach (['email', 'name', 'empId', 'department', 'designation', 'mobile','emg_mobile', 'address', 'joining'] as $k) {
        $old[$k] = trim($_POST[$k] ?? '');
    }
    $old['blood'] = $_POST['blood'] ?? '';
    $mobileDigits = preg_replace('/[\s-]+/', '', $old['mobile']);
    $emg_mobile = preg_replace('/[\s-]+/', '', $old['emg_mobile']);
 
    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL) || mb_strlen($old['email']) > 150)
        $errors[] = 'Enter a valid email address.';
    if ($old['name'] === '' || mb_strlen($old['name']) > 100)
        $errors[] = 'Enter the employee name.';
    if (!preg_match('/^[A-Za-z0-9_\/-]{1,30}$/', $old['empId']))
        $errors[] = 'Enter a valid Employee ID (letters, numbers, - or _ only).';
    if ($old['department'] === '' || mb_strlen($old['department']) > 100)
        $errors[] = 'Enter the department.';
    if ($old['designation'] === '' || mb_strlen($old['designation']) > 100)
        $errors[] = 'Enter the designation.';
    if (!preg_match('/^[6-9][0-9]{9}$/', $mobileDigits))
        $errors[] = 'Enter a valid 10-digit mobile number.';
    // if (!in_array($old['blood'], $bloodGroups, true))
    //     $errors[] = 'Choose a blood group.';
    if ($old['address'] === '' || mb_strlen($old['address']) > 500)
        $errors[] = 'Enter the address (up to 500 characters).';
    if (!validDate($old['joining']) || $old['joining'] > $today)
        $errors[] = 'Enter a valid Date of Joining (not in the future).';
 
    if (!$errors) {
        try {
            // $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
            //     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            // ]);
            $stmt = $con->prepare(
                'INSERT INTO employee_contact_details
                 (email, employee_name, employee_id, department, designation, mobile_number,emg_mobile, blood_group, address, date_of_joining)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
            );
            $stmt->execute([
                $old['email'], $old['name'], $old['empId'], $old['department'], $old['designation'],
                $mobileDigits ,$emg_mobile, $old['blood'], $old['address'], $old['joining']
            ]);
 
            $_SESSION['success'] = 'Your details have been recorded.';
            header('Location: ' . $_SERVER['PHP_SELF']);   // stops double-submit on refresh
            exit;
        } catch (PDOException $ex) {
            if ($ex->getCode() === '23000') {              // duplicate Employee ID
                $errors[] = 'This Employee ID has already been submitted.';
            } else {
                error_log($ex->getMessage());
                $errors[] = 'Could not save your details. Please try again.';
                if ($SHOW_ERROR_DETAILS) { $errors[] = 'Error details: ' . $ex->getMessage(); }
            }
        }
    }
}
 
$success = $_SESSION['success'] ?? '';
unset($_SESSION['success']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Employee Contact Details</title>
<style>
  :root {
    --brand: #009EE3;    /* Aeronero blue */
    --dark: #343434;     /* Primary Dark */
    --bg: #f3f1f4; --card: #ffffff; --ink: var(--dark); --muted: #6b6670;
    --line: #d6d1d9; --accent: var(--brand); --accent-dark: var(--dark);
    --error: #b3261e;
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
  .req::after { content: " *"; color: var(--brand); font-weight: 700; }
  .hint { font-weight: 400; color: var(--muted); font-size: .9rem; }
  input[type="text"], input[type="email"], input[type="tel"], input[type="date"], select, textarea {
    width: 100%; padding: 10px 12px; font: inherit; color: var(--ink);
    background: #fff; border: 1px solid var(--line); border-radius: 6px; }
  input:required, select:required, textarea:required { border-color: var(--brand); }
  textarea { min-height: 100px; resize: vertical; }
  input:focus, select:focus, textarea:focus {
    outline: 3px solid rgba(0, 158, 227, .35); border-color: var(--accent); }
  .actions { display: flex; gap: 12px; margin-top: 30px; flex-wrap: wrap; }
  .btn { font: inherit; font-weight: 600; padding: 11px 26px; border-radius: 6px; cursor: pointer; }
  .primary { background: var(--accent); color: #fff; border: 1px solid var(--accent); }
  .primary:hover { background: var(--accent-dark); border-color: var(--accent-dark); }
  .secondary { background: #fff; color: var(--accent); border: 1px solid var(--line); }
  .secondary:hover { background: var(--bg); }
  .msg { margin-top: 18px; padding: 12px 14px; border-radius: 6px; }
  .msg.ok { background: #e3f3e8; color: #17572b; }
  .msg.err { background: #fbe7e5; color: var(--error); }
  .msg.err ul { margin: 0; padding-left: 18px; }
  .note { margin-top: 20px; color: var(--muted); font-size: .85rem; }
</style>
</head>
<body>
<div class="wrap">
  <div class="logo-bar">
    <img src="images/logo123.jpg" alt="Aeronero">
  </div>
  <header>
    <h1>Employee Contact Details</h1>
    <p>Please fill in your details and submit.</p>
  </header>
 
  <form method="post" action="<?= e($_SERVER['PHP_SELF']) ?>" id="contactForm">
 
    <?php if ($success): ?>
      <div class="msg ok" role="status"><?= e($success) ?></div>
    <?php endif; ?>
 
    <?php if ($errors): ?>
      <div class="msg err" role="alert">
        <ul><?php foreach ($errors as $err): ?><li><?= e($err) ?></li><?php endforeach; ?></ul>
      </div>
    <?php endif; ?>
 
    <div class="field">
      <label class="req" for="email">Email</label>
      <input type="email" id="email" name="email" value="<?= e($old['email']) ?>"
             autocomplete="email" placeholder="you@example.com" maxlength="150" required>
    </div>
 
    <div class="field">
      <label class="req" for="name">Employee Name</label>
      <input type="text" id="name" name="name" value="<?= e($old['name']) ?>"
             autocomplete="name" placeholder="Type your full name" maxlength="100" required>
    </div>
 
    <div class="field">
      <label class="req" for="empId">Employee ID</label>
      <input type="text" id="empId" name="empId" value="<?= e($old['empId']) ?>"
             placeholder="Your employee ID" maxlength="30" required>
    </div>
 
    <div class="field">
      <label class="req" for="department">Department</label>
      <input type="text" id="department" name="department" value="<?= e($old['department']) ?>"
             placeholder="Your department" maxlength="100" required>
    </div>
 
    <div class="field">
      <label class="req" for="designation">Designation</label>
      <input type="text" id="designation" name="designation" value="<?= e($old['designation']) ?>"
             placeholder="Your designation" maxlength="100" required>
    </div>
 
    <div class="field">
      <label class="req" for="mobile">Mobile Number <span class="hint">(10 digits)</span></label>
      <input type="tel" id="mobile" name="mobile" value="<?= e($old['mobile']) ?>"
             inputmode="numeric" autocomplete="tel" placeholder="Mobile number" maxlength="12"
             pattern="[6-9][0-9]{9}" title="Enter a 10-digit mobile number" required>
    </div>

    <div class="field">
      <label class="req" for="emg_mobile">Emergency Number <span class="hint">(10 digits)</span></label>
      <input type="tel" id="emg_mobile" name="emg_mobile" value="<?= e($old['emg_mobile']) ?>"
             inputmode="numeric" autocomplete="tel" placeholder="Emgergency contact no" maxlength="12"
             pattern="[6-9][0-9]{9}" title="Enter a 10-digit mobile number" required>
    </div>
 
    <!-- <div class="field">
      <label class="req" for="blood">Blood group</label>
      <select id="blood" name="blood" required>
        <option value="">Choose</option>
        <?php foreach ($bloodGroups as $b): ?>
          <option <?= $old['blood'] === $b ? 'selected' : '' ?>><?= e($b) ?></option>
        <?php endforeach; ?>
      </select>
    </div> -->
    <div class="field">
      <label class="req" for="blood">Blood group</label>
      <input type="text" id="blood" name="blood" value="<?= e($old['blood']) ?>"
             placeholder="Your blood group" maxlength="100" required>    
    </div>
 
    <div class="field">
      <label class="req" for="address">Address</label>
      <textarea id="address" name="address" maxlength="500" required><?= e($old['address']) ?></textarea>
    </div>
 
    <div class="field">
      <label class="req" for="joining">Date of Joining</label>
      <input type="date" id="joining" name="joining" value="<?= e($old['joining']) ?>"
             max="<?= e($today) ?>" required>
    </div>
 
    <div class="actions">
      <button type="submit" class="btn primary">Submit</button>
      <a href="<?= e($_SERVER['PHP_SELF']) ?>"><button type="button" class="btn secondary">Clear form</button></a>
    </div>
 
    <p class="note">Aeronero</p>
  </form>
</div>
</body>
</html>