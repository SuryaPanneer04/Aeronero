<?php
require '../../../connect.php';
session_start();

// Auto-sync received items from Laboratory Requirements
$con->query("INSERT INTO z_lab_assets_water (req_id, glasswares, quantity, price) 
    SELECT id, items, quantity, price FROM z_laboratory_requirements 
    WHERE stock_type = 'Glasswares and Consumables' 
    AND received_status = 'Received' 
    AND id NOT IN (SELECT req_id FROM z_lab_assets_water WHERE req_id IS NOT NULL)");
$con->query("UPDATE z_lab_assets_water w 
    JOIN z_laboratory_requirements r ON w.req_id = r.id 
    SET w.price = r.price 
    WHERE (w.price IS NULL OR w.price = 0) AND r.price IS NOT NULL");
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">Lab Assets (Water)</font></h3>
        <a onclick="return add_lab_assets_water()" style="float: right;" class="btn btn-dark"><i class="fa fa-plus"></i> Add New Asset</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="dataTables-example table table-striped table-bordered table-hover" id="assets_water_table" style="width:100%;">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Source</th>
                        <th>Glasswares</th>
                        <th>Consumables</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Place</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = $con->query("SELECT * FROM z_lab_assets_water ORDER BY id DESC");
                $i = 1;
                while($res = $sql->fetch(PDO::FETCH_ASSOC)) {
                    $source = empty($res['req_id']) ? '<span class="badge badge-secondary">Manual</span>' : '<span class="badge badge-success">Lab Req</span>';
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $source; ?></td>
                        <td><?php echo $res['glasswares']; ?></td>
                        <td><?php echo $res['consumables']; ?></td>
                        <td><?php echo $res['quantity']; ?></td>
                        <td><?php echo $res['price']; ?></td>
                        <td><?php echo $res['place']; ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="edit_lab_assets_water(<?php echo $res['id']; ?>)"><i class="fa fa-edit"></i></button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#assets_water_table').DataTable({
        scrollX: true,
        pageLength: 25
    });
});

function add_lab_assets_water() {
    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/lab_assets_water/new.php",
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}

function edit_lab_assets_water(id) {
    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/lab_assets_water/edit.php",
        data: { id: id },
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}
</script>

