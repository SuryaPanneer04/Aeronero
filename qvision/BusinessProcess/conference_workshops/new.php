<?php
require '../../../connect.php';
session_start();
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">New Conference / Workshop</h3>
    </div>
    <form role="form" name="" action="" method="post" enctype="multipart/form-data" id="conf_form">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" name="conf_date" id="conf_date" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Attach Reports</label>
                        <table class="table table-bordered" id="doc_table">
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="doc_names[]" placeholder="Document Name (e.g. PPT, PDF)">
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="report_files[]">
                                </td>
                                <td>
                                    <button type="button" title="add" class="btn btn-success btn-sm add_doc"><i class="fa fa-plus"></i>+</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Topics covered</label>
                        <textarea class="form-control" name="topics_covered" id="topics_covered" rows="3" required></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Attendees</label>
                        <textarea class="form-control" name="attendees" id="attendees" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Inferences</label>
                        <textarea class="form-control" name="inferences" id="inferences" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
            <a onclick="conference_workshops()" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    $('#conf_form').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'qvision/BusinessProcess/conference_workshops/submit.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                alert(response);
                conference_workshops();
            }
        });
    });

    $('.add_doc').click(function() {
        var html = '<tr>' +
                   '<td><input type="text" class="form-control" name="doc_names[]" placeholder="Document Name"></td>' +
                   '<td><input type="file" class="form-control" name="report_files[]"></td>' +
                   '<td><button type="button" class="btn btn-danger btn-sm remove_doc"><i class="fa fa-trash"></i></button></td>' +
                   '</tr>';
        $('#doc_table').append(html);
    });

    $(document).on('click', '.remove_doc', function() {
        $(this).closest('tr').remove();
    });
});
</script>
