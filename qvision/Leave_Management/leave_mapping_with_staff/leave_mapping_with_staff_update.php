<?php
//require '../../user.php';
require '../../config.php';

$id=$_REQUEST['id'];
$staffid=$_REQUEST['staff_type_id'];
$staff_type=$_REQUEST['staff_type'];
$leaveid=$_REQUEST['leave_type_id'];
$leave_type=$_REQUEST['leave_type'];

if($_REQUEST['status']==1)
{
	$status = 1;
}
else
{
	$status = 2;
}



 $sql=$con->query("Update leave_mapping_with_staff set staff_type_id='$staffid', staff_type='$staff_type', leave_type_id='$leaveid', leave_type='$leave_type',status='$status'  where id='$id'");
 
 echo "Update leave_mapping_with_staff set staff_type_id='$staffid', staff_type='$staff_type', leave_type_id='$leaveid', leave_type='$leave_type',status='$status'  where id='$id'";
?>