<?php
require '../../../connect.php';
include("../../../user.php");
$candidateid = $_SESSION['candidateid'];

    $asset_id=$_REQUEST['id'];
    $id=$_REQUEST['get_id'];
	$asset_name=$_REQUEST['asset_name'];
	$serial_number=$_REQUEST['serial_number'];
	$asset_name_count=count($asset_name);


    $upd = $con->query("UPDATE `staff_asset` SET  `modified_by`='$candidateid',`modified_on`=now() WHERE id='$asset_id'");

	for($i=0;$i<$asset_name_count;$i++)
	{
	$sid=$id[$i];
	$asset= $asset_name[$i];
	$serial= $serial_number[$i];

	$sql=$con->query("update staff_asset_serial_no set asset_name='$asset',serial_number='$serial' where id='$sid'");
}

if($sql){
	echo 1;
}
else{
	echo 0;
}
?>