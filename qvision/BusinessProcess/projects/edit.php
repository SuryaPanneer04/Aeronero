<?php
require_once '../../../connect.php';
if (!headers_sent() && session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$stmt = $con->prepare("SELECT * FROM z_projects WHERE id = ?");
$stmt->execute([$id]);
$res = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$res) {
    echo "<div class='alert alert-danger'>Project not found!</div>";
    exit;
}

// 1. Fetch collaborations for dropdown
$collab_sql = $con->query("SELECT id, collaborator_name, collab_type, status FROM z_collaborations ORDER BY collaborator_name ASC");
$collabs = $collab_sql ? $collab_sql->fetchAll(PDO::FETCH_ASSOC) : [];

// 2. Fetch Project Codes from y_project_details (Project Master)
$pm_sql = $con->query("SELECT project_id, project_code, project_name FROM y_project_details ORDER BY project_code ASC");
$project_masters = $pm_sql ? $pm_sql->fetchAll(PDO::FETCH_ASSOC) : [];

// 3. Fetch R&D Department employees from staff_master
$rd_sql = $con->query("
    SELECT sm.id, sm.candid_id, sm.emp_code, sm.emp_name, sm.dep_id, zd.dept_name 
    FROM staff_master sm 
    JOIN z_department_master zd ON sm.dep_id = zd.id 
    WHERE zd.dept_name = 'R&D' OR zd.dept_name LIKE '%R&D%'
    ORDER BY sm.emp_name ASC
");
$rd_employees = $rd_sql ? $rd_sql->fetchAll(PDO::FETCH_ASSOC) : [];

// Determine which employees are currently selected
$existing_resources = $res['resource_used'] ?? '';
$matched_emp_parts = [];
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="4"><strong>Edit Project #<?php echo htmlspecialchars($res['project_code']); ?></strong></font></h3>
        <a onclick="projects()" style="float: right;" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Projects</a>
    </div>
    <form role="form" id="edit_project_form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
        
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Project Code <span class="text-danger">*</span> <small class="text-muted">(From Project Master)</small></label>
                        <select class="form-control" name="project_code" id="project_code" required onchange="handle_project_code_change(this)">
                            <option value="">-- Select Project Code --</option>
                            <?php 
                            $code_found = false;
                            foreach($project_masters as $pm): 
                                $is_sel = ($res['project_code'] == $pm['project_code']);
                                if ($is_sel) $code_found = true;
                            ?>
                                <option value="<?php echo htmlspecialchars($pm['project_code']); ?>" 
                                        data-name="<?php echo htmlspecialchars($pm['project_name']); ?>"
                                        <?php if ($is_sel) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($pm['project_code'] . ' - ' . $pm['project_name']); ?>
                                </option>
                            <?php endforeach; ?>
                            <?php if (!$code_found && !empty($res['project_code'])): ?>
                                <option value="<?php echo htmlspecialchars($res['project_code']); ?>" selected>
                                    <?php echo htmlspecialchars($res['project_code']); ?> (Custom)
                                </option>
                            <?php endif; ?>
                        </select>
                        <small class="form-text text-muted">
                            <i class="fa fa-info-circle text-info"></i> Selecting code auto-fills Project Name.
                        </small>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Project Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="project_name" id="project_name" value="<?php echo htmlspecialchars($res['project_name']); ?>" required readonly style="background-color: #f8f9fa;">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Project Lead <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="project_lead" id="project_lead" value="<?php echo htmlspecialchars($res['project_lead']); ?>" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="mb-0">Resource Used <span class="text-danger">*</span> <small class="text-muted">(R&D Staff Checkboxes)</small></label>
                            <div>
                                <a href="javascript:void(0);" onclick="toggleAllRD(true)" class="btn btn-xs btn-outline-primary mr-1"><i class="fa fa-check-square"></i> Select All</a>
                                <a href="javascript:void(0);" onclick="toggleAllRD(false)" class="btn btn-xs btn-outline-secondary"><i class="fa fa-square"></i> Clear</a>
                            </div>
                        </div>
                        <div class="card p-2 mb-2" style="max-height: 180px; overflow-y: auto; background-color: #fcfcfc; border: 1px solid #ced4da; border-radius: 4px;">
                            <div class="row">
                                <?php if(empty($rd_employees)): ?>
                                    <div class="col-12 text-muted small p-2">No R&D employees found in staff master.</div>
                                <?php else: ?>
                                    <?php 
                                    foreach($rd_employees as $emp): 
                                        $emp_val = $emp['emp_name'] . ' (' . $emp['emp_code'] . ')';
                                        $is_checked = (stripos($existing_resources, $emp['emp_name']) !== false || stripos($existing_resources, $emp['emp_code']) !== false);
                                    ?>
                                        <div class="col-sm-6 mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input rd-checkbox" 
                                                       name="resource_used[]" 
                                                       id="rd_emp_<?php echo $emp['id']; ?>" 
                                                       value="<?php echo htmlspecialchars($emp_val); ?>"
                                                       <?php if($is_checked) echo 'checked'; ?>>
                                                <label class="custom-control-label" for="rd_emp_<?php echo $emp['id']; ?>" style="font-weight: normal; cursor: pointer; font-size: 13px;">
                                                    <?php echo htmlspecialchars($emp['emp_name']); ?> 
                                                    <span class="text-muted" style="font-size: 11px;">(<?php echo htmlspecialchars($emp['emp_code']); ?>)</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="additional_resources" id="additional_resources" placeholder="Additional resources / equipment (Optional, e.g. Climatic chamber)">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Collaborated with (if any) <small class="text-muted">(From Collaborations Menu)</small></label>
                        <select class="form-control" name="collab_id" id="collab_id">
                            <option value="">-- None / No Collaboration --</option>
                            <?php foreach($collabs as $c): ?>
                                <option value="<?php echo $c['id']; ?>" <?php if($res['collab_id'] == $c['id']) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($c['collaborator_name'] . ' (' . $c['collab_type'] . ')'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="form-text text-muted">
                            <i class="fa fa-info-circle text-info"></i> Linked to <code>qvision/BusinessProcess/collaborations/main.php</code>
                        </small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Deadline <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="deadline" id="deadline" value="<?php echo $res['deadline']; ?>" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Attach Project Reports</label>
                        <input type="file" class="form-control" name="report_file" id="report_file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.zip">
                        <?php if(!empty($res['report_file'])): ?>
                            <div class="mt-2">
                                <span class="badge badge-info">Current Report:</span>
                                <a href="qvision/BusinessProcess/projects/uploads/<?php echo $res['report_file']; ?>" target="_blank" class="btn btn-xs btn-outline-primary ml-1">
                                    <i class="fa fa-download"></i> View / Download
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="Planned" <?php if($res['status'] == 'Planned') echo 'selected'; ?>>Planned</option>
                            <option value="In Progress" <?php if($res['status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                            <option value="Under Review" <?php if($res['status'] == 'Under Review') echo 'selected'; ?>>Under Review</option>
                            <option value="Completed" <?php if($res['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                            <option value="On Hold" <?php if($res['status'] == 'On Hold') echo 'selected'; ?>>On Hold</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" id="update_btn" class="btn btn-primary"><i class="fa fa-save"></i> Update Project</button>
            <a onclick="projects()" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>

<script>
function handle_project_code_change(sel) {
    var opt = $(sel).find('option:selected');
    var pName = opt.data('name');
    if (pName !== undefined && pName !== '') {
        $('#project_name').val(pName);
    }
}

function toggleAllRD(check) {
    $('.rd-checkbox').prop('checked', check);
}

$(document).ready(function() {
    $('#edit_project_form').on('submit', function(e) {
        e.preventDefault();
        
        var project_code = $('#project_code').val().trim();
        var project_name = $('#project_name').val().trim();
        var deadline = $('#deadline').val();
        
        if(!project_code) {
            alert('Please select Project Code');
            return false;
        }
        if(!project_name) {
            alert('Project Name is missing. Please select a valid Project Code.');
            return false;
        }
        if(!deadline) {
            alert('Please select a Deadline');
            return false;
        }

        var hasResource = $('.rd-checkbox:checked').length > 0 || $('#additional_resources').val().trim() !== '';
        if(!hasResource) {
            alert('Please select at least one R&D Employee or enter resource in Resource Used.');
            return false;
        }
        
        var formData = new FormData(this);
        $('#update_btn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');
        
        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/projects/update.php",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(response);
                projects();
            },
            error: function() {
                alert('An error occurred while updating the project.');
                $('#update_btn').prop('disabled', false).html('<i class="fa fa-save"></i> Update Project');
            }
        });
    });
});
</script>
