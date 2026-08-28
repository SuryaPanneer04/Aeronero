<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
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
                
				     <h3 class="card-title"><font size="5">ADD DIVISION DETAILS</font></h3>
		<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
              </div>
			  
			  
<form method="POST" action="qvision/masters/devision_master/divmaster_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td>Department ID</td>
<td colspan="2"><select class="form-control" name="department">
		<option value="0">-- Select Department --</option>
		<?php
		$dep_sql=$con->query("SELECT id, dept_name, status, created_by, created_on FROM z_department_master");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
			<?php
		}
		?>
		</select></td>

</tr>
<tr>
<td>Division Name</td>
<td colspan="2"><input type="text" class="form-control" id="div_name" name="div_name"</td>
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
<input type="submit" name="submit" class="btn btn-dark btn-md" style="float:right;position: relative;left: -5px;">
<br>
<br>
</form>
<script>
function back_ctc()
{
	devision_master();
} 
</script>