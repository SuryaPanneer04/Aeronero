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
	</style>
	<div class="card card-primary">
<div class="card-header">
	<h3 class="card-title"><font size="5">ADD LOCATION DETAILS</font></h3>
	<a onclick="back_lm()" style="float: right;" data-toggle="modal" class="btn btn-primary">BACK</a>

</div>
<form method="POST" action="">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<!-- <tr>
<td><center><img src="../../Recruitment/image/userlog/quadsel.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software Services Private Limited</b></center></td>
</tr> -->
<tr>
<td>Site</td>
<td colspan="2">
<select name="site" id="site" class="form-control" >
<?php
$sel=$con->query("select * from site_master");
while($sfet=$sel->fetch())
{
	?>
	<option value="<?php echo $sfet['id'];?>"><?php echo $sfet['site_name'];?></option>
	<?php
}
?>
</select>
</td>
</tr>
<tr>
<td>Location</td>
<td colspan="2"><input type="text" class="form-control" id="location" name="location" ></td>
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
<input type="button" value="Submit" name="submit" class="btn btn-primary btn-md" style="float:right;position:relative;left:-5px;" onclick="save_location()">
<br>
<br>
</form>


</div>
<script>
function back_lm(){

	location_master();
}
</script>
<script>
function save_location()
    {
		  var id=0;
	//alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:"POST",
	data: data + "&" + "id="+id,
    url:"qvision/masters/location_master/location_submit.php",
    success:function(){
  alert("Submited Successfully");
  location_master();
    }
    })
  }
</script>




