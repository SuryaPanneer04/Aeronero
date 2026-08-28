<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from prefixcode_master where id='$id'");
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
   <center><h3 class="card-title"><b>Preficxode Details Edit</b></h3></center>
	<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger">Back</a>
 </div>

<div class="card-body">
<form role="form" name="" action="" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td>Name :</td>
<td colspan="5">
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>"readonly>
<input type="text" class="form-control" id="name" name="name" value="<?php echo  $row['name'];?>">
</td>
</tr>
<tr>
<td>Code :</td>
<td colspan="5">
<input type="text" class="form-control" id="code" name="code" value="<?php echo  $row['code'];?>">
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

<input type="button" name="submit" value="Update" class="btn btn-primary btn-md" id="<?php echo $id; ?>" onclick="update_prefix(this.id)" style="float:right;">
</form>
</div>
</div>
<script>
function update_prefix(v)
{

	  var id=v;
	var data=$('form').serialize();
	$.ajax({
		type:"GET",
		data: data + "&" + "id="+id,
		url:"qvision/masters/Prefixcode_master/update_prefix.php",
		success:function(data)
		{
			if(data==0)
		{
			alert("Updated successfully");
			prefix_code();
		}
		else
		{
			alert("Not Updated");
			prefix_code();
		}
		}
	})  
}
 </script>
<script>
function back_ctc()
{
	prefix_code();
} 
</script>