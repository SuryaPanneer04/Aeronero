<?php
require '../../../connect.php';
session_start();

$created_by = isset($_SESSION['userid']) ? $_SESSION['userid'] : NULL;

$equipments = $_POST['equipments'];
$place = $_POST['place'];
$price = !empty($_POST['price']) ? $_POST['price'] : NULL;
$quantity = $_POST['quantity'];

$upload_dir = 'uploads/';
$report_doc = '';
if(!empty($_FILES['report_doc']['name'])) {
    $report_doc = time() . "_" . basename($_FILES['report_doc']['name']);
    move_uploaded_file($_FILES['report_doc']['tmp_name'], $upload_dir . $report_doc);
}

$stmt = $con->prepare("INSERT INTO z_lab_assets_climate (equipments, place, price, quantity, report_doc, created_by) VALUES (?, ?, ?, ?, ?, ?)");
$res = $stmt->execute([$equipments, $place, $price, $quantity, $report_doc, $created_by]);

if($res) {
    echo "Asset Added Successfully!";
} else {
    echo "Error: Failed to save.";
}
?>
