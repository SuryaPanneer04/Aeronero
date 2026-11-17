<?php
require '../../../connect.php';
session_start();
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Project Master</h3>
        <a onclick="project_master()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <form role="form" id="project_master_form" name="project_master_form" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row">
                 <div class="col-sm-4">
                    <div class="form-group">
                        <label>Project Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="project_code" id="project_code" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Project Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="project_name" id="project_name" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Country <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="country" id="country" required>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input type="button" class="btn btn-primary" onclick="submit_project_master()" value="Submit">
            </div>
        </div>
    </form>
</div>
<script>
function submit_project_master() {
    var project_name = $('#project_name').val();
    var project_code = $('#project_code').val();
    var country = $('#country').val();
    if(project_name == '') {
        alert("Enter Project Name");
        return false;
    }
    if(project_code == '') {
        alert("Enter Project Code");
        return false;
    }
    if(country == '') {
        alert("Enter Country");
        return false;
    }
    $.ajax({
        type: "POST",
        url: "qvision/project_management/project_master/submit.php",
        data: $('#project_master_form').serialize(),
        success: function(data) {
            alert("Project added successfully!");
            project_master();
        }
    });
}
</script>
