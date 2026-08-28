<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = $_SESSION['userrole'];
?>

<head>
  <style>
    #page-wrapper {
      margin-left: 117px !important;
    }

    .btn-warning {
      padding-top: 0px !important;
    }

    .btn-warning {
      background-color: #337ab7 !important;
      border-color: #337ab7 !important;
    }

    .btn-success {
      background-color: #5cb85c !important;
      border-color: #5cb85c !important;
    }

    .page-header {
      border-bottom: 3px solid #eee !important;
    }
  </style>

  <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<div class="card card-primary">

  <div class="card-header">
    <h3 class="card-title">
      <font size="5"> Hike Master </font>
    </h3>
    <a onclick="new_hikeadd()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-plus"></i> ADD</a>
  </div>

  <div class="card-body">
    <table id="example1" class="dataTables-example table table-bordered">
      <thead>
        <th>S.No</th>
        <th>EmployeeName</th>
        <th>Department</th>
        <th>Status</th>
        <th>Tools</th>
      </thead>
      <tbody>
        <?php
//         $emp_sql = $con->query("SELECT h.id, e.emp_name, h.status, z.dept_name
// FROM hike_master h
// LEFT JOIN employee_master e ON h.emp_id = e.id
// LEFT JOIN z_department_master z ON h.dept_id = z.id
// ");

    $emp_sql = $con->query("SELECT h.id, h.employeename, h.status, z.dept_name
 FROM hike_master h
 LEFT JOIN employee_master e ON h.emp_id = e.id
 LEFT JOIN z_department_master z ON h.dept_id = z.id
 ");

        $i = 1;
        while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
        ?>
          <tr>
            
            <td><?php echo $i; ?></td>
            <td><?php echo $emp_res['employeename']; ;?></td>
            <td><?php echo $emp_res['dept_name']; ?></td>
            <td>
              <?php
              if ($emp_res['status'] == 1) {
                echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
              } else {
                echo '<span style="color:red;text-align:center;"><b>Inactive</b></span>';
              }
              ?>
            </td>
            <td>
              <button class="btn btn-success btn-sm edit btn-flat"  onclick="hike_edit(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
            </td>
          </tr>
        <?php
          $i++;
        }
        ?>
      </tbody>
    </table>

  </div>
  <!-- /.card -->
</div>
<!-- /.col -->

<script>

  function new_hikeadd() {

    $.ajax({
      type: "POST",
      url: 'qvision/masters/hike_master/new_hikeadd.php',
      success: function(data) {
        $("#main_content").html(data);
      }
    })
  }

  function hike_edit(v) {
    $.ajax({
      type: "POST",
      url: "qvision/masters/hike_master/edit_hike.php?id=" + v,
      success: function(data) {
        $("#main_content").html(data);
      }
    })
  }
</script>