<?php
require '../../../connect.php';
session_start();

$id = $_POST['id'];
$sql = $con->query("SELECT * FROM z_conferences_workshops WHERE id = $id");
$res = $sql->fetch(PDO::FETCH_ASSOC);
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Conference / Workshop</h3>
    </div>
    <form role="form" name="" action="" method="post" enctype="multipart/form-data" id="edit_conf_form">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" name="conf_date" id="conf_date" value="<?php echo $res['conf_date']; ?>" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Existing Reports</label>
                        <div>
                        <?php 
                        $docs = $con->query("SELECT * FROM z_conferences_workshops_documents WHERE conf_id = $id");
                        if($docs !== false && $docs->rowCount() > 0) {
                            while($d = $docs->fetch(PDO::FETCH_ASSOC)) {
                                echo "<div class='mb-1'><a href='qvision/BusinessProcess/conference_workshops/uploads/".$d['document_path']."' target='_blank'>".$d['document_name']."</a></div>";
                            }
                        } else if(!empty($res['report_file'])) {
                            echo "<div class='mb-1'><a href='qvision/BusinessProcess/conference_workshops/uploads/".$res['report_file']."' target='_blank'>Legacy Report</a></div>";
                        } else {
                            echo "<small>No documents attached.</small>";
                        }
                        ?>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label>Attach Additional Reports</label>
                        <table class="table table-bordered" id="edit_doc_table">
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="doc_names[]" placeholder="Document Name (e.g. PPT, PDF)">
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="report_files[]">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add_edit_doc"><i class="fa fa-plus"></i></button>
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
                        <textarea class="form-control" name="topics_covered" id="topics_covered" rows="3" required><?php echo $res['topics_covered']; ?></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Attendees</label>
                        <textarea class="form-control" name="attendees" id="attendees" rows="3"><?php echo $res['attendees']; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Inferences</label>
                        <textarea class="form-control" name="inferences" id="inferences" rows="3"><?php echo $res['inferences']; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Update</button>
            <a onclick="conference_workshops()" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    $('#edit_conf_form').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'qvision/BusinessProcess/conference_workshops/update.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                alert(response);
                conference_workshops();
            }
        });
    });

    $('.add_edit_doc').click(function() {
        var html = '<tr>' +
                   '<td><input type="text" class="form-control" name="doc_names[]" placeholder="Document Name"></td>' +
                   '<td><input type="file" class="form-control" name="report_files[]"></td>' +
                   '<td><button type="button" class="btn btn-danger btn-sm remove_edit_doc"><i class="fa fa-trash"></i></button></td>' +
                   '</tr>';
        $('#edit_doc_table').append(html);
    });

    $(document).on('click', '.remove_edit_doc', function() {
        $(this).closest('tr').remove();
    });
});
</script>
