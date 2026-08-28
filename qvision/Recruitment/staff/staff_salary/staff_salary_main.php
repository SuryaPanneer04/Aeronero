<?php

require '../../../../connect.php';
include("../../../../user.php");
$staid = $_REQUEST['canid'];

$staffsel=$con->query("select s.*,d.dept_name,de.designation_name,dv.div_name from staff_master s left join z_department_master d on s.dep_id=d.id left join designation_master de on s.design_id=de.id left join division_master dv on s.div_id=dv.id where candid_id='$staid'");

/* echo "select s.*,d.dept_name,de.designation_name,dv.div_name from staff_master s left join z_department_master d on s.dep_id=d.id left join designation_master de on s.design_id=de.id left join division_master dv on s.div_id=dv.id where candid_id='$staid'"; */

$data1=$staffsel->fetch();
$emp_name=$data1['emp_name'];
$dept_name=$data1['dept_name'];
$div_name=$data1['div_name'];
$designation_name=$data1['designation_name'];
$scale_master_id=$data1['scale_master_id'];

//echo $scale_master_id.'jijijijijijiji';
$payroll_deduction_id=$data1['payroll_deduction_id'];
$varaible_pay=$data1['varaible_pay'];
$incentive_percentage=$data1['incentive_percentage'];
$salary_amount1=$data1['salary_amount'];
$salary_amount = str_replace(',', '', $salary_amount1);
//echo $salary_amount;


$acc_holder_name=$data1['acc_holder_name'];
$bank=$data1['bank'];
$account_no=$data1['account_no'];
$ifsc_code=$data1['ifsc_code'];
$pan_no=$data1['pan_number'];
$pf_no=$data1['pf_number'];
$esic_no=$data1['esic_number'];
$uan_no=$data1['uan_number'];
$gratuity_num=$data1['gratuity_num'];
$payslip_location=$data1['payslip_location'];

$salary=$con->query("select emp_name,salary,new_salary_start_date from `appraisal_details` WHERE emp_name='$emp_name' and new_salary_start_date=(select mAX(new_salary_start_date) as hike_sal_date FROM `appraisal_details` WHERE emp_name='$emp_name' and `new_salary_start_date` <= CURDATE())");

///echo "select emp_name,salary,new_salary_start_date from `appraisal_details` WHERE emp_name='$emp_name' and new_salary_start_date=(select mAX(new_salary_start_date) as hike_sal_date FROM `appraisal_details` WHERE emp_name='$staid' and `new_salary_start_date` <= CURDATE())";

$staff_sal=$salary->fetch();
if($staff_sal)
{
$app_salary_date = $staff_sal['new_salary_start_date'];
//echo $app_salary_date;  echo "<br>";
$app_salary = $staff_sal['salary'];
$after_appraisal = (($salary_amount * ($app_salary / 100)) + $salary_amount);
}

//echo $app_salary;

?>
<style>
/* .accno{   //for input bottom border.
  outline: 0;
  border-width: 0 0 2px;
  border-color: grey;
}
.accno:focus {
  border-color: grey;
} */

.bold{
	font-weight: bold;
}
.popup {
    display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
}

 .card-content {
            background: white;
            max-height: 100vh; /* Increase the maximum height for the card */
            overflow-y: auto; /* Enable vertical scrolling */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }
