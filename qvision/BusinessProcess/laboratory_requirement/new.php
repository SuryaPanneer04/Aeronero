<?php
require '../../../connect.php';
session_start();
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">New Laboratory Requirement (Request)</h3>
    </div>
    <form role="form" name="" action="" method="post" id="lab_form">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>STOCKS (filters)</label>
                        <select class="form-control" name="stock_type" id="stock_type" required>
                            <option value="">Select Stock Type</option>
                            <option value="Glasswares and Consumables">Glasswares and Consumables</option>
                            <option value="Equipments">Equipments</option>
                            <option value="Breakages">Breakages</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Items</label>
                        <input type="text" class="form-control" name="items" id="items" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" step="0.01" class="form-control" name="price" id="price" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Date of Request</label>
                        <input type="date" class="form-control" name="date_of_request" id="date_of_request" required>
                    </div>
                </div>
            </div>
            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i> After raising this request, other departments (Procurement, Finance, QC) will update their respective statuses from the main table.
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit Request</button>
            <a onclick="laboratory_requirement()" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    $('#lab_form').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'qvision/BusinessProcess/laboratory_requirement/submit.php',
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
