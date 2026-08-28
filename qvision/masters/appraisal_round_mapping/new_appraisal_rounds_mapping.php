<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>

<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<div  class="card card-primary">
 <div class="card-header">
    <h3 class="card-title"><font size="5">ADD ROUND</font></h3>
<a onclick="back_map()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"> </i>Back</a>
			
              </div>
              <!-- /.card-header -->
              <div class="card-body">
<form method="POST" action=" qvision/masters/appraisal_round_mapping/appraisalroundsmapping_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
		 
    <table id="example1" class="dataTables-example table table-bordered">
    <tr>
<td>Round ID</td>
<td colspan="2"><select class="form-control" name="round_id">
		<option value="0">-- Select Round ID --</option>
		<?php
		$dep_sql=$con->query("SELECT * FROM appraisal_rounds");
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
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
	 
    </div>
</div>
</form>


<script>
		function back_map()
    {
     appraisal_round_mapping();
  }
  </script>