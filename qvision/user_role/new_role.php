<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<style>
.card-primary:not(.card-outline)>.card-header{
    background-color: #f1cc61 !important;
    color: black !important;
}
.btn-dark{
    background-color: #ed5d00 !important;
    border-color: #ed5d00 !important;
}
.card-primary:not(.card-outline)>.card-header a {
    color: black !important;
}
</style>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">ADD USER ROLE MAPPING</font></h3>
        <a onclick="return back_mapping()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
    </div>

    <form method="POST" action="" id="new_mapping_form">
        <input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
        <table class="table table-bordered">
            <tr>
                <td>Select User</td>
                <td colspan="2">
                    <select class="form-control" name="user_id" id="user_id" required>
                        <option value="">Select User</option>
                        <?php
                        $user_sql = $con->query("SELECT * FROM z_user_master");
                        while($user_res = $user_sql->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="'.$user_res['user_id'].'">'.$user_res['full_name'].'</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Select Role</td>
                <td colspan="2">
                    <select class="form-control" name="code" id="code" required>
                        <option value="">Select Role</option>
                        <?php
                        $role_sql = $con->query("SELECT * FROM z_role_master");
                        while($role_res = $role_sql->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="'.$role_res['code'].'">'.$role_res['role_name'].'</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Description</td>
                <td colspan="2"><input type="text" class="form-control" id="descriptions" name="descriptions"></td>
            </tr>
        </table>
        <input type="button" name="submit" value="Submit" class="btn btn-primary btn-md" style="float:right;position: relative;left: -5px;" onclick="save_mapping()">
    </form>
    <br>
</div>
<script>
function back_mapping()
{
    $.ajax({
        type:"POST",
        url:"qvision/user_role/role.php",
        success:function(data){
            $("#main_content").html(data);
        }
    });
} 

function save_mapping()
{
    var data = $('#new_mapping_form').serialize();
    $.ajax({
        type:'POST',
        data: data,
        url:"qvision/user_role/role_submit.php",
        success:function(data)
        {      
            alert("Submited Successfully");
            back_mapping();
        }       
    });
}
</script>
