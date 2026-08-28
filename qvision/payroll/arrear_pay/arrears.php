<?php
/*
require '../../../connect.php';
include("../../user.php");
$userrole = $_SESSION['userrole'];
*/


// Start session before accessing session variables
session_start();

// Include database connection
require '../../../connect.php';

// Corrected path for user.php, ensure it exists
include("../../../user.php");  

// Check if 'userrole' is set in session before accessing it
$userrole = isset($_SESSION['userrole']) ? $_SESSION['userrole'] : null;

// Debugging: Check if session is set correctly
if ($userrole === null) {
    echo "Error: User role is not set in the session.";
}









?>
<style>
  td {
    font-size: 20px;
  }
</style>
<div class="card card-primary">
  <div class="card-header" style="background-color:#ff8b3d;">
    <h3 class="card-title">
      <font size="5">Arrear List</font>
    </h3>
    <a onclick="addArrears()" style="float: right;background-color:black;border:1px solid black;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i> ADD</a>
    <br>
    <br>
  </div>
  <!-- /.card-header --><br>

  <div class="card-body">

    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>S.No</th>
          <th>Employee Name</th>
          <th>Amount</th>
          <th>Month</th>
          <th>Tools</th>
        </tr>
      </thead>


      <tbody>
        <?php
        $emp_sql = $con->query("SELECT a.id,a.amount,a.payroll_month,b.emp_name FROM arrear_pay a left join staff_master b  on a.emp_id = b.id ");
        $i = 1;
        while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
        ?>
          <tr>
            <td> <?php echo  $i; ?> </td>
            <td> <?php echo $emp_res['emp_name']; ?> </td>
            <td> <?php echo $emp_res['amount']; ?> </td>
            <td> <?php echo $emp_res['payroll_month']; ?> </td>

            <td>
              <button class="btn btn-success" onclick="arrear_view(<?php echo $emp_res['id']; ?>)"><i class="fa fa-eye"></i> View</button>
            </td>
            
          </tr>
        <?php
        $i = $i + 1;
        }
        ?>
      </tbody>




    </table>


  </div>
  <!-- /.card-body -->
</div>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  function arrear_view(v) {
    $.ajax({
      type: "POST",
      url:"qvision/payroll/arrear_pay/arrear_view.php?id="+v,
      success: function(data) {
        $("#main_content").html(data);
      }
    })
  }

  function back(){
    arrear_pay()
  }

  function addArrears() {
    $.ajax({
      type: "POST",
      url:"qvision/payroll/arrear_pay/arrear_add.php",
      success: function(data) {
        $("#main_content").html(data);
      }
    })
  }
</script>