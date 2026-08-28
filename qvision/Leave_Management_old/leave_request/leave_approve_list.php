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
<h3 class="card-title"><font size="5">Staff Leave Approve</font></h3>

</div>

<div class="card-body">
<div class="table-responsive">
<form method="POST" id="fupform" autocomplete="off">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	<thead>
	<th>SL.No</th>
	<th>Emp Name</th>
	<th>Leave Date</th>
	<th> Leave Type</th>
	<th>Requested on</th>
	<th>Reason</th>
	<th>Action</th>
	
	
	</thead>
 <tbody>
        
     
      
 <?php
	$leave=$con->query("SELECT * FROM leave_apply_masters where (status=1 or status=2 or status=3) ORDER BY id");
	
	//echo "SELECT * FROM leave_apply_masters where status=1 ORDER BY id";
	$cnt=1;
	while($emp = $leave->fetch(PDO::FETCH_ASSOC))
	{
     $date=date('d-m-Y');

     $candid_id=$emp['candid_id'];
	 $id=$emp['id'];
     $emp_name=$emp['emp_name'];
     $from_date=$emp['from_date'];
	 $to_date=$emp['to_date'];
	 if(strtotime($from_date) == strtotime($to_date)){
		 $leave_date=$from_date;
	 }
	 else{
		 $leave_date=$from_date." to ".$to_date;
	 }
	 $leave_type=$emp['leave_type'];
	 if($leave_type == 1){
		 $leavetype="Sick Leave";
	 }
	 elseif($leave_type == 2){
		 $leavetype="Eligible Leave";
	 }
	 elseif($leave_type == 3){
		 $leavetype="Casual Leave";
	 }
	 elseif($leave_type == 4){
		 $leavetype="Loss Of Pay";
	 }
	 else{
		 $leavetype="Emergency Leave";
	 }
     $req_date=$emp['req_date'];
     $leave_type=$emp['leave_type'];
     $emp_code=$emp['emp_code'];
     $leave_reason=$emp['leave_reason'];
     
	 
	 ?>
	 <tr>
	<td><?php echo $cnt;?>.</td>
	<td><?php echo $emp_name; ?></td>		
	<td><?php echo $leave_date; ?></td>
	<td><?php echo $leavetype; ?></td>
	<td><?php echo "Requested on ".$req_date; ?></td>
	<td><?php echo $leave_reason; ?></td>
	
	<td>
	<?php
	if($emp['status']==1)
	{
	?>
	<input type="button" class="btn btn-success" id="save" name="save"  onclick='update_leave("<?php echo $id;?>","<?php echo $leave_type;?>","<?php echo $candid_id;?>")'  value="Leave Approve">
	<input type="button" class="btn btn-danger" id="submit" name="submit"  onclick='reject_leave("<?php echo $id;?>","<?php echo $leave_type;?>")'  value="Reject">
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
 