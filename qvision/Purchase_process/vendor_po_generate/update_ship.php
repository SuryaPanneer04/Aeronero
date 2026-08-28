<?php
require '../../../connect.php';

$pvmid = $_REQUEST['pvmid'];
$costsheetno = $_REQUEST['costsheetno'];
$so_num = $_REQUEST['so_num'];
$ship_to = $_REQUEST['ship_to'];
$terms = $_REQUEST['terms'];
$other_reference = $_REQUEST['other_reference'];
$term_delivery = $_REQUEST['term_delivery'];

if($ship_to == 2){
$plant_id = $_REQUEST['plant_id'];
}
else{
	$plant_id = null;
}

$insertshipto = $con -> query("INSERT INTO `ship_terms`(`pvm_id`, `cost_sheet_no`, `so_number`, `ship_to`, `plant_id`, `terms`, `other_reference`, `term_delivery`) VALUES ('$pvmid','$costsheetno','$so_num','$ship_to','$plant_id','$terms','$other_reference','$term_delivery')");

$updatePVM = $con -> query("UPDATE `purchase_vendor_master` SET `status`='6' WHERE id='$pvmid'");

if($insertshipto && $updatePVM){
	echo 1;
}
else{
	echo 0;
}
