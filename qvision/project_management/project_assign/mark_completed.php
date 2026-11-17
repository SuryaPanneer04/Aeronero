<?php
require '../../../connect.php';
session_start();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Update the acceptance status to Completed
    $stmt = $con->prepare("UPDATE y_project_employees SET acceptance_status = 'Completed' WHERE id = :id");
    
    if ($stmt->execute([':id' => $id])) {
        echo "Success";
    } else {
        echo "Database update failed";
    }
} else {
    echo "Invalid request";
}
?>
