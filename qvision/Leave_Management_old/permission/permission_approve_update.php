<?php
Session_start();
require '../../../connect.php';

$userrole = $_SESSION['userrole'];

$status=$_REQUEST['status'];
$leave=$_REQUEST['leave'];
$candid_id=$_REQUEST['candid_id'];

$upd=$con->query("UPDATE `permission_apply` SET status='2' where candid_id='$candid_id'");
if($upd)
{
	echo 0;
}
else
{
	echo 1;
}
?>