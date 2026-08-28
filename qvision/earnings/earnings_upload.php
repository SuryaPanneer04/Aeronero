	<?php
	require '../../connect.php';
	date_default_timezone_set("Asia/Kolkata");
	$curdate=date("d-m-y");
	
	/* echo $from_dat = '2022-01-01';
	echo $to_dat = '2022-01-31';
	
	$from_date = date("Y-m-d",strtotime($from_dat));
	$to_date = date("Y-m-d",strtotime($to_dat)); */
	
	$year = date("y");
    $month = date("m");
    $day = '30';

    $current_date = new DateTime(date('Y-m-d'), new DateTimeZone('Asia/Kolkata'));
	//print_r ($current_date);exit;
    $end_date = new DateTime("$year-$month-$day", new DateTimeZone('Asia/Kolkata'));
	//print_r ($end_date);
    $interval = $current_date->diff($end_date);
    //echo $interval->format('%a day(s)');
	
	?>
<style>
table th {
	padding:8px;
}
</style>

	<div class="col-12">
	<!-- Default box -->
	<div class="card">
	<div class="card-header">
	<h3 class="card-title">Earnings Upload</h3>
	</div>
	<div class="card-body">
	<a onclick="earnings_add()" style="float: right;" data-toggle="modal" class="btn btn-warning"><i class="fa fa-plus"></i> ADD</a>
	
	</div>
	
	<form role="form" name="area"  method="post" action="/ssinfo1/qvision/earnings/earning_delete.php">
	<table class="table table-striped table-bordered" style="font-family:'Times New Roman', Times, serif">
		<tr>
		<th><input type="checkbox" checked id="classaall"></th>
		<th>Employee Code</th>
		<th>Emp_Name</th>
		<th>Month</th>
		<th>Year</th>
		<th>Special Allowance</th>
		<th>LTA</th>
		<th>Status</th>			
		</tr>
		<?php
		
		$earning_sql="SELECT e.id as earn_id,e.emp_code,e.emp_name,e.payroll_month,e.payroll_year,e.Special_Allowance,e.LTA,e.status,b.prefix_code,b.emp_code as ecode FROM salary_monthly_earning e left join staff_master b on(e.emp_code=b.id) order by e.id ASC	";
		
		//echo "SELECT e.id as earn_id,e.emp_code,e.emp_name,e.payroll_month,e.payroll_year,e.Special_Allowance,e.LTA,e.status,b.prefix_code,b.emp_code as ecode FROM salary_monthly_earning e left join staff_master b on(e.emp_code=b.id) order by e.id ASC	";
	
		$earning_list = $con->query($earning_sql);
		$i=1;
		$total=0;
		while($earn_data = $earning_list->fetch(PDO::FETCH_ASSOC))
		{ 
			?>					
			<tr>
			<td>
			<input type="checkbox" name="earnings_id[]" class="classacheck" checked value="<?php echo $earn_data['earn_id'] ; ?>" >
			</td>
			<td><?php echo $earn_data['prefix_code'] ; ?><?php echo $earn_data['ecode'] ; ?></td>
			<td><?php echo $earn_data['emp_name'] ; ?></td>
			<td><?php echo $earn_data['payroll_month'] ; ?></td>
			<td><?php echo $earn_data['payroll_year'] ; ?></td>
			<td><?php echo $earn_data['Special_Allowance'] ; ?></td>
			<td><?php echo $earn_data['LTA'] ; ?></td>
			<td><?php echo $earn_data['status'] ; ?></td>
			</tr>
			<?php
		}
		?>
		</table>
		<div>
		<input type="submit" class="btn btn-primary" value="Delete Earnings" name="submit">
		</div>
	</form>
	<!-- /.card-body -->
	</div>
	<!-- /.card -->
	</div>
	<script>
		$(document).ready(function ()
		{
			$("#classaall").click(function () {
			$(".classacheck").prop('checked', $(this).prop('checked'));
			});
		});
		
		
	function earnings_add()
    {
	$.ajax({
    type:"POST",
    url:"/ssinfo1/qvision/earnings/earning_add.php",
    success:function(data){
      $("#earning_view").html(data);
    }
     })
   }
	</script>
