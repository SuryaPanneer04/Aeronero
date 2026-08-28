<?php
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];
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
   <center><h3 class="card-title"><b>Assesment Details</b></h3></center>
	<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger">Back</a>
 </div>

<form method="POST" action="">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td>Name :</td>
<td colspan="2"><input type="text" class="form-control" id="assesment_name" name="assesment_name" ></td>
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
<input type="button" name="submit" class="btn btn-primary btn-md" value="Save" onclick="insert_assesment()"style="float:right;">
</form>
</div>

<script>
function insert_assesment()
{
    var id=0;
    var data = $('form').serialize();
   $.ajax({
    type:"GET",
	data: data + "&" + "id="+id,
    url:"qvision/masters/assesment_master/insert_assesment.php",
    success:function(data){
		if(data=0)
		{
			alert("Not inserted");
			assesment_master();
		}
		else
		{
			alert("inserted successfully");
			assesment_master();
		}
    }
  }) 
}

function back_ctc()
{
	assesment_master();
}
</script>