<?php
require '../../../connect.php';
 $remark = $_REQUEST['remark'];

$stmt = $con->prepare("SELECT MAX(id) as lastid FROM daily_attendence LIMIT 1");
    $stmt->execute(); 
	$row = $stmt->fetch();
	$last_id=$row['lastid'];
    
	$insert= $con->query("update  daily_attendence set remark='$remark' where id='$last_id'");
	echo "update  daily_attendence set remark='$remark' where id='$last_id'"; 
?>

