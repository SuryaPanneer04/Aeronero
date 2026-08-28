<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT h.id,h.dept_id,h.status,z.dept_name FROM hike_master h left join z_department_master z  on h.dept_id = z.id where h.id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
?>
<head>
<style>
.card-header{
background: #007bff !important;
}
</style>
   <link rel="stylesheet" href="Qvision\commonstyle.css">
 </head>

<div  class="card card-primary">

  <div class="card-header">
   <center><h3 class="card-title"><b>Hike Details Edit</b></h3></center>
	<a onclick="hike_master()" style="float: right;" data-toggle="modal" class="btn btn-danger">Back</a>
 </div>

<div class="card-body">
<form role="form"  method="post" enctype="multipart/type">

<table class="table table-bordered">

<tr>
<td>Department</td>
<td colspan="2">
	<select class="form-control" name="department">
		<option value="<?php echo  $row['dept_id'];?>"><?php echo  $row['dept_name'];?></option>
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

<table class="table table-bordered">

<tr>
  <th>S.No</th>
  <th>Value</th>
  <th>Percentage Hike</th>
</tr>

<?php
$sql = $con->query("SELECT h.id as hike_id,hv.id as name_id,hv.rating_point,hv.percentage_hike FROM `hike_master` h
INNER JOIN hike_value_percent hv ON h.id=hv.hike_master_id
WHERE h.id='$id'");
$cnt = 0;
$i=1;
while ($rows = $sql->fetch(PDO::FETCH_ASSOC)) {
?>     
    <tr>
      <td><label for="name_<?php echo $cnt;?>"> <?php echo $i; ?> </label>
      <input type="hidden" class="form-control" id="get_id" name="get_id<?php echo $cnt; ?>" value="<?php echo   $rows['name_id']; ?>">
	</td>
    
      <td> <input type="text" class="form-control" id="value_<?php echo $cnt;?>" name="rating_score[]" value='<?php echo $rows['rating_point'] ;?>' readonly> </td>

      <td> <input type="number" class="form-control" id="percentage_<?php echo $cnt;?>" name="percentage[]" value="<?php echo $rows['percentage_hike'] ;?>"  autocomplete="off"> </td>

    </tr>
<?php  $cnt++;  $i++; } ?>

</table>


</table>

<input type="button" name="submit" value="Update" class="btn btn-primary btn-md" id="<?php echo $id; ?>" onclick="update_hike(this.id)" style="float:right;">
</form>
</div>
</div>

<script>
function update_hike(v)
{
	console.log(v)
	let id=v;
	let data=$('form').serialize();
	$.ajax({
		type:"POST",
		data: data,
		url:"qvision/masters/hike_master/update_hike.php?id=" +v,
		success:function(data)
		{
			if(data==1)
		{
			alert("Updated successfully");
			hike_master();
		}
		else
		{
			alert("Not Updated");
			hike_master();
		}
		}
	})  
}

</script>