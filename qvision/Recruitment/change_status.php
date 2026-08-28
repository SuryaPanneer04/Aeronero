<?php
require '../../connect.php';
require '../../user.php';

$id = $_REQUEST['id'];


$status = 2;




$sql2 = $con->query("Update vms set status='$status' where id='$id'");
//echo "Update enquiry set status='$status' where id='$id'";

if ($sql2) {
	echo 0;
} else {
	echo 1;
}
