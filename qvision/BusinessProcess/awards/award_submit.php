<?php
require '../../../connect.php';

$date = $_POST['date'];
$award_name = $_POST['award_name'];
$category = $_POST['category'];
$applied_by = $_POST['applied_by'];
$deadline = $_POST['deadline'];
$result = $_POST['result'];

$sql = "INSERT INTO awards_master (date, award_name, category, applied_by, deadline, result) 
        VALUES (:date, :award_name, :category, :applied_by, :deadline, :result)";

$stmt = $con->prepare($sql);
$stmt->bindParam(':date', $date);
$stmt->bindParam(':award_name', $award_name);
$stmt->bindParam(':category', $category);
$stmt->bindParam(':applied_by', $applied_by);
$stmt->bindParam(':deadline', $deadline);
$stmt->bindParam(':result', $result);

if($stmt->execute()) {
    echo "Successfully inserted";
} else {
    echo "Error inserting record";
}
?>