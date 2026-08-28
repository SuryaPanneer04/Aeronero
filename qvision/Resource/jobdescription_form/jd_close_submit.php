<?php
require '../../../connect.php';
include("../../../user.php");
$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : 0;
$jid = isset($_REQUEST['jid']) ? $_REQUEST['jid'] : '';

$upd = false;
if ($con && $jid !== '') {
	$upd = $con->query("update jobdescription_form_details set status=3 where id='$jid'");
}

if ($upd) {
	echo 1;
} else {
	echo 0;
}
?>