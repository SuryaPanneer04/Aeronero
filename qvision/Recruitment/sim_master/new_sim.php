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
 <h3 class="card-title"><font size="5">  New SIM Master  </font></h3>
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary"> <i class="fa fa-minus"></i>Back</a>
</div>


<form method="POST" action="qvision/Recruitment/sim_master/sim_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td> Provider Name:</td>
<td colspan="2"><input type="text" class="form-control" id="provider_name" name="provider_name" ></td>
</tr>
<tr>
<td> Phone Number:</td>
<td colspan="2"><input type="text" class="form-control" id="phone_no" name="phone_no" ></td>
</tr>
<tr>
<td>Activation Date</td>
<td colspan="2"><input type="date" class="form-control" id="activation_date" name="activation_date" ></td>
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
 function back_ctc()
  {
    sim_master()
  }
</script>