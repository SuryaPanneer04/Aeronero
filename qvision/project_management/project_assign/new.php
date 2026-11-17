<?php
require '../../../connect.php';
session_start();
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Assign Project</h3>
        <a onclick="project_assign()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <form role="form" id="project_assign_form" name="project_assign_form" method="post" enctype="multipart/form-data">
        <div class="card-body">
            
            <div class="form-group">
                <label>Project <span class="text-danger">*</span></label>
                <select class="form-control" name="project_id" id="project_id" required>
                    <option value="">Select Project</option>
                    <?php
                    $proj_sql = $con->query("SELECT * FROM y_project_details ORDER BY project_name ASC");
                    while($proj_res = $proj_sql->fetch(PDO::FETCH_ASSOC)) {
                        $pcode = !empty($proj_res['project_code']) ? " (" . $proj_res['project_code'] . ")" : "";
                        echo "<option value='".$proj_res['project_id']."'>".$proj_res['project_name'].$pcode."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Department</label>
                <select class="form-control" name="department_id" id="department_id" onchange="get_employees()">
                    <option value="">Select Department</option>
                    <?php
                    $dept_sql = $con->query("SELECT * FROM z_department_master WHERE status=1 AND dept_name = 'R&D' ORDER BY dept_name ASC");
                    while($dept_res = $dept_sql->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='".$dept_res['id']."'>".$dept_res['dept_name']."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Employee & Deadline (Date) <span class="text-danger">*</span></label>
                <div id="employee_container" style="max-height: 250px; overflow-y: auto; border: 1px solid #ccc; padding: 15px; border-radius: 5px; background: #f9f9f9;">
                    <p class="text-muted mb-0">Select a department to view employees</p>
                </div>
            </div>

            <div class="form-group">
                <label>Documents Upload</label>
                <div id="docs_container">
                    <div class="d-flex align-items-center mb-2 doc_row">
                        <input type="text" class="form-control mr-2" name="doc_names[]" placeholder="Document Name" style="flex: 1;">
                        <input type="file" class="form-control mr-2" name="project_docs[]" style="flex: 1;">
                        <button type="button" class="btn btn-success btn-sm" onclick="add_doc_row()"><i class="fa fa-plus"></i> Add</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <input type="button" class="btn btn-primary" onclick="submit_project_assign()" value="Submit">
        </div>
    </form>
</div>
<script>
function get_employees() {
    var dep_id = $('#department_id').val();
    $.ajax({
        type: "POST",
        url: "qvision/project_management/project_assign/get_employees.php",
        data: { dep_id: dep_id },
        success: function(data) {
            $('#employee_container').html(data);
        }
    });
}

function add_doc_row() {
    var html = '<div class="d-flex align-items-center mb-2 doc_row">' +
               '<input type="text" class="form-control mr-2" name="doc_names[]" placeholder="Document Name" style="flex: 1;">' +
               '<input type="file" class="form-control mr-2" name="project_docs[]" style="flex: 1;">' +
               '<button type="button" class="btn btn-danger btn-sm" onclick="$(this).parent().remove()"><i class="fa fa-minus"></i> Remove</button>' +
               '</div>';
    $('#docs_container').append(html);
}

function submit_project_assign() {
    var project_id = $('#project_id').val();
    var checked = $("input[name='employee_id[]']:checked").length;
    
    if(project_id == '') {
        alert("Please select a Project");
        return false;
    }
    if(checked == 0) {
        alert("Please select at least one Employee");
        return false;
    }

    var formData = new FormData(document.getElementById('project_assign_form'));

    $.ajax({
        type: "POST",
        url: "qvision/project_management/project_assign/submit.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            alert("Employee(s) and documents assigned successfully!");
            project_assign();
        }
    });
}
</script>
