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
<h3 class="card-title"><font size="5">Leave Rejected List</font></h3>

</div>

<div class="card-body">
<div class="table-responsive">
<form method="POST" id="fupform" autocomplete="off">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	<thead>
	<th>SL.No</th>
	<th>Emp_name</th>

	<th>Date</th>
	<th>Leave Reason</th>
	<th>Approved By</th>
	
	
	</thead>
 <tbody>
        
     
      
 <?php
	$leave_ddate=date('d-m-Y');

	$leave=$con->query("SELECT * FROM  leave_apply_masters where status=2  ORDER BY id");
	
	//echo "SELECT * FROM leave_apply_masters where status=1 ORDER BY id";
	$cnt=1;
	while($emp = $leave->fetch(PDO::FETCH_ASSOC))
	{
     $date=date('d-m-Y');

     $candid_id=$emp['candid_id'];
	 $id=$emp['id'];
     $emp_name=$emp['emp_name'];
     $newDate=$emp['req_date'];
	 $req_date = date("m-d-Y", strtotime($newDate));
     $leave_reason=$emp['leave_reason'];
     $created_by=$emp['created_by'];
$stmt = $con->prepare("SELECT id,first_name FROM candidate_form_details where id='$created_by' ");	
	$stmt->execute(); 
     $row3 = $stmt->fetch();
     $first_name=$row3['first_name'];
	 
	 ?>
	 <tr>
	<td><?php echo $cnt;?>.</td>
	<td><?php echo $emp_name; ?></td>			
	<td><?php echo $req_date; ?></td>
	<td><?php echo $leave_reason; ?></td>
<td><b><span style="color:red;"><?php echo $first_name; ?></span></b></td>
		
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
 