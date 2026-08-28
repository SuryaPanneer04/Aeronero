<?php
require '../../connect.php';
?>

<div class="content-wrapper" id="main_content">
<div class="container-fluid">
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i>Leave Availability Master
	  <input type="button" style="float:right;" class="btn btn-warning" name="back" value="BACK" onclick="leave_management()">
	  </div>
    <div class="card-body">
	<h2><b>  Leave Availability - Employee </b></h2>
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
			<label for="balance_leave" class="col-sm-2 col-form-label">Balance Leave</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="balance_leave" name="balance_leave" placeholder="No of Days.." readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="type" class="col-sm-2 col-form-label">Leave Counts</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="count" name="count" placeholder="Type.." readonly>
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
    url:"/qvision/leave_management/main.php",
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
    url:"/qvision/leave_management/check_leave.php",
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
		url:'/qvision/leave_management/Leave_new_submit.php',
		success:function(data)
		{
			if(data==0)
			{
				alert("Created Leave Master");
				leave_management();
			}
			else
			{
				alert("Not Created Leave Master");
				leave_management();
			}	
		}       
	});
	}
}
</script>
