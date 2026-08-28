<?php
require '../../../connect.php';
$id=$_REQUEST['id'];
$stmt = $con->prepare("select * from sim_mapping where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
$dep=$row['department_id'];
$phone=$row['sim_id'];
?>

<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<div class="card card-primary">
<div class="card-header">
<i class="fa fa-table"></i>Edit Sim Details 
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-minus"></i>Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="qvision/Recruitment/sim_mapping/update_sim_mapping.php" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="/KerliERP/Recruitment/image/userlog/quadsel.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software Services Private Limited</b></center></td>
</tr>
<tr>
<td> Department:</td>
<td colspan="2">
<input type="hidden" id="sid" name="sid" value="<?php echo $id;?>">
<select name="department" id="department" class="form-control">
<?php 
$sel1=$con->query("select * from z_department_master where status=1 and id='$dep'");
$setlfet=$sel1->fetch();
?>
<option value="<?php echo $setlfet['id'];?>"><?php echo $setlfet['dept_name'];?></option>
<?php 
$sel=$con->query("select * from z_department_master where status=1 and id !='$dep'");
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
<?php 
$sel1=$con->query("select * from sim_master where status=1 and id='$phone'");
$setlfet=$sel1->fetch();
?>
<option value="<?php echo $setlfet['id'];?>"><?php echo $setlfet['phone_no'];?></option>
<?php 
$sel=$con->query("select * from sim_master where status=1 and id!='$phone'");
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

<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form>
</div>
</div>
</div>

<script>
 function  back_ctc()
 {
	 sim_mapping()
 }
 </script>