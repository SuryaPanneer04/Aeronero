<?php
require '../../connect.php';
require '../../user.php';
echo $empid = $_SESSION['candidateid'];
?>
<div class="content-wrapper" style="padding-left: 50px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Assessment</h1>
        </div>

      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <form method="POST" enctype="multipart/form-data">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <tr>


                    </tr>
                  </thead>
                  <tbody>

                    <?php



                    $emp = $con->query("select * from staff_master where candid_id='$empid'");
                    //echo "select * from staff_master where candid_id='$empid'";
                    $fet = $emp->fetch();
                    $staffid = $fet['id'];

                    $select = $con->query("SELECT * FROM emp_assessment_login_detail where staff_id='$staffid' and status=1");
                    //echo "SELECT * FROM emp_assessment_login_detail where staff_id='$staffid'";
                    if ($select) {
                      $fdata = $select->fetch(PDO::FETCH_ASSOC);

                      if ($fdata && isset($fdata['qn_name_id'])) {
                        $qn_name = $fdata['qn_name_id'];
                      } else {
                        $qn_name = null; // or "N/A" or any fallback
                        // Optional debug
                        // echo "No record found for staff ID: $staffid";
                      }
                    } else {
                      // Query execution failed
                      $qn_name = null;
                      // Optional debug:
                      // print_r($con->errorInfo());
                    }

                    $sql = $con->query("SELECT distinct section,name FROM assessment_qn_master a join section_master s on a.section=s.id
where qn_name='$qn_name'");
                    $cnt = 1;
                    while ($row1 = $sql->fetch(PDO::FETCH_ASSOC))
                    //echo "<pre>";print_r($row);exit();
                    {
                      $secid = $row1['section'];
                      $sql1 = $con->query("SELECT * FROM assessment_qn_master where section='$secid' and qn_name='$qn_name'");
                    ?>
                      <tr>
                        <td>
                          <h4><b><?php echo $row1['name']; ?></b></h4>
                        </td>
                        <?php

                        while ($row = $sql1->fetch(PDO::FETCH_ASSOC)) {

                        ?>

                      <tr>
                        <td class="center"><?php echo $cnt; ?>.</td>

                        <td style="font-size: 18px;">

                          <?php echo $row['Questions']; ?>



                          <br>
                          <br>

                          <input type="radio" name="answer_value_<?php echo $cnt; ?>" id="answer_1_<?php echo $cnt; ?>" value="1">
                          <input type="hidden" name="question_value_<?php echo $cnt; ?>" id="question_<?php echo $cnt; ?>" value="<?php echo $row['id']; ?>">
                          <?php echo $row['Option_A']; ?>

                          <br>

                          <input type="radio" name="answer_value_<?php echo $cnt; ?>" id="answer_2_<?php echo $cnt; ?>" value="2">
                          <input type="hidden" name="question_value_<?php echo $cnt; ?>" id="question_<?php echo $cnt; ?>" value="<?php echo $row['id']; ?>">
                          <?php echo $row['Option_B']; ?>

                          <br>

                          <input type="radio" name="answer_value_<?php echo $cnt; ?>" id="answer_3_<?php echo $cnt; ?>" value="3">
                          <input type="hidden" name="question_value_<?php echo $cnt; ?>" id="question_<?php echo $cnt; ?>" value="<?php echo $row['id']; ?>">
                          <?php echo $row['Option_C']; ?>

                          <br>

                          <input type="radio" name="answer_value_<?php echo $cnt; ?>" id="answer_4_<?php echo $cnt; ?>" value="4">
                          <input type="hidden" name="question_value_<?php echo $cnt; ?>" id="question_<?php echo $cnt; ?>" value="<?php echo $row['id']; ?>">
                          <?php echo $row['Option_D']; ?>
                        </td>



                      </tr>

                    <?php

                          $cnt = $cnt + 1;
                        }

                    ?>

                    </tr>
                  <?php

                    }
                    $total = $cnt;
                  ?>
                  <input type="hidden" name="count" id="count" value="<?php echo $total; ?>">
                  </tbody>
                  <input type="hidden" name="candidateid" value="<?php echo $empid; ?>">
                  <input type="hidden" name="qn_id" value="<?php echo $qn_name; ?>">
                </table>
                <input type="button" class="btn btn-o btn-primary" name="submit" id="<?php echo $total; ?>" onclick="Answer_keys(this.id)" value="Submit">
              </form>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
</div>
</div>
<script>
  function Answer_keys(v) {

    var count = v;
    //alert(id);
    var data = $('form').serialize();
    $.ajax({
      type: 'GET',
      data: data + "&" + "count=" + count,
      url: 'qvision/assesment_question/Answer_validation.php',

      success: function(data) {

        alert('Your  Answer  Updated Successfully');
        window.location = 'login/logout.php'

      }
    });
  }
</script>