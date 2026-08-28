<?php
require '../config.php';
require '../user.php';

 $idee=$_REQUEST['idee'];


$status=2;

	$sql2= $con->query("Update new_client_master set status='$status',flow='2' where id='$idee'");

?>






