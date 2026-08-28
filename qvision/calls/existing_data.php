<?php
require '../../connect.php';
include("../../user.php");


$id	    = $_REQUEST['id'];

	$stmt1 = $con->query("select a.id,a.org_name,a.website,b.client_id,b.it_name,b.location,b.state,b.city,b.it_mob1,b.it_mail1,it_mail2,b.address from new_client_master a left join new_plant_master b on (a.id=b.client_id)  where a.id = '$id' ");

	while ($row1 = $stmt1->fetch()) {
		$rows[] = $row1;
	}


echo json_encode($rows);
