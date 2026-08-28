<?php
require '../../connect.php';
$id = $_REQUEST['id'];
$stmt = $con->prepare("SELECT * FROM z_role_mapping WHERE id='$id'");
$stmt->execute();
$row = $stmt->fetch();
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
        <h3 class="card-title"><font size="5">EDIT USER ROLE MAPPING</font></h3>
        <a onclick="return back_mapping()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
    </div>
    <div class="card-body" id="printableArea">
        <form role="form" name="edit_mapping_form" id="edit_mapping_form">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id; ?>">
            <table class="table table-bordered">
                <tr>
                    <td>Select User</td>
                    <td colspan="5">
                        <select class="form-control" name="user_id" id="user_id" required>
                            <option value="">Select User</option>
                            <?php
                            $user_sql = $con->query("SELECT * FROM z_user_master");
                            while($user_res = $user_sql->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($user_res['user_id'] == $row['user_id']) ? "selected" : "";
                                echo '<option value="'.$user_res['user_id'].'" '.$selected.'>'.$user_res['full_name'].'</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Select Role</td>
                    <td colspan="5">
                        <select class="form-control" name="code" id="code" required>
                            <option value="">Select Role</option>
                            <?php
                            $role_sql = $con->query("SELECT * FROM z_role_master");
                            while($role_res = $role_sql->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($role_res['code'] == $row['code']) ? "selected" : "";
                                echo '<option value="'.$role_res['code'].'" '.$selected.'>'.$role_res['role_name'].'</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td colspan="5">
                        <input type="text" class="form-control" id="descriptions" name="descriptions" value="<?php echo  $row['descriptions']; ?>">
                    </td>
                </tr>
            </table>
            <input type="button" name="submit" value="Submit" class="btn btn-primary btn-md" style="float:right;" onclick="update_mapping()">
            <br><br>
        </form>
    </div>
</div>
<script>
function back_mapping() {
    $.ajax({
        type:"POST",
        url:"qvision/user_role/role.php",
        success:function(data){
            $("#main_content").html(data);
        }
    });
}

function update_mapping() {
    var data = $('#edit_mapping_form').serialize();
    $.ajax({
        type: 'POST',
        url: 'qvision/user_role/update_role.php',
        data: data + "&submit=1",
        success: function(data) {
            alert("Updated Successfully");
            back_mapping();
        }
    });
}
</script>
