<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require('../../../connect.php');

if (!isset($_SESSION['username'])) {
    echo "Session expired. Please login again.";
    exit;
}

$admin_username = $_SESSION['username'];
$emp_code = $_POST['employee'] ?? '';
$new_password = $_POST['new_password'] ?? '';

if(empty($emp_code) || empty($new_password)) {
    echo "Employee or New Password missing.";
    exit;
}

$stmt = $con->prepare("SELECT password FROM z_user_master WHERE user_name = :emp_code AND status = 1");
$stmt->execute(['emp_code' => $emp_code]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $current_password = $row['password'];
    // Guess format based on length
    if(strlen($current_password) === 32 && ctype_xdigit($current_password)) {
        $format = 'md5';
    } else {
        $format = 'plain';
    }

    $new_pw_to_store = ($format === 'md5') ? md5($new_password) : $new_password;

    $update = $con->prepare("UPDATE z_user_master SET password = :newpw WHERE user_name = :emp_code");
    if ($update->execute(['newpw' => $new_pw_to_store, 'emp_code' => $emp_code])) {
        
        $insert = $con->prepare("INSERT INTO change_password 
                                (user_name, old_password, new_password, status, created_on, modified_on, created_by, modified_by) 
                                VALUES (:uname, :oldpw, :newpw, 1, NOW(), NOW(), :cby, :mby)");
        $insert->execute([
            'uname' => $emp_code,
            'oldpw' => 'ADMIN_RESET',
            'newpw' => $new_password,
            'cby' => $admin_username,
            'mby' => $admin_username
        ]);
        
        echo "success";
    } else {
        echo "Failed to update password. Database error.";
    }
} else {
    echo "Employee user not found or inactive.";
}
?>
