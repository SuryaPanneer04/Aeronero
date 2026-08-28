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
   <center><h3 class="card-title"><b>Preficxode Details</b></h3></center>
	<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger">Back</a>
 </div>

<form method="POST" action="">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td>Name :</td>
<td colspan="2"><input type="text" class="form-control" id="name" name="name" ></td>
</tr>
<tr>
<td>Code :</td>
<td colspan="2"><input type="text" class="form-control" id="code" name="code" ></td>
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
<input type="button" name="submit" class="btn btn-primary btn-md" value="Save" onclick="insert_prefix()"style="float:right;">
</form>
</div>

<script>
function insert_prefix()
{
    var id=0;
    var data = $('form').serialize();
   $.ajax({
    type:"GET",
	data: data + "&" + "id="+id,
    url:"qvision/masters/Prefixcode_master/insert_prefix.php",
    success:function(data){
		if(data=0)
		{
			alert("Not inserted");
			prefix_code();
		}
		else
		{
			alert("inserted successfully");
			prefix_code();
		}
    }
  }) 
}

function back_ctc()
{
	prefix_code();
}
</script>