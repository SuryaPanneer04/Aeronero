<?php
require '../../../connect.php';

$pvmid = $_REQUEST['id'];
$edd = $_REQUEST['date'];

$updateEDD = $con -> query("update purchase_vendor_master set status= 5, edd='$edd' where id = '$pvmid' "); //status= 5 means EDD updated.

if($updateEDD){
	echo 1;
}
else{
	echo 0;
}
?>
