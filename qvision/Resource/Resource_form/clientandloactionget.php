<?php
require '../../../connect.php';

$jdnameid = $_REQUEST['id'];

$getclientlocationnme = $con->query("SELECT DISTINCT client_org_name FROM `jobdescription_form_details` WHERE jobdescription_id='$jdnameid'");

while ($location = $getclientlocationnme->fetch(PDO::FETCH_ASSOC)) {
    echo $clientnamelocation = $location['client_org_name'] . "||";
}
?>
