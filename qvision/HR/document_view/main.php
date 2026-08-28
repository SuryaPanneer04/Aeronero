<?php
require '../../../connect.php'; // Check your DB connection path

// =========================================================================
// 1. AJAX BACKEND LOGIC
// =========================================================================
if(isset($_POST['action'])) {
    $action = $_POST['action'];

    // Action A: Fetch Divisions
    if($action == 'get_divisions') {
        $dept_id = $_POST['dept_id'];
        $stmt = $con->prepare("SELECT id, div_name FROM division_master WHERE dep_id = ? AND status = 1");
        $stmt->execute([$dept_id]);
        echo "<option value=''>-- Select Division --</option>";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='".$row['id']."'>".$row['div_name']."</option>";
        }
        exit;
    }

    // Action B: Fetch Employees
    if($action == 'get_employees') {
        $div_id = $_POST['div_id'];
        $dept_id = $_POST['dept_id'];
        $stmt = $con->prepare("
            SELECT zum.user_name, zum.full_name 
            FROM z_user_master zum 
            INNER JOIN staff_master sm ON zum.candidate_id = sm.candid_id 
            WHERE zum.department = ? AND sm.div_id = ? AND zum.status = 1
        ");
        $stmt->execute([$dept_id, $div_id]);
        echo "<option value=''>-- Select Employee --</option>";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='".$row['user_name']."'>".$row['full_name']." (".$row['user_name'].")</option>";
        }
        exit;
    }

    // Action C: Load UI for Document Upload & Buttons
    if($action == 'get_document_ui') {
        $emp_id = $_POST['emp_id'];
        ?>
        <div class="mt-4 pt-3 border-top">
            <input type="hidden" id="current_emp_id" value="<?php echo $emp_id; ?>">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 style="color: #dc8460; font-weight: 600; margin: 0;">Employee Documents Management</h5>
                <button type="button" class="btn btn-info btn-sm text-white" onclick="view_employee_documents()" style="background-color: #17a2b8; font-weight: 600; padding: 6px 20px; border-radius: 4px;"><i class="fa fa-eye"></i> View Uploaded Docs</button>
            </div>
            
            <!-- Document Sections -->
            <?php 
            $documents = ["1. Offer Letter" => "Offer Letter", "2. Relieving Order" => "Relieving Order", "3. NDA" => "NDA", "4. System Agreement" => "System Agreement"];
            foreach($documents as $label => $doc_type) {
                $container_id = "container_" . str_replace(' ', '_', $doc_type);
            ?>
            <div class="row align-items-start mb-3 pb-3 border-bottom">
                <div class="col-md-3">
                    <button type="button" class="btn btn-outline-secondary w-100 text-left" style="font-weight: 500; border-color: #ccc;"><?php echo $label; ?></button>
                </div>
                <!-- flex-wrap allows items to sit side-by-side -->
                <div class="col-md-9 d-flex flex-wrap" id="<?php echo $container_id; ?>" style="gap: 15px;">
                    <form class="d-flex align-items-center upload-form" data-doc-type="<?php echo $doc_type; ?>" style="gap: 5px;">
                        <input type="file" name="doc_file" class="form-control form-control-sm" style="width: 220px;" required>
                        <button type="button" class="btn btn-sm" onclick="add_specific_doc('<?php echo $container_id; ?>', '<?php echo $doc_type; ?>')" style="background-color: #eb6a14; color: #fff; border: 1px solid #c2590e; font-weight: 600; padding: 3px 12px; border-radius: 3px;">ADD</button>
                        <button type="button" class="btn btn-sm" onclick="upload_single_doc(this)" style="background-color: #5a6268; color: white; border: 1px solid #545b62; font-weight: 600; padding: 3px 12px; border-radius: 3px;">Upload</button>
                    </form>
                </div>
            </div>
            <?php } ?>
            
        </div>
        <?php
        exit;
    }

    // Action D: File Upload Process to Database
    if($action == 'upload_single_document') {
        $emp_id = $_POST['emp_id'];
        $doc_type = $_POST['doc_type']; 
        
        if(isset($_FILES['doc_file']) && $_FILES['doc_file']['error'] == 0) {
            $file_name = $_FILES['doc_file']['name'];
            $tmp_name = $_FILES['doc_file']['tmp_name'];
            
            $upload_dir = 'uploads/';
            if(!is_dir($upload_dir)) { mkdir($upload_dir, 0777, true); }
            
            $clean_name = preg_replace("/[^a-zA-Z0-9.]/", "_", $file_name);
            $new_file_name = $emp_id . "_" . time() . "_" . $clean_name;
            $destination = $upload_dir . $new_file_name;
            
            if(move_uploaded_file($tmp_name, $destination)) {
                $stmt = $con->prepare("INSERT INTO employee_documents (emp_id, doc_name, file_path, status, created_on) VALUES (?, ?, ?, 1, NOW())");
                if($stmt->execute([$emp_id, $doc_type, $new_file_name])) {
                    echo "Success: ".$doc_type." uploaded successfully!";
                } else {
                    echo "Error: Database insertion failed!";
                }
            } else {
                echo "Error: Failed to move uploaded file!";
            }
        } else {
            echo "Error: Please select a valid file.";
        }
        exit;
    }

    // Action E: View Uploaded Documents List with Employee Name
    if($action == 'view_employee_documents') {
        $emp_id = $_POST['emp_id'];
        
        // Fetch exact Employee Name
        $emp_stmt = $con->prepare("SELECT full_name FROM z_user_master WHERE user_name = ?");
        $emp_stmt->execute([$emp_id]);
        $emp_name = $emp_stmt->fetchColumn();
        
        // Fetch uploaded files
        $stmt = $con->prepare("SELECT * FROM employee_documents WHERE emp_id = ? AND status = 1 ORDER BY id DESC");
        $stmt->execute([$emp_id]);
        ?>
        <div class="mt-4 pt-3 border-top">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="text-info m-0" style="font-weight: 600; color: #17a2b8 !important;">
                    <i class="fa fa-folder-open"></i> Uploaded Documents - <span class="text-dark"><?php echo $emp_name . " (" . $emp_id . ")"; ?></span>
                </h5>
                <button type="button" class="btn btn-sm btn-secondary" onclick="load_employee_documents('<?php echo $emp_id; ?>')"><i class="fa fa-arrow-left"></i> Back to Uploads</button>
            </div>
            
            <div class="table-responsive">
                <!-- Added id="view_doc_table" for DataTables -->
                <table class="table table-bordered table-striped" id="view_doc_table" style="width: 100%;">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th>Id</th>
                            <th>Document Type</th>
                            <th>File Name</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>".$i++."</td>";
                        echo "<td style='font-weight:500;'>".$row['doc_name']."</td>";
                        echo "<td>".$row['file_path']."</td>";
                        echo "<td>".date('Y-m-d', strtotime($row['created_on']))."</td>";
                        echo "<td><span style='color: #28a745; font-weight: bold;'>Uploaded</span></td>";
                        // Orange View Button
                        echo "<td><a href='qvision/HR/document_view/uploads/".$row['file_path']."' target='_blank' class='btn btn-sm text-white' style='background-color: #eb6a14; padding: 2px 10px; border-radius: 3px;'>View</a></td>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Initialize DataTables to match the 4th image style -->
        <script>
            $(document).ready(function() {
                if ($.fn.DataTable.isDataTable('#view_doc_table')) {
                    $('#view_doc_table').DataTable().destroy();
                }
                $('#view_doc_table').DataTable({
                    "pageLength": 10,
                    "ordering": true,
                    "info": true
                });
            });
        </script>
        <?php
        exit;
    }
}
// =========================================================================
// 2. FRONTEND UI LOGIC
// =========================================================================
?>
<div class="card" style="box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2); margin-left: -30px; width: calc(100% + 30px);">
    <div class="card-header" style="background-color: #dc8460 !important; color: #333 !important; border-radius: 4px 4px 0 0;">
        <h3 class="card-title" style="font-size: 1.1rem; margin: 0; font-weight: 500;">Document View</h3>
    </div>
    <div class="card-body" style="min-height: 200px;">
        <div class="row pt-2 pb-3">
            <!-- 1. Department Dropdown -->
            <div class="col-md-4">
                <label style="font-size: 1rem; font-weight: 600; color: #444;">Select Department</label>
                <select class="form-control" style="height: 40px; font-size: 0.95rem; border-radius: 4px;" id="doc_dept_id" onchange="get_doc_divisions(this.value)">
                    <option value="">-- Select Department --</option>
                    <?php
                    $dept_sql = $con->query("SELECT id, dept_name FROM z_department_master WHERE status = 1");
                    while($dept = $dept_sql->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='".$dept['id']."'>".$dept['dept_name']."</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- 2. Division Dropdown -->
            <div class="col-md-4">
                <label style="font-size: 1rem; font-weight: 600; color: #444;">Select Division</label>
                <select class="form-control" style="height: 40px; font-size: 0.95rem; border-radius: 4px;" id="doc_div_id" onchange="get_doc_employees(this.value)">
                    <option value="">-- Select Division --</option>
                </select>
            </div>

            <!-- 3. Employee Dropdown -->
            <div class="col-md-4">
                <label style="font-size: 1rem; font-weight: 600; color: #444;">Select Employee</label>
                <select class="form-control" style="height: 40px; font-size: 0.95rem; border-radius: 4px;" id="doc_emp_id" onchange="load_employee_documents(this.value)">
                    <option value="">-- Select Employee --</option>
                </select>
            </div>
        </div>
        
        <!-- Target Area to display documents -->
        <div id="document_display_area">
            <p class="text-muted text-center mt-4 pt-4">Please select an employee to view or upload their documents.</p>
        </div>
    </div>
</div>

<!-- =========================================================================
     3. JAVASCRIPT LOGIC
========================================================================== -->
<script>
var doc_url = "qvision/HR/document_view/main.php";

function get_doc_divisions(dept_id) {
    $("#doc_div_id").html("<option value=''>Loading...</option>");
    $("#doc_emp_id").html("<option value=''>-- Select Employee --</option>");
    $("#document_display_area").html("<p class='text-muted text-center mt-4 pt-4'>Please select an employee to view or upload their documents.</p>");

    if(dept_id != "") {
        $.ajax({
            type: "POST", url: doc_url, data: { action: 'get_divisions', dept_id: dept_id },
            success: function(data) { $("#doc_div_id").html(data); }
        });
    } else { $("#doc_div_id").html("<option value=''>-- Select Division --</option>"); }
}

function get_doc_employees(div_id) {
    var dept_id = $("#doc_dept_id").val();
    $("#doc_emp_id").html("<option value=''>Loading...</option>");
    $("#document_display_area").html("<p class='text-muted text-center mt-4 pt-4'>Please select an employee to view or upload their documents.</p>");

    if(div_id != "") {
        $.ajax({
            type: "POST", url: doc_url, data: { action: 'get_employees', div_id: div_id, dept_id: dept_id },
            success: function(data) { $("#doc_emp_id").html(data); }
        });
    } else { $("#doc_emp_id").html("<option value=''>-- Select Employee --</option>"); }
}

function load_employee_documents(emp_id) {
    if(emp_id != "") {
        $("#document_display_area").html("<h5 class='text-center mt-4 text-info'><i class='fa fa-spinner fa-spin'></i> Loading UI...</h5>");
        $.ajax({
            type: "POST", url: doc_url, data: { action: 'get_document_ui', emp_id: emp_id },
            success: function(data) { $("#document_display_area").html(data); }
        });
    }
}

// Dynamic Add side-by-side with Red X button
function add_specific_doc(container_id, doc_type) {
    var html = '<form class="d-flex align-items-center upload-form" data-doc-type="'+doc_type+'" style="gap: 5px;">' +
               '<input type="file" name="doc_file" class="form-control form-control-sm" style="width: 220px;" required>' +
               '<button type="button" class="btn btn-danger btn-sm" onclick="remove_specific_doc(this)" style="font-weight: 600; padding: 3px 12px; border-radius: 3px;">X</button>' +
               '<button type="button" class="btn btn-sm" onclick="upload_single_doc(this)" style="background-color: #5a6268; color: white; border: 1px solid #545b62; font-weight: 600; padding: 3px 12px; border-radius: 3px;">Upload</button>' +
               '</form>';
    $("#" + container_id).append(html);
}

function remove_specific_doc(element) {
    $(element).closest('.upload-form').remove();
}

function upload_single_doc(btn_element) {
    var form = $(btn_element).closest('.upload-form')[0];
    var doc_type = $(btn_element).closest('.upload-form').attr('data-doc-type');
    var emp_id = $("#current_emp_id").val();

    var formData = new FormData(form);
    formData.append('action', 'upload_single_document');
    formData.append('emp_id', emp_id);
    formData.append('doc_type', doc_type);

    var fileInput = $(form).find('input[type="file"]').val();
    if(!fileInput) { alert("Please choose a file to upload."); return; }

    $(btn_element).text('...').prop('disabled', true);

    $.ajax({
        type: "POST",
        url: doc_url,
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            alert(response); 
            $(btn_element).text('Upload').prop('disabled', false); 
            // Optional: You can remove the row after successful upload if it's an appended one
        }
    });
}

function view_employee_documents() {
    var emp_id = $("#current_emp_id").val();
    if(emp_id != "") {
        $("#document_display_area").html("<h5 class='text-center mt-4 text-info'><i class='fa fa-spinner fa-spin'></i> Fetching Documents...</h5>");
        $.ajax({
            type: "POST", url: doc_url, data: { action: 'view_employee_documents', emp_id: emp_id },
            success: function(data) { 
                $("#document_display_area").html(data); 
            }
        });
    }
}
</script>