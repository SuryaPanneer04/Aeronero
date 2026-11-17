<?php
$id = $_REQUEST["id"];
?>
<div class="card card-primary">
    <div class="card-header" style="background-color:#00c0ef !important;">
        <h3 class="card-title"><font size="5">Upload File for Software</font></h3>
    </div>
    <form id="uploadForm" enctype="multipart/form-data">
        <div class="card-body">
            <input type="hidden" name="enquiry_id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label>File Upload</label>
                <input type="file" name="software_file" class="form-control" required>
            </div>
            <button type="button" class="btn btn-info" onclick="saveSoftwareFile()">Upload</button>
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
function saveSoftwareFile() {
    var formData = new FormData($("#uploadForm")[0]);
    $.ajax({
        type: "POST",
        url: "qvision/CRM/software_upload_submit.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            if(data == 1) {
                alert("File uploaded successfully.");
                backToCost();
            } else {
                alert("Failed to upload file.");
            }
        }
    });
}
</script>
