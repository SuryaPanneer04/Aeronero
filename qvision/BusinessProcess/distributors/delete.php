<?php
require '../../../connect.php';
session_start();

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if (empty($id)) {
    echo "Invalid request!";
    exit;
}

try {
    $stmt = $con->prepare("DELETE FROM z_distributors WHERE id = ?");
    $res = $stmt->execute([$id]);

    if ($res) {
        echo "Distributor Deleted Successfully!";
    } else {
        echo "Error: Failed to delete distributor.";
    }
} catch (Exception $e) {
    echo "Database Error: " . $e->getMessage();
}
?>
