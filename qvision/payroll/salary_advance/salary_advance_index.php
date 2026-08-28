<?php
require '../../../connect.php';
?>

<head>
     <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<div class="card card-primary">
  <div class="card-header" style="background-color:#ff8b3d !important;color:white !important;">
    <h3 class="card-title">
      <font size="5">Salary Advance</font>
    </h3>
    <a onclick="add_enquree()" style="float: right;color:white !important;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i> Add </a>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
      <thead>
        <th>S.No</th>
        <th>Emp Code</th>
        <th>Emp Name</th>
        <th>Amount</th>
        <!-- <th>EMI Status</th> -->
        <th>EMI Period</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>EMI Amount</th>

      </thead>
      <tbody>
        <?php
        $sa = $con->query("SELECT * FROM `salary_advance` INNER JOIN staff_master on salary_advance.emp_id=staff_master.id");
        $cnt = 1;
        while ($sas = $sa->fetch(PDO::FETCH_ASSOC)) {
        ?>
          <tr>
            <td><?php echo $cnt; ?></td>
            <td><?php echo $sas['prefix_code'] .$sas['emp_code']; ?></td>
            <td><?php echo $sas['emp_name']; ?></td>
            <td><?php echo $sas['advance_amount']; ?></td>
            <!-- <td><?php echo $sas['emi_status']; ?></td> -->
            <td><?php echo $sas['emi_period']; ?></td>
            <td><?php echo $sas['start_date']; ?></td>
            <td><?php echo $sas['end_date']; ?></td>
            <td><?php echo round($sas['emi_amount'], 2); ?></td>
          </tr>
        <?php
          $cnt++;
        }
        ?>
      </tbody>
    </table>

  </div>
  <!-- /.card-body -->
</div>

<script>
  function add_enquree() {
    $.ajax({
      type: "POST",
      url: "qvision/payroll/salary_advance/add.php",
      success: function(data) {
        $("#main_content").html(data);
      }
    })
  }
</script>