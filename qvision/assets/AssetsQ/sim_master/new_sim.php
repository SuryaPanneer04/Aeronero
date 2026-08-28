<?php
require '../../config.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
?>
<div class="container-fluid">
<div class="card mb-3">

<div class="card-header">
<i class="fa fa-table"></i> Add Sim Details 
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary"> <i class="fa fa-minus"></i>Back</a>
</div>


<form method="POST" action="/KerliERP/AssetsQ/sim_master/sim_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td><center><img src="/KerliERP/Recruitment/image/userlog/quadsel.png" alt="quadsel" style="width:100px;height:50px;"> </center></td>
<td colspan="5"><center><h3><b>New SIM Master</b><h3></center></td>
</tr>
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