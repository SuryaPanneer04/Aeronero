<?php
require '../connect.php';
?>

<div class="content-wrapper" id="main_content">
<div class="container-fluid">
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i>Apply Leave Master
	  <input type="button" style="float:right;" class="btn btn-warning" name="back" value="BACK" onclick="leave_management()">
	  </div>
    <div class="card-body">
	<h2><b> Add Leave Request - Employee </b></h2>
	 <form method="POST">
		  <div class="form-group row">
			<label for="employee" class="col-sm-2 col-form-label">Employee Name</label>
			<div class="col-sm-4">
			  <select class="form-control" id="employee" name="employee" placeholder="Employee" onchange="leave_check(this.value)">
			  <option value=""> CHOOSE Employeee </option>
			 <?php $stmt = $con->query("SELECT id,user_name,leave_type FROM y_masters_employee where status=1");
					while ($row1 = $stmt->fetch()) {?>
					 <option value="<?php echo $row1['id']; ?>"> <?php echo $row1['user_name']; ?> </option>
				<?php } ?>
				</select>
			</div>
			<label for="type" class="col-sm-2 col-form-label">Leave Counts</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="count" name="count" placeholder="Type.." readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="balance_leave" class="col-sm-2 col-form-label">Balance Leave</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="balance_leave" name="balance_leave" placeholder="No of Days.." readonly>
			</div>
			<label for="Leave" class="col-sm-2 col-form-label">Leave Type</label>
			<div class="col-sm-4">
			  <select class="form-control" id="leave_type" name="leave_type" placeholder="Leave Type">
			  <option value=""> CHOOSE Leave Type </option>
			 <?php $stmt = $con->query("SELECT * FROM master_leave where status=1");
					while ($row = $stmt->fetch()) {?>
					 <option value="<?php echo $row['id']; ?>"> <?php echo $row['leave_name']; ?> </option>
				<?php } ?>
				</select>
			</div>
		  </div>
		  <div class="form-group row">
		  <label for="from" class="col-sm-1 col-form-label">From Date</label>
		  <div class="col-sm-3">
		  <input type="date" class="form-control" name="from_date">
		  </div>
		  <label for="to" class="col-sm-1 col-form-label">To Date</label>
		  <div class="col-sm-3">
		  <input type="date" class="form-control" name="to_date">
		  </div>
		 <label for="noofdays" class="col-sm-1 col-form-label">No of Days</label>
		  <div class="col-sm-3">
		   <input type="number" class="form-control" name="no_of_days" placeholder="No of Days">
		  </div>
		  </div>
		  <div class="form-group row">
		  <label for="Reason" class="col-sm-2 col-form-label">Reason For Leave : </label>
		  <div class="col-sm-10">
		   <input type="text" class="form-control" name="reason" placeholder="Reason for Leave">
		  </div>
		  </div>
		  <div class="form-group row">
		  <label for="Reason" class="col-sm-2 col-form-label">Contact Address (optional): </label>
		  <div class="col-sm-4">
		   <input type="text" class="form-control" name="address" placeholder="Contact Address">
		  </div>
		   <label for="number_contact" class="col-sm-2 col-form-label">Contact Phone (optional): </label>
		  <div class="col-sm-4">
		   <input type="text" class="form-control" name="phone" placeholder="">
		  </div>
		  </div>
		  <div class="form-group row">
		   <label for="Reason" class="col-sm-2 col-form-label">Approver Name : </label>
		  <div class="col-sm-10">
		   <input type="text" class="form-control" name="approver_name" placeholder="Approver Name">
		  </div>
		  </div>
		  <br>
		  <div class="form-group row">
			<div class="col-sm-10"></div>
			<div class="col-sm-2">
			  <input type="button" class="btn btn-primary btn-md" onclick="Leave_create()" value="Confirm">
			</div>
		  </div>
	</form>
    </div>
  </div>
</div>
</div>
<script>
function leave_management()
{
  $.ajax({
    type:"POST",
    url:"HRMS/leave_management/main.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function leave_check(value)
{
  $.ajax({
    type:"GET",
    data:"value="+value,
    url:"HRMS/leave_management/check_leave.php",
    success:function(data){
		var split=data.split("-");
      $('#balance_leave').val(split[1]);
      $('#count').val(split[2]);
    }
  })
}
function Leave_create()
{
	var confirms=confirm("Are you want apply leave..!");
	if(confirms ==  true){
	var field=1;
	var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data: data + "&" + "field="+field,
		url:'HRMS/leave_management/Leave_new_submit.php',
		success:function(data)
		{
			if(data==0)
			{
				alert("Created Leave Master");
				employee_leave();
			}
			else
			{
				alert("Not Created Leave Master");
				employee_leave();
			}	
		}       
	});
	}
}
</script>
