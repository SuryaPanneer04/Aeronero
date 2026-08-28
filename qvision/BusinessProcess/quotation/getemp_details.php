<?php
require '../../../connect.php';
include("../../../user.php");


$staff_id	=$_REQUEST["id"];
 $stmt = $con->query("select a.*,b.*,c.* from staff_master a inner join designation_master b on (b.id = a.design_id) inner join z_user_master c on (c.candidate_id=a.id) where a.id = '$staff_id' ");

	while ($row = $stmt->fetch()) {
			$rows[] = $row;
		}

echo json_encode($rows); 




?> 

