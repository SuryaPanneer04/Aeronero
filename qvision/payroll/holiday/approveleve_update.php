<?php
require '../../../connect.php';

 $id = $_REQUEST['id'];
 //$year = $_REQUEST['year'];
 //$date = $_REQUEST['date'];
 //$holiday_name = $_REQUEST['holiday_name'];


$sql = $con->query("Update `holiday_master` set `md_approve_sts`=1  where `id`='$id' and `status`=1");
//echo "Update `holiday_master` set `year`='$year',`leave_date`='$date',`leave_name`='$holiday_name',`md_approve_sts`=1  where `id`='$id' and `status`=1";
?>