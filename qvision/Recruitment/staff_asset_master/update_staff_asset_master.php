<?php
require '../../../connect.php';

if (isset($_REQUEST['id']) && isset($_REQUEST['asset'])) {
    $id = $_REQUEST['id'];
    $asset = $_REQUEST['asset'];

    $stmt = $con->prepare("UPDATE staff_asset_master SET asset = :asset WHERE id = :id");
    $stmt->bindParam(':asset', $asset);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Updated Successfully";
    } else {
        echo "Update Failed";
    }
} else {
    echo "Missing parameters";
}
