<?php
require '../../../connect.php';
$id = $_REQUEST['id'];
$stmt = $con->prepare("select * from staff_asset where id='$id'");
$stmt->execute();
$row = $stmt->fetch();
$sid = $row['emp_name'];
?>

<head>
     <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<div class="card card-primary">
     <div class="card-header">
          <i class="fa fa-table"></i> STAFF ASSET EDIT
          <a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-minus"> </i>Back</a>
     </div>
 
          <form role="form" name="fupname" action="" method="post" enctype="multipart/type">

               <table class="table table-bordered">
                    <tr>


                         <td>Employee Name:</td>
                         <input type="hidden" name="id" id="id" value="<?php echo  $id; ?>">
                         <td colspan="2">

                              <?php
                              $dep_sql1 = $con->query("SELECT * FROM staff_master where id='$sid' ");
                              $fet = $dep_sql1->fetch();
                              ?>
                              <input type="text" class="form-control" name="emp_name" value=" <?php echo $fet['emp_name']; ?>" readonly>
                         </td>
                    </tr>
                    <tr>
                         <th>S.No</th>
                         <th>Asset Name</th>
                         <th>Serial Number / Model Number</th>
                    </tr>

                    <?php
                    $assetData = $con->query("SELECT * FROM `staff_asset_serial_no` WHERE `staff_asset_id`='$id'");
                    $i = 1;
                    while ($serialno = $assetData->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                         <tr>
                              <td> <?php echo $i; ?>
                                   <input type="hidden" class="form-control" id="get_id" name="get_id[]" value="<?php echo $serialno['id'] ?>">
                              </td>

                              <td><input type="text" class="form-control" id="asset_name" name="asset_name[]" value="<?php echo $serialno['asset_name'] ?>"></td>
                              <td><input type="text" class="form-control" id="serial_number" name="serial_number[]" value="<?php echo $serialno['serial_number'] ?>"></td>
                         </tr>

                    <?php $i++;
                    } ?>
                    <tr>
                         <td colspan="3">
                              <input type="button" class="btn btn-success btn-md" name="Update" onclick="satff_asset_edit()" value="Update" style="float:right;">
                         </td>
                    </tr>
               </table>
          </form>
     </div>
</div>
</div>
<script>
     function back() {
          staff_assets();
     }


     function satff_asset_edit(v) {
          var data = $('form').serialize();
          $.ajax({
               type: "POST",
               data: data,
               url: "qvision/Recruitment/staff_asset/update_staff_asset.php?id=" + v,
               success: function(data) {
                    if (data == 1) {
                         alert("Sucessfully Updated")
                         staff_assets()
                    } else {
                         alert("Updated Failed")
                         staff_assets()
                    }
               }
          })
     }
</script>