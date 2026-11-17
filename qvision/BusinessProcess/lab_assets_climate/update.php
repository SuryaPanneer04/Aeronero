<?php
require '../../../connect.php';

$id = $_POST['id'];
$equipments = $_POST['equipments'];
$place = $_POST['place'];
$price = !empty($_POST['price']) ? $_POST['price'] : NULL;
$quantity = $_POST['quantity'];

$upload_dir = 'uploads/';
$report_doc = isset($_POST['old_report_doc']) ? $_POST['old_report_doc'] : '';
if(!empty($_FILES['report_doc']['name'])) {
    $report_doc = time() . "_" . basename($_FILES['report_doc']['name']);
    move_uploaded_file($_FILES['report_doc']['tmp_name'], $upload_dir . $report_doc);
}

$stmt = $con->prepare("UPDATE z_lab_assets_climate SET equipments=?, place=?, price=?, quantity=?, report_doc=? WHERE id=?");
$res = $stmt->execute([$equipments, $place, $price, $quantity, $report_doc, $id]);

if($res) {
    echo "Asset Updated Successfully!";
} else {
    echo "Error: Failed to update.";
}
?>
