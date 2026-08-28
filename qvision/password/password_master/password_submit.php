<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require('../../../connect.php'); // Adjust path based on location: qvision/password/password_master/ -> bbvision/connect.php

if (!isset($_SESSION['username'])) {
    echo "Session expired. Please login again.";
    exit;
}

$username = $_SESSION['username'];
$userid = $_SESSION['userid'];

$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];

$md5_old = md5($old_password);
$md5_new = md5($new_password);

$stmt = $con->prepare("SELECT password FROM z_user_master WHERE user_id = :uid AND status = 1");
$stmt->execute(['uid' => $userid]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    // Check if the current password is stored as MD5 or plain text
    if ($row['password'] === $md5_old) {
        $format = 'md5';
    } elseif ($row['password'] === $old_password) {
        $format = 'plain';
    } else {
        echo "Old password is incorrect.";
        exit;
    }

    // Keep the same format as it currently is in the database
    $new_pw_to_store = ($format === 'md5') ? $md5_new : $new_password;

    $update = $con->prepare("UPDATE z_user_master SET password = :newpw WHERE user_id = :uid");
    if ($update->execute(['newpw' => $new_pw_to_store, 'uid' => $userid])) {
        
        // Insert log into change_password table. 
        // Omit user_id because it is set as AUTO_INCREMENT PRIMARY KEY in the schema, 
        // inserting the actual userid causes duplicate key error on the second attempt.
        // Also storing the actual entered password format as requested.
        $insert = $con->prepare("INSERT INTO change_password 
                                (user_name, old_password, new_password, status, created_on, modified_on, created_by, modified_by) 
                                VALUES (:uname, :oldpw, :newpw, 1, NOW(), NOW(), :cby, :mby)");
        $insert->execute([
            'uname' => $username,
            'oldpw' => $old_password,
            'newpw' => $new_password,
            'cby' => $username,
            'mby' => $username
        ]);
        
        echo "success";
    } else {
        echo "Failed to update password. Database error.";
    }
} else {
    echo "User not found or inactive.";
}
?>
