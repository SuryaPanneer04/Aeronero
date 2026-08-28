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

/* style for leave date input*/
.leave_date{
	float:right;
}
</style>

</head>
<div id="table_view">
     </div>
<div  class="card card-primary">
       <div class="card-header" style="background-color:#ff8b3d;">
<h3 class="card-title"><font size="5">Staff Leave update</font></h3>
<span class="leave_date"> <input type="date" class="form-control" name="leavedate" id="l_date"  onchange="changedate()"/> </span>
</div>

<div class="card-body">
<div class="table-responsive">
<form method="POST" id="fupform" autocomplete="off">
<table class="dataTables-example table table-bordered" id="leaveUpdateTable" width="100%" cellspacing="0">
	<thead>
	<th>SL.No</th>
	<th>Emp_code</th>
	<th>Emp_name</th>
	<th>Date</th>
	<th>Remark</th>
	<th>Action</th>
	</thead>
   <tbody id="list">
  

	</tbody>
	</table>
	</form>
     </div>
              <!-- /.card-body -->
     </div>
<div class="form-popup" id="myForm" autocomplete="off">
		  <form action="" class="form-container">
			<h3>Leave Remark</h3>

			<label for="email"><b>Remark</b></label>
			<input type="text" placeholder="Enter Remark" name="remark" id ="remark" autocomplete="off" required>
			<input type="hidden" name="candid_id" id ="candid">
			<input type="hidden" name="old_date" id ="old_date">
          
			<button type="button" class="btn" id="popup" onclick="insert_remark()">Submit</button>
			<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
		  </form>
		</div>
<input type="hidden" id="leavetpy" name="leavetpy" value="">
<script>

 function openForm(e,d,leavetype) {
	debugger;
  document.getElementById("myForm").style.display = "block";
  document.querySelector('#candid').value =e;
  document.querySelector('#old_date').value = d;
  document.querySelector('#leavetpy').value = leavetype;
  $('#remark').val('');  
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
  //leave_update()
  changedate()
} 

	function leave_master_add()
    {
		$.ajax({
		type:"POST",
		url:"qvision/Leave_Management/leave_master/leave_master_add.php",
		success:function(data){
		 $("#table_view").html(data);
		}
		})
	}
	 function leave_master_edit(v){
		$.ajax({
		type:"POST",
		url:"qvision/Leave_Management/leave_master/leave_master_edit.php?id="+v,
		success:function(data)
		{
			 $("#table_view").html(data);
		}
		})
	}

function update_leave(status)
{
   var leavetpy=document.getElementById('leavetpy').value;

 	$.ajax({
	type:'GET',
	data: {status: status, leavetype: leavetpy},
	url:"qvision/Leave_Management/leave_request/leave_status_update.php?leavetpy="+leavetpy,
	success:function(data)
	{      
		alert("Marked as Leave");
		   //leave_management()
				  
	}       
	}); 
}



function insert_remark(){
		  var old_date = document.getElementById('old_date').value;
		  var date = document.getElementById('l_date').value;
		  var candid_id = document.getElementById('candid').value;
		  var remark = document.getElementById('remark').value;
		  var leavetpy=document.getElementById('leavetpy').value;
			  $.ajax({
			  type:"GET",
			  data: {remark: remark, candid_id: candid_id, leavedate: date, date: old_date, leavetpy_get: leavetpy},
			  url:"qvision/Leave_Management/leave_request/leave_status_update.php",
			  success:function(data)
			  {
				 // $("#table_view").html(data);
				  alert("Remark Updated")
				  //leave_update()
				  closeForm()
			  }
			  })
		  
				}

function changedate(){
	
	let leavedate = $('#l_date').val()

	$.ajax({
			  type:"GET",
			  data:"leavedate="+leavedate,
			  url:"qvision/Leave_Management/leave_request/leave_update_list.php",
			  success:function(data)
			  {
				  $("#list").html(data);
			  }
			  })
	
}

</script>
 