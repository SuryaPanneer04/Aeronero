<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from feedback_master where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
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
                
				 <h3 class="card-title"><font size="5">EDIT FEEDBACK DETAILS</font></h3>
		<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn">BACK</a>
              </div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="" method="post" enctype="multipart/type">

<table class="table table-bordered">

<tr>
<td>Feedback</td>
<td colspan="5">
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>"readonly>
<input type="text" class="form-control" id="feedback" name="feedback" value="<?php echo  $row['name'];?>">
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

<input type="button" name="submit" value="Update" class="btn btn-primary btn-md" id="<?php echo $id; ?>" onclick="update_feedback(this.id)" style="float:right;">
</form>
</div>
</div>
</div>
<script>
function update_feedback(v)
{
	//alert(v);
	 var id=v;
	var data=$('form').serialize();
	$.ajax({
		type:"GET",
		data: data + "&" + "id="+id,
		url:"qvision/masters/Feedback_master/update_feedback.php",
		success:function(data)
		{
			if(data==1)
		{
			alert("Updated successfully");
			feedback_master();
		}
		else
		{
			alert("Not Updated");
			feedback_master();
		}
		}
	}) 
}
 
function back_ctc()
{
	feedback_master();
} 
</script>