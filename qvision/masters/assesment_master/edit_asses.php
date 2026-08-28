<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from z_assesment_master where id='$id'");
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
   <center><h3 class="card-title"><b>ASSESMENT DETIALS Edit</b></h3></center>
   
	<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger">Back</a>
 </div>

<div class="card-body">
<form role="form" name="" action="" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td>Assesment</td>
<td colspan="5">
<input type="hidden" class="form-control" id="sno" name="sno" value="<?php echo  $id;?>">
<input type="text" class="form-control" id="assesment" name="assesment" value="<?php echo  $row['assesment_name'];?>">
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

<input type="button" name="update" value="Update" class="btn btn-primary btn-md" id="<?php echo $id; ?>" onclick="update_asses(this.id)" style="float:right;">
</form>
</div>
</div>
<script>
function update_asses(v)
{

	  var id=v;
	var data=$('form').serialize();
	$.ajax({
		type:"POST",
		data: data + "&" + "id="+id,
		url:"qvision/masters/assesment_master/update_asses.php",
		success:function(data)
		{
			if(data==0)
		{
			alert("Updated successfully");
			assesment_master();
		}
		else
		{
			alert("Not Updated");
			assesment_master();
		}
		}
	})  
}
 </script>
<script>
function back_ctc()
{
	assesment_master();
} 
</script>