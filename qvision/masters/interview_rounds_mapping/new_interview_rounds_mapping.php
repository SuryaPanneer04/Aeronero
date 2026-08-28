<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>

<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
</style>

<div  class="card card-primary">

  <div class="card-header">
    <center><h3 class="card-title"><b>Add Round</b></h3></center>
	<a onclick="back_map()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"></i>Back</a>
   </div>

<form method="POST" > <!--action="qvision/masters/interview_rounds_mapping/interviewroundsmapping_submit.php" -->
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td>Round ID</td>
<td colspan="2"><select class="form-control" name="round_id">
		<option value="0">-- Select Round ID --</option>
		<?php
		$dep_sql=$con->query("SELECT * FROM interview_rounds");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['name']; ?></option>
			<?php
		}
		?>
		</select></td>

</tr>
<tr>
<td>Person Name:</td>
<td colspan="2"><select class="form-control" name="person_name">
		<option value="0">-- Select Person Name --</option>
		<?php
		$dep_sql=$con->query("SELECT * FROM staff_master");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['emp_name']; ?></option>
			<?php
		}
		?>
		</select></td>
</tr>


<tr>
<td>Status</td>
<td colspan="2">
<select class="form-control" name="status" id="status">
<option value="">Select Status</option>
<option value="1">Active</option>
<option value="0">InActive</option>
</select>
</td>
</tr>
</table>
<input type="button" name="submit" value="Submit" class="btn btn-success btn-md" style="float:right;" onclick="add_interview_mapping()">
</form>
	</div>

<script>
		function back_map()
    {
     interview_rounds_mapping();
  }
  
 function add_interview_mapping()
 {
	var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data: data,
    url:'qvision/masters/interview_rounds_mapping/interviewroundsmapping_submit.php',	
    success:function(data)
    	{
			if(data==0)
		{
			alert("Entry Failed");
			 interview_rounds_mapping();
		}
		else
		{
			alert("Entry Successfully");
			 interview_rounds_mapping();
		}
		}
    });
 }
  </script>