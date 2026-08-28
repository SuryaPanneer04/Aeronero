<?php
require '../../connect.php';
include("../../user.php");
$asset_name = $_REQUEST["id"];


$sqlzz=$con->query("SELECT * FROM `product_master` where id='$asset_name'");
$row11 = $sqlzz->fetch(PDO::FETCH_ASSOC);
if($row11)
echo $row11["gst_code"] ?? null;
else
	echo NULL;
?>

       
