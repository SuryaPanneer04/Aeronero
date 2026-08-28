<?php

require '../../../../connect.php';
include("../../../../user.php");

$staff_id=$_REQUEST['staff_id'];
$pan_number=$_REQUEST['pan_number'];
$pf_number=$_REQUEST['pf_number'];
$esi_number=$_REQUEST['esi_number'];
$uan_number=$_REQUEST['uan_number'];
$gratuity_num=$_REQUEST['gratuity_num'];
$holder_name=$_REQUEST['holder_name'];
$bank_name=$_REQUEST['bank_name'];
$acc_number=$_REQUEST['acc_number'];
$ifsc_code=$_REQUEST['ifsc_code'];
$location=$_REQUEST['location'];
$Incentive_staff_flag=$_REQUEST['Incentive_staff_flag'];
$staff_salary_amount=$_REQUEST['staff_salary_amount'];
$Payable_staff_salary=$_REQUEST['Payable_staff_salary'];
$staff_scale=$_REQUEST['staff_scale'];
// echo $staff_scale."00000000000000000000000000000000000000000000000";

/* $statement = $con->query("UPDATE staff_master SET scale_master_id='$staff_scale',acc_holder_name='$holder_name',esi_number='$esi_number',bank='$bank_name',account_no='$acc_number',ifsc_code='$ifsc_code',salary_amount='$staff_salary_amount',varaible_pay='$Payable_staff_salary',incentive_percentage='$Incentive_staff_flag' WHERE candid_id='$staff_id'"); */
 $statement = $con->query("UPDATE staff_master SET scale_master_id='$staff_scale',acc_holder_name='$holder_name',bank='$bank_name',account_no='$acc_number',ifsc_code='$ifsc_code',pan_number='$pan_number',pf_number='$pf_number',esic_number='$esi_number',uan_number='$uan_number',gratuity_num='$gratuity_num',payslip_location='$location',salary_amount='$staff_salary_amount',varaible_pay='$Payable_staff_salary',incentive_percentage='$Incentive_staff_flag' WHERE candid_id='$staff_id'");
// $statement ="UPDATE staff_master SET scale_master_id='$staff_scale',acc_holder_name='$holder_name',bank='$bank_name',account_no='$acc_number',ifsc_code='$ifsc_code',pan_number='$pan_number',pf_number='$pf_number',esic_number='$esi_number',uan_number='$uan_number',gratuity_num='$gratuity_num',payslip_location='$location',salary_amount='$staff_salary_amount',varaible_pay='$Payable_staff_salary',incentive_percentage='$Incentive_staff_flag' WHERE candid_id='$staff_id'";
// echo $statement;exit();
// $sff=$con->query($statement);
// echo "UPDATE staff_master SET scale_master_id='$staff_scale',acc_holder_name='$holder_name',bank='$bank_name',account_no='$acc_number',ifsc_code='$ifsc_code',pan_number='$pan_number',pf_number='$pf_number',esic_number='$esi_number',uan_number='$uan_number',payslip_location='$location',salary_amount='$staff_salary_amount',varaible_pay='$Payable_staff_salary',incentive_percentage='$Incentive_staff_flag' WHERE candid_id='$staff_id'";

 /* echo "UPDATE staff_master SET scale_master_id='$staff_scale',acc_holder_name='$holder_name',bank='$bank_name',account_no='$acc_number',ifsc_code='$ifsc_code',salary_amount='$staff_salary_amount',varaible_pay='$Payable_staff_salary',incentive_percentage='$Incentive_staff_flag' WHERE candid_id='$staff_id'"; */ 
if($statement)
{
	echo 1;
}

?>