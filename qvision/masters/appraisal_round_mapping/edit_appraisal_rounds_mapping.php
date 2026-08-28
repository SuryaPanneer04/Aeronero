<?php
require '../../../connect.php';
$id=$_REQUEST['id'];
//echo $id;
$stmt = $con->prepare("select * from appraisal_rounds_mapping where id='$id'");
//echo "select * from interview_rounds_mapping where id='$id'";
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
$rid=$row['round_id'];
$pid=$row['person_name'];
?>

<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<div  class="card card-primary">
 <div class="card-header">
    <h3 class="card-title"><font size="5">APPRAISAL ROUNDS MAPPING LIST</font></h3>
<a onclick="back_to_map()" style="float: right;" data-toggle="modal" class="btn btn-primary"> <i class="fa fa-minus"></i> Back</a>
			
              </div>
              <!-- /.card-header -->
              <div class="card-body">
<form method="POST" action=" qvision/masters/appraisal_round_mapping/appraisalroundsmapping_submit.php">		 
    <table id="example1" class="dataTables-example table table-bordered">
<tr>
<td>Round ID</td>
<td colspan="2"><select class="form-control" name="round_id">
<?php
$dep_sql1=$con->query("SELECT * FROM appraisal_rounds where id='$rid' ");
$fet=$dep_sql1->fetch();
?>
		<option value="<?php echo $fet['id'];?>"><?php echo $fet['name'];?></option>
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
<input type="button" name="submit" value="Update" class="btn btn-primary btn-md" id="<?php echo $id; ?>" onclick="update_rounds(this.id)" style="float:right;">
	 
    </div>
</div>
</form>



<script>
	function back_to_map()
    {
     appraisal_round_mapping();
  }
 </script>
  
<script>
function update_rounds(v)
{
	//alert(v);
	 var id=v;
	var data=$('form').serialize();
	$.ajax({
		type:"GET",
		data: data + "&" + "id="+id,
		url:"qvision/masters/appraisal_round_mapping/update_appraisal_rounds_mapping.php?id="+v,
		success:function(data)
		{
			if(data==0)
		{
			alert("Not Updated");
			appraisal_round_mapping();
		}
		else
		{
			alert("Updated successfully");
			 appraisal_round_mapping();
			
		}
		}
	}) 
}

</script>