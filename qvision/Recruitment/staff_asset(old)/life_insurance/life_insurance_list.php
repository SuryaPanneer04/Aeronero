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
      <font size="5"> Life Insurance </font>
    </h3>
    <a onclick="add_insurance()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i> ADD</a>
  </div>

        <!-- Content Header (Page header) -->

        <!-- Main content -->


        <div class="card-body">
          <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
            <thead>
              <th>ID</th>
              <th>Employee Name</th>
              <th>Insurance Name</th>
              <th>Validity From</th>
              <th>Validity To</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php
              $emp_sql = $con->query("SELECT s.id as sid,sm.emp_name as ename,s.insurance_name,s.validity_from,s.validity_to FROM life_insurance s join staff_master sm on s.emp_id=sm.id");
              $i = 1;
              while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
              ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $emp_res['ename']; ?></td>
                  <td><?php echo $emp_res['insurance_name']; ?></td>
                  <td><?php echo $emp_res['validity_from']; ?></td>
                  <td><?php echo $emp_res['validity_to']; ?></td>

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

        </div>
</div>

<script>
  $(document).ready(function() {
    $('.dataTables-example').DataTable({
      responsive: true
    });
  });

  function add_insurance() {
    $.ajax({
      type: "POST",
      url: "qvision/Recruitment/staff_asset/life_insurance/add_insurance.php",
      success: function(data) {
        $("#leave_view").html(data);
      }
    })
  }

  function edit_insurance(v) {
    $.ajax({
      type: "POST",
      url: "qvision/Recruitment/staff_asset/life_insurance/edit_insurance.php?id=" + v,
      success: function(data) {
        $("#leave_view").html(data);
      }
    })
  }
</script>