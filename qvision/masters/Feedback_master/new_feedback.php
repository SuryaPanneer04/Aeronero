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
	.card-primary:not(.card-outline)>.card-header a {
		color: #3c0808 !important;
    background-color: #ed5d00 !important;
	}
	</style>
<div class="card card-primary">
              <div class="card-header">
                
				      <h3 class="card-title"><font size="5">FEEDBACK DETAILS</font></h3>
		<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn">BACK</a>
              </div>
<form method="POST" action="">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">

<tr>
<td>Feedback</td>
<td colspan="2"><input type="text" class="form-control" id="feedback" name="feedback" ></td>
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
<input type="button" name="submit" class="btn btn-primary btn-md" value="Save" onclick="insert_feedback()"style="float:right;position:relative;left:-5px;">
<br>
<br>
</form>
</div>
<script>
function back_ctc()
{
	feedback_master();
}
</script>
<script>
function insert_feedback()
{
    var id=0;
    var data = $('form').serialize();
  $.ajax({
    type:"GET",
	data: data + "&" + "id="+id,
    url:"qvision/masters/feedback_master/insert_feedback.php",
    success:function(data){
		if(data==0)
		{
			alert("inserted successfully");
			feedback_master();
		}
		else
		{
			alert("Not inserted");
			feedback_master();
		}
      //$("#main_content").html(data);
    }
  })
}


</script>