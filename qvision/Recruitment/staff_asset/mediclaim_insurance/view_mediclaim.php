<?php
require '../../../../connect.php';
include("../../../../user.php");
$userrole = $_SESSION['userrole'];
?>

<head>
  <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">
      <font size="5"> Mediclaim Insurance </font>
    </h3>
    <a onclick="generate_insurance()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i> ADD</a>
  </div>

  <div class="row content">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <!--    Staff Asset  -->
        </div>

        <!-- Content Header (Page header) -->

        <!-- Main content -->
          <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
            <thead>
              <th>ID</th>
              <th>Employee Name</th>
              <th>Insurance Name</th>
              <th>Validate From</th>
              <th>Validate To</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php
              $emp_sql = $con->query("SELECT sm.emp_name,s.insurance_name,s.validate_from,s.validate_to,s.id AS sid FROM mediclamim_insurance s  join staff_master sm on s.emp_name=sm.id ");
              
              $i = 1;
              while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
              ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $emp_res['emp_name']; ?></td>
                  <td><?php echo $emp_res['insurance_name']; ?></td>
                  <td><?php echo $emp_res['validate_from']; ?></td>
                  <td><?php echo $emp_res['validate_to']; ?></td>
                  <td>
                    <button class="btn btn-success btn-sm edit btn-flat" onclick="edit_insurance(<?php echo $emp_res['sid']; ?>)"><i class="fa fa-edit"></i> Edit</button>
                  </td>
                </tr>
              <?php
                $i++;
              }
              ?>
            </tbody>
          </table>


        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->

  <!-- /.content -->
</div>

<script>
  $(document).ready(function() {
    $('.dataTables-example').DataTable({
      responsive: true
    });
  });

  function generate_insurance() {
    $.ajax({
      type: "POST",
      url:  'qvision/Recruitment/staff_asset/mediclaim_insurance/mediclaim.php',
      success: function(data) {
        $("#leave_view").html(data);
      }
    })
  }

  function edit_insurance(v) {
    $.ajax({
      type: "POST",
      url: "qvision/Recruitment/staff_asset/mediclaim_insurance/edit_mediclaim.php?id=" + v,
      success: function(data) {
        $("#leave_view").html(data);
      }
    })
  }
</script>