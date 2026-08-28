<?php
require '../../config.php';

echo $id=$_REQUEST['get_id'];

$sql=$con->query("Update claim_request set status='5' where id='$id'");


?>