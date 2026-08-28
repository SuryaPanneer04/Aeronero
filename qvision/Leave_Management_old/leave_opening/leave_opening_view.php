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
              <h3 class="card-title"><font size="5">Leave Opening Balance</font></h3>
			<a onclick="leave_opening_add()"  style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i>  Add </a>
			
              </div>
<body>
<div class="card-body">
	<table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
<table style="width:100%">
	<thead>
	<th>ID</th>
	<th>Staff id</th>
	<th>Staff Type id</th>
	<th>Date of Joining </th>
	<th>From Date</th>
	<th>Leave Type id</th>
	<th>Leave Name</th>
    <th>Leave Op Balance</th>
	<th>status</th>
	
	
	</thead>
 <tbody>
        
     
      
 <?php
	$leave=$con->query("SELECT * FROM leave_opening_balance");
	$cnt=1;
	while($leave_opening_balance = $leave->fetch(PDO::FETCH_ASSOC))
	{
     
	 ?>
	 <tr>
	<td><?php echo $cnt;?>.</td>
	<td><?php echo $leave_opening_balance['staff_id']; ?></td>
	<td><?php echo $leave_opening_balance['staff_type_id']; ?></td>
	<td><?php echo $leave_opening_balance['doj']; ?></td>
	<td><?php echo $leave_opening_balance['from_date']; ?></td>
	<td><?php echo $leave_opening_balance['leave_type_id']; ?></td>
	<td><?php echo $leave_opening_balance['leave_name']; ?></td>
	<td><?php echo $leave_opening_balance['leave_op_balance']; ?></td>
	
	
	
	<td>
	<?php 
	if($leave_opening_balance['status'] ==1)
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
	<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $leave_opening_balance['id']; ?>" onclick="leave_opening_edit(<?php echo $leave_opening_balance['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
function leave_opening_add()
	{
		$.ajax({
		type:"POST",
		url:"Leave_Management/leave_opening/leave_opening_add.php",
		success:function(data){
		$("#table_view").html(data);
		}
		})
	}
	 function leave_opening_edit(v){
		$.ajax({
		type:"POST",
		url:"Leave_Management/leave_opening/leave_opening_edit.php?id="+v,
		success:function(data)
		{
			 $("#table_view").html(data);
		}
		})
	}
</script>
 

    </script></script>
<script>
function leave_opening_add()
	{
		$.ajax({
		type:"POST",
		url:"Leave_Management/leave_opening/leave_opening_add.php",
		success:function(data){
		$("#table_view").html(data);
		}
		})
	}
	
	function scale_structure_edit(v)
	{
		alert(v);
	}
    </script>