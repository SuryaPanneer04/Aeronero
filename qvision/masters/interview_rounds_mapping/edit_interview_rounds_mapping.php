<?php
require '../../../connect.php';
$id=$_REQUEST['id'];

$stmt = $con->prepare("select * from interview_rounds_mapping where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
$rid=$row['round_id'];
$pid=$row['person_name'];
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
<i class="fa fa-table"></i> Interview Rounds Mapping Edit
<a onclick="back_to_map()" style="float: right;" data-toggle="modal" class="btn btn-danger"> <i class="fa fa-minus"></i> Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name=""  method="GET" enctype="multipart/type">
<table class="table table-bordered">
<tr>
<td>Round ID</td>
<td colspan="2">
<select class="form-control" name="round_id">
<?php
$dep_sql1=$con->query("SELECT * FROM interview_rounds where id='$rid' ");

$fet=$dep_sql1->fetch();
?>
		<option value="<?php echo $fet['id'];?>"><?php echo $fet['name'];?></option>
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
<?php
$dep_sql1=$con->query("SELECT * FROM staff_master where id='$pid' ");
$fet=$dep_sql1->fetch();
?>
				<option value="<?php echo $fet['id'];?>"><?php echo $fet['emp_name'];?></option>
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
<?php

if($sta==0)
{
	?>
<option value="0">InActive</option>
<option value="1">Active</option>
<?php	
}
else{
	?>
	<option value="1">Active</option>
	<option value="0">InActive</option>
	<?php
}
?>

</select>
</td>
</tr>
</table>

<input type="button" name="submit" value="Update" class="btn btn-success btn-md" id="<?php echo $id; ?>" onclick="update_rounds(this.id)" style="float:right;">

</form>
</div>
</div>



<script>
		function back_to_map()
    {
     interview_rounds_mapping();
  }
  </script>
  
<script>
function update_rounds(v)
{
	 var id=v;
	var data=$('form').serialize();
	$.ajax({
		type:"GET",
		data: data + "&" + "id="+id,
		url:"qvision/masters/interview_rounds_mapping/update_interview_rounds_mapping.php?id=" +v,
		success:function(data)
		{
			if(data==0)
		{
			alert("Not Updated");
			 interview_rounds_mapping();
		}
		else
		{
			alert("Updated successfully");
			 interview_rounds_mapping();
		}
		}
	}) 
}
</script>