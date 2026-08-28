	<?php
	require '../../connect.php';
	?>

<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
</style>	
	<div  class="card card-primary">
    <div class="card-header">
	<div class="col-lg-12">
	<h4>Salary Details View</h4>
	</div>
    <div class="panel-body">
	<form method="GET" name="payslip_inputs" role="form">
		<div class="row">
		
		<div class="col-lg-2">
		<div class="form-group">
		<select class="form-control" name="payroll_id">
		<option value="0">-- Select Month --</option>
		<?php
		$staff_payroll_sql=$con->query("select id,month,year,flag from payroll_master where flag in (2,3)");
		while($staff_payroll_res=$staff_payroll_sql->fetch(PDO::FETCH_ASSOC))
		{
		?>
		<option value="<?php echo $staff_payroll_res['id']; ?>"><?php echo $staff_payroll_res['month'].'-'.$staff_payroll_res['year']; ?></option>
		<?php
		} 
		?>
		</select>
		</div>
		</div>
		
		<div class="col-lg-2">
		<div class="form-group">
		<select class="form-control" name="department">
		<option value="0">-- Select Department --</option>
		<?php
		$dep_sql=$con->query("SELECT id, dept_name, status FROM z_department_master");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
		?>
		<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
		<?php
		}
		?>
		</select>
		</div>		
		</div>
		
		<div class="col-lg-2">
		<div class="form-group">		
		<input  type="button" class="btn btn-default" value="search" onclick="payslip_view()">
		</div>
		</div>
		
		</div>
	</form>
	</div>
    </div>
  <!-- /.card-header -->
    <div class="card-body">
      <div id="salary_details_view" style="overflow-x: scroll !important;">
      </div>
    </div>
    <!-- /.card-body -->
  </div>

	
<script>
function payslip_view()
{
	var data = $('form').serialize();
	$.ajax({
	type: "GET",
	url: "/ssinfo1/Qvision/salary_details/salary_details_view.php",
	data:  "id="+ 1,  data,
	success: function(data)
	{
	$("#salary_details_view").html(data);		
	}				
	});	
}
</script>