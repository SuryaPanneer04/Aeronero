<?php
require '../../connect.php';

$id = $_REQUEST['earnings_id'];
$earning_id = implode(',',$id); 

$earning_delete_sql = "DELETE FROM salary_monthly_earning WHERE id in ($earning_id)";
$earning_delete = $con->query($earning_delete_sql);

if ($earning_delete) {
	echo "<script>window.location.href='../../index.php';</script>";
}
?>