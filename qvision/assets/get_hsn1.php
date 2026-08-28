<?php
require '../config.php';
include("../user.php");
$asset_name = $_REQUEST["id"];

$sqlzz=$con->query("SELECT * FROM `products_hsn` where product_id='$asset_name'");
$row11 = $sqlzz->fetch(PDO::FETCH_ASSOC);
 echo $row11["hsn_code"] ?? null;
?>


 