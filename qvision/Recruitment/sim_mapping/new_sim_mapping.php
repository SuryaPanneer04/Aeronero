<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<div class="card card-primary">

<div class="card-header">
<i class="fa fa-table"></i> Add Sim Details 
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-minus"></i>Back</a>
</div> 

<form method="POST" action="qvision/Recruitment/sim_mapping/sim_mapping_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td> Department:</td>
<td colspan="2">
<select name="department" id="department" class="form-control">
<option value=""> -- Select Department -- </option>
<?php 
$sel=$con->query("select * from z_department_master where status=1");
while($dis=$sel->fetch())
{
	?>
	<option value="<?php echo $dis['id'];?>"><?php echo $dis['dept_name'];?></option>
<?php	
}
?>
</select>
 </td>
</tr>

<tr>
<td> Phone Number:</td>
<td colspan="2"><select name="phone_no" id="phone_no" class="form-control">
<option value=""> -- Select Phone Number -- </option>
<?php 
$sel=$con->query("select * from sim_master where status=1");
while($dis=$sel->fetch())
{
	?>
	<option value="<?php echo $dis['id'];?>"><?php echo $dis['phone_no'];?></option>
<?php	
}
?>
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
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form>

<script>
 function  back_ctc()
 {
	 sim_mapping()
 }
 </script>