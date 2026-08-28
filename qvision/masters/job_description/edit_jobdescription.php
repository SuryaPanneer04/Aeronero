<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from jobdescription_master where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
?>
<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.btn-danger{
	background-color: #ed5d00 !important;
    border-color: #ed5d00 !important;
}
</style>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>

<!-- <div class="container-fluid">
<div class="card mb-3"> -->

<div  class="card card-primary">
   <div class="card-header">
      <h3 style="float: left;"><font size="5">EDIT JOB DESCRIPTION</font></h3>
	  <a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
</div>

<div class="card-body" id="printableArea">
<form role="form" name=""  method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td>Title</td>
<td colspan="5">
<input type="hidden" class="form-control" id="jd_id" name="id" value="<?php echo $id;?>">
<input type="text" class="form-control" id="jd_tittle" name="jd_tittle" value="<?php echo  $row['tittle'];?>">
</td>
</tr>

<tr>
<td>Approval Level</td>
<td colspan="2">
<select class="form-control" id="approve_level" name="approve_level">
	<option value="<?php echo  $row['approval_level'];?>"><?php echo  $row['approval_level'];?></option>
	<option value="">-- Select Level --</option>
	<option value="1">1</option>
	<option value="2">2</option>
</select> </td>
</tr>

<tr>
<td>Interview Round Level</td>
<td colspan="2">
<select class="form-control" id="round_level" name="round_level">
	<option value="<?php echo  $row['interview_round_level'];?>"><?php echo  $row['interview_round_level'];?></option>
	<option value="">-- Select Round --</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
</select></td>
</tr>

<tr>
<td>Status</td>
<td colspan="2">

<select class="form-control" name="status" id="jd_status">
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

<input type="button" name="submit" value="Update" class="btn btn-primary btn-md" style="float:right;" onclick="jd_update()">
</form>
</div>
</div>


<script>
function jd_update()
    {
		var id=$('#jd_id').val();
		var title=$('#jd_tittle').val();
		var status=$('#jd_status').val();
        let approve = $('#approve_level').val()
        let round = $('#round_level').val()
    $.ajax({
    type:"POST",
    url:"qvision/masters/job_description/update_jobdescription.php",
    data: {title: title, status: status, id: id, approve: approve, round: round},
    success:function(data){
		if(data==1)
		{
	    alert("Updated Successfully");
        job_description();
		
		}
		else
		{
		alert("Failed to Update");
        job_description();
		}
      }
    })
  }

function back_ctc(){
	job_description();
}
</script>