<?php
require '../../../connect.php';

?>
<!DOCTYPE html>
<html>
<head>
 <style>
/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}
.btn-danger {
    background-color: #1da348;
    border-color: #1da348;
}
/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 400px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 25px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
   
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
 
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>

</head>
<div id="table_view">
     </div>
<div  class="card card-primary">
       <div class="card-header">
<h3 class="card-title"><font size="5">Leave Approve List</font></h3>
</div>

<div class="card-body">
<div class="table-responsive">
<form method="POST" id="fupform" autocomplete="off">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	<thead>
	<th>SL.No</th>
	<th>Emp_code</th>
	<th>Emp_name</th>
	<th>Date</th>
	<th>Action</th>
	
	
	</thead>
 <tbody>
        
     
      
 <?php
	$leave=$con->query("SELECT * FROM leave_apply_masters where status=2");
	$cnt=1;
	while($emp = $leave->fetch(PDO::FETCH_ASSOC))
	{
     $date=date('d-m-Y');
	 $emp_code=$emp['emp_code'];
     $candid_id=$emp['candid_id'];
	 
	 ?>
	 <tr>
	<td><?php echo $cnt;?>.</td>
	<td><?php echo $emp_code; ?></td>
	<td><?php echo $emp['emp_name']; ?></td>
	<td><?php echo $date; ?></td>
	<td>
	<input type="hidden" class="btn btn-danger" id="value" name="value"  value="2">
	<input type="button" class="btn btn-danger" id="save" name="save"  onclick="views_leave(<?php echo $candid_id;?>)"  value="View">
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
              <!-- /.card-body -->
     </div>
<div class="form-popup" id="myForm">
		  <form action="" class="form-container">
			<h3>Leave Remark</h3>

			<label for="email"><b>Remark</b></label>
			<input type="text" placeholder="Enter Remark" name="remark" id ="remark" required>
          
			<button type="button" class="btn" id="popup" onclick="insert_remark()">Submit</button>
			<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
		  </form>
		</div>

<script>


function views_leave(status)
{


 	$.ajax({
	type:'GET',
	data:"status="+status,
	url:"Leave_Management/leave_request/leave_status_view.php",
	success:function(data)
	{      
		//alert("Marked as Leave");
		   //leave_management()
				  
	}       
	}); 
}
</script>
 