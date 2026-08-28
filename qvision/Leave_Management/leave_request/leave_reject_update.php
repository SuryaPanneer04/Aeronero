<?php
require '../../../connect.php';
Session_start();
 $id = $_REQUEST['status'];
 $leave_type= $_REQUEST['leave'];

	$user_id=$_SESSION['userid'];

	$sql=$con->query("Update leave_apply_masters set status=3, modified_on=NOW(), modified_by='$user_id'  where id='$id'");

?>






