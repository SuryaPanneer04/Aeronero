<?php
require '../../config.php';

?>
<!DOCTYPE html>
<html>
<head>
<style>
	table, th, td {
	border: 1px solid black;
	border-collapse: collapse;
}
</style>
</head>
<div  class="card card-primary">
       <div class="card-header">
<i class="fa fa-table"></i>  leave master
<input type="button" style="float:right;" class="btn btn-warning" name="new" value="ADD" onclick="leave_master_add()">
</div>

<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	<thead>
	<th>id</th>
	<th>from_date</th>
	<th>leave_name</th>
	<th>days_per_month </th>
	<th>days_per_year</th>
	<th>is_cummulative</th>
	<th>status</th>
	
	
	</thead>
 <tbody>
        
     
      
 <?php
	$leave=$con->query("SELECT * FROM leave_master");
	$cnt=1;
	while($leave_master = $leave->fetch(PDO::FETCH_ASSOC))
	{
     
	 ?>
	 <tr>
	<td><?php echo $cnt;?>.</td>
	<td><?php echo $leave_master['from_date']; ?></td>
	<td><?php echo $leave_master['leave_name']; ?></td>
	<td><?php echo $leave_master['days_per_month']; ?></td>
	<td><?php echo $leave_master['days_per_year']; ?></td>
	<td><?php echo $leave_master['is_cummulative']; ?></td>
	
	<td>
	<?php 
	if($leave_master['status'] ==1)
	{	  
		echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	?>
	<?php 
	}
	else 
	{
		echo '<span style="color:red;text-align:center;"><b>INActive</b></span>';	  
	}
	?>


	</td>
	
    
	<td>
	<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $leave_master['id']; ?>" onclick="leave_master_edit(<?php echo $leave_master['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
	</td>
	</tr>
	<?php
	$cnt=$cnt+1;
	}
	?>
	</tbody>
	</table>
	<div id="table_view">
     </div>
     </div>
              <!-- /.card-body -->
     </div>

<script>
	function leave_master_add()
    {
		$.ajax({
		type:"POST",
		url:"Leave_Management/leave_master/leave_master_add.php",
		success:function(data){
		 $("#table_view").html(data);
		}
		})
	}
	 function leave_master_edit(v){
		$.ajax({
		type:"POST",
		url:"Leave_Management/leave_master/leave_master_edit.php?id="+v,
		success:function(data)
		{
			 $("#table_view").html(data);
		}
		})
	}
</script>
 