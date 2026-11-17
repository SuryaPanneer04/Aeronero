<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
require('../connect.php');

// Check database connection
if (!$con) {
    echo json_encode(["Database connection failed."]);
    exit;
}

$ip = $_SERVER['REMOTE_ADDR'];

$username = $_POST['username'] ?? $_GET['username'] ?? '';
$password = $_POST['password'] ?? $_GET['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Username '  . $username . $password . ' or password is empty'

    ]);
    exit;
}

$md5password = md5($password);

$res = $con->query("SELECT *
    FROM z_user_master zum
LEFT JOIN z_department_master zdm ON zdm.id = zum.department
where user_name='$username' and zum.status=1");

$num_of_rows = $res->rowCount();

if ($num_of_rows > 0) {
    $row = $res->fetch(PDO::FETCH_ASSOC);

    $dbPassword  = $row['password'];

    if ($dbPassword  == $md5password) {
        unset($row['password']);
        echo json_encode([
            'status' => 'success',
            'data' => $row
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'missmatch password' . $username . $password . "dd"
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'username error'
    ]);
}
