<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from source_master where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
?>

<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #ff8b3d !important;
}
.card-primary:not(.card-outline)>.card-header{
color: white !important;
}
.btn-dark{
background-color: rgb(237, 93, 0) !important;
    color: rgb(60, 8, 8) !important;
    border-color: rgb(237, 93, 0) !important;
}
</style>
<div class="container-fluid">


 <div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">EDIT RESOURCE</font></h3>
			
                <a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger">BACK</a>
              </div>
			  
<div class="card-body" id="printableArea">
<form role="form" name="" action="" method="GET" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td>Resource</td>
<td colspan="5">
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>"readonly>
<input type="text" class="form-control" id="resource" name="resource" value="<?php echo  $row['name'];?>">
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

<input type="button" name="submit" value="Update" class="btn btn-dark"  id="<?php echo $id; ?>" onclick="update_resource(this.id)" style="float:right;color:white !important;">
</form>
</div>
</div>
</div>
<script>
function update_resource(v)
{
	//alert(v);
	 var id=v;
	var data=$('form').serialize();
	$.ajax({
		type:"GET",
		data: data + "&" + "id="+id,
		url:"qvision/masters/Resource_master/resource_update.php",
		success:function(data)
		{
			if(data.trim() == "1")
		{
			alert("Record Updated Successfully");
			resource_master();
		}
		else
		{
			alert("Record Not Updated. Error: " + data);
			resource_master();
		}
		}
	}) 
}
 
function back_ctc()
{
	resource_master();
} 
</script>