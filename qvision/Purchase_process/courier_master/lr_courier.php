<?php
//challan_entry status= 2 is to upload details,
//challan_entry status= 3 is to details uploaded ,
//challan_entry status= 4 is to challan uploaded ,


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
      <font size="5"> LR Courier </font>
    </h3>
    <!-- <a onclick=" add_courier()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-plus"></i> ADD</a> -->
  </div>

  <div class="card-body">
    <table id="example1" class="dataTables-example table table-bordered">
      <thead>
        <th>S.No</th>
        <th>Invoice No</th>
        <th>Status</th>
        <th>Tools</th>
      </thead>
      <tbody>
        <?php
        $emp_sql = $con->query("SELECT * FROM challan_entry");
        $i = 1;
        while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
        ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $emp_res['invoice_no']; ?></td>
            <td>
              <?php
              if ($emp_res['status'] == 2) {
                echo '<span style="color:red;text-align:center;"><b>Waiting for Details upload</b></span>';
              } else if($emp_res['status'] == 3) {
                echo '<span style="color:red;text-align:center;"><b>Waiting for Challan upload</b></span>';
              }
              else if($emp_res['status'] == 4) {
                echo '<span style="color:red;text-align:center;"><b> Challan uploaded</b></span>';
              }
              else if($emp_res['status'] == 5) {
                echo '<span style="color:green;text-align:center;"><b> Intimation to Installation</b></span>';
              }
			  else if($emp_res['status'] == 6) {
                echo '<span style="color:green;text-align:center;"><b> Challan uploaded </b></span>';
              }
              ?>
            </td>
			 <input type="hidden" value="<?php echo $emp_res['id']; ?>" name="lr_id" id="lr_id">
            <td>
            <?php
              if ($emp_res['status'] == 2) {
                ?>
            <button class="btn btn-danger"  onclick="add_courier(<?php echo $emp_res['id']; ?>);"><i class="fa fa-eye"></i> Upload Details</button>
<?php  } else if($emp_res['status'] == 3) {?>
              <button class="btn btn-info"  onclick="lr_upload(<?php echo $emp_res['id']; ?>);"><i class="fa fa-eye"></i> Upload Challan</button>
  <?php }else if($emp_res['status'] == 4) { ?>
            <button class="btn btn-danger"  onclick="initiate_install(<?php echo $emp_res['id']; ?>);"><i class="fa fa-eye"></i> Intimation to Installation</button>
           <?php } ?>
			  <button class="btn btn-success "  onclick="lr_view(<?php echo $emp_res['id']; ?>);"><i class="fa fa-eye"></i> View</button>
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

  function add_courier(v) {

    $.ajax({
      type: "POST",
      url: "qvision/Purchase_process/courier_master/new_courieradd.php?id="+ v,
      success: function(data) {
        $("#main_content").html(data);
      }
    })
  }

  function lr_upload(id) {
    $.ajax({
      type: "POST",
      url: "qvision/Purchase_process/courier_master/courier_file_upload.php?id="+id,
      success: function(data) {
        $("#main_content").html(data);
      }
    })
  }
  function lr_view(id) {
    $.ajax({
      type: "POST",
      url: "qvision/Purchase_process/courier_master/view_lr_details.php?id="+id,
      success: function(data) {
        $("#main_content").html(data);
      }
    })
  }
  function initiate_install(id) {
    $.ajax({
      type: "POST",
      url: "qvision/Purchase_process/courier_master/initiate_to_install.php?id="+id,
      success: function(data) {
        $("#main_content").html(data);
      }
    })
  }

</script>