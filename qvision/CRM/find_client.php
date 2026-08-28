<?php
require '../../connect.php';
include("../../user.php");
$location = $_REQUEST["location"];
$company = $_REQUEST["company_name"];

$sql=$con->query("select a.id as existing_id,a.department_id,a.employee_id,a.org_name,a.status,a.flow,
b.area,b.address,b.pincode,b.client_department,b.it_name,b.it_designation,b.it_mob1,b.it_mob2,b.it_mail1,b.it_mail2,b.it_landno,b.location,b.client_org_name,c.dept_name,c.id,d.first_name,d.id from new_client_master a left join new_plant_master b on (a.id=b.client_id) left join z_department_master c ON (a.department_id=c.id) left join candidate_form_details d ON (a.employee_id = d.id) where b.location='$location' and b.client_org_name='$company'");

/*  echo "select a.id as existing_id,a.department_id,a.employee_id,a.org_name,a.status,a.flow,
b.area,b.address,b.pincode,b.client_department,b.it_name,b.it_designation,b.it_mob1,b.it_mob2,b.it_mail1,b.it_mail2,b.it_landno,b.location,b.client_org_name,c.dept_name,c.id,d.first_name,d.id from new_client_master a left join new_plant_master b on (a.id=b.client_id) left join z_department_master c ON (a.department_id=c.id) left join candidate_form_details d ON (a.employee_id = d.id) where b.location='$location' and b.client_org_name='$company' and a.status=2 and a.flow=2"; */

$row = $sql->fetch(PDO::FETCH_ASSOC);
	
$client_id=$row['existing_id'];
$address=$row['address'];
$area=$row['area'];
$pincode=$row['pincode'];
$department_name=$row['dept_name'];
$employee_name=$row['first_name'];
$department_id=$row['department_id'];
$employee_id=$row['employee_id'];
echo $address."=".$area."=".$pincode."=".$department_name."=".$employee_name."=".$department_id."=".$employee_id."=".$client_id;
?>