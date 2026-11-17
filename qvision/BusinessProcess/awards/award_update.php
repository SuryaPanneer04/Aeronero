<?php
require '../../../connect.php';

$id = $_POST['id'];
$date = $_POST['date'];
$award_name = $_POST['award_name'];
$category = $_POST['category'];
$applied_by = $_POST['applied_by'];
$deadline = $_POST['deadline'];
$result = $_POST['result'];

$sql = "UPDATE awards_master SET 
        date = :date, 
        award_name = :award_name, 
        category = :category, 
        applied_by = :applied_by, 
        deadline = :deadline, 
        result = :result 
        WHERE id = :id";

$stmt = $con->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':date', $date);
$stmt->bindParam(':award_name', $award_name);
$stmt->bindParam(':category', $category);
$stmt->bindParam(':applied_by', $applied_by);
$stmt->bindParam(':deadline', $deadline);
$stmt->bindParam(':result', $result);

if($stmt->execute()) {
    echo "Successfully updated";
} else {
    echo "Error updating record";
}
?>