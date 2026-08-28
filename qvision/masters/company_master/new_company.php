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
<div  class="card card-primary">
              <div class="card-header">
                <h3 style="float: left;"><font size="5">ADD COMPANY DETAILS</font></h3>
		  		  <a onclick="back_cmp()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
		   </div>

<!--<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
<!-- <div class="container-fluid">
<div class="card mb-3"> ->
<div class="card card-primary">
<div class="card-header">
<!-- <i class="fa fa-table"></i> COMPANY DETAILS EDIT ->
<center><h3 class="card-title">COMPANY DETAILS EDIT</h3></center>
<a onclick=" back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>-->
<form method="POST" action="">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td>Company Name</td>
<td colspan="2"><input type="text" class="form-control" id="company" name="company"></td>
</tr>

<tr>
<td>Address</td>
<td colspan="2"><input type="text" class="form-control" id="address" name="address" ></td>
</tr>

<tr>
<td>Email</td>
<td colspan="2"><input type="text" class="form-control" id="email_id" name="email_id" ></td>
</tr>
<tr>
<td>Phone No</td>
<td colspan="2"><input type="text" class="form-control" id="phone_no" name="phone_no" ></td>
</tr>
<tr>
<td>GST No</td>
<td colspan="2"><input type="text" class="form-control" id="gst_no" name="gst_no" ></td>
</tr>
<!--<tr>
<td>PAN No:</td>
<td colspan="2"><input type="text" class="form-control" id="pan_no" name="pan_no" ></td>
</tr>
<tr>
<td>CIN No :</td>
<td colspan="2"><input type="text" class="form-control" id="cin_no" name="cin_no" ></td>
</tr>-->

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

<input type="button" name="submit" Value="Submit"class="btn btn-primary btn-md" style="float:right;position: relative;left: -5px;" onclick="save_company()">


<br>
<br>
</form>
</div>

<script>
function back_cmp()
{
 company_master();
}
</script>
<script>
function save_company()
    {
		  var id=0;
	//alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:"POST",
	data: data + "&" + "id="+id,
    url:"qvision/masters/company_master/company_submit.php",
    success:function(){
  alert("Submited Successfully");
  company_master();
    }
    })
  }
</script>
