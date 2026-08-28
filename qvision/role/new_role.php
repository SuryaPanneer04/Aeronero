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
        <h3 class="card-title"><font size="5">ADD ROLE DETAILS</font></h3>
        <a onclick="return back_role()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
    </div>

    <form method="POST" action="" id="new_role_form">
        <input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
        <table class="table table-bordered">
            <tr>
                <td>Role Code</td>
                <td colspan="2"><input type="text" class="form-control" id="code" name="code" required></td>
            </tr>
            <tr>
                <td>Role Name</td>
                <td colspan="2"><input type="text" class="form-control" id="role_name" name="role_name" required></td>
            </tr>
            <tr>
                <td>Status</td>
                <td colspan="2">
                    <select class="form-control" name="status" id="status" required>
                        <option value="">Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                    </select>
                </td>
            </tr>
        </table>
        <input type="button" name="submit" value="Submit" class="btn btn-primary btn-md" style="float:right;position: relative;left: -5px;" onclick="save_role()">
    </form>
    <br>
</div>
<script>
function back_role()
{
    $.ajax({
        type:"POST",
        url:"qvision/role/role.php",
        success:function(data){
            $("#main_content").html(data);
        }
    });
} 

function save_role()
{
    var data = $('#new_role_form').serialize();
    $.ajax({
        type:'POST',
        data: data,
        url:"qvision/role/role_submit.php",
        success:function(data)
        {      
            alert("Submited Successfully");
            back_role();
        }       
    });
}
</script>
