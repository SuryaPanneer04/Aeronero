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
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
.btn-dark{
	background-color: #ed5d00 !important;
    border-color: #ed5d00 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black !important;
}
</style>
<!-- <div class="container-fluid">
<div class="card mb-3"> -->

<div class="card card-primary">
<div class="card-header">
<h3 class="card-title"><font size="5">ADD DEPARTMENT DETAILS</font></h3>
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
</div>

<form method="POST" action="">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td>Department Name</td>
<td colspan="2"><input type="text" class="form-control" id="department" name="department" ></td>
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
<input type="button" name="submit" value="Submit" class="btn btn-primary btn-md" style="float:right;position: relative;left: -5px;" onclick="save_department()">
</form>
<br>
</div>
<script>
function back_ctc()
{
	department_master();
} 

</script>
<script>
function save_department()
{
	  var id=0;
	//alert(id);
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
  url:"qvision/masters/department_master/depmaster_submit.php",
    success:function(data)
    {      
        alert("Submited Successfully");
		 department_master();
		          
    }       
    });
}

</script>