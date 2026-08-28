<?php
require '../../connect.php';
require '../../user.php';

$id=$_REQUEST['id'];


$status=20;




$sql2= $con->query("Update enquiry set status='$status' where id='$id'");
	echo "Update enquiry set status='$status' where id='$id'";


 





?>






