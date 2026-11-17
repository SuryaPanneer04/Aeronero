<?php
require '../../../connect.php';
session_start();

$id = $_POST['id'];
$stock_type = $_POST['stock_type'];
$items = $_POST['items'];
$quantity = $_POST['quantity'];
$price = isset($_POST['price']) && $_POST['price'] !== '' ? $_POST['price'] : NULL;
$date_of_request = $_POST['date_of_request'];

$stmt = $con->prepare("UPDATE z_laboratory_requirements SET stock_type=?, items=?, quantity=?, price=?, date_of_request=? WHERE id=?");
$result = $stmt->execute([ $stock_type, $items, $quantity, $price, $date_of_request, $id ]);

if($result) {
    // Also sync updated price/quantity/item to connected Lab Assets if already synced
    if ($stock_type == 'Equipments') {
        $con->prepare("UPDATE z_lab_assets_climate SET equipments=?, quantity=?, price=? WHERE req_id=?")->execute([$items, $quantity, $price, $id]);
    } elseif ($stock_type == 'Glasswares and Consumables') {
        $con->prepare("UPDATE z_lab_assets_water SET glasswares=?, quantity=?, price=? WHERE req_id=?")->execute([$items, $quantity, $price, $id]);
    }
    echo "Successfully Updated!";
} else {
    echo "Error: Failed to update.";
}
?>
