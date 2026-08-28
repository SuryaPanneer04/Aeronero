<?php 

require '../../config.php';
$uploadDir = 'Uploads/';
if(isset($_POST['payment']) )
{
$cash = $_REQUEST['cash'];
$online = $_REQUEST['online'];
 $id = $_REQUEST['get_id'];
 
 $sql=$con->query("Update claim_request set cash='$cash',online='$online',status='3' where id='$id'");
 echo "Update claim_request set cash='$cash',online='$online',status='3' where id='$id'";
}
 ?>