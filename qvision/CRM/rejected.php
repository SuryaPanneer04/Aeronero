<?php

require '../config.php';
require '../user.php';

$id = $_REQUEST['get_id'];


$status = 6;




//$sql2 = $con->query("Update enquiry set status='$status' where id='$id'");
$sql2= $con->query("Update crm_calls set status='$status' where id='$id'");
?>






