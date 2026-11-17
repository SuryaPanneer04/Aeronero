<?php
require '../../../connect.php';
session_start();

$id = $_POST['id'];
$sql = $con->query("SELECT * FROM z_lab_assets_water WHERE id = $id");
$res = $sql->fetch(PDO::FETCH_ASSOC);

$glasswares_readonly = (!empty($res['req_id']) && !empty($res['glasswares'])) ? 'readonly' : '';
$consumables_readonly = (!empty($res['req_id']) && !empty($res['consumables'])) ? 'readonly' : '';
$quantity_readonly = (!empty($res['req_id']) && !empty($res['quantity'])) ? 'readonly' : '';
$price_readonly =(!empty($res['req_id']) && !empty($res['price'])) ? 'readonly' : '';
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Lab Asset (Water)</h3>
    </div>
    <form role="form" name="" action="" method="post" id="edit_assets_water_form">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Glasswares</label>
                        <input type="text" class="form-control" name="glasswares" id="glasswares" value="<?php echo $res['glasswares']; ?>" <?php echo $glasswares_readonly; ?>>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Consumables</label>
                        <input type="text" class="form-control" name="consumables" id="consumables" value="<?php echo $res['consumables']; ?>" <?php echo $consumables_readonly; ?>>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" value="<?php echo $res['quantity']; ?>" <?php echo $quantity_readonly; ?>>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" step="0.01" class="form-control" name="price" id="price" value="<?php echo $res['price']; ?>" <?php echo $price_readonly; ?>>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Place</label>
                        <input type="text" class="form-control" name="place" id="place" value="<?php echo $res['place']; ?>">
                    </div>
                </div>  
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Update</button>
            <a onclick="lab_assets_water()" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    $('#edit_assets_water_form').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'qvision/BusinessProcess/lab_assets_water/update.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                alert(response);
                lab_assets_water();
            }
        });
    });
});
</script>
