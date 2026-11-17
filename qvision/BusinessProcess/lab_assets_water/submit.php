<?php
require '../../../connect.php';
session_start();

$created_by = isset($_SESSION['userid']) ? $_SESSION['userid'] : NULL;

$glasswares = $_POST['glasswares'];
$consumables = $_POST['consumables'];
$quantity = $_POST['quantity'];
$price = !empty($_POST['price']) ? $_POST['price'] : NULL;
$place = $_POST['place'];

$stmt = $con->prepare("INSERT INTO z_lab_assets_water (glasswares, consumables, quantity, price, place, created_by) VALUES (?, ?, ?, ?, ?, ?)");
$res = $stmt->execute([$glasswares, $consumables, $quantity, $price, $place, $created_by]);

if($res) {
    echo "Asset Added Successfully!";
} else {
    echo "Error: Failed to save.";
}
?>
