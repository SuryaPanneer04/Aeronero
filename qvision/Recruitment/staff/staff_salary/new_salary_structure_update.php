<?php

require '../../../../connect.php';
include("../../../../user.php");


$allllvall=$_REQUEST['allval'];

//echo $allllvall;

$explodealllval = explode('***', $allllvall);

$staff_id = $explodealllval[0];
$m_grossfixed = $explodealllval[1];
$p_grossfixed = $explodealllval[2];
$mbasic = $explodealllval[3];
$pbasic = $explodealllval[4];
$mHRA = $explodealllval[5];
$pHRA = $explodealllval[6];
$mOtherallowances = $explodealllval[7];
$pOtherallowances = $explodealllval[8];
$mSiteallowances = $explodealllval[9];
$pSiteallowances = $explodealllval[10];
$mAdvance = $explodealllval[11];
$pAdvance = $explodealllval[12];
$mEmployee_PF = $explodealllval[13];
$pEmployee_PF = $explodealllval[14];
$mEmployee_ESIC = $explodealllval[15];
$pEmployee_ESIC = $explodealllval[16];
$mProfessional_Tax = $explodealllval[17];
$pProfessional_Tax = $explodealllval[18];
$mTDS = $explodealllval[19];
$pTDS = $explodealllval[20]; // Fixed typo here
$mClubEE = $explodealllval[21];
$pClubEE = $explodealllval[22];
$mTotal_Deductions_Employee = $explodealllval[23];
$pTotal_Deductions_Employee = $explodealllval[24]; // Fixed typo here
$mnetsalary = $explodealllval[25];
$Pnetsalary = $explodealllval[26]; // Note the capital 'P' here
$mEmployer_PF = $explodealllval[27];
$pEmployer_PF = $explodealllval[28];
$mEmployer_ESIC = $explodealllval[29];
$pEmployer_ESIC = $explodealllval[30];
$mClubER = $explodealllval[31];
$pClubER = $explodealllval[32];
$mTotal_deduction_Employer = $explodealllval[33];
$pTotal_deduction_Employer = $explodealllval[34];
$m_fixed = $explodealllval[35];
$p_fixed = $explodealllval[36];
 //echo $explodealllval[24].')_)_)'.$explodealllval[26];


 $newsalstruup=$con->query("UPDATE `joining_detail_sal_structure` SET `fixedgross_month`='$m_grossfixed',`fixedgross_annum`='$p_grossfixed',`basic_month`='$mbasic',`basic_annum`='$pbasic',`HRA_month`='$mHRA',`HRA_annum`='$pHRA',`otherallowances_permonth`='$mOtherallowances',`otherallowances_perannum`='$pOtherallowances',`siteallowance_permonth`='$mSiteallowances',`siteallowance_perannum`='$pSiteallowances',`advancebonus_permonth`='$mAdvance',`advancebonus_perannum`='$pAdvance',`employee_PF_month`='$mEmployee_PF',`employee_PF_annum`='$pEmployee_PF',`employee_ESIC_month`='$mEmployee_ESIC',`employee_ESIC_annum`='$pEmployee_ESIC',`professionaltax_permonth`='$mProfessional_Tax',`professionaltax_perannum`='$pProfessional_Tax',`tds_permonth`='$mTDS',`tds_perannum`='$pTDS',`clubee_permonth`='$mClubEE',`clubee_perannum`='$pClubEE',`totaldeduction_employee_permonth`='$mTotal_Deductions_Employee',`totaldeduction_employee_perannum`='$pTotal_Deductions_Employee',`netsalary_month`='$mnetsalary',`netsalary_annum`='$Pnetsalary',`employer_PF_month`='$mEmployer_PF',`employer_PF_annum`='$pEmployer_PF',`employer_ESIC_month`='$mEmployer_ESIC',`employer_ESIC_annum`='$pEmployer_ESIC',`cluber_month`='$mClubER',`cluber_annum`='$pClubER',`total_Deductions_Employer_month`='$mTotal_deduction_Employer',`total_Deductions_Employer_annum`='$pTotal_deduction_Employer',`fixed_month`='$m_fixed',`fixed_annum`='$p_fixed',`status`=1,`created_on`=now() WHERE candid_id='$staff_id'");

if($newsalstruup)
{
	echo 1;
}
else 
{
	echo 0;
}
//echo 'kokokokok';

?>