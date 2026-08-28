<?php
require '../../../connect.php';
include("../../../user.php");
$Product = $_REQUEST["product"];

$sql = $con->query("SELECT * FROM `product_master` where name='$Product'");

$row = $sql->fetch(PDO::FETCH_ASSOC);
echo $row["hsn_code"];
?>