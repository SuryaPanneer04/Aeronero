<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$candidateid=$_REQUEST['id'];
$ins=$con->query("update candidate_form_details set status='22' where id='$candidateid'");
echo "update candidate_form_details set status='22' where id='$candidateid'";

if($ins)
{
	echo "Query is updated";
}
else
{
	echo "Query is not updated";
}
?>