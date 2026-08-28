<?php
require '../../../../connect.php';
include("../../../../user.php");

$salary_amount = $_REQUEST['salary_amount'];
$staid = $_REQUEST['canid'];
$scaleif=$_REQUEST['scalid'];



$staffsel=$con->query("select s.*,d.dept_name,de.designation_name,dv.div_name from staff_master s left join z_department_master d on s.dep_id=d.id left join designation_master de on s.design_id=de.id left join division_master dv on s.div_id=dv.id where candid_id='$staid'");

/* echo "select s.*,d.dept_name,de.designation_name,dv.div_name from staff_master s left join z_department_master d on s.dep_id=d.id left join designation_master de on s.design_id=de.id left join division_master dv on s.div_id=dv.id where candid_id='$staid'"; */

$data1=$staffsel->fetch();

$payroll_deduction_id=$data1['payroll_deduction_id'];
//echo $staid."kokokok";
?>
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
