<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = $_SESSION['userrole'];
$user_candid = $_SESSION['candidateid'];
// echo '<div><h1>usercandidate : ' . $user_candid . '</h1></div>';
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="Qvision\commonstyle.css">
  <style>
    .card-body>p {
      font-weight: bold;
      font-size: 20px;
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="card card-primary">
    <div class="card-header" style="background-color:#ff8b3d !important;">
      <h3 class="card-title">
        <font size="5">SELF APPRAISAL LIST</font>
      </h3>
      <?php
      date_default_timezone_set("Asia/Kolkata");
      $curDate = date('Y-m-d');
      $todayDate = date('Y-m-d', strtotime($curDate));
      $appraisal_start = date('Y-m-d', strtotime("04/16/" . date("Y"))); //strtotime(m/d/y)
      $appraisal_end = date('Y-m-d', strtotime("05/15/" . date("Y"))); //strtotime(m/d/y)

      //if($todayDate >= $appraisal_start and $todayDate <= $appraisal_end ){
      if ($todayDate >= $appraisal_start || $todayDate <= $appraisal_end) {
      ?>

        <a onclick="add_appraisal()" style="float: right;" data-toggle="modal" class="btn">ADD</a>

      <?php   }  else { ?>
        <h4 class="card-title" style="float: right;"> Self Appraisal Question is open in April to May  FY Month  </h4>

        <?php   }  ?>
    </div>
    <div class="card-body">
      <table class="table table-bordered display nowrap" id="example1" style="width:100%">
        <thead>
          <th>S.No</th>
          <th>Department</th>
          <th>Created Date</th>
          <th>Tools</th>
        </thead>
        <tbody>
          <?php
            $emp_sql = $con->query("select a.id as aid,a.dep_name as dept,b.dept_name,a.person_id,a.created_on from  self_appraisal_master a left join z_department_master b on a.dep_name=b.id where a.person_id='$user_candid' && EXTRACT(YEAR_MONTH FROM now()) BETWEEN EXTRACT(YEAR_MONTH FROM a.created_on) AND EXTRACT(YEAR_MONTH FROM (a.created_on)+1 ) order by a.id DESC");

          $i = 1;
          while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
          ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $emp_res['dept_name']; ?></td>
              <td><?php echo date('d-m-Y',strtotime($emp_res['created_on'])); ?></td>
              <td>
                <?php 
                  //if($todayDate >= $appraisal_start and $todayDate <= $appraisal_end ){
                  if ($todayDate >= $appraisal_start || $todayDate <= $appraisal_end) {
                ?>
                <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['aid']; ?>" onclick="question_edit(<?php echo $emp_res['aid']; ?>,<?php echo $emp_res['dept']; ?>)"><i class="fa fa-edit"></i> Edit</button>

                <?php   }  ?>

                <button class="btn btn-info btn-sm view btn-flat" data-id="<?php echo $emp_res['aid']; ?>" onclick="question_view(<?php echo $emp_res['aid']; ?>,<?php echo $emp_res['dept']; ?>)"><i class="fa fa-eye"></i> view</button>

                <button class="btn btn-dark btn-sm view btn-flat" data-id="<?php echo $emp_res['aid']; ?>" onclick="question_appraisal(<?php echo $emp_res['aid']; ?>,<?php echo $emp_res['dept']; ?>)"><i class="fa fa-address-card"></i> Appraisal </button>

              </td>
            </tr>
          <?php
            $i++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>


  <script>
    $(document).ready(function() {
      $('#example1').DataTable({
        "scrollX": true
      });

      $('.dataTables-example').DataTable({
        responsive: true
      });
    });

    function add_appraisal() {
      $.ajax({
        type: "POST",
        url: "qvision/masters/self_appraisal_master/new_selfappraisal_master.php",
        success: function(data) {
          $("#main_content").html(data);
        }
      })
    }

    function question_edit(v, e) {
      $.ajax({
        type: "POST",
        url: "qvision/masters/self_appraisal_master/edit_selfappraisal_master.php?id=" + v + "&dept=" + e,
        success: function(data) {
          $("#main_content").html(data);
        }
      })
    }

    function question_view(v, e) {
      $.ajax({
        type: "POST",
        url: "qvision/masters/self_appraisal_master/view_selfappraisal_master.php?id=" + v + "&dept=" + e,
        success: function(data) {
          $("#main_content").html(data);
        }
      })
    }

    function question_appraisal(v,e)
    {
        $.ajax({
            type: "POST",
            url: "qvision/appraisal/self_appraisal/self_appraisal.php?id=" + v,
            success: function (data) {
                $("#main_content").html(data);
            }
        })
    }
  </script>
</body>

</html>