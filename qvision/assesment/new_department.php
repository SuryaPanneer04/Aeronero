<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
?>
<div class="container-fluid">
<div class="card mb-3">

<form id="new_department_form" method="POST" action="qvision/assesment/questionmaster_submit.php">
<div class="card-header">
<a onclick="return back_ctc()" style="float: right; color: white; cursor: pointer;" class="btn btn-primary">Back</a>
</div>
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td><center><img src="qvision/images/logo123.jpg" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software Services Private Limited</b></center></td>
</tr>
<tr>
<td>Question Name:</td>
<td colspan="2"><input type="text" class="form-control" id="name" name="name" ></td>
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
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form>
</div>
<script>
function back_ctc() {
    question_name();
}
</script>
</div>
