<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from location_master where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
$sid=$row['site_id'];
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
	<style>
	.card-primary:not(.card-outline)>.card-header{
		background-color: #ff8b3d !important;
	}
	</style>
	
<!-- <div class="container-fluid">
<div class="card mb-3"> -->
<div class="card card-primary">
<div class="card-header">
<!-- <i class="fa fa-table"></i> LOCATION DETAILS EDIT -->
<h3 class="card-title"><font size="5">EDIT LOCATION DETAILS</font></h3>

<a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-primary">BACK</a>

</div>
<div class="card-body" id="printableArea">
<form role="form" id="edit_loc_form" action="" method="post" enctype="multipart/type">

<table class="table table-bordered">
<!-- <tr>
<td><center><img src="../../Recruitment/image/userlog/quadsel.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software Services Private Limited</b></center></td>
</tr> -->
<tr>
<td>Site</td>
<td colspan="2">
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>"readonly>
<select name="site" id="site" class="form-control" >
<?php 
$select=$con->query("select * from site_master where id='$sid'");
$selfet=$select->fetch();
?>
<option value="<?php echo $selfet['id'];?>"><?php echo $selfet['site_name'];?></option>
<?php
$sel=$con->query("select * from site_master where id !='$sid'");
while($sfet=$sel->fetch())
{
	?>
	<option value="<?php echo $sfet['id'];?>"><?php echo $sfet['site_name'];?></option>
	<?php
}
?>
</select>
</td>
</tr>
<tr>
<td>Location</td>
<td colspan="5">
<input type="text" class="form-control" id="location" name="location" value="<?php echo  $row['location'];?>">
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

<input type="button" name="submit" value="Update" class="btn btn-primary btn-md" style="float:right;" onclick="update_location()">
</form>
</div>
</div>
<script>
function back(){

	location_master();
}
</script>
<script>
function update_location()
    {
    var data = $('#edit_loc_form').serialize();
    $.ajax({
    type:"POST",
	data: data,
    url:"qvision/masters/location_master/update_location.php",
    success:function(){
  alert("Updated Successfully");
  location_master();
    }
    })
  }
</script>

