<?php
require '../../../connect.php';

$id = $_POST['id'];
$glasswares = $_POST['glasswares'];
$consumables = $_POST['consumables'];
$quantity = $_POST['quantity'];
$price = !empty($_POST['price']) ? $_POST['price'] : NULL;
$place = $_POST['place'];

$stmt = $con->prepare("UPDATE z_lab_assets_water SET glasswares=?, consumables=?, quantity=?, price=?, place=? WHERE id=?");
$res = $stmt->execute([$glasswares, $consumables, $quantity, $price, $place, $id]);

if($res) {
    echo "Asset Updated Successfully!";
} else {
    echo "Error: Failed to update.";
}
?>
