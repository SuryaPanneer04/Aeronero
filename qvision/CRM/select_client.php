<?php
require '../config.php';
include("../user.php");
$client_department = $_REQUEST["client"];
$location = $_REQUEST["location"];
$Company_name = $_REQUEST["Company_name"];

if($client_department==1)
{
$sql=$con->query("select a.id as existing_id,a.department_id,a.employee_id,a.org_name,
b.area,b.address,b.pincode,b.client_department,b.it_name,b.it_designation,b.it_mob1,b.it_mob2,b.it_mail1,b.it_mail2,b.it_landno,b.location,b.	client_org_name,c.dept_name,c.id,d.first_name,d.id from new_client_master a left join new_plant_master b on (a.id=b.client_id) left join z_department_master c ON (a.department_id=c.id) left join candidate_form_details d ON (a.employee_id = d.id) where b.location='$location' and b.client_org_name='$Company_name'");


 $row = $sql->fetch(PDO::FETCH_ASSOC);
	
$value="1";
$client_name=$row['it_name'];
$client_designation=$row['it_designation'];
$client_mob1=$row['it_mob1'];
$client_mob2=$row['it_mob2'];
$client_mail1=$row['it_mail1'];
$client_mail2=$row['it_mail2'];
$client_land=$row['it_landno'];

echo $client_name."=".$client_designation."=".$client_mob1."=".$client_mob2."=".$client_mail1."=".$client_mail2."=".$client_land."=".$value;

}elseif($client_department==2)
{
$sql=$con->query("select a.id as existing_id,a.department_id,a.employee_id,a.org_name,
b.area,b.address,b.pincode,b.client_department,b.pur_name,b.pur_designation,b.pur_mail,b.pur_contact,b.location,b.	client_org_name,c.dept_name,c.id,d.first_name,d.id from new_client_master a left join new_plant_master b on (a.id=b.client_id) left join z_department_master c ON (a.department_id=c.id) left join candidate_form_details d ON (a.employee_id = d.id) where b.location='$location' and b.client_org_name='$Company_name'");	 

 $row = $sql->fetch(PDO::FETCH_ASSOC);
	
$client_name=$row['pur_name'];
$client_designation=$row['pur_designation'];
$client_mob1=$row['pur_contact'];
$client_mail1=$row['pur_mail'];
$value="2";
echo $client_name."=".$client_designation."=".$client_mob1."=".$client_mail1."=".$value;

}elseif($client_department==3)
{
$sql=$con->query("select a.id as existing_id,a.department_id,a.employee_id,a.org_name,
b.area,b.address,b.pincode,b.client_department,b.fin_name,b.fin_designation,b.fin_mail,b.fin_contact,b.location,b.client_org_name,c.dept_name,c.id,d.first_name,d.id from new_client_master a left join new_plant_master b on (a.id=b.client_id) left join z_department_master c ON (a.department_id=c.id) left join candidate_form_details d ON (a.employee_id = d.id) where b.location='$location'and b.client_org_name='$Company_name'");


 $row = $sql->fetch(PDO::FETCH_ASSOC);
	
$client_name=$row['fin_name'];
$client_designation=$row['fin_designation'];
$client_mob1=$row['fin_contact'];
$client_mail1=$row['fin_mail'];
$value="3";
echo $client_name."=".$client_designation."=".$client_mob1."=".$client_mail1."=".$value;	
}elseif($client_department==4)
{
	$sql=$con->query("select a.id as existing_id,a.department_id,a.employee_id,a.org_name,
b.area,b.address,b.pincode,b.client_department,b.it_name,b.it_designation,b.it_mob1,b.it_mob2,b.it_mail1,b.it_mail2,b.it_landno,c.dept_name,c.id,d.first_name,d.id from new_client_master a left join new_plant_master b on (a.id=b.client_id) left join z_department_master c ON (a.department_id=c.id) left join candidate_form_details d ON (a.employee_id = d.id) where b.location='$location'");
}


?>