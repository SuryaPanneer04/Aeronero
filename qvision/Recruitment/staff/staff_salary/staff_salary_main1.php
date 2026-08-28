<?php

require '../../../../connect.php';
include("../../../../user.php");
$staid = $_REQUEST['canid'];
//echo $staid;


$staffsel=$con->query("select s.*,d.dept_name,de.designation_name,dv.div_name from staff_master s left join z_department_master d on s.dep_id=d.id left join designation_master de on s.design_id=de.id left join division_master dv on s.div_id=dv.id where candid_id='$staid'");

/* echo "select s.*,d.dept_name,de.designation_name,dv.div_name from staff_master s left join z_department_master d on s.dep_id=d.id left join designation_master de on s.design_id=de.id left join division_master dv on s.div_id=dv.id where candid_id='$staid'"; */

$data1=$staffsel->fetch();
$emp_name=$data1['emp_name'];
$dept_name=$data1['dept_name'];
$div_name=$data1['div_name'];
$designation_name=$data1['designation_name'];
$scale_master_id=$data1['scale_master_id'];
$payroll_deduction_id=$data1['payroll_deduction_id'];
$varaible_pay=$data1['varaible_pay'];
$incentive_percentage=$data1['incentive_percentage'];
$salary_amount=$data1['salary_amount'];

$acc_holder_name=$data1['acc_holder_name'];
$bank=$data1['bank'];
$account_no=$data1['account_no'];
$ifsc_code=$data1['ifsc_code'];

$salary=$con->query("select cand_id,salary,new_salary_start_date from `appraisal_details` WHERE emp_name='$staid' and new_salary_start_date=(select mAX(new_salary_start_date) as hike_sal_date FROM `appraisal_details` WHERE emp_name='$staid' and `new_salary_start_date` <= CURDATE())");

 /* echo "select cand_id,salary,new_salary_start_date from `appraisal_details` WHERE emp_name='$staid' and new_salary_start_date=(select mAX(new_salary_start_date) as hike_sal_date FROM `appraisal_details` WHERE emp_name='$staid' and `new_salary_start_date` <= CURDATE())";  */

/* echo "SELECT cand_id,salary,MAX(`new_salary_start_date`) as hike_sal_date FROM `appraisal_details` WHERE emp_name='$staid' and `new_salary_start_date` <= '2022-06-15'"; */

/* echo "SELECT cand_id,salary,new_salary_start_date FROM `appraisal_details` WHERE emp_name='$staid'"; */ 
//echo "<br>";

$staff_sal=$salary->fetch();
$app_salary_date = $staff_sal['new_salary_start_date'];
//echo $app_salary_date;  echo "<br>";
$app_salary = $staff_sal['salary'];
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
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Salary Amount</label>
                    <div class="col-sm-10">
	<?php 
       if($app_salary_date==''){	
	   ?>
           <input type="text" class="form-control" id="staff_salary_amount" name="staff_salary_amount" value="<?php echo $salary_amount; ?>">
	   <?php 
	   } else{ 
	   ?>
	       <input type="text" class="form-control" id="staff_salary_amount" name="staff_salary_amount" value="<?php echo $app_salary; ?>">
	   <?php 
	   }
	   ?>
				
				
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Payable Percentage</label>
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
					if($varaible_pay==100)
					{
						?>
						<input type="text" class="form-control" id="Incentive_staff_salary" name="Incentive_staff_salary" value="<?php echo 0; ?>" readonly>
						<?php
					}
					else
					{
						?>
						<input type="text" class="form-control" id="Incentive_staff_salary" name="Incentive_staff_salary" value="<?php echo 100-$varaible_pay; ?>" readonly>
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
		<div class="col-md-6">
			<div class="card card-danger">
			<div class="card-header">
			<h3 class="card-title">Earnings</h3>
			</div>
			<div class="card-body" id="earning_body">
			<table class="table table-bordered table-hover">
			<thead>
			<tr><th>Name</th><th>Percentage</th><th>Amount</th></tr>
			</thead>
			<tbody>

			<?php

			$payroll_deduction_sql=$con->query("SELECT id, name, amount, percentage, status, created_by, created_on, modified_by, modified_on FROM payroll_structure where id in (SELECT salary_structure_id FROM payroll_scale_details where payroll_master_id='$scale_master_id')");
			
			$i=1;
			$grand_tot = 0;
			
			while($payroll_deduction_res = $payroll_deduction_sql->fetch(PDO::FETCH_ASSOC))
			{
				$percentage = $payroll_deduction_res['percentage'];
			?>
			<tr>
			<td><?php echo $payroll_deduction_res['id'] ?></td>
			<td><?php echo $payroll_deduction_res['name'] ?></td>
			<td><?php echo $percentage; ?></td>
			<td style="text-align:right">
			<?php 
			
	    if($app_salary_date==''){
			if($percentage > 0)
			{
				$values = ($percentage * $salary_amount/100) ;
				echo $values;
			}
			else
			{ 
				echo $values=0; 
			}	
	    }	else {
             
			if($percentage > 0)
			{
				$values = ($percentage * $app_salary/100) ;
				echo $values;
			}
			else
			{ 
				echo $values=0; 
			}
		}			
			?>
			</td>
			</tr>					
			<?php

			$grand_tot =$grand_tot+$values;
			}
			?>
			<tr><td colspan="3">Total</td><td style="text-align:right"><?php echo $grand_tot; ?></td></tr>
			</tbody>
			</table>
			</div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col (left) -->
          <div class="col-md-6">
            <div class="card card-primary">
				<div class="card-header">
				<h3 class="card-title">Deductions</h3>
				</div>
				<div class="card-body">
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
<script>
function scale_changes(v)
{
	/* var salary_amount = document.getElementById("staff_salary_amount").value; */
	var salary_amount = $('#staff_salary_amount').val();
	//console.log(salary_amount);
	
	$.ajax({
		type:"GET",
		url:"/ssinfo1/qvision/Recruitment/staff/staff_salary/staff_earnings_view.php?earning_id="+v+"&salary_amount="+salary_amount,
		success:function(data)
		{
			$('#earning_body').html(data);
		}
	}); 
}
</script>
<script>
 function staff_salary_save()
{
	var id=$('#staff_id').val;
	var data = $('form').serialize();
	$.ajax({
	type:'GET',
	data: data + "&" + "id="+id,
	  url:"/ssinfo1/qvision/Recruitment/staff/staff_salary/staff_salary_update.php",
		success:function(data)
		{
			if(data==0)
			{
				alert("Not Created Deduction Master");
				
			}       
			else
			{
				alert("Created Deduction Master");
				staff_list();
			}	
		}
	}); 
}
</script>
