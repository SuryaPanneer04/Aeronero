<?php
require '../../connect.php';

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
              <h3 class="card-title"><font size="5">Leave Master</font></h3>
			<a onclick="leave_mapping_add()"  style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i>  Add </a>
			
              </div>
<body>
<div class="card-body">
	<table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
<table style="width:100%">
	<thead>
	<th>id</th>
	<th>leave_id</th>
	<th>from_date</th>
	<th>to_date</th>
	<th>days_per_month </th>
	<th>days_per_year</th>
	<th>is_cummulative</th>
	<th>status</th>
	
	
	</thead>
 <tbody>
        
     
      
 <?php
	$leave=$con->query("SELECT * FROM leave_master_mapping");
	$cnt=1;
	while($leave_master_mapping = $leave->fetch(PDO::FETCH_ASSOC))
	{
     
	 ?>
	 <tr>
	<td><?php echo $cnt;?>.</td>
	<td><?php echo $leave_master_mapping['leave_id']; ?></td>
	<td><?php echo $leave_master_mapping['from_date']; ?></td>
	<td><?php echo $leave_master_mapping['to_date']; ?></td>
	<td><?php echo $leave_master_mapping['days_per_month']; ?></td>
	<td><?php echo $leave_master_mapping['days_per_year']; ?></td>
	<td><?php echo $leave_master_mapping['is_cummulative']; ?></td>
	
	<td>
	<?php 
	if($leave_master_mapping['status'] ==1)
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
	<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $leave_master_mapping['id']; ?>" onclick="leave_mapping_edit(<?php echo $leave_master_mapping['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
	function leave_mapping_add()
    {
		$.ajax({
		type:"POST",
		url:"Leave_Management/leave_mapping/leave_mapping_add.php",
		success:function(data){
		 $("#table_view").html(data);
		}
		})
	}
	 function leave_mapping_edit(v){
		$.ajax({
		type:"POST",
		url:"Leave_Management/leave_mapping/leave_mapping_edit.php?id="+v,
		success:function(data)
		{
			 $("#table_view").html(data);
		}
		})
	}
</script>
 