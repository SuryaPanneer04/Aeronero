<?php
require ('../../connect.php');
include("../../user.php");
$state = $_REQUEST["city_id"];
$state_id = $_REQUEST["states_id"];
$company= $_REQUEST["company"];


$stmt1 = $con->query("SELECT a.id,a.org_name,b.client_id,b.gst_no,b.state FROM  new_client_master a left join new_plant_master b on (a.id=b.client_id) where 
b.state ='$state_id' and a.org_name='$company'"); 
/* echo "SELECT a.id,a.org_name,b.client_id,b.gst_no,b.state FROM  new_client_master a left join new_plant_master b on (a.id=b.client_id) where 
b.state ='$state_id' and a.org_name='$company'"; */


$row2[] = $stmt1->fetch(PDO::FETCH_ASSOC);



echo json_encode($row2);

?>



