<?php
require_once '../../../connect.php';
if (!headers_sent() && session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Fetch Projects from y_project_details
$p_sql = $con->query("SELECT project_id, project_code, project_name FROM y_project_details ORDER BY project_code ASC");
$projects = $p_sql ? $p_sql->fetchAll(PDO::FETCH_ASSOC) : [];

// Fetch Installation and Service Team (Operations / Service staff)
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
        <h3 class="card-title"><font size="4"><strong>Add New CSR Record</strong></font></h3>
        <a onclick="csr()" style="float: right;" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to CSR List</a>
    </div>
    <form role="form" id="csr_form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="project_name" id="project_name">
        <div class="card-body">
            <div class="row">
                <!-- Column 1: Project -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Project <span class="text-danger">*</span></label>
                        <select class="form-control" name="project_id" id="project_id" required onchange="handle_project_select(this)">
                            <option value="">-- Select Project --</option>
                            <?php foreach($projects as $p): ?>
                                <option value="<?php echo $p['project_id']; ?>" data-name="<?php echo htmlspecialchars($p['project_name']); ?>">
                                    <?php echo htmlspecialchars($p['project_code'] . ' - ' . $p['project_name']); ?>
                                </option>
                            <?php endforeach; ?>
                            <option value="custom">-- Other / Enter Custom Project Name --</option>
                        </select>
                        <input type="text" class="form-control mt-2" name="custom_project_name" id="custom_project_name" placeholder="Enter custom project name" style="display: none;">
                    </div>
                </div>

                <!-- Column 2: Installations / Running Status -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Installations / Running Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="installation_status" id="installation_status" required>
                            <option value="Installed & Running" selected>Installed & Running</option>
                            <option value="Installation In Progress">Installation In Progress</option>
                            <option value="Installation Pending">Installation Pending</option>
                            <option value="Under Service / Maintenance">Under Service / Maintenance</option>
                            <option value="Completed">Completed</option>
                            <option value="Decommissioned">Decommissioned</option>
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
                            <?php foreach($service_team as $tm): ?>
                                <option value="<?php echo htmlspecialchars($tm['emp_name'] . ' (' . $tm['emp_code'] . ')'); ?>">
                                    <?php echo htmlspecialchars($tm['emp_name'] . ' (' . $tm['emp_code'] . ')'); ?>
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
                            <option value="Working" selected>Working</option>
                            <option value="Not Working">Not Working</option>
                            <option value="Partially Working">Partially Working</option>
                            <option value="Under Maintenance">Under Maintenance</option>
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
                        <small class="form-text text-muted">Allowed: PDF, DOCX, XLSX, Images, ZIP</small>
                    </div>
                </div>

                <!-- Column 5: Visits Completed -->
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Visits Completed <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="visits_completed" id="visits_completed" min="0" value="0" required>
                    </div>
                </div>

                <!-- Column 6: Next Visit Planned -->
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Next Visit Planned</label>
                        <input type="date" class="form-control" name="next_visit_planned" id="next_visit_planned">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Remarks / Notes</label>
                        <textarea class="form-control" name="remarks" id="remarks" rows="2" placeholder="Enter any specific notes regarding installation, service or project condition"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" id="save_csr_btn" class="btn btn-primary"><i class="fa fa-save"></i> Save CSR Record</button>
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
    $('#csr_form').on('submit', function(e) {
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
        $('#save_csr_btn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');
        
        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/csr/submit.php",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(response);
                csr();
            },
            error: function() {
                alert('An error occurred while saving the CSR record.');
                $('#save_csr_btn').prop('disabled', false).html('<i class="fa fa-save"></i> Save CSR Record');
            }
        });
    });
});
</script>
