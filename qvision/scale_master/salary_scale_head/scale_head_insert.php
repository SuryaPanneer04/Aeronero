<?php

require '../../../connect.php';

$scale=$_REQUEST['Scale'];
$earnings=$_REQUEST['earnings'];
$earning_name=$_REQUEST['earning_name'];
$amount=$_REQUEST['amount'];

$payroll_scale_master = $con->query("INSERT INTO payroll_scale_master(name, status, created_by, created_on) VALUES ('$scale',1,1,NOW())");	

$master_id=$con->lastInsertId();
$master_name=$scale;

if (!$master_id) {
    $get_master_id_sql = $con->query("select id,name from payroll_scale_master where name='$scale' order by id desc limit 1");	
    if($get_master_id_sql) {
        $get_master_id = $get_master_id_sql->fetch(PDO::FETCH_ASSOC);
        $master_id=$get_master_id['id'];
        $master_name=$get_master_id['name'];
    }
}

for($m=0;$m<sizeof($earnings);$m++)
{
    $amt = $amount[$m];
	$payroll_scale_details = $con->query("INSERT INTO payroll_scale_details(payroll_master_id, payroll_master_name, salary_structure_id, salary_structure_name,amount, status, created_by, created_on) VALUES ('$master_id','$master_name','$earnings[$m]','$earning_name[$m]','$amt',1,1,NOW())");	
}

if($payroll_scale_master)
{
	echo 1;
}
else
{
	echo '';
}

?>