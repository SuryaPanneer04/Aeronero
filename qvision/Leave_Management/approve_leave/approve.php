<?php 
require '../../../connect.php';
 $id=$_REQUEST['ids'];
 $now=date("Y-m-d");
 
$statement = $con->prepare('update leave_details set status=2,modified_on=:now  where id=:id');
$statement->execute([
    'id' => $id,
	'now' => $now,
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
