<?php
require '../../connect.php';
Session_start();
$userrole = $_SESSION['userrole'];
$user_id=$_SESSION['userid'];
$candidateid=$_SESSION['candidateid'];
?>
<!DOCTYPE html>
<html>
<head>


</head>
<div id="table_view">
     </div>
<div  class="card card-primary">
       <div class="card-header" style="background-color: #f1cc61; !important">
<h3 class="card-title"><font size="5">Staff Leave List</font></h3>

</div>

<div class="card-body">
<div class="table-responsive">
<form method="POST" id="fupform" autocomplete="off">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	<thead>
	<th>SL.No</th>
	<th>Emp Name</th>
	<th>Leave Date</th>
	<th>Leave Type</th>
	<th>Leave Reason</th>
	<th>Status</th>
	
	
	</thead>
 <tbody>
        
     
      
 <?php
	$leave_ddate=date('d-m-Y');
	if($candidateid == 4){

	$leave=$con->query("SELECT * FROM leave_apply_masters ORDER BY id desc");
	
	}
	else{
		$leave=$con->query("SELECT * FROM leave_apply_masters where candid_id='$candidateid' ORDER BY id desc");
	}
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
      $leave_reason=$emp['leave_reason'];
	  $status=$emp['status'];
	  if($status == 1){
		  $statuss="Pending";
	  }
	  elseif($status == 2){
		  
		  $statuss="Approved";
	  }
	elseif($status == 3){
		  
		  $statuss="Rejected";
	  }

	 ?>
	 <tr>
	<td><?php echo $cnt;?>.</td>
	<td><?php echo $emp_name; ?></td>		
	<td><?php echo $leave_date; ?></td>
	<td><?php echo $leavetype; ?></td>
	<td><?php echo $leave_reason; ?></td>
	<td><b><?php echo $statuss; ?></b></td>
		
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
	url:"Leave_Management/leave_request/leave_approve_update.php",
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
	url:"Leave_Management/leave_request/leave_reject_update.php",
	success:function(data)
	{      
		alert("Leave Request Rejected");
		   leave_management()
				  
	}       
	}); 
}
</script>
 