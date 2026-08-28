<?php
require '../../connect.php';
$id = $_REQUEST['id'];
$stmt = $con->prepare("select * from z_role_master where id='$id'");
$stmt->execute();
$row = $stmt->fetch();
$sta = $row['status'];
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
        <h3 class="card-title"><font size="5">EDIT ROLE DETAILS</font></h3>
        <a onclick="return back_role()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
    </div>
    <div class="card-body" id="printableArea">
        <form role="form" name="edit_role_form" id="edit_role_form">
            <table class="table table-bordered">
                <tr>
                    <td>Role Code</td>
                    <td colspan="5">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id; ?>">
                        <input type="text" class="form-control" id="code" name="code" value="<?php echo  $row['code']; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Role Name</td>
                    <td colspan="5">
                        <input type="text" class="form-control" id="role_name" name="role_name" value="<?php echo  $row['role_name']; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td colspan="2">
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
            <input type="button" name="submit" value="Submit" class="btn btn-primary btn-md" style="float:right;" onclick="update_role()">
            <br><br>
        </form>
    </div>
</div>
<script>
function back_role() {
    $.ajax({
        type:"POST",
        url:"qvision/role/role.php",
        success:function(data){
            $("#main_content").html(data);
        }
    });
}

function update_role() {
    var data = $('#edit_role_form').serialize();
    $.ajax({
        type: 'POST',
        url: 'qvision/role/update_role.php',
        data: data + "&submit=1",
        success: function(data) {
            alert("Updated Successfully");
            back_role();
        }
    });
}
</script>
