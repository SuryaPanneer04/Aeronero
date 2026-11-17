<?php
require '../../../connect.php';
session_start();

$id = $_POST['id'];

$stmt = $con->prepare("SELECT pe.*, pd.project_name, sm.emp_name FROM y_project_employees pe JOIN y_project_details pd ON pe.project_id = pd.project_id JOIN staff_master sm ON pe.employee_id = sm.candid_id WHERE pe.id = :id");
$stmt->execute([':id' => $id]);
$res = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Project Assignment</h3>
        <a onclick="project_assign()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <form role="form" id="project_assign_edit_form" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
            
            <div class="form-group">
                <label>Project Name</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($res['project_name']); ?>" readonly>
            </div>

            <div class="form-group">
                <label>Employee Name</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($res['emp_name']); ?>" readonly>
            </div>

            <div class="form-group">
                <label>Deadline (Date) <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="deadline_date" id="deadline_date" value="<?php echo $res['deadline_date']; ?>" required>
            </div>

            <div class="form-group">
                <label>Add More Documents</label>
                <div id="docs_container_edit">
                    <div class="d-flex align-items-center mb-2 doc_row">
                        <input type="text" class="form-control mr-2" name="doc_names[]" placeholder="Document Name" style="flex: 1;">
                        <input type="file" class="form-control mr-2" name="project_docs[]" style="flex: 1;">
                        <button type="button" class="btn btn-success btn-sm" onclick="add_doc_row_edit()"><i class="fa fa-plus"></i> Add</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <input type="button" class="btn btn-primary" onclick="update_project_assign()" value="Update">
        </div>
    </form>
</div>
<script>
function add_doc_row_edit() {
    var html = '<div class="d-flex align-items-center mb-2 doc_row">' +
               '<input type="text" class="form-control mr-2" name="doc_names[]" placeholder="Document Name" style="flex: 1;">' +
               '<input type="file" class="form-control mr-2" name="project_docs[]" style="flex: 1;">' +
               '<button type="button" class="btn btn-danger btn-sm" onclick="$(this).parent().remove()"><i class="fa fa-minus"></i> Remove</button>' +
               '</div>';
    $('#docs_container_edit').append(html);
}

function update_project_assign() {
    var deadline = $('#deadline_date').val();
    
    if(deadline == '') {
        alert("Please enter a Deadline Date");
        return false;
    }

    var formData = new FormData(document.getElementById('project_assign_edit_form'));

    $.ajax({
        type: "POST",
        url: "qvision/project_management/project_assign/update.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            alert("Project assignment updated successfully!");
            project_assign();
        }
    });
}
</script>
