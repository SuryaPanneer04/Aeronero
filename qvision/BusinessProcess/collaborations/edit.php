<?php
require '../../../connect.php';
session_start();

$id = $_POST['id'];
$sql = $con->query("SELECT * FROM z_collaborations WHERE id = $id");
$res = $sql->fetch(PDO::FETCH_ASSOC);
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Collaboration</h3>
    </div>
    <form role="form" name="" action="" method="post" enctype="multipart/form-data" id="edit_collab_form">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Academia/Industries/Laboratories</label>
                        <select class="form-control" name="collab_type" id="collab_type" required>
                            <option value="">Select Type</option>
                            <option value="Academia" <?php if($res['collab_type'] == 'Academia') echo 'selected'; ?>>Academia</option>
                            <option value="Industries" <?php if($res['collab_type'] == 'Industries') echo 'selected'; ?>>Industries</option>
                            <option value="Laboratories" <?php if($res['collab_type'] == 'Laboratories') echo 'selected'; ?>>Laboratories</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Name of the collaborator/Institute/organisation</label>
                        <input type="text" class="form-control" name="collaborator_name" id="collaborator_name" value="<?php echo $res['collaborator_name']; ?>" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>NDA</label>
                        <select class="form-control" name="nda_status" id="nda_status">
                            <option value="No" <?php if($res['nda_status'] == 'No') echo 'selected'; ?>>No</option>
                            <option value="Yes" <?php if($res['nda_status'] == 'Yes') echo 'selected'; ?>>Yes</option>
                            <option value="Pending" <?php if($res['nda_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Attach NDA (Leave blank to keep existing)</label>
                        <input type="file" class="form-control" name="nda_file" id="nda_file">
                        <?php if(!empty($res['nda_file'])): ?>
                            <small><a href="qvision/BusinessProcess/collaborations/uploads/<?php echo $res['nda_file']; ?>" target="_blank">View current NDA</a></small>
                            <input type="hidden" name="old_nda_file" value="<?php echo $res['nda_file']; ?>">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Date of Signing (NDA)</label>
                        <input type="date" class="form-control" name="nda_date" id="nda_date" value="<?php echo $res['nda_date']; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>MoU</label>
                        <select class="form-control" name="mou_status" id="mou_status">
                            <option value="No" <?php if($res['mou_status'] == 'No') echo 'selected'; ?>>No</option>
                            <option value="Yes" <?php if($res['mou_status'] == 'Yes') echo 'selected'; ?>>Yes</option>
                            <option value="Pending" <?php if($res['mou_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Attach MoU (Leave blank to keep existing)</label>
                        <input type="file" class="form-control" name="mou_file" id="mou_file">
                        <?php if(!empty($res['mou_file'])): ?>
                            <small><a href="qvision/BusinessProcess/collaborations/uploads/<?php echo $res['mou_file']; ?>" target="_blank">View current MoU</a></small>
                            <input type="hidden" name="old_mou_file" value="<?php echo $res['mou_file']; ?>">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Date of Signing (MoU)</label>
                        <input type="date" class="form-control" name="mou_date" id="mou_date" value="<?php echo $res['mou_date']; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Description of work</label>
                        <textarea class="form-control" name="work_description" id="work_description" rows="3"><?php echo $res['work_description']; ?></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Next Steps/follow-ups</label>
                        <textarea class="form-control" name="next_steps" id="next_steps" rows="3"><?php echo $res['next_steps']; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Attach Results (Leave blank to keep existing)</label>
                        <input type="file" class="form-control" name="results_file" id="results_file">
                        <?php if(!empty($res['results_file'])): ?>
                            <small><a href="qvision/BusinessProcess/collaborations/uploads/<?php echo $res['results_file']; ?>" target="_blank">View current Results</a></small>
                            <input type="hidden" name="old_results_file" value="<?php echo $res['results_file']; ?>">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="Active" <?php if($res['status'] == 'Active') echo 'selected'; ?>>Active</option>
                            <option value="In Progress" <?php if($res['status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                            <option value="Completed" <?php if($res['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                            <option value="On Hold" <?php if($res['status'] == 'On Hold') echo 'selected'; ?>>On Hold</option>
                            <option value="Closed" <?php if($res['status'] == 'Closed') echo 'selected'; ?>>Closed</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Update</button>
            <a onclick="collaborations()" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    $('#edit_collab_form').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'qvision/BusinessProcess/collaborations/update.php',
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
</script>
