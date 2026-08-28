<!DOCTYPE html>
<html>
<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = $_SESSION['userrole'];
$user_candid = $_SESSION['candidateid'];

//$id = $_REQUEST['id'];

$emp = $con->query("select s.id,s.emp_name,s.dep_id,z.dept_name from staff_master s LEFT JOIN z_department_master z ON s.dep_id=z.id where candid_id='$user_candid'");
$emp_no = $emp->fetch();
$emp_id = $emp_no['id'];
$emp_depid = $emp_no['dep_id'];
$emp_dep = $emp_no['dept_name'];
?>

<head>
  <link rel="stylesheet" href="Qvision\commonstyle.css">
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

    .card-body>p {
      font-weight: bold;
      font-size: 20px;
      text-align: center;
    }
  </style>
</head>

<body>
  <?php
  date_default_timezone_set("Asia/Kolkata");
  $curDate = date('Y-m-d');
  $todayDate = date('Y-m-d', strtotime($curDate));
  $appraisal_start = date('Y-m-d', strtotime("06/01/" . date("Y"))); //strtotime(m/d/y)
  $appraisal_end = date('Y-m-d', strtotime("01/31/" . date("Y", strtotime('+1 years')))); //strtotime(m/d/y)

  if ($todayDate >= $appraisal_start and $todayDate <= $appraisal_end) {
    //if($todayDate >= $appraisal_start || $todayDate <= $appraisal_end ){
  ?>

    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">
          <font size="5">SELF APPRAISAL </font>
        </h3>
        <a onclick="backtoselfappraisal()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
      </div>

      <form method="POST" action="">

        <input type="hidden" name="self_appraisalMaster_id" id="self_appraisalMaster_id" value="<?php echo $emp_id; ?>">
        <input type="hidden" name="personid" id="personid" value="<?php echo $user_candid; ?>">
        <input type="hidden" name="userrole" id="userrole" value="<?php echo $userrole; ?>">
        <input type="hidden" name="emp_no" id="emp_no" value="<?php echo $emp_id; ?>">
        <table class="table table-bordered">

          <tr>
            <td>Department Name</td>
            <td colspan="2">
              <input type="text" id="department" name="department" class="form-control" value="<?php echo $emp_dep; ?>" readonly>
            </td>
          </tr>

          <table class="table table-bordered" id="question_view">
            <tbody>
              <tr>
                <td colspan='2'>
                  <h3>
                    <center>Appraisal Questions</center>
                  </h3>
                </td>
              </tr>
              <?php
              $sql = $con->query("SELECT a.id,a.dep_name,a.question,b.rating,b.emp_name,b.id as self_app_id FROM self_appraisal_question a left join self_appraisal_rating b on a.id=b.question_id where a.self_appraisal_id='$emp_id'");
              $count = $sql->rowCount();
              $cnt = 0;
              ?>
              <tr>
                <td> Questions </td>
                <td> Rating</td>
                <input type="hidden" name="count" id="rate_totcnt" value="<?php echo $count; ?>">
              </tr>
              <?php
              while ($rows = $sql->fetch(PDO::FETCH_ASSOC)) {
              ?>
                <tr>
                  <td>
                    <input type="hidden" name="qid<?php echo $cnt; ?>[]" id="qid" value="<?php echo $qid = $rows['id']; ?>">
                    <input type="hidden" name="sid<?php echo $cnt; ?>[]" id="sid" value="<?php echo $rows['self_app_id']; ?>">
                    <input type="text" class="form-control" id="question_1" name="question<?php echo $cnt; ?>" value="<?php echo  $rows['question']; ?>" autocomplete="off" readonly>
                  </td>

                  <td style="display: flex; justify-content: space-around; align-items: baseline;">
                    <label for="performance"> 1</label>
                    <?php if ($rows['rating'] == '') {
                    ?>
                      <input type="radio" name="rating<?php echo $cnt; ?>[]" id="performance_<?php echo $cnt; ?>" value="1">
                    <?php } else { ?>
                      <input type="radio" name="rating<?php echo $cnt; ?>[]" id="performance_<?php echo $cnt; ?>" value="<?php echo $rows['rating']; ?>" <?php if ($rows['rating'] == '1') { echo "checked"; } else { echo "disabled";} ?>>
                    <?php } ?>

                    <label for="performance"> 2</label>
                    <?php if ($rows['rating'] == '') {
                    ?>
                      <input type="radio" name="rating<?php echo $cnt; ?>[]" id="performance_<?php echo $cnt; ?>" value="2">
                    <?php } else { ?>
                      <input type="radio" name="rating<?php echo $cnt; ?>[]" id="performance_<?php echo $cnt; ?>" value="<?php echo $rows['rating']; ?>" <?php if ($rows['rating'] == '2') { echo "checked"; } else { echo "disabled"; } ?>>
                    <?php } ?>

                    <label for="performance"> 3</label>
                    <?php if ($rows['rating'] == '') {
                    ?>
                      <input type="radio" name="rating<?php echo $cnt; ?>[]" id="performance_<?php echo $cnt; ?>" value="3">
                    <?php } else { ?>
                      <input type="radio" name="rating<?php echo $cnt; ?>[]" id="performance_<?php echo $cnt; ?>" value="<?php echo $rows['rating']; ?>" <?php if ($rows['rating'] == '3') { echo "checked"; } else { echo "disabled"; } ?>>
                    <?php } ?>

                    <label for="performance"> 4</label>
                    <?php if ($rows['rating'] == '') {
                    ?>
                      <input type="radio" name="rating<?php echo $cnt; ?>[]" id="performance_<?php echo $cnt; ?>" value="4">
                    <?php } else { ?>
                      <input type="radio" name="rating<?php echo $cnt; ?>[]" id="performance_<?php echo $cnt; ?>" value="<?php echo $rows['rating']; ?>" <?php if ($rows['rating'] == '4') { echo "checked"; } else { echo "disabled"; } ?>>
                    <?php } ?>

                    <label for="performance"> 5</label>
                    <?php if ($rows['rating'] == '') {
                    ?>
                      <input type="radio" name="rating<?php echo $cnt; ?>[]" id="performance_<?php echo $cnt; ?>" value="5">
                    <?php } else { ?>
                      <input type="radio" name="rating<?php echo $cnt; ?>[]" id="performance_<?php echo $cnt; ?>" value="<?php echo $rows['rating']; ?>" <?php if ($rows['rating'] == '5') { echo "checked"; } else { echo "disabled"; } ?>>
                    <?php } ?>

                  </td>
                </tr>
              <?php
                $cnt++;
              } ?>
            </tbody>
          </table>

        </table>
        <input type="button" name="submit" value="Submit" id="submit" class="btn btn-primary" style="float:right;position: relative;width: 100px;right: 10px;" onclick="submit_appraisal()">
      </form>
      <br>
    </div>

  <?php
  } else {
  ?>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">
          <font size="5">SELF APPRAISAL </font>
        </h3>
      </div>
      <div class="card-body">
        <p>Self Appraisal Rating Period is Before February-<?php echo date("Y") + 1; ?></p>
      </div>
    </div>

  <?php   }  ?>


  <script>
    $(document).ready(function() {
      let total_rowcount = $('#rate_totcnt').val()
      let selectedrow = $("input:radio:checked").length
      if (total_rowcount == selectedrow) {
        $('#submit').hide()
      }
    })

    function submit_appraisal() {
      let first_row = $("input:radio:checked").length;
      let data = $('form').serialize();
      $.ajax({
        type: 'GET',
        data: data,
        url: "qvision/appraisal/self_appraisal/selfappraisal_submit.php?rating_count=" + first_row,
        success: function(data) {
          if (data == 0) {
            alert("Submission Failed");
            //self_appraisal();
            self_appraisal_master()
          } else {
            alert("Submitted Successfully");
            //self_appraisal();
            self_appraisal_master()
          }
        }
      });
    }

    function backtoselfappraisal(){
      self_appraisal_master()
    }
  </script>
</body>

</html>