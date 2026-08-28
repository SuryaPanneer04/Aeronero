<?php
require '../../connect.php';
include("../../user.php");

$id=$_REQUEST['id'];

$sql=$con->query("SELECT a.id as enquiry_id,a.status as enquiry_status,a.client_type as clients_type,a.Location,a.Address,a.area,a.pincode,a.*,b.*,c.*,d.*,e.*,f.name as eqp_name,f.*,g.status as client_master_status,g.org_type as client_org_type,g.*,h.state,h.city,h.client_id,h.gst_no,h.pan_no  FROM enquiry a left join calls_master b on (a.call_type=b.id) left join z_department_master c on (a.Department=c.id) left join candidate_form_details d on(a.employee=d.id) left join products_master e on(a.product=e.Product_id) left join product_services f on (a.list=f.id) left join  new_client_master g on (a.client_id=g.id) left join new_plant_master h on(a.client_id=h.client_id)where a.id='$id'");

/* echo "SELECT a.id as enquiry_id,a.status as enquiry_status,a.client_type as clients_type,a.Location,a.Address,a.area,a.pincode,a.*,b.*,c.*,d.*,e.*,f.name as eqp_name,f.*,g.status as client_master_status,g.org_type as client_org_type,g.*,h.state,h.city,h.client_id,h.gst_no,h.pan_no  FROM enquiry a left join calls_master b on (a.call_type=b.id) left join z_department_master c on (a.Department=c.id) left join candidate_form_details d on(a.employee=d.id) left join products_master e on(a.product=e.Product_id) left join product_services f on (a.list=f.id) left join  new_client_master g on (a.client_id=g.id) left join new_plant_master h on(a.client_id=h.client_id)where a.id='$id'"; */


$row = $sql->fetch(PDO::FETCH_ASSOC);
	
$location=$row['Location'];
$address=$row['Address'];
$area=$row['area'];
$pincode=$row['pincode'];

echo $location."=".$address."=".$area."=".$pincode;
?>