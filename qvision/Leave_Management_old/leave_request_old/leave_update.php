<?php
require '../../connect.php';

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
<div class="card-header" style="background-color: #f1cc61; !important">
<h3 class="card-title"><font size="5">Staff Leave update</font></h3>
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
	$leave=$con->query("SELECT candid_id,prefix_code,emp_code,emp_name,status FROM staff_master where status=1 and id<>101 ORDER BY emp_code ASC");
	$cnt=1;
	while($emp = $leave->fetch(PDO::FETCH_ASSOC))
	{
     $date=date('d-m-Y');
	 $code=$emp['prefix_code'];
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
	<input type="button" class="btn btn-danger" id="save" name="save"  onclick="update_leave(<?php echo $candid_id;?>)"  value="Mark as Leave">
	<!--<input type="button" class="btn btn-danger" id="save1" name="save1[]"  onclick="openForm(< ?php echo $candid_id;?>)"  value="Remark">-->
	
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

 function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
} 

function insert_remark()
	  {
		  


	$.ajax({
	type:"GET",
	url:"Leave_Management/leave_request/leave_remark_update.php",
	success:function(data)
	{
		$("#table_view").html(data);
	}
	})

	  }
</script>
<script>
	  $(document).ready(function(){
	
    $("#fupform").on('keyup','#save1',function(){
		var ids = $(this).val();
        var currentRow=$(this).closest("tr"); 
        var eic=currentRow.find("td:eq(1)").html();			
		var wo=currentRow.find("td:eq(2)").html(); 
	alert(eic)
	alert(wo)
       /*   jQuery.ajax({
      url:"Leave_Management/leave_request/leave_remark_update.php",
      type: "GET",
      data: {
		work_order: wo,
		eic: eic
      },
      dataType: "html",
      success: function(data) {
       
      } 
    });     */    
    }); 
});

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

function update_leave(status)
{


 	$.ajax({
	type:'GET',
	data:"status="+status,
	url:"Leave_Management/leave_request/leave_status_update.php",
	success:function(data)
	{      
		alert("Marked as Leave");
		   //leave_management()
				  
	}       
	}); 
}
</script>
 