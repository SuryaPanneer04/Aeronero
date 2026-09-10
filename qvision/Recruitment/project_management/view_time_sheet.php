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
    $one=$row['one']; $two=$row['two']; $three=$row['three'];
    $four=$row['four']; $five=$row['five']; $six=$row['six'];
    $seven=$row['seven']; $eight=$row['eight']; $nine=$row['nine'];
	$ten=$row['ten']; $over_time=$row['over_time'];
	
    $a_one=$row['a_one']; $a_two=$row['a_two']; $a_three=$row['a_three'];
    $a_four=$row['a_four']; $a_five=$row['a_five']; $a_six=$row['a_six'];
    $a_seven=$row['a_seven']; $a_eight=$row['a_eight']; $a_nine=$row['a_nine'];
    $a_ten=$row['a_ten']; $a_over_time=$row['a_over_time'];

    $date=$row['date'];
    $emp_name=$row['emp_name'];
    $dateS = date('d-m-Y', strtotime($date));
} else {
    $one=''; $two=''; $three=''; $four=''; $five=''; $six=''; $seven=''; $eight=''; $nine=''; $ten=''; $over_time=''; 
    $a_one=''; $a_two=''; $a_three=''; $a_four=''; $a_five=''; $a_six=''; $a_seven=''; $a_eight=''; $a_nine=''; $a_ten=''; $a_over_time=''; 
    $date=''; $emp_name='';
    $dateS = '';
}

?>
<form role="form" name="" action="HRMS/Recruitment/project_management/time_sheet_submit.php" method="post" enctype="multipart/type">
<div class="card card-primary shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h3 class="card-title m-0 d-inline-block"><font size="5">Hourly Time Sheet</font></h3>
            <strong class="ml-3 text-light"><?php echo $dateS; ?></strong>
        </div>
        <div class="d-flex align-items-center">
            <strong class="mr-2" style="font-size: 1.1rem; color: #fff;">In Time:</strong>
            <input type="text" id="one1" class="form-control" style="width: 140px; text-align: center; font-weight: bold;" readonly="readonly" value="<?php echo $one?>">
            <a onclick="daily_mis_report()" class="btn btn-danger btn-sm ml-3 text-white"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
  
    <div class="card-body">
    <table class="table table-bordered">
        <tr>
            <td colspan="3" class="text-center py-3">
                <h5 class="mb-0 font-weight-bold"><?php echo $emp_name; ?></h5>
            </td>
        </tr>
        <tr style="background-color: #f4f6f9;">
            <th width="15%"><center>Time</center></th>
            <th width="42.5%"><center>To-do List</center></th>
            <th width="42.5%"><center>Task Completed</center></th>
        </tr>
        <tr>
            <td><strong>9.30-10.30</strong></td>
            <td><textarea id="two2" class="form-control" style="height:50px" readonly="readonly"><?php echo $two; ?></textarea></td>
            <td><textarea id="a_two2" class="form-control" style="height:50px" readonly="readonly"><?php echo $a_two; ?></textarea></td>
        </tr>
        <tr>
            <td><strong>10.30-11.30</strong></td>
            <td><textarea id="three3" class="form-control" style="height:50px" readonly="readonly"><?php echo $three; ?></textarea></td>
            <td><textarea id="a_three3" class="form-control" style="height:50px" readonly="readonly"><?php echo $a_three; ?></textarea></td>
        </tr>
        <tr>
            <td><strong>11.30-12.30</strong></td>
            <td><textarea id="four4" class="form-control" style="height:50px" readonly="readonly"><?php echo $four; ?></textarea></td>
            <td><textarea id="a_four4" class="form-control" style="height:50px" readonly="readonly"><?php echo $a_four; ?></textarea></td>
        </tr>
        <tr>
            <td><strong>12.30-01.30</strong></td>
            <td><textarea id="five5" class="form-control" style="height:50px" readonly="readonly"><?php echo $five; ?></textarea></td>
            <td><textarea id="a_five5" class="form-control" style="height:50px" readonly="readonly"><?php echo $a_five; ?></textarea></td>
        </tr>
        <tr>
            <td><strong>01.30-02.30</strong></td>
            <td><textarea id="six6" class="form-control" style="height:50px" readonly="readonly"><?php echo $six; ?></textarea></td>
            <td><textarea id="a_six6" class="form-control" style="height:50px" readonly="readonly"><?php echo $a_six; ?></textarea></td>
        </tr>
        <tr>
            <td><strong>02.30-03.30</strong></td>
            <td><textarea id="seven7" class="form-control" style="height:50px" readonly="readonly"><?php echo $seven; ?></textarea></td>
            <td><textarea id="a_seven7" class="form-control" style="height:50px" readonly="readonly"><?php echo $a_seven; ?></textarea></td>
        </tr>
        <tr>
            <td><strong>03.30-04.30</strong></td>
            <td><textarea id="eight8" class="form-control" style="height:50px" readonly="readonly"><?php echo $eight; ?></textarea></td>
            <td><textarea id="a_eight8" class="form-control" style="height:50px" readonly="readonly"><?php echo $a_eight; ?></textarea></td>
        </tr>
        <tr>
            <td><strong>04.30-05.30</strong></td>
            <td><textarea id="nine9" class="form-control" style="height:50px" readonly="readonly"><?php echo $nine; ?></textarea></td>
            <td><textarea id="a_nine9" class="form-control" style="height:50px" readonly="readonly"><?php echo $a_nine; ?></textarea></td>
        </tr>
        <tr>
            <td><strong>05.30-06.30</strong></td>
            <td><textarea id="ten10" class="form-control" style="height:50px" readonly="readonly"><?php echo $ten; ?></textarea></td>
            <td><textarea id="a_ten10" class="form-control" style="height:50px" readonly="readonly"><?php echo $a_ten; ?></textarea></td>
        </tr>
        <tr>
            <td><strong>Over Time</strong></td>
            <td colspan="2"><textarea id="over_time10" class="form-control" style="height:50px" readonly="readonly"><?php echo $over_time; ?></textarea></td>
        </tr>
    </table>
    </div>
</div>
</form>