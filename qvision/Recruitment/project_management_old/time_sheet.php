<?php
require '../../../connect.php';
require '../../../user.php';
$userrole=$_SESSION['userrole'];
$candidateid=$_SESSION['candidateid'];




$date = date('Y-m-d');

$chck=$con->query("SELECT * FROM `time_sheet` WHERE date='$date' and staff_id='$candidateid'");
//echo "SELECT * FROM `time_sheet` WHERE date='$date' and staff_id='$candidateid'";
$row = $chck->fetch();
if(!$row){
?>

<div  class="card card-primary">
              <div class="card-header" style="background:orange;">
                <h3 class="card-title"><font size="5">Hourly Time Sheet For <?php echo $date?></font></h3>
			
			
              </div>
  
              <div class="card-body">
			  
<form role="form" name="" action="qvision/Recruitment/project_management/time_sheet_submit.php" method="post" enctype="multipart/type">

	<table class="table table-bordered">
		<tr>
			<td><center><img src="qvision/images/logo123.jpg" alt="quadsel" style="width:150px;height:50px;"></center></td>
			<td colspan="5"><center><b>Bluebase Software Services Private Limited</b></center></td>
		</tr>
		<tr>
			<td><strong>9-10</strong></td>
			<td colspan="2">
			<textarea id="one1" name="one1" class="form-control one1" value="" style="height:50px"></textarea></td>
		</tr>
		<tr>
			<td><strong>10-11</strong></td>
			<td colspan="2">
			<textarea id="two2" name="two2" class="form-control" onclick="CheckerField2()" style="height:50px"></textarea></td>
		</tr>
		<tr>
			<td><strong>11-12</strong></td>
			<td colspan="2">
			<textarea id="three3" name="three3" class="form-control" onclick="CheckerField3()" style="height:50px"></textarea></td>
		</tr>
		<tr>
			<td><strong>12-01</strong></td>
			<td colspan="2">
			<textarea id="four4" name="four4" class="form-control" onclick="CheckerField4()" style="height:50px"></textarea></td>
		</tr>
		<tr>
			<td><strong>01-02</strong></td>
			<td colspan="2">
			<textarea id="five5" name="five5" class="form-control" onclick="CheckerField5()" style="height:50px"></textarea></td>
		</tr>
		<tr>
			<td><strong>02-03</strong></td>
			<td colspan="2">
			<textarea id="six6" name="six6" class="form-control" onclick="CheckerField6()" style="height:50px"></textarea></td>
		</tr>
		<tr>
			<td><strong>03-04</strong></td>
			<td colspan="2">
			<textarea id="seven7" name="seven7" class="form-control" onclick="CheckerField7()" style="height:50px"></textarea></td>
		</tr>
		<tr>
			<td><strong>04-05</strong></td>
			<td colspan="2">
			<textarea id="eight8" name="eight8" class="form-control" onclick="CheckerField8()" style="height:50px"></textarea></td>
		</tr>
			<tr>
			<td><strong>05-06</strong></td>
			<td colspan="2">
			<textarea id="nine9" name="nine9" class="form-control" onclick="CheckerField9()" style="height:50px"></textarea></td>
		</tr>
		<tr>
			<td><strong>Over Time</strong></td>
			<td colspan="2">
			<textarea id="over_time10" name="over_time10" class="form-control" onclick="CheckerField10()" style="height:50px"></textarea></td>
			<input type="hidden" id="pro_id" name="pro_id" value="<?php echo $candidateid; ?>" />
		</tr>
	</table>
	<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form>
<?php
}
else
{
?>
<div  class="card card-primary">
              <div class="card-header" style="background:orange;">
                <h3 class="card-title"><font size="5">Hourly Time Sheet For <?php echo $date?></font></h3>
			
		       </div>
  
              <div class="card-body">
			  <label style="text-align:center;font-size:20px;color:green;font-weight:600;margin-left:250px;">You Already Uploaded Daily_Mis!..</label>
			  </div>
			  </div>
<?php
}
?>
<script>
	$(document).ready(function(){
  $("form").submit(function(){
    alert("Time Sheet Sumbitted Successfully");
  });
});

  /* $(function () {
//Add text editor
/* $('#one1').summernote()
}) 
$(function () {
//Add text editor
$('#two2').summernote()
})
$(function () {
//Add text editor
$('#three3').summernote()
})
$(function () {
//Add text editor
$('#four4').summernote()
})
$(function () {
//Add text editor
$('#five5').summernote()
})
$(function () {
//Add text editor
$('#six6').summernote()
})
$(function () {
//Add text editor
$('#seven7').summernote()
})
$(function () {
//Add text editor
$('#eight8').summernote()
})
$(function () {
//Add text editor
$('#nine9').summernote()
})
$(function () {
//Add text editor
$('#over_time10').summernote()
}) */ 
</script>





