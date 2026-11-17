<?php
require '../../../connect.php';
session_start();

$id = $_POST['id'];
$sql = $con->query("SELECT * FROM z_laboratory_requirements WHERE id = $id");
$res = $sql->fetch(PDO::FETCH_ASSOC);
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Update Laboratory Requirement Details</h3>
    </div>
    <form role="form" name="" action="" method="post" enctype="multipart/form-data" id="edit_lab_form">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <div class="card-body">
            <!-- Basic Details (Read Only or editable if they are admin) -->
            <h5 class="text-primary border-bottom pb-2 mb-3">1. Requirement Details</h5>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>STOCKS (filters)</label>
                        <select class="form-control" name="stock_type" id="stock_type" required>
                            <option value="Glasswares and Consumables" <?php if($res['stock_type'] == 'Glasswares and Consumables') echo 'selected'; ?>>Glasswares and Consumables</option>
                            <option value="Equipments" <?php if($res['stock_type'] == 'Equipments') echo 'selected'; ?>>Equipments</option>
                            <option value="Breakages" <?php if($res['stock_type'] == 'Breakages') echo 'selected'; ?>>Breakages</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Items</label>
                        <input type="text" class="form-control" name="items" id="items" value="<?php echo $res['items']; ?>" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" value="<?php echo $res['quantity']; ?>" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" step="0.01" class="form-control" name="price" id="price" value="<?php echo $res['price']; ?>" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Date of Request</label>
                        <input type="date" class="form-control" name="date_of_request" id="date_of_request" value="<?php echo $res['date_of_request']; ?>" required>
                    </div>
                </div>
            </div>

            </div>
        <div class="card-footer">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Update Details</button>
            <a onclick="laboratory_requirement()" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    $('#edit_lab_form').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'qvision/BusinessProcess/laboratory_requirement/update.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                alert(response);
                laboratory_requirement();
            }
        });
    });
});
</script>

