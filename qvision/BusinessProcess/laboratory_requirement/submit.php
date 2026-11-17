<?php
require '../../../connect.php';
session_start();

$created_by = isset($_SESSION['userid']) ? $_SESSION['userid'] : NULL;
$stock_type = $_POST['stock_type'];
$items = $_POST['items'];
$quantity = $_POST['quantity'];
$price = isset($_POST['price']) && $_POST['price'] !== '' ? $_POST['price'] : NULL;
$date_of_request = !empty($_POST['date_of_request']) ? $_POST['date_of_request'] : NULL;

$stmt = $con->prepare("INSERT INTO z_laboratory_requirements (stock_type, items, quantity, price, date_of_request, created_by) VALUES (?, ?, ?, ?, ?, ?)");
$res = $stmt->execute([
    $stock_type, 
    $items, 
    $quantity, 
    $price,
    $date_of_request,
    $created_by
]);

if($res) {
    echo "Request Raised Successfully!";
} else {
    echo "Error: Failed to save.";
}
?>
