<?php
require "../../connect.php";
include("../../user.php");
$id = $_REQUEST["id"];

$aa = $con->query("SELECT * FROM enquiry WHERE id='$id'");
$enq = $aa->fetch();
?>
<div class="card card-primary">
    <div class="card-header" style="background-color:#009EE3 !important;">
        <h3 class="card-title"><font size="5">Add Scope for Software</font></h3>
    </div>
    <form id="scopeForm">
        <div class="card-body">
            <input type="hidden" name="enquiry_id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label>Scope / Requirement Details</label>
                <textarea name="scope_text" class="form-control" rows="5" required></textarea>
            </div>
            <button type="button" class="btn btn-success" onclick="saveSoftwareScope()">Submit for Approval</button>
            <button type="button" class="btn btn-danger" onclick="backToCost()">Back</button>
        </div>
    </form>
</div>
<script>
function backToCost() {
    if(typeof costsheet_add === "function") {
        costsheet_add();
    } else {
        window.location.reload();
    }
}
function saveSoftwareScope() {
    $.ajax({
        type: "POST",
        url: "qvision/CRM/software_scope_submit.php",
        data: $("#scopeForm").serialize(),
        success: function(data) {
            if(data == 1) {
                alert("Scope submitted for approval successfully.");
                backToCost();
            } else {
                alert("Failed to submit.");
            }
        }
    });
}
</script>
