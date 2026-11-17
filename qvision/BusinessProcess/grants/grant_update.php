<?php
require '../../../connect.php';

// Retrieve data from the AJAX POST request
$id = $_POST['id']; // The hidden ID field passed from the edit form
$date = $_POST['date'];
$grant_name = $_POST['grant_name'];
$project_applied = $_POST['project_applied'];
$applied_by = $_POST['applied_by'];
$amount = $_POST['amount'];
$deadline = $_POST['deadline'];
$result = $_POST['result'];
$status = $_POST['status'];

// Prepare the SQL UPDATE statement using PDO to prevent SQL injection
$sql = "UPDATE grants_master SET 
        date = :date, 
        grant_name = :grant_name, 
        project_applied = :project_applied, 
        applied_by = :applied_by, 
        amount = :amount, 
        deadline = :deadline, 
        result = :result, 
        status = :status 
        WHERE id = :id";

$stmt = $con->prepare($sql);

// Bind the parameters
$stmt->bindParam(':id', $id);
$stmt->bindParam(':date', $date);
$stmt->bindParam(':grant_name', $grant_name);
$stmt->bindParam(':project_applied', $project_applied);
$stmt->bindParam(':applied_by', $applied_by);
$stmt->bindParam(':amount', $amount);
$stmt->bindParam(':deadline', $deadline);
$stmt->bindParam(':result', $result);
$stmt->bindParam(':status', $status);

// Execute the query
if($stmt->execute()) {
    echo "Successfully updated";
} else {
    echo "Error updating record";
}
?>