<?php
require '../../../../connect.php';
include("../../../../user.php");

$staid = $_REQUEST['canid'];

$staffsel=$con->query("select s.*,d.dept_name,de.designation_name,dv.div_name from staff_master s left join z_department_master d on s.dep_id=d.id left join designation_master de on s.design_id=de.id left join division_master dv on s.div_id=dv.id where candid_id='$staid'");
$data1=$staffsel->fetch();
$emp_name=$data1['emp_name'];
$dept_name=$data1['dept_name'];
$div_name=$data1['div_name'];
$designation_name=$data1['designation_name'];
$scale_master_id=$data1['scale_master_id'];
$payroll_deduction_id=$data1['payroll_deduction_id'];
$salary_amount=$data1['salary_amount'];
?>

<div class="col-12">
			<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Staff Salary</h3>
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
                      <input type="text" class="form-control" id="dep_id" value="<?php echo $dept_name; ?>" readonly>
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
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Salary Amount</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="staff_salary_amount" name="staff_salary_amount" value="<?php echo $salary_amount; ?>" readonly>
                    </div>
                  </div> 
                </div>
				
	<div class="row">		
          <!-- /.col (left) -->
			<div class="col-md-12">
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
			
			
			if($payroll_deduction_id === NULL)
			{
				
				$payroll_deduction_sql=$con->query("SELECT id, name, from_date, amount, percentage, min_amount, max_amount, status, created_by, created_on, modified_by, modified_on FROM payroll_deduction_master");
				$i=1;
				
				while($payroll_deduction_res = $payroll_deduction_sql->fetch(PDO::FETCH_ASSOC))
				{
					?>
					<tr>
					<td><input type="checkbox" name="check_list[]" value="<?php echo $payroll_deduction_res['id'] ?>"></td>
					<td><?php echo $payroll_deduction_res['name'] ?></td>
					<td><?php echo $payroll_deduction_res['amount'] ?></td>
					<td><?php echo $payroll_deduction_res['percentage']; ?></td>
					</tr>				
					<?php
				}
			}
			else
			{
				$payroll_deduction_sql=$con->query("SELECT id, name, from_date, amount, percentage, min_amount, max_amount, status, created_by, created_on, modified_by, modified_on FROM payroll_deduction_master WHERE id in ($payroll_deduction_id)");
			
			
			
				$i=1;
				while($payroll_deduction_res = $payroll_deduction_sql->fetch(PDO::FETCH_ASSOC))
				{
					?>
					<tr>
					<td><input type="checkbox" name="check_list[]" value="<?php echo $payroll_deduction_res['id'] ?>" checked></td>
					<td><?php echo $payroll_deduction_res['name'] ?></td>
					<td><?php echo $payroll_deduction_res['amount'] ?></td>
					<td><?php echo $payroll_deduction_res['percentage']; ?></td>
					</tr>				
					<?php
				}
				$payroll_deduction_sql=$con->query("SELECT id, name, from_date, amount, percentage, min_amount, max_amount, status, created_by, created_on, modified_by, modified_on FROM payroll_deduction_master where id not in ($payroll_deduction_id)");
				
				$i=1;
				
				while($payroll_deduction_res = $payroll_deduction_sql->fetch(PDO::FETCH_ASSOC))
				{
					?>
					<tr>
					<td><input type="checkbox" name="check_list[]" value="<?php echo $payroll_deduction_res['id'] ?>"></td>
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
	<button type="reset" class="btn btn-default float-right">Reset</button>
	<input type="button" name="staff_salar_save" value="Save" onclick="staff_deduction_save()" class="btn btn-info">
	</div>
	<!-- /.card-footer -->
	</form>
	</div>

</div>
<script>
 function staff_deduction_save()
{
	var id=$('#staff_id').val();
	var data = $('form').serialize();
	$.ajax({
	type:'POST',
	data: data + "&" + "id="+id,
	  url:'qvision/Recruitment/staff/staff_salary/staff_deduction_update.php',
		success:function(data)
		{
			if(data==0)
			{
				alert("Not Updated");
				staff_list();
			}       
			else
			{
				alert("Updated succesfully");
				staff_list();
				
			}	
		}
	}); 
}
</script>
