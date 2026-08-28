<?php
require '../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from question_name_master where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> QUESTION DETAILS EDIT
<a onclick="return back_ctc()" style="float: right; color: white; cursor: pointer;" class="btn btn-primary">Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="edit_form" id="edit_form" method="POST" action="qvision/assesment/update_question.php">

<table class="table table-bordered">
<tr>
<td><center><img src="qvision/images/logo123.jpg" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software Services Private Limited</b></center></td>
</tr>
<tr>
<td>Question Name:</td>
<td colspan="5">
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>"readonly>
<input type="text" class="form-control" id="name" name="name" value="<?php echo  $row['name'];?>"readonly>
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

<input type="submit" id="submit_btn" name="submit" value="Submit" class="btn btn-primary btn-md" style="float:right;">
</form>
</div>
</div>
</div>

<script>
function back_ctc() {
    question_name();
}
</script>
