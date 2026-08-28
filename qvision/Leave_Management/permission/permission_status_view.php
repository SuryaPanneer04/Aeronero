<?php
Session_start();
require '../../../connect.php';

$userrole = $_SESSION['userrole'];

?>
<!DOCTYPE html>
<html>
<head>


</head>
<div id="table_view">
     </div>
<div  class="card card-primary">
       <div class="card-header" style="background-color:#ff8b3d !important;">
<h3 class="card-title"><font size="5">Permission Approve</font></h3>

</div>

<div class="card-body">
<div class="table-responsive">
<form method="POST" id="fupform" autocomplete="off">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	<thead>
	<th>SL.No</th>
	<th>Emp Name</th>
	<th>Per_Hour</th>
	<th>To_hour</th>
	<th>Date</th>
	<th>Reason</th>
	<th>Action</th>
	
	
	</thead>
 <tbody>
        
     
      
 <?php
	$leave=$con->query("SELECT * FROM `permission_apply` WHERE (status='1' or status='2' or status='3') ORDER BY id desc");
	
	$cnt=1;
	while($emp = $leave->fetch(PDO::FETCH_ASSOC))
	{
		$candid_id=$emp['candid_id'];
		
		$empnameget=$con->query("SELECT * FROM `staff_master` WHERE candid_id='$candid_id'");
		$empy_name = $empnameget->fetch(PDO::FETCH_ASSOC);
     //$date=date('d-m-Y');

     
	 //$id=$emp['id'];
     $emp_name=$empy_name['emp_name'];
	 
     $hrs_from=$emp['per_from'];
	 $hrs_to=$emp['per_to'];
	$dateper=$emp['per_date'];
     $leave_reason=$emp['reason'];
     
	 
	 ?>
	 <tr>
	<td><?php echo $cnt;?>.</td>
	<td><?php echo $emp_name; ?></td>		
	<td><?php echo $hrs_from; ?></td>
	<td><?php echo $hrs_to; ?></td>
	<td><?php echo "Requested on ".$dateper; ?></td>
	<td><?php echo $leave_reason; ?></td>
	
	<td>
	<?php
	if($emp['status']==1)
	{
	?>
		<label style="color:orange;font-size:18px;font-weight:600;">Waiting For Approval</label>
	<?php
	}
	else if($emp['status']==2)
	{
		?>
		<label style="color:green;font-size:20px;font-weight:600;">Approved</label>
		<?php
	}
	else if($emp['status']==3)
	{?>
		<label style="color:red;font-size:20px;font-weight:600;">Rejected</label>

	<?php }?>
	</td>
		
	</tr>
	<?php
	$cnt=$cnt+1;
	}
	?>
	</tbody>
	</table>
	</form>
     </div>
     </div>


<script>


function update_leave(status,leave,candid_id)
{
//alert(candid_id)
//alert(leave)

 	$.ajax({
	type:'GET',
	data: 'status='+status+'&leave='+leave+'&candid_id='+candid_id,
	url:"qvision/Leave_Management/leave_request/leave_approve_update.php",
	success:function(data)
	{      
		alert("Leave Approved Successfully");
		   leave_management()
				  
	}       
	}); 
}
function reject_leave(status,leave)
{


 	$.ajax({
	type:'GET',
	data: 'status='+status+'&leave='+leave,
	url:"qvision/Leave_Management/leave_request/leave_reject_update.php",
	success:function(data)
	{      
		alert("Leave Request Rejected");
		   leave_management()
				  
	}       
	}); 
}
</script>
 