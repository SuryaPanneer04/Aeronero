<?php
require '../../../connect.php';
include("../../../user.php");
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
        <h3 class="card-title"><font size="5">ADD ASSET DETAILS</font></h3>
        <a onclick="return back_asset()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
    </div>

    <form method="POST" action="" id="new_asset_form">
        <input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
        <table class="table table-bordered">
            <tr>
                <td>Asset Name</td>
                <td colspan="2"><input type="text" class="form-control" id="name" name="name" required></td>
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
        <input type="button" name="submit" value="Submit" class="btn btn-primary btn-md" style="float:right;position: relative;left: -5px;" onclick="save_asset()">
    </form>
    <br>
</div>
<script>
function back_asset()
{
    $.ajax({
        type:"POST",
        url:"qvision/masters/asset_master/asset.php",
        success:function(data){
            $("#main_content").html(data);
        }
    });
} 

function save_asset()
{
    var data = $('#new_asset_form').serialize();
    $.ajax({
        type:'POST',
        data: data,
        url:"qvision/masters/asset_master/asset_submit.php",
        success:function(data)
        {      
            alert("Submited Successfully");
            back_asset();
        }       
    });
}
</script>
