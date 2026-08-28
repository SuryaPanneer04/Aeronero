<?php
require '../../../connect.php';
include("../../../user.php");


$pan_no	    = $_REQUEST['pan_no'];

	$stmt1 = $con->query("select pan_number from new_client_master where pan_number = '$pan_no'");

	$stmt1->execute(); 
	 $rowx        = $stmt1->fetch();
	echo $row   = $stmt1->rowCount();
?>