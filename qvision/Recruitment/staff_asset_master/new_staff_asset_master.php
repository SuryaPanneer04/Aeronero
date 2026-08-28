<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = $_SESSION['userrole'];
?>
<div class="card mb-3">

    <form id="new_staff_asset_form">
        <input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
        <table class="table table-bordered">
            <tr>
                <div class="row">
                    <a href="javascript:void(0)"
   id="btn_back_new_staff_asset"
   class="btn btn-primary btn-sm btn-flat"
   style="float:right;">
    Back
</a>
                </div>
</div>
</tr>
<tr>
    <td>
        <center><img src="qvision\images\logo123.jpg" alt="quadsel" style="width:100px;height:50px;"></center>
    </td>
    <td colspan="5">
        <center><b>Bluebase Software Services Private Limited</b></center>
    </td>
</tr>
<tr>
    <td>Asset</td>

    <td colspan="2">
        <select class="form-control" name="asset" id="asset">
            <option value="ALL">ALL</option>
            <option value="Office Stationery">Office Stationery</option>
            <option value="Visiting Cards">Visiting Cards</option>
            <option value="Keys">Keys</option>
            <option value="Files">System</option>
            <option value="LapTop">LapTop</option>
            <option value="ID Card">ID Card</option>
            <option value="CUG">CUG</option>
            <option value="Access Card">Access Card</option>
            <option value="ERP Access">ERP Access</option>
        </select>
    </td>
</tr>
</table>
<input type="button" id="btn_submit_new_staff_asset" name="submit" class="btn btn-primary btn-md" style="float:right;" value="Submit">
</form>
<script>
    
    $(document).off('click', '#btn_submit_new_staff_asset').on('click', '#btn_submit_new_staff_asset', function() {
        var data = $('#new_staff_asset_form').serialize();
        $.ajax({
            type: "POST",
           url: "qvision/Recruitment/staff_asset_master/staff_asset_master_submit.php",
            data: data,
            success: function(response) {
                alert("Asset Created Successfully!");
                $.ajax({
    type: "POST",
    url: "qvision/Recruitment/staff_asset_master/staff_asset_master.php",
    success: function(data) {
        $(".content").html(data);
    }
});
            },
            error: function(xhr, status, error) {
                alert("Submit Error: " + error + " - " + xhr.responseText);
            }
        });
    });
</script>