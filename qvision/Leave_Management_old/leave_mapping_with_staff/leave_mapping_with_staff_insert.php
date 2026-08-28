<?php
require '../../connect.php';

$staffid=$_REQUEST['staff_type_id'];
$stafftype=$_REQUEST['staff_type'];
$leaveid=$_REQUEST['leave_type_id'];
$leavetype=$_REQUEST['leave_type'];


$sql=$con->query("insert into leave_mapping_with_staff(staff_type_id,staff_type,leave_type_id , leave_type,status) values('$staffid','$stafftype','$leaveid','$leavetype','1')");

 echo "insert into leave_mapping_with_staff(staff_type_id,staff_type,leave_type_id , leave_type,status) values('$staffid','$stafftype','$leaveid','$leavetype','1')";

?>