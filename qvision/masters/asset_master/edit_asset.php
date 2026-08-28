<?php
require '../../../connect.php';
$id = $_REQUEST['id'];
$stmt = $con->prepare("SELECT * FROM assets_master WHERE id='$id'");
$stmt->execute();
$row = $stmt->fetch();
$sta = isset($row['status']) ? $row['status'] : 1;
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<style>
.card-primary:not(.card-outline)>.card-header {
    background-color: #f1cc61 !important;
    color: black !important;
}
.btn-dark {
    background-color: #ed5d00 !important;
    border-color: #ed5d00 !important;
}
.card-primary:not(.card-outline)>.card-header a {
    color: black !important;
}
</style>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">EDIT ASSET DETAILS</font></h3>
        <a onclick="return back_asset()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
    </div>
    <div class="card-body" id="printableArea">
        <form role="form" name="edit_asset_form" id="edit_asset_form">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id; ?>">
            <table class="table table-bordered">
                <tr>
                    <td>Asset Name</td>
                    <td colspan="5">
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo  $row['name']; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td colspan="5">
                        <select class="form-control" name="status" id="status" required>
                            <?php if ($sta == 0) { ?>
                                <option value="0">InActive</option>
                                <option value="1">Active</option>
                            <?php } else { ?>
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
            </table>
            <input type="button" name="submit" value="Submit" class="btn btn-primary btn-md" style="float:right;" onclick="update_asset()">
            <br><br>
        </form>
    </div>
</div>
<script>
function back_asset() {
    $.ajax({
        type:"POST",
        url:"qvision/masters/asset_master/asset.php",
        success:function(data){
            $("#main_content").html(data);
        }
    });
}

function update_asset() {
    var data = $('#edit_asset_form').serialize();
    $.ajax({
        type: 'POST',
        url: 'qvision/masters/asset_master/update_asset.php',
        data: data + "&submit=1",
        success: function(data) {
            alert("Updated Successfully");
            back_asset();
        }
    });
}
</script>
