<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<head>
<style>
.card-header{
background: #007bff !important;
}
</style>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
 </head>
<div class="card card-primary">
   <div class="card-header">
   <center><h3 class="card-title"><b>Hike Details</b></h3></center>
	<a onclick="back_To_hike()" style="float: right;" data-toggle="modal" class="btn btn-danger">Back</a>
 </div>

<form method="POST" action="">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">

<tr>
<td>Department</td>
<td colspan="2">
	<select class="form-control" name="department">
		<option value="0">-- Select Department --</option>
		<?php
		$dep_sql=$con->query("SELECT id, dept_name FROM z_department_master where status=1");
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
<td>Status</td>
<td colspan="2">
<select class="form-control" name="status">
<option value="">Select Status</option>
<option value="1">Active</option>
<option value="0">InActive</option>
</select>
</td>
</tr>
<tr>
<td>Employee Name<input type="text" id="amount" name="amount" class="form-control"></td>
</tr>
<table class="table table-bordered">

<tr>
  <th>S.No</th>
  <th>Value</th>
  <th>Percentage Hike</th>
</tr>

<?php
$rating=['< 70','70 - 80','80 - 90','90 - 100','> 100'];
$cnt =1;
 for($i=0;$i<5;$i++){
?>     
    <tr>
      <td><label for="name_<?php echo $i;?>"> <?php echo $cnt; ?> </label></td>
    
      <td><input type="text" class="form-control" id="value_<?php echo $i;?>" name="rating_score[]" value='<?php echo $rating[$i] ;?>' readonly></td>
      <td><input type="number" class="form-control" id="percentage_<?php echo $i;?>" name="percentage[]" autocomplete="off"></td>
  
    </tr>
<?php  $cnt++; } ?>

</table>

</table>
<input type="button" name="submit" class="btn btn-primary btn-md" value="Save" onclick="insert_hike()"style="float:right;">
</form>
</div>

<script>
function insert_hike()
{
    var data = $('form').serialize();
   $.ajax({
    type:"GET",
	data: data,
    url:"qvision/masters/hike_master/insert_hikemaster.php",
    success:function(data){
		if(data=0)
		{
			alert("Not inserted");
			hike_master();
		}
		else
		{
			alert("Inserted successfully");
			hike_master();
		}
    }
  }) 
}

function back_To_hike()
{
	hike_master();
}
</script>