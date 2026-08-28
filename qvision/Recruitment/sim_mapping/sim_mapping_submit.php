<?php
require '../../../connect.php';
include("../../../user.php");

$userid = $_SESSION['userid'];

if (isset($_POST['submit'])) {

    $department = $_POST['department'];
    $sim_id     = $_POST['phone_no'];
    $status     = $_POST['status'];

    $sql = $con->query("
        INSERT INTO sim_mapping
        (sim_id, department_id, status, created_by, created_on)
        VALUES
        ('$sim_id', '$department', '$status', '$userid', NOW())
    ");

    if ($sql) {
        echo "<script>
                alert('Inserted Successfully');
                window.location.href = '../../../index.php';
              </script>";
        exit;
    } else {
        echo "Database Error: " . $con->error;
    }
}
?>