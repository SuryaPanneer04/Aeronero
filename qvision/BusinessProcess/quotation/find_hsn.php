<?php
require '../../../connect.php';
include("../../../user.php");
$Product = $_REQUEST["product"];
$exp = explode('-', $Product);
$name = $exp[0];
$id = implode('-', array_slice($exp, 1));

if (!empty($id)) {
    $sql = $con->prepare("SELECT * FROM `product_master` where name=:name AND id=:id");
    $sql->execute([':name' => $name, ':id' => $id]);
} else {
    $sql = $con->prepare("SELECT * FROM `product_master` where name=:name LIMIT 1");
    $sql->execute([':name' => $name]);
}

$row = $sql->fetch(PDO::FETCH_ASSOC);
echo $row["hsn_code"];
?>