<?php 
require '../../../connect.php';

 $id=$_REQUEST['id'];
 $reject_reason=$_REQUEST['reject'];
 $now=date("Y-m-d");
 
$statement = $con->prepare('update leave_details set status=3,reject_reason=:reject_reason,modified_on=:now where id=:id');
$statement->execute([
    'reject_reason' => $reject_reason,
    'now' => $now,
    'id' => $id,
]);

if($statement)
{
	echo 1;
}
else
{
	echo 0;
}
?>
