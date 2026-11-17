<?php
require '../../../connect.php';
session_start();
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">New Collaboration</h3>
    </div>
    <form role="form" name="" action="" method="post" enctype="multipart/form-data" id="collab_form">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Academia/Industries/Laboratories</label>
                        <select class="form-control" name="collab_type" id="collab_type" required>
                            <option value="">Select Type</option>
                            <option value="Academia">Academia</option>
                            <option value="Industries">Industries</option>
                            <option value="Laboratories">Laboratories</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Name of the collaborator/Institute/organisation</label>
                        <input type="text" class="form-control" name="collaborator_name" id="collaborator_name" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>NDA</label>
                        <select class="form-control" name="nda_status" id="nda_status">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4" id="nda_file_section" style="display: none;">
                    <div class="form-group">
                        <label>Attach NDA *</label>
                        <input type="file" class="form-control" name="nda_file" id="nda_file" require>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Date of Signing (NDA)</label>
                        <input type="date" class="form-control" name="nda_date" id="nda_date">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>MoU</label>
                        <select class="form-control" name="mou_status" id="mou_status">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group" id="mou_file_section" style="display: none;">
                        <label>Attach MoU *</label>
                        <input type="file" class="form-control" name="mou_file" id="mou_file" require>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Date of Signing (MoU)</label>
                        <input type="date" class="form-control" name="mou_date" id="mou_date">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Description of work</label>
                        <textarea class="form-control" name="work_description" id="work_description" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Next Steps/follow-ups</label>
                        <textarea class="form-control" name="next_steps" id="next_steps" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Attach Results</label>
                        <input type="file" class="form-control" name="results_file" id="results_file">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="Active">Active</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                            <option value="On Hold">On Hold</option>
                            <option value="Closed">Closed</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
            <a onclick="collaborations()" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    $('#collab_form').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'qvision/BusinessProcess/collaborations/submit.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                alert(response);
                collaborations();
            }
        });
    });
});

$(document).ready(function () {

    $('#nda_status').change(function () {

        if ($(this).val() === 'Yes') {
            $('#nda_file_section').show();
        } else {
            $('#nda_file_section').hide();
            $('#nda_file').val('');
        }

    });

});
$(document).ready(function () {

    $('#mou_status').change(function () {

        if ($(this).val() === 'Yes') {
            $('#mou_file_section').show();
        } else {
            $('#mou_file_section').hide();
            $('#mou_file').val('');
        }

    });

});
</script>