#saveButton {
    display: none;
}
.btnnnnnnnn {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
.btnnnnnnnn:hover
{
background-color: darkgreen;	
}
</style>
<div class="col-12">
			<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Staff Detail</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="POST">
			  <input type="hidden" name="staff_id" id="staff_id" value="<?php echo $staid; ?>">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="emp_name" value="<?php echo $emp_name; ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Department</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="dept_id" value="<?php echo $dept_name; ?>" readonly>
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Division</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="div_id" value="<?php echo $div_name; ?>" readonly>
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Designation</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="design_id" value="<?php echo $designation_name; ?>" readonly>
                    </div>
                  </div>
				  
				  <div class="form-group row">
                    <label for="pan" class="col-sm-2 col-form-label">PAN Number</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pan-num" name="pan_number" value="<?php echo $pan_no;?>" >
                    </div>
                  </div>
				  
				   <div class="form-group row">
                    <label for="pf" class="col-sm-2 col-form-label">PF Number</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pf-num" name="pf_number" value="<?php echo $pf_no;?>" >
                    </div>
                  </div>
				  
				   <div class="form-group row">
                    <label for="esi" class="col-sm-2 col-form-label">ESIC Number</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="esi-num" name="esi_number" value="<?php echo $esic_no;?>" >
                    </div>
                  </div>
				  
				  <div class="form-group row">
                    <label for="uan" class="col-sm-2 col-form-label">UAN Number</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="uan-num" name="uan_number" value="<?php echo $uan_no;?>" >
                    </div>
                  </div>

				  <div class="form-group row">
                    <label for="Gratuity" class="col-sm-2 col-form-label">Gratuity Number</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="gratuity_num" name="gratuity_num" value="<?php echo $gratuity_num;?>" >
                    </div>
                  </div>
				  
				   <div class="form-group row">
                    <label for="location" class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="location" name="location" value="<?php echo $payslip_location;?>" >
                    </div>
                  </div>
				  
</div>				  
<div class="col-12">
			<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Salary Account Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             <form class="form-horizontal" method="POST">
			  <input type="hidden" name="staff_id" id="staff_id" value="<?php echo $staid; ?>">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Bank</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="bank_name" name="bank_name" value="<?php echo $bank; ?>">
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">A/C Holder Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control accno" id="holder_name" name="holder_name" value="<?php echo $acc_holder_name; ?>">
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">A/C Number</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control accno" id="acc_number" name="acc_number" value="<?php echo $account_no; ?>">
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">IFSC Code</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" value="<?php echo $ifsc_code; ?>">
                    </div>
                  </div>
               </div>

			<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Salary Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="POST">
			  <input type="hidden" name="staff_id" id="staff_id" value="<?php echo $staid; ?>">
			  <div class="card-body">
				  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Salary Amount (Monthly Basis)</label>
                    <div class="col-sm-10">
	<?php 
       //..if($app_salary_date==''){	
	   ?>
           <input type="text" class="form-control" id="staff_salary_amount" name="staff_salary_amount" value="<?php echo $salary_amount; ?>">
	   <?php 
	   //} else{ 
	   ?>
	       <!--<input type="text" class="form-control" id="staff_salary_amount" name="staff_salary_amount" value="<?php echo $after_appraisal; ?>">-->
	   <?php 
	   //}
	   ?>
				
				
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Variable Pay Percentage</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="Payable_staff_salary" name="Payable_staff_salary" min="1" max="100" value="<?php echo $varaible_pay; ?>" onchange="payable(this.value)" required>
                    </div>					
                  </div>
				  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Incentive Percentage</label>
					<div class="col-sm-2">
					<select class="form-control" name="Incentive_staff_flag">
					<?php 
					if($incentive_percentage==1)
					{
					?>
						<option value="1">Yes</option>
						<option value="0">No</option>
						<?php
					}
					else
					{
						?>
						<option value="0">No</option>
						<option value="1">Yes</option>
						<?php
					}
					?>
					</select>
					</div>
					<div class="col-sm-7">	
					<?php 
if (is_numeric($varaible_pay)) {
    if ($varaible_pay == 100) {
        ?>
        <input type="text" class="form-control" id="Incentive_staff_salary" name="Incentive_staff_salary" value="<?php echo 0; ?>" readonly>
        <?php
    } else {
        ?>
        <input type="text" class="form-control" id="Incentive_staff_salary" name="Incentive_staff_salary" value="<?php echo 100 - $varaible_pay; ?>" readonly>
        <?php
    }
} else {
    // Handle the case when $varaible_pay is not numeric
    // For example, you can set a default value or show an error message.
    ?>
    <input type="text" class="form-control" id="Incentive_staff_salary" name="Incentive_staff_salary" value="0" readonly>
    <?php
}
?>

					</div>					
                  </div>
				  
				  <script>
					function payable(v)
					{
						if(v > 100 || v<0)
						{
							alert('value must be 0 to 100 ..');
							$('#Payable_staff_salary').val(100);
						}
						else
						{
							if(v == 100)
							{
								$('#Incentive_staff_salary').val(0);
							}
							else
							{
								let incentive = 100-v;
								$('#Incentive_staff_salary').val(incentive);
							}
						}
					}
				   </script>
					
				  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Staff Scale</label>
                    <div class="col-sm-10">
						<div class="form-group">
                        <select class="custom-select" name="staff_scale" onChange="scale_changes(this.value)">
						
						<?php
						if(!empty($scale_master_id) && $scale_master_id != 0) {
							$current_scale_sql = $con->query("SELECT id, name FROM payroll_scale_master WHERE id='$scale_master_id'");
							if($current_scale = $current_scale_sql->fetch(PDO::FETCH_ASSOC)) {
								?>
								<option value="<?php echo $current_scale['id']; ?>" selected><?php echo $current_scale['name']; ?></option>
								<?php
							}
						}
						?>
						<option value="0">--Select Scale--</option>
						<?php

						$payroll_scale_sql=$con->query("SELECT id, name, status, created_by, created_on, modified_by, modified_on FROM payroll_scale_master WHERE  id not in ('$scale_master_id')");
                           //  echo "SELECT id, name, status, created_by, created_on, modified_by, modified_on FROM payroll_scale_master WHERE  id not in ('$scale_master_id')";
							 
						$i=1;
						while($payroll_scale_res = $payroll_scale_sql->fetch(PDO::FETCH_ASSOC))
						{

						?>
						<option value="<?php echo $payroll_scale_res['id']; ?>"><?php echo $payroll_scale_res['name']; ?></option>
						<?php

						}
						?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
				
	<div class="row">
	
		
          <div class="col-md-12">
            <div class="card card-primary">
				<div class="card-header">
				<h3 class="card-title">Deductions</h3>
				</div>
				<div class="card-body" id="earning_body">
				<table class="table table-bordered table-hover">
				<thead>
				<tr><th>S.No</th><th>Deduction</th><th>Amount</th><th>Percentage</th></tr>
				</thead>
				<tbody>

				<?php

				if($payroll_deduction_id <>"")
				{
				$payroll_deduction_sql=$con->query("SELECT id, name, from_date, amount, percentage, min_amount, max_amount, status, created_by, created_on, modified_by, modified_on FROM payroll_deduction_master WHERE id in ($payroll_deduction_id)");
				$i=1;
				while($payroll_deduction_res = $payroll_deduction_sql->fetch(PDO::FETCH_ASSOC))
				{
				?>
					<tr>
					<td><?php echo $payroll_deduction_res['id'] ?></td>
					<td><?php echo $payroll_deduction_res['name'] ?></td>
					<td><?php echo $payroll_deduction_res['amount'] ?></td>
					<td><?php echo $payroll_deduction_res['percentage']; ?></td>
					</tr>				
					<?php
				}
				}
				else
				{
				$payroll_deduction_sql=$con->query("SELECT id, name, from_date, amount, percentage, min_amount, max_amount, status, created_by, created_on, modified_by, modified_on FROM payroll_deduction_master");				
				$i=1;
				while($payroll_deduction_res = $payroll_deduction_sql->fetch(PDO::FETCH_ASSOC))
				{

					?>
					<tr>
					<td><?php echo $payroll_deduction_res['id'] ?></td>
					<td><?php echo $payroll_deduction_res['name'] ?></td>
					<td><?php echo $payroll_deduction_res['amount'] ?></td>
					<td><?php echo $payroll_deduction_res['percentage']; ?></td>
					</tr>				
					<?php

				}
				}
				?>

				</tbody>
				</table>
				</div>
                <!-- /.form group -->
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col (right) -->
<?php 
   $salStructure=$con->query("SELECT * FROM `joining_detail_sal_structure` WHERE `candid_id`='$staid'");
   $structure=$salStructure->fetch();
   if (!$structure) {
       $structure = array(
           'fixedgross_month' => '', 'fixedgross_annum' => '', 'basic_month' => '', 'basic_annum' => '',
           'HRA_month' => '', 'HRA_annum' => '', 'otherallowances_permonth' => '', 'otherallowances_perannum' => '',
           'siteallowance_permonth' => '', 'siteallowance_perannum' => '', 'advancebonus_permonth' => '', 
           'advancebonus_perannum' => '', 'employee_PF_month' => '', 'employee_PF_annum' => '', 
           'employee_ESIC_month' => '', 'employee_ESIC_annum' => '', 'professionaltax_permonth' => '', 
           'professionaltax_perannum' => '', 'tds_permonth' => '', 'tds_perannum' => '', 'clubee_permonth' => '', 
           'clubee_perannum' => '', 'totaldeduction_employee_permonth' => '', 'totaldeduction_employee_perannum' => '', 
           'netsalary_month' => '', 'netsalary_annum' => '', 'employer_PF_month' => '', 'employer_PF_annum' => '', 
           'employer_ESIC_month' => '', 'employer_ESIC_annum' => '', 'cluber_month' => '', 'cluber_annum' => '', 
           'total_Deductions_Employer_month' => '', 'total_Deductions_Employer_annum' => '', 'fixed_month' => '', 
           'fixed_annum' => ''
       );
   }
 ?>
 <img src="qvision/images/edit.png" id="editIcon" style="height:25px;width:25px;float:right;" onclick="editt();" /><br>
 <br>
 
	<div class="row">
	   <table class="table table-bordered">
<tr> 
	<th colspan="4" style="background: darkgray;"><center>  Components </center></th>
	<th colspan="1" style="background: darkgray;"> <center> Per Month</center></th>
	<th colspan="1" style="background: darkgray;"> <center> Per Annum </center></th>
</tr>
<!-----------------------------------------new salary details-------------------------------------------->
<tr>
	<td colspan="4"><b> Fixed Gross Month</b></td>
	<td colspan="1"><input type="text" class="form-control month bold" id="m_grossfixed" name="m_grossfixed" value="<?php echo $structure['fixedgross_month'];  ?>" readonly > </td>
	<td colspan="1"><input type="text" class="form-control annual bold" id="p_grossfixed" name="p_grossfixed" value="<?php echo $structure['fixedgross_annum'];  ?>" readonly > </td>
</tr>
<tr>
	<td colspan="4">Basic </td>
	<td colspan="1"><input type="text" class="form-control month" id="mbasic" name="mbasic"  value="<?php echo $structure['basic_month'];  ?>" readonly> </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pbasic" name="pbasic"  value="<?php echo $structure['basic_annum'];  ?>" readonly> </td>
</tr>

<tr>
	<td colspan="4"> HRA</td>
	<td colspan="1"><input type="text" class="form-control month" id="mHRA" name="mHRA" value="<?php echo $structure['HRA_month'];  ?>" readonly> </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pHRA" name="pHRA" value="<?php echo $structure['HRA_annum'];  ?>" readonly> </td>
</tr>
<tr>
	<td colspan="4"> Other Allowances </td>
	<td colspan="1"><input type="text" class="form-control month" id="mOtherallowances" name="mOtherallowances" value="<?php echo $structure['otherallowances_permonth'];  ?>" readonly > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pOtherallowances" name="pOtherallowances" value="<?php echo $structure['otherallowances_perannum'];  ?>" readonly > </td>
</tr>
<tr>
	<td colspan="4"> Site Allowances</td>
	<td colspan="1"><input type="text" class="form-control month" id="mSiteallowances" name="mSiteallowances" value="<?php echo $structure['siteallowance_permonth'];  ?>" readonly > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pSiteallowances" name="pSiteallowances"  value="<?php echo $structure['siteallowance_perannum'];  ?>" readonly> </td>
</tr>
<tr>
	<td colspan="4"> Advance Bonus</td>
	<td colspan="1"><input type="text" class="form-control month" id="mAdvance" name="mAdvance" value="<?php echo $structure['advancebonus_permonth'];  ?>" readonly > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pAdvance" name="pAdvance"  value="<?php echo $structure['advancebonus_perannum'];  ?>" readonly> </td>
</tr>
<tr>
	<td colspan="4"> Employee_PF</td>
	<td colspan="1"><input type="text" class="form-control month" id="mEmployee_PF" name="mEmployee_PF" value="<?php echo $structure['employee_PF_month'];  ?>" readonly > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pEmployee_PF" name="pEmployee_PF" value="<?php echo $structure['employee_PF_annum'];  ?>" readonly> </td>
</tr>
<tr>
	<td colspan="4">Employee_ESIC </td>
	<td colspan="1"><input type="text" class="form-control month" id="mEmployee_ESIC" name="mEmployee_ESIC" value="<?php echo $structure['employee_ESIC_month'];  ?>" readonly > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pEmployee_ESIC" name="pEmployee_ESIC" value="<?php echo $structure['employee_ESIC_annum'];  ?>" readonly> </td>
</tr>
<tr>
	<td colspan="4"> Professional_Tax</td>
	<td colspan="1"><input type="text" class="form-control month" id="mProfessional_Tax" name="mProfessional_Tax" value="<?php echo $structure['professionaltax_permonth'];  ?>" readonly > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pProfessional_Tax" name="pProfessional_Tax"value="<?php echo $structure['professionaltax_perannum'];  ?>" readonly> </td>
</tr>
<tr>
	<td colspan="4">TDS </td>
	<td colspan="1"><input type="text" class="form-control month" id="mTDS" name="mTDS" value="<?php echo $structure['tds_permonth'];  ?>" readonly > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pTDS" name="pTDS" value="<?php echo $structure['tds_perannum'];  ?>" readonly> </td>
</tr>
<tr>
	<td colspan="4"> Club EE</td>
	<td colspan="1"><input type="text" class="form-control month" id="mClubEE" name="mClubEE" value="<?php echo $structure['clubee_permonth'];  ?>" readonly> </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pClubEE" name="pClubEE" value="<?php echo $structure['clubee_perannum'];  ?>" readonly> </td>
</tr>
<tr>
	<td colspan="4">Total_Deductions_Employee </td>
	<td colspan="1"><input type="text" class="form-control month" id="mTotal_Deductions_Employee" name="mTotal_Deductions_Employee" value="<?php echo $structure['totaldeduction_employee_permonth'];  ?>" readonly > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pTotal_Deductions_Employee" name="pTotal_Deductions_Employee" value="<?php echo $structure['totaldeduction_employee_perannum'];  ?>" readonly> </td>
</tr>
<tr>
	<td colspan="4"><b>Net Salary</b></td>
	<td colspan="1"><input type="text" class="form-control month" id="mnetsalary" name="mnetsalary" value="<?php echo $structure['netsalary_month'];  ?>" readonly> </td>
	<td colspan="1"><input type="text" class="form-control annual" id="Pnetsalary" name="Pnetsalary" value="<?php echo $structure['netsalary_annum'];  ?>" readonly> </td>
</tr>
<tr>
	<td colspan="4">Employer_PF</td>
	<td colspan="1"><input type="text" class="form-control month" id="mEmployer_PF" name="mEmployer_PF" value="<?php echo $structure['employer_PF_month'];  ?>" readonly> </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pEmployer_PF" name="pEmployer_PF"value="<?php echo $structure['employer_PF_annum'];  ?>" readonly > </td>
</tr>
<tr>
	<td colspan="4">Employer_ESIC</td>
	<td colspan="1"><input type="text" class="form-control month" id="mEmployer_ESIC" name="mEmployer_ESIC" value="<?php echo $structure['employer_ESIC_month'];  ?>" readonly> </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pEmployer_ESIC" name="pEmployer_ESIC" value="<?php echo $structure['employer_ESIC_annum'];  ?>" readonly> </td>
</tr>
<tr>
	<td colspan="4"> Club ER</td>
	<td colspan="1"><input type="text" class="form-control month" id="mClubER" name="mClubER" value="<?php echo $structure['cluber_month'];  ?>" readonly> </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pClubER" name="pClubER" value="<?php echo $structure['cluber_annum'];  ?>" readonly> </td>
</tr>
<tr>
	<td colspan="4">Total_deduction_Employer</td>
	<td colspan="1"><input type="text" class="form-control month" id="mTotal_deduction_Employer" name="mTotal_deduction_Employer" value="<?php echo $structure['total_Deductions_Employer_month'];  ?>" readonly> </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pTotal_deduction_Employer" name="pTotal_deduction_Employer" value="<?php echo $structure['total_Deductions_Employer_annum'];  ?>" readonly> </td>
</tr>

<tr>
	<td colspan="4"><b>Fixed</b></td>
	<td colspan="1"><input type="text" class="form-control bold" id="m_fixed" name="m_fixed" value="<?php echo $structure['fixed_month'];  ?>" readonly> </td>
	<td colspan="1"><input type="text" class="form-control bold" id="p_fixed" name="p_fixed" value="<?php echo $structure['fixed_annum'];  ?>" readonly> </td>
</tr>
<!----------------------------------------------------------------------------------->

</table>
	</div>
        </div>
		<!-- /.card-body -->
		<div class="card-footer">
		<button type="reset" class="btn btn-info float-right">Reset</button>
		<input type="button" name="staff_salar_save" value="Save" onclick="staff_salary_save()" class="btn btn-info">
		</div>
		<!-- /.card-footer -->
	</form>
	</div>

</div>

<!-- Edit Popup -->
<div id="editPopup" class="popup">
<div class="card-content">
<div>
 <span style="font-size:25px;color:blue;">New Salary Structure <span><img src="qvision/images/close.png" id="editIcon" style="height:25px;width:25px;float:right;" onclick="closeee();" /><br><br>
</div>

<div class="row">
  <table class="table table-bordered">

<tr> 
	<th colspan="4" style="background: darkgray;"><center>  Components </center></th>
	<th colspan="1" style="background: darkgray;"> <center> Per Month</center></th>
	<th colspan="1" style="background: darkgray;"> <center> Per Annum </center></th>
</tr>
<tr>
	<td colspan="4"><b> Fixed Gross Month</b></td>
	<td colspan="1"><input type="text" class="form-control month bold" id="m_grossfixednew" name="m_grossfixednew" value="0"> </td>
	<td colspan="1"><input type="text" class="form-control annual bold" id="p_grossfixednew" name="p_grossfixednew" value="0"  > </td>
</tr>
<tr>
	<td colspan="4">Basic </td>
	<td colspan="1"><input type="text" class="form-control month" id="mbasicnew" name="mbasicnew"  value="0" > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pbasicnew" name="pbasicnew"  value="0" > </td>
</tr>

<tr>
	<td colspan="4"> HRA</td>
	<td colspan="1"><input type="text" class="form-control month" id="mHRAnew" name="mHRAnew" value="0" > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pHRAnew" name="pHRAnew" value="0" > </td>
</tr>
<tr>
	<td colspan="4"> Other Allowances </td>
	<td colspan="1"><input type="text" class="form-control month" id="mOtherallowancesnew" name="mOtherallowancesnew" value="0"  > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pOtherallowancesnew" name="pOtherallowancesnew" value="0"  > </td>
</tr>
<tr>
	<td colspan="4"> Site Allowances</td>
	<td colspan="1"><input type="text" class="form-control month" id="mSiteallowancesnew" name="mSiteallowancesnew" value="0"  > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pSiteallowancesnew" name="pSiteallowancesnew"  value="0" > </td>
</tr>
<tr>
	<td colspan="4"> Advance Bonus</td>
	<td colspan="1"><input type="text" class="form-control month" id="mAdvancenew" name="mAdvancenew" value="0"  > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pAdvancenew" name="pAdvancenew"  value="0" > </td>
</tr>
<tr>
	<td colspan="4"> Employee_PF</td>
	<td colspan="1"><input type="text" class="form-control month" id="mEmployee_PFnew" name="mEmployee_PFnew" value="0"  > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pEmployee_PFnew" name="pEmployee_PFnew" value="0" > </td>
</tr>
<tr>
	<td colspan="4">Employee_ESIC </td>
	<td colspan="1"><input type="text" class="form-control month" id="mEmployee_ESICnew" name="mEmployee_ESICnew" value="0"  > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pEmployee_ESICnew" name="pEmployee_ESICnew" value="0" > </td>
</tr>
<tr>
	<td colspan="4"> Professional_Tax</td>
	<td colspan="1"><input type="text" class="form-control month" id="mProfessional_Taxnew" name="mProfessional_Taxnew" value="0"  > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pProfessional_Taxnew" name="pProfessional_Taxnew"value="0" > </td>
</tr>
<tr>
	<td colspan="4">TDS </td>
	<td colspan="1"><input type="text" class="form-control month" id="mTDSnew" name="mTDSnew" value="0"> </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pTDSnew" name="pTDSnew" value="0" > </td>
</tr>
<tr>
	<td colspan="4"> Club EE</td>
	<td colspan="1"><input type="text" class="form-control month" id="mClubEEnew" name="mClubEEnew" value="0" > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pClubEEnew" name="pClubEEnew" value="0" > </td>
</tr>
<tr>
	<td colspan="4">Total_Deductions_Employee </td>
	<td colspan="1"><input type="text" class="form-control month" id="mTotal_Deductions_Employeenew" name="mTotal_Deductions_Employeenew" value="0"  > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pTotal_Deductions_Employeenew" name="pTotal_Deductions_Employeenew" value="0" > </td>
</tr>
<tr>
	<td colspan="4"><b>Net Salary</b></td>
	<td colspan="1"><input type="text" class="form-control month" id="mnetsalarynew" name="mnetsalarynew" value="0" > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="Pnetsalaryneww" name="Pnetsalaryneww" value="0"> </td>
</tr>
<tr>
	<td colspan="4">Employer_PF</td>
	<td colspan="1"><input type="text" class="form-control month" id="mEmployer_PFnew" name="mEmployer_PFnew" value="0" > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pEmployer_PFnew" name="pEmployer_PFnew"value="0" > </td>
</tr>
<tr>
	<td colspan="4">Employer_ESIC</td>
	<td colspan="1"><input type="text" class="form-control month" id="mEmployer_ESICnew" name="mEmployer_ESICnew" value="0" > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pEmployer_ESICnew" name="pEmployer_ESICnew" value="0" > </td>
</tr>
<tr>
	<td colspan="4"> Club ER</td>
	<td colspan="1"><input type="text" class="form-control month" id="mClubERnew" name="mClubERnew" value="0" > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pClubERnew" name="pClubERnew" value="0" > </td>
</tr>
<tr>
	<td colspan="4">Total_deduction_Employer</td>
	<td colspan="1"><input type="text" class="form-control month" id="mTotal_deduction_Employernew" name="mTotal_deduction_Employernew" value="0" > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pTotal_deduction_Employernew" name="pTotal_deduction_Employernew" value="0" > </td>
</tr>

<tr>
	<td colspan="4"><b>Fixed</b></td>
	<td colspan="1"><input type="text" class="form-control bold" id="m_fixednew" name="m_fixednew" value="0" > </td>
	<td colspan="1"><input type="text" class="form-control bold" id="p_fixednew" name="p_fixednew" value="0" > </td>
</tr>
</div>

</table>

<!-- Include your JavaScript file where you define the function -->
<script src="your-script.js"></script>

<!-- Your button that calls the function -->
<button type="button" id="saveButton" class="btnnnnnnnn" >Save</button>
</div>
</div>
<script src="path/to/jquery.min.js"></script>
<script src="path/to/jquery-jvectormap-2.0.5.min.js"></script>
<link rel="stylesheet" href="path/to/jquery-jvectormap-2.0.5.css">


<script>
function scale_changes(v)
{
	//alert(v);
//debugger;
	 var salary_amount = document.getElementById("staff_salary_amount").value;
    var candidid=$('#staff_id').val();	 
	var salary_amount = $('#staff_salary_amount').val();
	//console.log(salary_amount);
	
	$.ajax({
		type:"GET",
		url:"qvision/Recruitment/staff/staff_salary/staff_earnings_view.php?earning_id="+v+"&salary_amount="+salary_amount,
		success:function(data)
		{
			  //alert("priya:"+data);
			 console.warn("priya:"+data)
			$('#earning_body').html(data);
		}
	}); 
}
</script>
<script>
 function staff_salary_save()
{
	//debugger;
	var id=$('#staff_id').val();
	var data = $('form').serialize();
	$.ajax({
	type:'POST',
	data: data + "&" + "id="+id,
	  url:'qvision/Recruitment/staff/staff_salary/staff_salary_update.php',


		success:function(data)
		{
			if(data==0)
			{
				alert("Update Failed");
				
			}       
			else
			{
				alert("Update Successfully");
				//console.warn("ko:"+data);
				staff_list();
			}	
		}
	}); 


}
</script>

<script>
//function editt()
//{
	//debugger;
	//alert('kokok');
//}

// Function to show the edit popup
function editt() {
    var editPopup = document.getElementById("editPopup");
    var saveButton = document.getElementById("saveButton");

    editPopup.style.display = "block";
    saveButton.style.display = "block";
}

// Attach a click event handler to the edit icon
////var editIcon = document.querySelector("#editIcon");
//editIcon.addEventListener("click", showEditPopup);
</script>
<script>
function closeee()
{
	var editPopup = document.getElementById("editPopup");
    var saveButton = document.getElementById("saveButton");

    editPopup.style.display = "none";
    saveButton.style.display = "none";
}
</script>



<script>
    // Initialize your JavaScript function once the document is ready
    $(document).ready(function() {
        // Call the savebtnnnn function when the button is clicked
        $('#saveButton').on('click', function() {
            savebtnnnn();
        });
    });

    function savebtnnnn() {
       debugger;
   var staff_id=$("#staff_id").val();
	   
 var m_grossfixednew = $("#m_grossfixednew").val();
var p_grossfixednew = $("#p_grossfixednew").val();

var mbasicnew = $("#mbasicnew").val();
var pbasicnew = $("#pbasicnew").val();

var mHRAnew = $("#mHRAnew").val();
var pHRAnew = $("#pHRAnew").val();

var mOtherallowancesnew = $("#mOtherallowancesnew").val();
var pOtherallowancesnew = $("#pOtherallowancesnew").val();

var mSiteallowancesnew = $("#mSiteallowancesnew").val();
var pSiteallowancesnew = $("#pSiteallowancesnew").val();

var mAdvancenew = $("#mAdvancenew").val();
var mpAdvancenew = $("#pAdvancenew").val();

var mEmployee_PFnew = $("#mEmployee_PFnew").val();
var pEmployee_PFnew = $("#pEmployee_PFnew").val();

var mEmployee_ESICnew = $("#mEmployee_ESICnew").val();
var pEmployee_ESICnew = $("#pEmployee_ESICnew").val();

var mProfessional_Taxnew = $("#mProfessional_Taxnew").val();
var pProfessional_Taxnew = $("#pProfessional_Taxnew").val();

var mTDSnew = $("#mTDSnew").val();
var pTDSnew = $("#pTDSnew").val();

var mClubEEnew = $("#mClubEEnew").val();
var pClubEEnew = $("#pClubEEnew").val();

var mTotal_Deductions_Employeenew = $("#mTotal_Deductions_Employeenew").val();
var pTotal_Deductions_Employeenew = $("#pTotal_Deductions_Employeenew").val();

var mnetsalarynew = $("#mnetsalarynew").val();
var Pnetsalaryneww = $("#Pnetsalaryneww").val();
//alert(pnetsalaryneww);

var mEmployer_PFnew = $("#mEmployer_PFnew").val();
var pEmployer_PFnew = $("#pEmployer_PFnew").val();

var mEmployer_ESICnew = $("#mEmployer_ESICnew").val();
var pEmployer_ESICnew = $("#pEmployer_ESICnew").val();

var mClubERnew = $("#mClubERnew").val();
var pClubERnew = $("#pClubERnew").val();

var mTotal_deduction_Employernew = $("#mTotal_deduction_Employernew").val();
var pTotal_deduction_Employernew = $("#pTotal_deduction_Employernew").val();

var m_fixednew = $("#m_fixednew").val();
var p_fixednew = $("#p_fixednew").val();

var alldata = staff_id +'***'+ m_grossfixednew + '***' + p_grossfixednew + '***' +
    mbasicnew + '***' + pbasicnew + '***' +
    mHRAnew + '***' + pHRAnew + '***' +
    mOtherallowancesnew + '***' + pOtherallowancesnew + '***' +
    mSiteallowancesnew + '***' + pSiteallowancesnew + '***' +
    mAdvancenew + '***' + mpAdvancenew + '***' +
    mEmployee_PFnew + '***' + pEmployee_PFnew + '***' +
    mEmployee_ESICnew + '***' + pEmployee_ESICnew + '***' +
    mProfessional_Taxnew + '***' + pProfessional_Taxnew + '***' +
    mTDSnew + '***' + mTDSnew + '***' +
    mClubEEnew + '***' + pClubEEnew + '***' +
    mTotal_Deductions_Employeenew + '***' + pTotal_Deductions_Employeenew + '***' +
    mnetsalarynew + '***' + Pnetsalaryneww + '***' +
    mEmployer_PFnew + '***' + pEmployer_PFnew + '***' +
    mEmployer_ESICnew + '***' + pEmployer_ESICnew + '***' +
    mClubERnew + '***' + pClubERnew + '***' +
    mTotal_deduction_Employernew + '***' + pTotal_deduction_Employernew + '***' +
    m_fixednew + '***' + p_fixednew;

 //console.warn("kok:"+alldata);

$.ajax({
	type:'POST',
	
	  url:'qvision/Recruitment/staff/staff_salary/new_salary_structure_update.php?allval=' + alldata,


		success:function(data)
		{
			//alert(data);
			//console.warn("lp:"+data);
			if(data==1)
			{
				
				alert("Update Successfully");
				//console.warn("ko:"+data);
				staff_list();
				
			}       
			else
			{
				alert("Update Failed");
			}	
		}
	});
       
    }
</script>
