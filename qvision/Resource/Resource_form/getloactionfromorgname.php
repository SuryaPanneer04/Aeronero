<?php 
require '../../../connect.php';

$jdnameid=$_REQUEST['id'];
$postappid=$_REQUEST['postappid'];
$getclientlocationnme=$con->query("SELECT * FROM `jobdescription_form_details` WHERE jobdescription_id='$postappid' and client_org_name='$jdnameid'");

while($location=$getclientlocationnme->fetch(PDO::FETCH_ASSOC))
{ 
   
     //echo $clientnamelocation=$location['client_org_name']."||".$location['location']."##";
     echo $clientnamelocation=$location['location']."||";
}
?>