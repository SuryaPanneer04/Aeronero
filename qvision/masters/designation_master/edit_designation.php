<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from designation_master where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
$did=$row['dep_id'];
?>
<style>
.card-primary:not(.card-outline)>.card-header{
background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
.btn-dark{
	background-color: #ed5d00 !important;
    border-color: #ed5d00 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black !important;
}
</style>
<div class="container-fluid">


<div class="card card-primary">
              <div class="card-header">
                
				  <h3 class="card-title"><font size="5">EDIT DESIGNATION DETAILS</font></h3>
		<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
              </div>
			  
<div class="card-body" id="printableArea">
<form role="form" name="" action="" method="GET" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td>Department Id</td>
<td colspan="5">
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>">
<select class="form-control" name="dep_id">
<?php
$dep_sql1=$con->query("SELECT * FROM z_department_master where id='$did' ");
$fet=$dep_sql1->fetch();
?>

		<option value="<?php echo $fet['id'];?>"><?php echo $fet['dept_name'];?></option>
		<?php
		$dep_sql=$con->query("SELECT * FROM z_department_master");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
			<?php
		}
		?>
		</select>
</td>
</tr>
<tr>
<td>Designation Name</td>
<td colspan="5">
<input type="text" class="form-control" id="designation_name" name="designation_name" value="<?php echo  $row['designation_name'];?>">
</td>
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


<input type="button" name="submit" value="Update"class="btn btn-dark btn-md" style="float:right;" onclick="update_designation()">

</form>
</div>
</div>
</div>
<script>
function back_ctc()
{
	designation_master();
} 
</script>
<script>
function update_designation()
    {
    var data = $('form').serialize();
    $.ajax({
    type:"POST",
	data: data,
    url:"qvision/masters/designation_master/update_designation.php",
    success:function()
	{
		alert("Updated Successfully");
		designation_master();
    }
    })
  }
</script>