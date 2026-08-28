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
      <font size="5"> Company E-mail </font>
    </h3>
    <a onclick="generate_mail()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i> GENERATE</a>
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
              <th>Mail ID</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php
              $emp_sql = $con->query("SELECT s.id as sid,sm.emp_name as ename,s.mail_id FROM emp_mail_details s join staff_master sm on s.emp_name=sm.candid_id");
              $i = 1;
              while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
              ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $emp_res['ename']; ?></td>
                  <td><?php echo $emp_res['mail_id']; ?></td>

                  <td>
                    <button class="btn btn-success btn-sm edit btn-flat" onclick="edit_mail(<?php echo $emp_res['sid']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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

  function generate_mail() {
    $.ajax({
      type: "POST",
      url: "/qvision/Recruitment/staff_asset/mail_generation/mail_generate.php",
      success: function(data) {
        $("#leave_view").html(data);
      }
    })
  }

  function edit_mail(v) {
    $.ajax({
      type: "POST",
      url: "qvision/Recruitment/staff_asset/mail_generation/edit_mail_generate.php?id=" + v,
      success: function(data) {
        $("#leave_view").html(data);
      }
    })
  }
</script>