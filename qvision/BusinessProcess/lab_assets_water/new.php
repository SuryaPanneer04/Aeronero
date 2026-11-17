<?php
require '../../../connect.php';
session_start();
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Lab Asset (Water)</h3>
    </div>
    <form role="form" name="" action="" method="post" id="assets_water_form">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Glasswares</label>
                        <input type="text" class="form-control" name="glasswares" id="glasswares">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Consumables</label>
                        <input type="text" class="form-control" name="consumables" id="consumables">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" step="0.01" class="form-control" name="price" id="price">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Place</label>
                        <input type="text" class="form-control" name="place" id="place">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
            <a onclick="lab_assets_water()" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    $('#assets_water_form').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'qvision/BusinessProcess/lab_assets_water/submit.php',
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
