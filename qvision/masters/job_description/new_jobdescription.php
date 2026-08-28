<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
	<style>
	.card-primary:not(.card-outline)>.card-header{
		background-color: #f1cc61 !important;
	}
	</style>
<div class="card card-primary">
	 <div class="card-header">
            <h3 class="card-title"><font size="5">NEW JOB DESCRIPTION</font></h3>
			<a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-primary">BACK</a>
	</div>
<form method="POST">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td>Title</td>
<td colspan="2"><input type="text" class="form-control" id="jd_tittle" name="jd_tittle" ></td>
</tr>

<!---<tr>
<td>Approval Level</td>
<td colspan="2">
<select class="form-control" id="approve_level" name="approve_level">
	<option value="">-- Select Level --</option>
	<option value="1">1</option>
	<option value="2">2</option>
</select> </td>
</tr>--->

<tr>
<td>Interview Round Level</td>
<td colspan="2">
<select class="form-control" id="round_level" name="round_level">
	<option value="">-- Select Round --</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
</select></td>
</tr>

<tr>
<td>Status</td>
<td colspan="2">
<select class="form-control" name="status" id="status">
<option value="1">Active</option>
<option value="0">InActive</option>
</select>
</td>
</tr>
</table>
<input type="button" name="submit" value="Submit"class="btn btn-primary btn-md" style="float:right;position:relative;left:-5px;" onclick="jd_save()">
<br>
<br>
</form>


</div>
<script>
function jd_save()
    {
		var title=$('#jd_tittle').val();
		var status=$('#status').val();
		//let approve = $('#approve_level').val()
		let round = $('#round_level').val()
    $.ajax({
    type:"POST",
    url:"qvision/masters/job_description/jobdescription_submit.php?title="+title+"&status="+status+"&round="+round,
    success:function(data){
		if(data==1)
		{
	 alert("Inserted Successfully");
	  console.warn("info"+data);
     job_description();	
		}
		else
		{
		 alert("Failed to Insert");
		 console.warn("info"+data);
         job_description();
		}
      }
    })
  }

function back(){
	job_description();
}
</script>