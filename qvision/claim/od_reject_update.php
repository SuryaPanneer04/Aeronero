<?php
require '../../config.php';

echo $id=$_REQUEST['get_id'];

$sql=$con->query("Update claim_request set status='3' where id='$id'");

?>