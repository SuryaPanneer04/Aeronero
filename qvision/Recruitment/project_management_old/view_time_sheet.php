<?php
require '../../../connect.php';
require '../../../user.php';

$id=$_REQUEST['id'];

$dateS = date('d-m-Y');



$stmt = $con->prepare("select a.*,b.* from time_sheet a left join staff_master b on(a.staff_id=b.candid_id)where a.id='$id'");

//echo "select a.*,b.* from time_sheet a left join staff_master b on(a.staff_id=b.candid_id)where a.id='$id'";

//echo "select a.date,a.*,b.emp_name,b.* from time_sheet a left join staff_master b on(a.staff_id=b.candid_id)where a.id='$id'";
$stmt->execute(); 
$row = $stmt->fetch();


$one=$row['one'];
$two=$row['two'];
$three=$row['three'];
$four=$row['four'];
$five=$row['five'];
$six=$row['six'];
$seven=$row['seven'];
$eight=$row['eight'];
$nine=$row['nine'];
$over_time=$row['over_time'];
$date=$row['date'];

$emp_name=$row['emp_name'];

?>
<div  class="card card-primary">
              <div class="card-header" style="background:#ff8b3d;">
                <h3 class="card-title"><font size="5">Hourly Time Sheet</font></h3>
			
			<input type="button" style="float:right;background:black;color:white;border:1px solid black;" class="btn btn-warning" name="back" value="BACK" onclick="daily_mis_report()">

              </div>
  
              <div class="card-body">
			  
<form role="form" name="" action="" method="post" enctype="multipart/type">

	<table class="table table-bordered">
		<tr>
			<td><center><strong><?php echo $date; ?></strong></center></td>
			<td colspan="5"><center><b><?php echo $emp_name; ?></b></center></td>
		</tr>
		<tr>
			<td><strong>9-10</strong></td>
			<td colspan="2">
			<textarea id="one1" name="one1" class="form-control one1" value="<?php echo $one?>" style="height:50px" readonly="true"><?php echo $one?></textarea></td>
		</tr>
		<tr>
			<td><strong>10-11</strong></td>
			<td colspan="2">
			<textarea id="two2" name="two2" class="form-control" onclick="CheckerField2()" style="height:50px"><?php echo$two; ?></textarea></td>
		</tr>
		<tr>
			<td><strong>11-12</strong></td>
			<td colspan="2">
			<textarea id="three3" name="three3" class="form-control" onclick="CheckerField3()" style="height:50px"><?php echo$three; ?></textarea></td>
		</tr>
		<tr>
			<td><strong>12-01</strong></td>
			<td colspan="2">
			<textarea id="four4" name="four4" class="form-control" onclick="CheckerField4()" style="height:50px"><?php echo$four; ?></textarea></td>
		</tr>
		<tr>
			<td><strong>01-02</strong></td>
			<td colspan="2">
			<textarea id="five5" name="five5" class="form-control" onclick="CheckerField5()" style="height:50px"><?php echo$five; ?></textarea></td>
		</tr>
		<tr>
			<td><strong>02-03</strong></td>
			<td colspan="2">
			<textarea id="six6" name="six6" class="form-control" onclick="CheckerField6()" style="height:50px"><?php echo$six; ?></textarea></td>
		</tr>
		<tr>
			<td><strong>03-04</strong></td>
			<td colspan="2">
			<textarea id="seven7" name="seven7" class="form-control" onclick="CheckerField7()" style="height:50px"><?php echo$seven; ?></textarea></td>
		</tr>
		<tr>
			<td><strong>04-05</strong></td>
			<td colspan="2">
			<textarea id="eight8" name="eight8" class="form-control" onclick="CheckerField8()" style="height:50px"><?php echo$eight; ?></textarea></td>
		</tr>
			<tr>
			<td><strong>05-06</strong></td>
			<td colspan="2">
			<textarea id="nine9" name="nine9" class="form-control" onclick="CheckerField9()" style="height:50px"><?php echo$nine; ?></textarea></td>
		</tr>
		<tr>
			<td><strong>Over Time</strong></td>
			<td colspan="2">
			<textarea id="over_time10" name="over_time10" class="form-control" onclick="CheckerField10()" style="height:50px"><?php echo$over_time; ?></textarea></td>
			
		</tr>
	</table>
	
</form>
<script>
$(document).ready(function(){

 var first_hr = document.getElementById('one1').value;
 var second_hr = document.getElementById('two2').value;
 var third_hr = document.getElementById('three3').value;
 var fourth_hr = document.getElementById('four4').value;
 var fifth_hr = document.getElementById('five5').value;
 var sixth_hr = document.getElementById('six6').value;
 var seventh_hr = document.getElementById('seven7').value;
 var eighth_hr = document.getElementById('eight8').value;
 var ninth_hr = document.getElementById('nine9').value;
 var over_time = document.getElementById('over_time10').value;

 if (first_hr != ""){

						$("textarea#one1").attr("readonly","readonly");
						
					}else{
						
					$("textarea#one1").removeAttr("readonly");	
					}
					
if (second_hr != ""){

					$('#two2').attr('readonly', 'readonly');
				} else {

					$('#two2').removeAttr('readonly');
				}	
if (third_hr != ""){

					$('#three3').attr('readonly', 'readonly');
				} else {

					$('#three3').removeAttr('readonly');
				}					
if (fourth_hr != ""){

					$('#four4').attr('readonly', 'readonly');
				} else {

					$('#four4').removeAttr('readonly');
				}					
if (fifth_hr != ""){

					$('#five5').attr('readonly', 'readonly');
				} else {

					$('#five5').removeAttr('readonly');
				}					
					
if (sixth_hr != ""){

					$('#six6').attr('readonly', 'readonly');
				} else {

					$('#six6').removeAttr('readonly');
				}					
					
if (seventh_hr != ""){

					$('#seven7').attr('readonly', 'readonly');
				} else {

					$('#seven7').removeAttr('readonly');
				}					
if (eighth_hr != ""){

					$('#eight8').attr('readonly', 'readonly');
				} else {

					$('#eight8').removeAttr('readonly');
				}					
					
if (ninth_hr != ""){

					$('#nine9').attr('readonly', 'readonly');
				} else {

					$('#nine9').removeAttr('readonly');
				}					
					
if (over_time != ""){

					$('#over_time10').attr('readonly', 'readonly');
				} else {

					$('#over_time10').removeAttr('readonly');
				}					
					
					
}); 
 