<?php
require '../../../../config.php';
include("../../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<!--div class="container-fluid"-->
<div class="card mb-3">

<form method="POST"  action="qvision/Recruitment/project_management/project_schedule/project_schedule_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<div class="row">
						 <!--div class="col-lg-12"-->
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>


          </div>
                        <!-- /.col-lg-12 -->
                    <!--/div>
</tr>
<tr>
<td><center><img src="../../Recruitment/image/userlog/quadsel.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software Services Private Limited</b></center></td>
</tr>
<tr>
<td>Modules:</td>
<td colspan="2">
<input type="text" class="form-control" id="modules" name="modules" ></td>
			  </td>
</tr>
<tr>
<td>Employees:</td>
<td colspan="2">
<input type="text" class="form-control" id="employees" name="employees" ></td>
</tr>


<tr>
<td>No of Working Hours:</td>
<td colspan="2">
<input type="text" class="form-control" id="no_of_working_hours" name="no_of_working_hours" ></td>
</tr>
<tr>
<td>Date:</td>
<td colspan="2">
<input type="date" class="form-control" id="date" name="date" ></td>
 <td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
      <input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove">
</tr>
</table>
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form-->
<!--form action="" method="post" enctype="multipart/form-data"-->

 <table class="table table-bordered">
		<TR>
		  <TH>
			<INPUT type="checkbox" name="select-all" id="select-all" onclick="toggle(this);">
		  </TH> 
		  <th>Client</th>
		  <th>Project Name</th>
		  <th>Modules</th>
		  <TH>Employees</TH>
		  <th>No Of Working Hours</th>
		  <th>Date</th>

		</TR>
		</table>
		
		
			<table class="table table-bordered" id="new_tab">
			<TR>
			<TD>
			<INPUT type="checkbox" name="chk[]">
			</TD>
			<TD>
			<select id="client_1" name="client_1[]" onchange="getProject_data(1,this.value)" class="form-control" >
			<option value="all">All</option>
			<?php
			$dep_sql=$con->query("SELECT * FROM client_master");
			while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
			{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['client_name']; ?></option>
			<?php
			}
			?>
			</select></td>
			<TD>
			<select id="project_name_1" name="project_name_1[]" onchange="getModules_data(1,this.value)" class="form-control">
			</select>
			</td>


			<TD>
			<select id="modules_1" name="modules[]" onchange="getemp_data(1,this.value)" class="form-control">
			</select>
			</td>

			<TD>
			<select  name="employees[]" id="employees_1" onchange="gethrs_data(1,this.value)" class="form-control" >
			</select>
			</td>			
			<td>
			<select id="no_of_working_hours_1" name="no_of_working_hours[]" class="form-control"></td>
			<td>
			<input type="date" id="date" name="date[]" class="form-control"></td>


			
			<td>
			</td>
			</tr>
			</TR>
			</TABLE>
			
			<table>
			<tr>
			<td>
			<input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="append()" value="Add">
			<input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove">
			</td>
			</tr>
			</table>
			
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">

</form>
<script>
/*function project_submit()
    {
    $.ajax({
    type:"POST",
    url:"/qvision/Recruitment/project_management/project/project_submit.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }*/
		function back()
    {
    $.ajax({
    type:"POST",
    url:"/qvision/Recruitment/project_management/project_schedule/project_schedule.php",
    success:function(data){
    $(".main_content").html(data);
    }
    })
  }
  </script>
 

   <script>
		  function getProject_data(v,c){
			  alert(v);
			  //var client_id=document.getElementById('client_'+v).value;
			    //document.getElementById("demo").innerHTML = "You selected: " + client_id;

			  $.ajax({
				  type: "GET",
					url: "/qvision/Recruitment/project_management/project_schedule/find_project.php?client_id="+c,
					success: function(data){
					$("#project_name_"+v).html(data);
					}
					});

		  }
		  </script>
		   <script>
		  function getModules_data(v,c){
			  alert(v);
			  //var project_id=document.getElementById('project_name_'+v).value;
			  $.ajax({
				url: "/qvision/Recruitment/project_management/project_schedule/find_modules.php?project_id="+c,
				type: "GET",
				//data: {
				//project_id: project_id
				//},
				//cache: false,
				success: function(data){
				$("#modules_"+v).html(data);
				}
				});

		  }
		  </script>
	 <script>
		  function getemp_data(v,c){
			  alert(v);
			 // var project_id=document.getElementById('modules_'+v).value;
			  $.ajax({
url: "/qvision/Recruitment/project_management/project_schedule/find_emp.php?project_id="+c,
type: "GET",
//data: {
//project_id: project_id
//},
//cache: false,
success: function(data){
$("#employees"+v).html(data);
}
});

		  }
		  </script>
		   <script>
		  function gethrs_data(v,c){
			  alert(v);
			  //var employees_id=document.getElementById('employees_'+v).value;
			  $.ajax({
url: "/qvision/Recruitment/project_management/project_schedule/find_hours.php?project_id="+c,
type: "GET",
//data: {
//employees_id: employees_id
//},
//cache: false,
success: function(data){
$("#no_of_working_hours"+v).html(data);
}
});

		  }
		  </script>
  <script>
  $(document).ready(function() {
$('#client').on('change', function() {

var client_id = this.value;
alert(client_id);
$.ajax({
url: "/qvision/Recruitment/project_management/project_schedule/find_project.php",
type: "POST",	
data: {
client_id: client_id
},
cache: false,
success: function(result){
$("#project_name").html('<option value="">Select Project Name</option>');

}
});
});
});

 $(document).ready(function() {
$('#project_name').on('change', function() {

var client_id = this.value;
alert(client_id);
$.ajax({
url: "/qvision/Recruitment/project_management/project_schedule/find_modules.php",
type: "POST",	
data: {
project_id: project_id
},
cache: false,
success: function(result){
$("#modules").html('<option value="">Select Modules</option>');

}
});
});
});

 $(document).ready(function() {
$('#modules').on('change', function() {

var client_id = this.value;
alert(client_id);
$.ajax({
url: "/qvision/Recruitment/project_management/project_schedule/find_emp.php",
type: "POST",	
data: {
project_id: project_id
},
cache: false,
success: function(result){
$("#employee").html('<option value="">Select Employee</option>');

}
});
});
});


 $(document).ready(function() {
$('#employees').on('change', function() {

var employees_id = this.value;
alert(employees_id);
$.ajax({
url: "/qvision/Recruitment/project_management/project_schedule/find_hours.php",
type: "POST",	
data: {
employees_id: employees_id
},
cache: false,
success: function(result){
$("#no_of_working_hours").html('<option value="">Select No Of Working Hours</option>');

}
});
});
});

  function append() 
    {
    var len=$('#new_tab tr').length;	
    len=len+1; 
     $('#new_tab').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td><select id="client'+len+'" name="client_'+len+'[]" onchange="getProject_data('+len+',this.value)" class="form-control" ><option value="all">All</option><?php $dep_sql=$con->query("SELECT * FROM client_master"); while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC)){ ?><option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['client_name']; ?></option><?php } ?></select></td><td><select id="project_name_'+len+'" name="project_name_'+len+'[]" onchange="getModules_data('+len+',this.value)" class="form-control"></select></td><td><select id="modules_'+len+'" name="modules_'+len+'[]" onchange="getemp_data('+len+',this.value)" class="form-control"></select></td><td><select  name="employees_'+len+'[]" id="employees_'+len+'" onchange="gethrs_data('+len+',this.value)" class="form-control"></select></td><td><select id="no_of_working_hours_'+len+'" name="no_of_working_hours_'+len+'[]" class="form-control"></td></select></td><td><input type="date" class="form-control" id="date_'+len+'"  name="date_'+len+'"></td></tr>'); 
    }
		
	 $('#enquiry_row_remove').click(function(){
    $('input:checkbox:checked.chk').map(function(){
    var id=$(this).val();
    var le=$('#new_tab tr').length;

    if(le==1)
    {
    alert("You Can't Delete All the Rows");
    }
    else
    {
    $('.row_'+id).remove();
    }

    });
    });
	
  </script>
	