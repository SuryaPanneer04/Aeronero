<?php
require '../../connect.php';
Session_start();
$userrole = $_SESSION['userrole'];

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
	<th>Emp_name</th>
	<!--<th>Department</th>-->
	<th>Date</th>
	<th>Action</th>
	
	
	</thead>
 <tbody>
        
     
      
 <?php
	$leave_ddate=date('d-m-Y');

	$leave=$con->query("SELECT * FROM daily_attendence where status=2  ORDER BY id");
	
	//echo "SELECT * FROM leave_apply_masters where status=1 ORDER BY id";
	$cnt=1;
	while($emp = $leave->fetch(PDO::FETCH_ASSOC))
	{
     $date=date('d-m-Y');

     $candid_id=$emp['candid_id'];
	 $id=$emp['id'];
     $emp_name=$emp['emp_name'];
     $req_date=$emp['date'];

     
	 
	 ?>
	 <tr>
	<td><?php echo $cnt;?>.</td>
	<td><?php echo $emp_name; ?></td>		
	<!--<td>< ?php echo $emp_name; ?></td>-->		
	<td><?php echo $req_date; ?></td>
	<td><?php echo ""; ?></td>

		
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
 