<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from division_master where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
$did=$row['dep_id'];
?>

<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
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
<div class="card card-primary">
              <div class="card-header">
				        <h3 class="card-title"><font size="5">EDIT DIVISION DETAILS</font></h3>
							  <a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
              </div>
<form role="form" name="" action="qvision/masters/devision_master/update_devision.php" method="GET" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td>Department ID</td>
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
<td>Division Name</td>
<td colspan="5">
<input type="text" class="form-control" id="div_name" name="div_name" value="<?php echo  $row['div_name'];?>">
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


<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
<br>
<br>

</form>
</div>
<script>
function back()
{
	devision_master();
} 
</script>