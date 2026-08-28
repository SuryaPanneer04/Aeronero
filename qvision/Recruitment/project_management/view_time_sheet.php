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


if ($row) {
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
    $dateS = date('d-m-Y', strtotime($date));
} else {
    $one=''; $two=''; $three=''; $four=''; $five=''; $six=''; $seven=''; $eight=''; $nine=''; $over_time=''; $date=''; $emp_name='';
    $dateS = '';
}

?>
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Hourly Time Sheet</font></h3>
				<a onclick="daily_mis_report()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
			
              </div>
  
              <div class="card-body">
			  
<form role="form" name="" action="HRMS/Recruitment/project_management/time_sheet_submit.php" method="post" enctype="multipart/type">

	<table class="table table-bordered">
		<tr>
			<td><center><strong><?php echo $dateS; ?></strong></center></td>
			<td colspan="5"><center><b><?php echo $emp_name; ?></b></center></td>
		</tr>
		<tr>
			<td><strong>9-10</strong></td>
			<td colspan="2">
			<textarea id="one1" name="one1" class="form-control one1" style="height:50px" readonly="readonly"><?php echo $one?></textarea></td>
		</tr>
		<tr>
			<td><strong>10-11</strong></td>
			<td colspan="2">
			<textarea id="two2" name="two2" class="form-control" style="height:50px" readonly="readonly"><?php echo$two; ?></textarea></td>
		</tr>
		<tr>
			<td><strong>11-12</strong></td>
			<td colspan="2">
			<textarea id="three3" name="three3" class="form-control" style="height:50px" readonly="readonly"><?php echo$three; ?></textarea></td>
		</tr>
		<tr>
			<td><strong>12-01</strong></td>
			<td colspan="2">
			<textarea id="four4" name="four4" class="form-control" style="height:50px" readonly="readonly"><?php echo$four; ?></textarea></td>
		</tr>
		<tr>
			<td><strong>01-02</strong></td>
			<td colspan="2">
			<textarea id="five5" name="five5" class="form-control" style="height:50px" readonly="readonly"><?php echo$five; ?></textarea></td>
		</tr>
		<tr>
			<td><strong>02-03</strong></td>
			<td colspan="2">
			<textarea id="six6" name="six6" class="form-control" style="height:50px" readonly="readonly"><?php echo$six; ?></textarea></td>
		</tr>
		<tr>
			<td><strong>03-04</strong></td>
			<td colspan="2">
			<textarea id="seven7" name="seven7" class="form-control" style="height:50px" readonly="readonly"><?php echo$seven; ?></textarea></td>
		</tr>
		<tr>
			<td><strong>04-05</strong></td>
			<td colspan="2">
			<textarea id="eight8" name="eight8" class="form-control" style="height:50px" readonly="readonly"><?php echo$eight; ?></textarea></td>
		</tr>
			<tr>
			<td><strong>05-06</strong></td>
			<td colspan="2">
			<textarea id="nine9" name="nine9" class="form-control" style="height:50px" readonly="readonly"><?php echo$nine; ?></textarea></td>
		</tr>
		<tr>
			<td><strong>Over Time</strong></td>
			<td colspan="2">
			<textarea id="over_time10" name="over_time10" class="form-control" style="height:50px" readonly="readonly"><?php echo$over_time; ?></textarea></td>
			
		</tr>
	</table>
	
</form> 