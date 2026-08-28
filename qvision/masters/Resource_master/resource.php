<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = $_SESSION['userrole'];

?>

<head>
  <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
</style>
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">
      <font size="5">RESOURCE LIST</font>
    </h3>
    <a onclick="add()" style="float: right;" data-toggle="modal" class="btn btn-primary">ADD</a>
  </div>
  <!-- /.card-header --><br>

  <div class="card-body">

    <!-- <table id="example1" class="table table-bordered table-striped"> -->
    <table class="table table-striped table-bordered table-hover display nowrap" id="example1" style="width:100%">

      <thead>
        <tr>
          <th>S.No</th>
          <th>Name</th>
          <th>Status</th>
          <th>Tools</th>
        </tr>
      </thead>


      <tbody>
        <?php
        $emp_sql = $con->query("SELECT * FROM source_master");
        $i = 1;
        while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
        ?>
          <tr>
            <td><?php echo $emp_res['id']; ?></td>
            <td><?php echo $emp_res['name']; ?></td>
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
              <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" onclick="resource_edit(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>




    </table>


  </div>
  <!-- /.card-body -->
</div>
<script>
  $(document).ready(function() {
    $('#example1').DataTable({
      "scrollX": true
    });
  });
</script>
<script>
  // $(function() {
        //   $("#example1").DataTable({
        //     "responsive": true,
        //     "autoWidth": false,
        //   });
        //   $('#example2').DataTable({
        //     "paging": true,
        //     "lengthChange": false,
        //     "searching": false,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     "responsive": true,
        //   });
        // });
</script>
<script>
  function back()

  {
    resource_master()


  }
</script>
<script>
  function add() {
    $.ajax({
      type: "POST",
      url: "qvision/masters/Resource_master/resource_add.php",
      success: function(data) {
        $("#main_content").html(data);
      }
    })
  }
</script>
<script>
  function resource_edit(v) {
    //alert(v);
    $.ajax({
      type: "POST",
      url: "/bbvision/qvision/masters/Resource_master/resource_edit.php?id="+v,

      success: function(data) {
        $("#main_content").html(data);
      }
    })
  }
</script>