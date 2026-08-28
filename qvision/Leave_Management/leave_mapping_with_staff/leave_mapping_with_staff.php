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
              <h3 class="card-title"><font size="5">Leave Mapping with Staff</font></h3>
			<a onclick="leave_mapping_with_staff_add()"  style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i>  Add </a>
			
              </div>
<body>
<div class="card-body">
	<table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
<table style="width:100%">
	<thead>
	<th>ID</th>
	<th>Staff Type id</th>
	<th>Staff Type</th>
	<th>Leave_Type_id </th>
	<th>Leave_Type</th>
	<th>status</th>
	
	
	</thead>
 <tbody>
        
     
      
 <?php
	$leave=$con->query("SELECT * FROM leave_mapping_with_staff");
	$cnt=1;
	while($leave_mapping_with_staff = $leave->fetch(PDO::FETCH_ASSOC))
	{
     
	 ?>
	 <tr>
	<td><?php echo $cnt;?>.</td>
	<td><?php echo $leave_mapping_with_staff['staff_type_id']; ?></td>
	<td><?php echo $leave_mapping_with_staff['staff_type']; ?></td>
	<td><?php echo $leave_mapping_with_staff['leave_type_id']; ?></td>
	<td><?php echo $leave_mapping_with_staff['leave_type']; ?></td>
	
	
	<td>
	<?php 
	if($leave_mapping_with_staff['status'] ==1)
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
	<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $leave_mapping_with_staff['id']; ?>" onclick="leave_mapping_with_staff_edit(<?php echo $leave_mapping_with_staff['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
function leave_mapping_with_staff_add()
	{
		$.ajax({
		type:"POST",
		url:"Leave_Management/leave_mapping_with_staff/leave_mapping_with_staff_add.php",
		success:function(data){
		$("#table_view").html(data);
		}
		})
	}
	 function leave_mapping_with_staff_edit(v){
		$.ajax({
		type:"POST",
		url:"Leave_Management/leave_mapping_with_staff/leave_mapping_with_staff_edit.php?id="+v,
		success:function(data)
		{
			 $("#table_view").html(data);
		}
		})
	}
</script>
 

    </script>