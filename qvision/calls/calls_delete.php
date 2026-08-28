<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$candidateid=$_SESSION['candidateid'];
$id=$_REQUEST['id'];





 $sql11=$con->query("UPDATE `crm_calls` SET status='0' WHERE id='$id'"); 

// echo "DELETE FROM crm_calls WHERE id='$id'";


$sql12=$con->query("UPDATE crm_calls_feedback SET status='0' WHERE calls_id='$id'");
// echo "DELETE FROM crm_calls_feedback WHERE calls_id='$id'";





?>