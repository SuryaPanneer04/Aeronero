	<?php
	require '../config.php';
	date_default_timezone_set("Asia/Kolkata");
	$curdate=date("d-m-y");

	$department_id = $_REQUEST['department_id'];
	$from_date = $_REQUEST['from_date'];
	
	?>
	<div class="col-12">
	<!-- Default box -->
	<div class="card">
	<div class="card-header">
	<h3 class="card-title">Attendance Daily Report</h3>
	</div>
	<div class="card-body">

	<table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
	<thead>
	<th>S.No</th>
	<th>Employee Code</th>
	<th>Employee Name</th>
	<th>Date</th>
	<th>LogTime </th>
	<th>Direction</th>
	<th>LogTime </th>
	<th>Direction</th>
	</thead>
	<tbody>
	<?php
	
	
	$holiday=$con->query("SELECT a.emp_code,c.emp_name,c.candid_id,c.prefix_code,c.dep_id,c.div_id,c.design_id,a.Date,a.LogTime as Intime,a.log_tpye as Indirection,b.LogTime as outtime,b.log_tpye as outdirection from 
	(SELECT emp_code, Date(log_time) as Date, max(log_time) as LogTime, log_tpye, status FROM attendance where Date(log_time) ='$from_date' and log_tpye = 'in')a 
	left JOIN 
	(SELECT emp_code, Date(log_time) as Date, max(log_time) as LogTime, log_tpye, status FROM attendance where Date(log_time) ='$from_date' and log_tpye = 'out')b 
	on 
	a.emp_code=b.emp_code and a.Date=b.Date left join staff_master c on a.emp_code=c.id order by c.prefix_code,a.emp_code");	
	
	
	
	

	
	$cnt=1;
	while($holiday_master = $holiday->fetch(PDO::FETCH_ASSOC))
	{

	?>
	<tr>
	<td><?php echo $cnt;?>.</td>
	<td><?php echo $holiday_master['emp_code']; ?></td>
	<td><?php echo $holiday_master['emp_name']; ?></td>
	<td><?php echo $holiday_master['Date']; ?></td>
	<td><?php echo $holiday_master['Intime']; ?></td>
	<td><?php echo $holiday_master['Indirection']; ?></td>
	<td><?php echo $holiday_master['outtime']; ?></td>
	<td><?php echo $holiday_master['outdirection']; ?></td>
	</tr>
	<?php
	$cnt=$cnt+1;
	}
	?>
	</tbody>
	</table>

	</div>
	<!-- /.card-body -->
	</div>
	<!-- /.card -->
	</div>