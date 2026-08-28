<?php
require '../../../connect.php';

$name=$_REQUEST['name'];
$status=$_REQUEST['status'];

$sql=$con->query("INSERT INTO `appraisal_rounds`(`name`,`status`) VALUES('$name','$status')");

/* echo "INSERT INTO `appraisal_rounds`(`name`,`status`) VALUES('$name','$status')"; */

?>
