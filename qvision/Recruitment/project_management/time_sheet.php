<?php
require '../../../connect.php';
require '../../../user.php';
$userrole=$_SESSION['userrole'];
$candidateid=$_SESSION['candidateid'];

$one=''; $two=''; $three=''; $four=''; $five=''; $six='';
$seven=''; $eight=''; $nine=''; $ten =''; $over_time='';

$a_one=''; $a_two=''; $a_three=''; $a_four=''; $a_five=''; $a_six='';
$a_seven=''; $a_eight=''; $a_nine=''; $a_ten =''; $a_over_time='';

$user_id=$_SESSION['userid'];
$date = date('Y-m-d');	
$stmt = $con->query("select * from time_sheet where staff_id='$candidateid' and date='$date'");

$row = $stmt->fetch();
if($row){
    $one=$row['one']; $two=$row['two']; $three=$row['three'];
    $four=$row['four']; $five=$row['five']; $six=$row['six'];
    $seven=$row['seven']; $eight=$row['eight']; $nine=$row['nine'];
    $ten=$row['ten']; $over_time=$row['over_time'];

    $a_one=$row['a_one']; $a_two=$row['a_two']; $a_three=$row['a_three'];
    $a_four=$row['a_four']; $a_five=$row['a_five']; $a_six=$row['a_six'];
    $a_seven=$row['a_seven']; $a_eight=$row['a_eight']; $a_nine=$row['a_nine'];
    $a_ten=$row['a_ten']; $a_over_time=$row['a_over_time'];
}
?>

<form role="form" name="" action="qvision/Recruitment/project_management/time_sheet_submit.php" method="post" enctype="multipart/type">
<div class="card card-primary shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title m-0"><font size="5">Hourly Time Sheet For <?php echo $date?></font></h3>
        <div class="d-flex align-items-center">
            <strong class="mr-2" style="font-size: 1.1rem; color: #fff;">In Time:</strong>
            <input type="text" id="one1" name="one1" class="form-control" style="width: 140px; text-align: center; font-weight: bold;" placeholder="e.g. 09:30 AM" value="<?php echo $one?>">
        </div>
    </div>
    <div class="card-body">
    <table class="table table-bordered">
        <tr>
            <td colspan="3" class="text-center py-3">
                <img src="qvision/images/logo123.jpg" alt="logo" style="width:80px; height:auto; margin-bottom:10px;"><br>
                <h5 class="mb-0 font-weight-bold">Aeronero Solutions Private Limited</h5>
            </td>
        </tr>
        <tr style="background-color: #f4f6f9;">
            <th width="15%" class="text-center align-middle">Time</th>
            <th width="42.5%" class="text-center align-middle">To-do List</th>
            <th width="42.5%" class="text-center align-middle">Task Completed</th>
        </tr>
        <tr>
            <td><strong>9.30-10.30</strong></td>
            <td><textarea id="two2" name="two2" class="form-control" style="height:50px"><?php echo $two; ?></textarea></td>
            <td><textarea id="a_two2" name="a_two2" class="form-control" style="height:50px"><?php echo $a_two; ?></textarea></td>
        </tr>
        <tr>
            <td><strong>10.30-11.30</strong></td>
            <td><textarea id="three3" name="three3" class="form-control" style="height:50px"><?php echo $three; ?></textarea></td>
            <td><textarea id="a_three3" name="a_three3" class="form-control" style="height:50px"><?php echo $a_three; ?></textarea></td>
        </tr>
        <tr>
            <td><strong>11.30-12.30</strong></td>
            <td><textarea id="four4" name="four4" class="form-control" style="height:50px"><?php echo $four; ?></textarea></td>
            <td><textarea id="a_four4" name="a_four4" class="form-control" style="height:50px"><?php echo $a_four; ?></textarea></td>
        </tr>
        <tr>
            <td><strong>12.30-01.30</strong></td>
            <td><textarea id="five5" name="five5" class="form-control" style="height:50px"><?php echo $five; ?></textarea></td>
            <td><textarea id="a_five5" name="a_five5" class="form-control" style="height:50px"><?php echo $a_five; ?></textarea></td>
        </tr>
        <tr>
            <td><strong>01.30-02.30</strong></td>
            <td><textarea id="six6" name="six6" class="form-control" style="height:50px"><?php echo $six; ?></textarea></td>
            <td><textarea id="a_six6" name="a_six6" class="form-control" style="height:50px"><?php echo $a_six; ?></textarea></td>
        </tr>
        <tr>
            <td><strong>02.30-03.30</strong></td>
            <td><textarea id="seven7" name="seven7" class="form-control" style="height:50px"><?php echo $seven; ?></textarea></td>
            <td><textarea id="a_seven7" name="a_seven7" class="form-control" style="height:50px"><?php echo $a_seven; ?></textarea></td>
        </tr>
        <tr>
            <td><strong>03.30-04.30</strong></td>
            <td><textarea id="eight8" name="eight8" class="form-control" style="height:50px"><?php echo $eight; ?></textarea></td>
            <td><textarea id="a_eight8" name="a_eight8" class="form-control" style="height:50px"><?php echo $a_eight; ?></textarea></td>
        </tr>
        <tr>
            <td><strong>04.30-05.30</strong></td>
            <td><textarea id="nine9" name="nine9" class="form-control" style="height:50px"><?php echo $nine; ?></textarea></td>
            <td><textarea id="a_nine9" name="a_nine9" class="form-control" style="height:50px"><?php echo $a_nine; ?></textarea></td>
        </tr>
        <tr>
            <td><strong>05.30-06.30</strong></td>
            <td><textarea id="ten10" name="ten10" class="form-control" style="height:50px"><?php echo $ten; ?></textarea></td>
            <td><textarea id="a_ten10" name="a_ten10" class="form-control" style="height:50px"><?php echo $a_ten; ?></textarea></td>
        </tr>
        <tr>
            <td><strong>Over Time</strong></td>
            <td colspan="2"><textarea id="over_time10" name="over_time10" class="form-control" style="height:50px" placeholder="Enter Actual Over Time Task..."><?php echo $over_time; ?></textarea></td>
        </tr>
    </table>
    <input type="hidden" id="pro_id" name="pro_id" value="<?php echo $candidateid; ?>" />
    <input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
    </div>
</div>
</form>

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

<script>
$(document).ready(function(){

    function makeReadonly(id) {
        var el = document.getElementById(id);
        if (el && el.value.trim() !== "") {
            $('#' + id).attr('readonly', 'readonly');
        } else if(el) {
            $('#' + id).removeAttr('readonly');
        }
    }

    var fields = [
        'one1', 'two2', 'three3', 'four4', 'five5', 'six6', 'seven7', 'eight8', 'nine9', 'ten10', 'over_time10',
        'a_one1', 'a_two2', 'a_three3', 'a_four4', 'a_five5', 'a_six6', 'a_seven7', 'a_eight8', 'a_nine9', 'a_ten10'
    ];

    for (var i = 0; i < fields.length; i++) {
        makeReadonly(fields[i]);
    }

}); 
</script>



