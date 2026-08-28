<?php
require '../../connect.php';
require '../../user.php';
$candidateid = $_SESSION['candidateid'];
$userrole = $_SESSION['userrole'];
$id = $_REQUEST['id'];
$stmt = $con->prepare("SELECT a.id as aid,a.emp_name as emp_id,b.dept_name,d.designation_name,e.emp_name,e.candid_id as emp_candidid,a.remark, a.from_date,a.to_date,a.person_id as pid, a.salary,e.salary_amount,a.status,s.emp_name as pname,a.new_salary_start_date as start_date,a.overall_points,a.appraisal_point,a.recommend_full_appraisal,a.full_appraisal_meet_date,a.reject_remark,a.md_reject__remark,a.new_designation FROM appraisal_details a 
LEFT JOIN z_department_master b ON a.dep_name=b.id 
LEFT JOIN designation_master d ON a.new_designation=d.id 
LEFT JOIN staff_master e ON a.emp_name=e.id  
LEFT JOIN staff_master s ON a.person_id=s.id   
where a.id='$id' "); //and a.person_id='$candidateid'


$stmt->execute();
$row = $stmt->fetch();
$per_id = $row['pid'];
$candidate_id = $row['emp_candidid'];

$from_date = $row['from_date'];
$appfrom_date = date("d-M-Y", strtotime($from_date));

$to_date = $row['to_date'];
$appto_date = date("d-M-Y", strtotime($to_date));

$salarydate = $row['start_date'];
$saldate = date("d-M-Y", strtotime($salarydate));

$meet_date = $row['full_appraisal_meet_date'];
$app_meet_date = date('d-M-Y', strtotime($meet_date));

$emp_id = $row['emp_id'];
$emp_new_salary = $row['salary'];
$emp_salary = $row['salary_amount'];
//echo $emp_new_salary; echo"<br>";
//echo $emp_salary; echo"<br>";
$per_salary = $emp_salary * $emp_new_salary / 100;
//echo $per_salary; echo"<br>";
$new_salary = $emp_salary + $per_salary;

?>

<head>
  <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<style>
  .card-primary:not(.card-outline)>.card-header {
    background-color: #f1cc61 !important;
  }

  .card-primary:not(.card-outline)>.card-header {
    color: black !important;
  }

  .btn-dark {
    background-color: #ed5d00 !important;
    border-color: #ed5d00 !important;
  }

  .card-primary:not(.card-outline)>.card-header a {
    color: black !important;
  }
</style>

<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">
      <font size="5">EDIT APPRAISAL DETAILS</font>
    </h3>
    <a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
  </div>
  <div class="card-body" id="printableArea">
    <form role="form" method="post" enctype="multipart/type">
      <input type="hidden" class="form-control" id="aid" name="aid" value="<?php echo $row['aid']; ?>">
      <input type="hidden" class="form-control" id="recomend" name="recomend" value="<?php echo $row['recommend_full_appraisal']; ?>">

      <table class="table table-bordered">
        <tr>
          <td>Department Name</td>
          <td colspan="5">
            <input type="text" class="form-control" id="department" name="department" value="<?php echo  $row['dept_name']; ?>" readonly>
          </td>
        </tr>

        <tr>
          <td>Employee Name</td>
          <td colspan="2">
            <input type="hidden" class="form-control" id="emp" name="emp" value="<?php echo  $row['emp_id']; ?>" readonly>
            <input type="text" class="form-control" id="employee" name="employee" value="<?php echo  $row['emp_name']; ?>" readonly>
          </td>
        </tr>

        <tr>
          <td>From Date</td>
          <td colspan="2">
            <input type="text" class="form-control" id="employee" name="employee" value="<?php echo  $appfrom_date; ?>" readonly>
          </td>
        </tr>

        <tr>
          <td>To Date</td>
          <td colspan="2">
            <input type="text" class="form-control" id="employee" name="employee" value="<?php echo $appto_date; ?>" readonly>
          </td>
        </tr>

        <tr>
          <td>Salary (In Percentage)</td>
          <td colspan="2">
            <select class="form-control" name="salary" id="salary">
              <option value="<?php echo $emp_new_salary; ?>"><?php echo $emp_new_salary . '%'; ?></option>
              <option value="0">--- Select Percentage ---</option>
              <?php
              foreach (range(5, 100, 5) as $percent) : ?>
                <option value="<?php echo $percent; ?>"> <?php echo $percent; ?> % </option>
              <?php endforeach; ?>
            </select>
          </td>
        </tr>

        <tr>
          <td>Designation</td>
          <td colspan="2">
            <select class="form-control" name="new_designation" id="new_designation">
              <option value="<?php echo  $row['new_designation']; ?>"> <?php echo  $row['designation_name']; ?> </option>
              <option value="">--- Select Designation ---</option>
              <?php
              $des_sql = $con->query("SELECT id, designation_name FROM designation_master WHERE status=1 AND id<>1");
              while ($des_sql_res = $des_sql->fetch(PDO::FETCH_ASSOC)) {
              ?>
                <option value="<?php echo $des_sql_res['id']; ?>"><?php echo $des_sql_res['designation_name']; ?></option>
              <?php
              }
              ?>
            </select>
          </td>
        </tr>

        <!-- /////////////////////////////      Self Appraisal Start /////////////////////////////////////// -->
        <table class="table table-bordered" id="question_view">
          <tbody>
            <tr>
              <td colspan='2'>
                <h3>
                  <center>Self Appraisal Review</center>
                </h3>
              </td>
            </tr>
            <?php
            $maxappraisal_id = $con->query("SELECT max(id) as maxid FROM `self_appraisal_master` WHERE `person_id`='$candidate_id'");
            $max_id = $maxappraisal_id->fetch();
            $selfmaxid = $max_id['maxid'];

            $sql = $con->query("SELECT a.id,a.dep_name,a.question,b.rating,b.emp_name,b.id as self_app_id FROM self_appraisal_question a left join self_appraisal_rating b on a.id=b.question_id where a.self_appraisal_id='$selfmaxid' ");
            $count = $sql->rowCount();
            $cnt = 0;
            if ($count == 0) {
            ?>
              <tr>
                <td style="font-size: 20px;font-weight: 900;text-align: center; color:red;"> Employee not yet fill </td>
              </tr>
            <?php } else { ?>
              <tr>
                <td> Questions </td>
                <td> Rating</td>
              </tr>

              <?php
              $points = 0;
              while ($rows = $sql->fetch(PDO::FETCH_ASSOC)) {
              ?>
                <tr>
                  <td>
                    <input type="text" class="form-control" id="question_1" name="question<?php echo $cnt; ?>" value="<?php echo  $rows['question']; ?>" autocomplete="off" readonly>
                  </td>

                  <td style="display: flex; justify-content: space-around; align-items: baseline;">
                    <label for="performance"> 1</label>
                    <input type="radio" name="rating_<?php echo $cnt; ?>[]" id="performance<?php echo $cnt; ?>" value="<?php echo $rows['rating']; ?>" <?php if ($rows['rating'] == '1') {  echo "checked";  } else {  echo "disabled";  } ?>>
                    <label for="performance"> 2</label>
                    <input type="radio" name="rating_<?php echo $cnt; ?>[]" id="performance<?php echo $cnt; ?>" value="<?php echo $rows['rating']; ?>" <?php if ($rows['rating'] == '2') { echo "checked";  } else {  echo "disabled";  } ?>>
                    <label for="performance"> 3</label>
                    <input type="radio" name="rating_<?php echo $cnt; ?>[]" id="performance<?php echo $cnt; ?>" value="<?php echo $rows['rating']; ?>" <?php if ($rows['rating'] == '3') {  echo "checked";  } else {  echo "disabled";  } ?>>
                    <label for="performance"> 4</label>
                    <input type="radio" name="rating_<?php echo $cnt; ?>[]" id="performance<?php echo $cnt; ?>" value="<?php echo $rows['rating']; ?>" <?php if ($rows['rating'] == '4') {  echo "checked";  } else {  echo "disabled";  } ?>>
                    <label for="performance"> 5</label>
                    <input type="radio" name="rating_<?php echo $cnt; ?>[]" id="performance<?php echo $cnt; ?>" value="<?php echo $rows['rating']; ?>" <?php if ($rows['rating'] == '5') {  echo "checked";  } else { echo "disabled"; } ?>>
                  </td>
                </tr>
              <?php
                $cnt++;
                $per_point = $rows['rating'];
                $points = $points + $per_point;
              }
              ?>

              <tr>
                <td><b>Sum of the Points(OUT OF 25)</b></td>
                <td>
                  <input type="text" class="form-control" id="points_get_self" name="points_get_self" value="<?php echo  $points; ?>" readonly>
                </td>
              </tr>

            <?php } ?>
          </tbody>
        </table>
  <!-- ////////////////////////      Self appraisal END    /////////////////////////////////     -->

        <?php  // Appraisal by HOD
        $remar = $con->query("SELECT a.id,a.emp_name,a.person_id,a.status,b.emp_name as s_emp,c.dept_name as d_name FROM appraisal_details a LEFT JOIN staff_master b ON a.person_id=b.id LEFT JOIN z_department_master c ON b.dep_id=c.id where a.emp_name='$emp_id' AND from_date='$from_date' AND to_date='$to_date'");

        $countt = 1;
        while ($sample = $remar->fetch(PDO::FETCH_ASSOC)) {
          $p_id = $sample['person_id'];
          $personn_id = $sample['s_emp'];
          $dept_name = $sample['d_name'];
        ?>

          <table class="table table-bordered">
            <tbody>
              <tr>
                <td> Manager Name </td>
                <td colspan="2">
                  <input type="text" class="form-control" name="person<?php echo $countt; ?>" value="<?php echo  $personn_id; ?>" readonly>
                </td>
              </tr>

              <?php
              $remark = $con->query("SELECT id,remark,from_date FROM appraisal_details where emp_name='$emp_id' AND person_id='$p_id' AND from_date='$from_date' AND to_date='$to_date'");
              $remark_row = $remark->fetch();

              $sql = $con->query("SELECT  a.id,a.question,b.rating FROM appraisal_question a  LEFT JOIN appraisal_rating b ON  a.id=b.question_id where b.emp_name='$emp_id' AND b.persons_id='$p_id' AND b.from_date ='$from_date' AND b.to_date ='$to_date'");
              $counts = $sql->rowcount();
              $countz = $counts + 1;

              $cnt = 0;
              while ($rows = $sql->fetch(PDO::FETCH_ASSOC)) {
              ?>
                <tr>
                  <td>
                        <input type="hidden" name="counts" id="rate_totcnt" value="<?php echo $counts; ?>">
                        <input type="hidden" name="qid<?php echo $cnt; ?>[]" id="qid" value="<?php echo $qid = $rows['id']; ?>">
                        <input type="text" class="form-control" id="question_1" name="question<?php echo $cnt; ?>" value="<?php echo  $rows['question']; ?>" autocomplete="off" readonly>
                    </td>

                  <td style="display: flex; justify-content: space-around; align-items: baseline;">
                    <label for="performance"> 1</label>
                    <input type="radio" class="calc" name="rating<?php echo $cnt; ?>[]" id="performance_<?php echo $cnt; ?>" value="1" onclick="get_appraisal_point()" <?php if ($rows['rating'] == '1') { echo "checked"; } ?>>

                    <label for="performance"> 2</label>
                    <input type="radio" class="calc" name="rating<?php echo $cnt; ?>[]" id="performance_<?php echo $cnt; ?>" value="2" onclick="get_appraisal_point()" <?php if ($rows['rating'] == '2') { echo "checked"; } ?>>

                    <label for="performance"> 3</label>
                    <input type="radio" class="calc" name="rating<?php echo $cnt; ?>[]" id="performance_<?php echo $cnt; ?>" value="3" onclick="get_appraisal_point()" <?php if ($rows['rating'] == '3') { echo "checked"; } ?>>

                    <label for="performance"> 4</label>
                    <input type="radio" class="calc" name="rating<?php echo $cnt; ?>[]" id="performance_<?php echo $cnt; ?>" value="4" onclick="get_appraisal_point()" <?php if ($rows['rating'] == '4') { echo "checked"; } ?>>

                    <label for="performance"> 5</label>
                    <input type="radio" class="calc" name="rating<?php echo $cnt; ?>[]" id="performance_<?php echo $cnt; ?>" value="5" onclick="get_appraisal_point()" <?php if ($rows['rating'] == '5') { echo "checked";  } ?>>
                  </td>

                </tr>
            <?php
                $cnt++;
              }
              $countt = $countz++;
            }
            ?>

            <tr>
              <td><b>Sum of the Points(OUT OF 75)</b></td>
              <td>
                <input type="text" class="form-control" id="appraisal_score" name="appraisal_score" value="<?php echo $row['appraisal_point']; ?>" readonly>
              </td>
            </tr>

            <tr>
              <td><b>Overall Points(OUT OF 100)</b></td>
              <td>
                <input type="text" class="form-control" id="overallmark" name="overallmark" value="<?php echo $row['overall_points']; ?>" readonly>
              </td>
            </tr>
            <?php
            if ($row['status'] == 2) { ?>
              <tr>
                <td>Reject Remark</td>
                <td colspan="2">
                  <input type="text" class="form-control" id="remark1" name="remark1" value="<?php echo $row['reject_remark']; ?>" readonly />
                </td>
              </tr>

            <?php
            }
            if ($row['status'] == 6) {
            ?>

              <tr>
                <td>MD Reject Remark</td>
                <td colspan="2">
                  <input type="text" class="form-control" id="remark2" name="remark2" value="<?php echo $row['md_reject__remark']; ?>" readonly />
                </td>
              </tr>

            <?php }  ?>
           

          <tr id="recommend">
	          <td>Would you like to recommend for 360* Appraisal?</td>
	          <td><input type="checkbox"  name="appraisal_recommend" id="appraisal_recommend" onclick="hidereason()" <?php if($row['recommend_full_appraisal'] =='on'){ echo "checked";}?> > </td>
          </tr>
          <tr id='reason'>
            <td>Reason for 360* Appraisal</td>
            <td> <textarea class="form-control" id="remark" name="remark"><?php echo  $row['remark'];?> </textarea></td>
          </tr>
           </tbody>
          </table>

      </table>
      <input type="button" name="submit" value="Update" class="btn btn-primary btn-md" style="float:right;" onclick="appraisal_update()">
    </form>
  </div>
</div>

<script>
  $(document).ready(function(){
	$('#recommend').hide()
	$('#reason').hide()

  var chk = $('input:checkbox:checked').val()
  console.log(chk)
  if(chk == 'on'){
    $('#recommend').show()
    $('#reason').show()
  }
})

function hidereason(){
	let checkvalue = $("input:checkbox:checked").val()

	if(checkvalue == 'on'){   /// When full Appraisal open click checkbox to open remark ////
		$('#reason').show()
	}
	else if(checkvalue== null ){
       $('#reason').hide()
	}
  else{
    $('#reason').hide()
  }
}

  function back() {
    appraisal();
  }

  function get_appraisal_point() {

    var score = 0;
    $(".calc:checked").each(function() {
      score += parseInt($(this).val(), 10) * 3;     /// ADD the Appraisal Points ///
    });

    $('#appraisal_score').val(score)    /// Insert the Appraisal Points in the input ///

    let selftotal = $('#points_get_self').val()
    let overall = parseInt(selftotal) + parseInt(score)   /// ADD the self Appraisal & Appraisal Points ///

    $('#overallmark').val(overall)    /// Insert the Total Appraisal Points in the input ///

    if (overall >= 100) {
      $('#recommend').show()       /// When Total mark 100 full appraisal open ///
    } else {
      $('#recommend').hide()
    }
  }

  function appraisal_update()
    {
    var data = $('form').serialize();
    $.ajax({
    type:'POST',
    data: data,
    url:'/ssinfo1/qvision/appraisal/appraisal_update.php',
    success:function(data)
    {
      if(data==0)
      { 
        alert('Not updated');
        appraisal()
      }
      else
      {
        alert("Updated Successfully");
		    appraisal()
      } 
    }       
    });
    }
</script>