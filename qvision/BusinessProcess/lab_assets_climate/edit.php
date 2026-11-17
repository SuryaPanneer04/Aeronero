<?php
require '../../../connect.php';
session_start();

$id = $_POST['id'];
$sql = $con->query("SELECT * FROM z_lab_assets_climate WHERE id = $id");
$res = $sql->fetch(PDO::FETCH_ASSOC);

$equipments_readonly = (!empty($res['req_id']) && !empty($res['equipments'])) ? 'readonly' : '';
$quantity_readonly = (!empty($res['req_id']) && !empty($res['quantity'])) ? 'readonly' : '';
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Lab Asset (Climate)</h3>
    </div>
    <form role="form" name="" action="" method="post" enctype="multipart/form-data" id="edit_assets_climate_form">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Equipments</label>
                        <input type="text" class="form-control" name="equipments" id="equipments" value="<?php echo $res['equipments']; ?>" <?php echo $equipments_readonly; ?>>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Place</label>
                        <input type="text" class="form-control" name="place" id="place" value="<?php echo $res['place']; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" step="0.01" class="form-control" name="price" id="price" value="<?php echo $res['price']; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" value="<?php echo $res['quantity']; ?>" <?php echo $quantity_readonly; ?>>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Report/Attach Documents</label>
                        <input type="file" class="form-control" name="report_doc" id="report_doc">
                        <?php if(!empty($res['report_doc'])): ?>
                            <small><a href="qvision/BusinessProcess/lab_assets_climate/uploads/<?php echo $res['report_doc']; ?>" target="_blank">View current Document</a></small>
                            <input type="hidden" name="old_report_doc" value="<?php echo $res['report_doc']; ?>">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Update</button>
            <a onclick="lab_assets_climate()" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    $('#edit_assets_climate_form').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'qvision/BusinessProcess/lab_assets_climate/update.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                alert(response);
                lab_assets_climate();
            }
        });
    });
});
</script>
