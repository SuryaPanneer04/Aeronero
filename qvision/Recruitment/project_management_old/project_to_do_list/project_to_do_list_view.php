<?php
require '../../../../config.php';
include("../../../../user.php");
$userrole=$_SESSION['userrole'];

?>

<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<i class="fa fa-table"></i> Project To Do List View
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>
<br>
<br>

<div class="card-body">
<div class="tab-content">

    <div class="active tab-pane" id="example">
    <form method="POST" enctype="multipart/form-data" action="/qvision/Recruitment/project_management/project_to_do_list/project_to_do_list_view_submit.php">
	<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">

    <!-- Post -->
 <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
        <!--tr>
        <td><center><img src="../../Recruitment/image/userlog/quadsel.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
        <td colspan="5"><center><b>Bluebase Software Services Private Limited</b></center></td>
        </tr-->
      
        <tr>
        <td colspan="6"><center><b>Project To Do List</b></center></td>
        </tr>
		
        
		
<tr>
 <td>Assigned By:</td>
	 <td colspan="2">
		<input type="text" class="form-control" id="assigned_by" name="assigned_by"  readonly ></td>

</tr>
        
      <tr>
<td>Project Name:</td>
<td colspan="2">
<input type="text" class="form-control" id="project_name" name="project_name"  readonly></td>

</tr>
 <tr>
<td>Modules:</td>
<td colspan="2">
<input type="text" class="form-control" id="modules" name="modules"  readonly></td>

</tr>
 <tr>
<td>No Of Working Hours:</td>
<td colspan="2">
<input type="text" class="form-control" id="no_of_working_hours" name="no_of_working_hours"  readonly></td>

</tr>	
<tr>
<td>Date:</td>
<td colspan="2">
<input type="date" class="form-control" id="date" name="date"  readonly></td>

</tr>	
		<tr>
<td>Status:</td>
<td colspan="2">
<select id="status" name="status"  class="form-control" onclick="openForm()">
				<option value="1">-- Completed --</option>

		<option value="2">-- Pending Reson--</option>

		</select></td>
		  		  
		</TR>
		
	   </TABLE>
          					<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">

</form>

		<div class="form-popup" id="myForm">
		  <form action="" class="form-container">

			<label for="email"><b>Pending Reason</b></label>
			<input type="text" placeholder="Enter Remark" name="remark" id ="remark" required>

		  </form>
		</div>


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
<script>
		function back()
    {
    $.ajax({
    type:"POST",
    url:"/qvision/Recruitment/project_management/project_to_do_list/project_to_do_list.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  </script>
 <script>
function openForm() {
	var status    = document.getElementById("status").value;
	if(status=='1'){
       document.getElementById("myForm").style.display = "none";
    }else{
	  document.getElementById("myForm").style.display = "block";
	}
}
function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
<script>
function pending()
{
	alert()
	//var data  = $('form').serialize();
	var pending    = document.getElementById("pending").value;
	var remark    = document.getElementById("remark").value;
	alert(pending)
    alert(remark)
 	$.ajax({
	type:'POST',
	data:"pending="+pending+'&remark='+remark,
	url:"qvision/Recruitment/project_management/project_to_do_list/project_to_do_list_view_submit.php",
	success:function(data)
	{      
		alert("Remarks Successfully");
		    pending_remarks();
				  
	}       
	}); 
}
</script>
 

	<script>
            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
