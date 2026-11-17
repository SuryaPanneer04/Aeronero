<?php
require_once '../../../connect.php';
if (!headers_sent() && session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$stmt = $con->prepare("SELECT * FROM z_csr WHERE id = ?");
$stmt->execute([$id]);
$res = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$res) {
    echo "<div class='alert alert-danger'>CSR Record not found!</div>";
    exit;
}

// Fetch Projects from y_project_details
$p_sql = $con->query("SELECT project_id, project_code, project_name FROM y_project_details ORDER BY project_code ASC");
$projects = $p_sql ? $p_sql->fetchAll(PDO::FETCH_ASSOC) : [];

// Fetch Installation and Service Team
$team_sql = $con->query("
    SELECT sm.id, sm.emp_code, sm.emp_name 
    FROM staff_master sm 
    LEFT JOIN z_department_master zd ON sm.dep_id = zd.id 
    WHERE sm.dep_id = '59' OR zd.dept_name LIKE '%service%' OR zd.dept_name LIKE '%operation%'
    ORDER BY sm.emp_name ASC
");
$service_team = $team_sql ? $team_sql->fetchAll(PDO::FETCH_ASSOC) : [];
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="4"><strong>Edit CSR Record #<?php echo $res['id']; ?></strong></font></h3>
        <a onclick="csr()" style="float: right;" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to CSR List</a>
    </div>
    <form role="form" id="edit_csr_form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
        <input type="hidden" name="project_name" id="project_name" value="<?php echo htmlspecialchars($res['project_name']); ?>">
        
        <div class="card-body">
            <div class="row">
                <!-- Column 1: Project -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Project <span class="text-danger">*</span></label>
                        <select class="form-control" name="project_id" id="project_id" required onchange="handle_project_select(this)">
                            <option value="">-- Select Project --</option>
                            <?php 
                            $matched_proj = false;
                            foreach($projects as $p): 
                                $is_sel = ($res['project_id'] == $p['project_id']);
                                if ($is_sel) $matched_proj = true;
                            ?>
                                <option value="<?php echo $p['project_id']; ?>" 
                                        data-name="<?php echo htmlspecialchars($p['project_name']); ?>"
                                        <?php if ($is_sel) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($p['project_code'] . ' - ' . $p['project_name']); ?>
                                </option>
                            <?php endforeach; ?>
                            <option value="custom" <?php if (!$matched_proj) echo 'selected'; ?>>-- Custom Project Name --</option>
                        </select>
                        <input type="text" class="form-control mt-2" name="custom_project_name" id="custom_project_name" 
                               value="<?php echo htmlspecialchars($res['project_name']); ?>" 
                               placeholder="Enter custom project name" 
                               style="<?php echo (!$matched_proj) ? 'display: block;' : 'display: none;'; ?>">
                    </div>
                </div>

                <!-- Column 2: Installations / Running Status -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Installations / Running Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="installation_status" id="installation_status" required>
                            <option value="Installed & Running" <?php if($res['installation_status'] == 'Installed & Running') echo 'selected'; ?>>Installed & Running</option>
                            <option value="Installation In Progress" <?php if($res['installation_status'] == 'Installation In Progress') echo 'selected'; ?>>Installation In Progress</option>
                            <option value="Installation Pending" <?php if($res['installation_status'] == 'Installation Pending') echo 'selected'; ?>>Installation Pending</option>
                            <option value="Under Service / Maintenance" <?php if($res['installation_status'] == 'Under Service / Maintenance') echo 'selected'; ?>>Under Service / Maintenance</option>
                            <option value="Completed" <?php if($res['installation_status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                            <option value="Decommissioned" <?php if($res['installation_status'] == 'Decommissioned') echo 'selected'; ?>>Decommissioned</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Service & Installation Team Access -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Assigned Installation & Service Team <small class="text-muted">(Access given to Service Team)</small></label>
                        <select class="form-control" name="assigned_team" id="assigned_team">
                            <option value="">-- Select Assigned Service / Installation Personnel --</option>
                            <?php foreach($service_team as $tm): 
                                $val = $tm['emp_name'] . ' (' . $tm['emp_code'] . ')';
                            ?>
                                <option value="<?php echo htmlspecialchars($val); ?>" <?php if($res['assigned_team'] == $val) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($val); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Column 3: Condition (Working / Not Working) -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Condition <span class="text-danger">*</span> <small class="text-muted">(Working / Not Working)</small></label>
                        <select class="form-control" name="condition_status" id="condition_status" required>
                            <option value="Working" <?php if($res['condition_status'] == 'Working') echo 'selected'; ?>>Working</option>
                            <option value="Not Working" <?php if($res['condition_status'] == 'Not Working') echo 'selected'; ?>>Not Working</option>
                            <option value="Partially Working" <?php if($res['condition_status'] == 'Partially Working') echo 'selected'; ?>>Partially Working</option>
                            <option value="Under Maintenance" <?php if($res['condition_status'] == 'Under Maintenance') echo 'selected'; ?>>Under Maintenance</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Column 4: Impact Report (Attach Report) -->
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Impact Report <small class="text-muted">(Attach Report)</small></label>
                        <input type="file" class="form-control" name="impact_report" id="impact_report" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.zip">
                        <?php if(!empty($res['impact_report'])): ?>
                            <div class="mt-2">
                                <span class="badge badge-info">Current Report:</span>
                                <a href="qvision/BusinessProcess/csr/uploads/<?php echo htmlspecialchars($res['impact_report']); ?>" target="_blank" class="btn btn-xs btn-outline-primary ml-1">
                                    <i class="fa fa-download"></i> Download Report
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Column 5: Visits Completed -->
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Visits Completed <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="visits_completed" id="visits_completed" min="0" value="<?php echo intval($res['visits_completed']); ?>" required>
                    </div>
                </div>

                <!-- Column 6: Next Visit Planned -->
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Next Visit Planned</label>
                        <input type="date" class="form-control" name="next_visit_planned" id="next_visit_planned" value="<?php echo $res['next_visit_planned']; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Remarks / Notes</label>
                        <textarea class="form-control" name="remarks" id="remarks" rows="2"><?php echo htmlspecialchars($res['remarks'] ?? ''); ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" id="update_csr_btn" class="btn btn-primary"><i class="fa fa-save"></i> Update CSR Record</button>
            <a onclick="csr()" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>

<script>
function handle_project_select(sel) {
    var val = $(sel).val();
    if (val === 'custom') {
        $('#custom_project_name').show().prop('required', true);
        $('#project_name').val('');
    } else {
        $('#custom_project_name').hide().prop('required', false);
        var pName = $(sel).find('option:selected').data('name') || '';
        $('#project_name').val(pName);
    }
}

$(document).ready(function() {
    $('#edit_csr_form').on('submit', function(e) {
        e.preventDefault();
        
        var project_id = $('#project_id').val();
        var custom_project_name = $('#custom_project_name').val().trim();
        var project_name = $('#project_name').val().trim();
        
        if (!project_id) {
            alert('Please select a Project.');
            return false;
        }
        if (project_id === 'custom' && !custom_project_name) {
            alert('Please enter Custom Project Name.');
            return false;
        }
        
        var formData = new FormData(this);
        $('#update_csr_btn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');
        
        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/csr/update.php",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(response);
                csr();
            },
            error: function() {
                alert('An error occurred while updating the CSR record.');
                $('#update_csr_btn').prop('disabled', false).html('<i class="fa fa-save"></i> Update CSR Record');
            }
        });
    });
});
</script>
