<?php
require '../../connect.php';
include("../../user.php");

// 1. AJAX CALL - Department choose panna Employee List fetch pandra backend logic
if (isset($_POST['action']) && $_POST['action'] == 'get_employees') {
    $dept_id = $_POST['dept_id'] ?? '';
    
    echo '<option value="">-- Choose Employee --</option>';
    if (!empty($dept_id)) {
        // z_user_master table la irundhu department compare panni full_name edukudhu
        $emp_stmt = $con->prepare("SELECT user_id, full_name FROM z_user_master WHERE department = ? AND full_name IS NOT NULL AND full_name != ''");
        $emp_stmt->execute([$dept_id]);
        
        while ($emp_row = $emp_stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="'.$emp_row['user_id'].'">'.$emp_row['full_name'].'</option>';
        }
    }
    exit; // AJAX response mudinjadhukku apram file stop aagidum
}

// 2. AJAX CALL - Final Save Logic
if (isset($_POST['action']) && $_POST['action'] == 'save_assignment') {
    $quote_id = $_POST['quote_id'] ?? '';
    $dept_id = $_POST['department'] ?? '';
    $emp_id = $_POST['employee_id'] ?? '';

    if (empty($emp_id)) {
        echo json_encode(["status" => 0, "message" => "Please select an employee"]);
        exit;
    }

    // REPLACE WITH THIS CODE:
    // Cost sheet / Enquiry status update
    try {
        // 1. Get the cost_sheet_no from po_generate using quote_id
        $po_stmt = $con->query("SELECT cost_sheet_no FROM po_generate WHERE id='$quote_id'");
        if ($po_row = $po_stmt->fetch(PDO::FETCH_ASSOC)) {
            $cs_no = $po_row['cost_sheet_no'];
            
            // 2. Get the enquiry_id from cost_sheet_entry
            $cs_stmt = $con->query("SELECT enquiry_id FROM cost_sheet_entry WHERE cost_sheet_no='$cs_no' LIMIT 1");
            if ($cs_row = $cs_stmt->fetch(PDO::FETCH_ASSOC)) {
                $enq_id = $cs_row['enquiry_id'];
                
                // 3. Update Enquiry table: Set assigned employee and change status to 30 (Software Flow Created)
                $con->exec("UPDATE enquiry SET status='30', employee='$emp_id' WHERE id='$enq_id'");
                
                // 4. Update Cost Sheet table status just in case
                $con->exec("UPDATE cost_sheet_entry SET status='30' WHERE cost_sheet_no='$cs_no'");
            }
        }
        
        echo json_encode(["status" => 1, "message" => "Employee Assigned Successfully"]);
    } catch (PDOException $e) {
        echo json_encode(["status" => 0, "message" => "Database error"]);
    }
    exit;
}

// 3. UI VIEW - Page load aagura form
$quoteid = $_REQUEST['id'] ?? '';
?>

<div class="card card-primary">
    <div class="card-header" style="background-color: #009EE3 !important;">
        <h3 class="card-title" style="color:white;"><font size="5">Assign Employee for Software</font></h3>
        <a onclick="back_to_po()" style="float: right;" class="btn btn-dark">Back</a>
    </div>
    
    <div class="card-body">
        <form id="assign_form" method="POST">
            <input type="hidden" name="quote_id" id="quote_id" value="<?php echo $quoteid; ?>">

            <table class="table table-bordered">
                <tr>
                    <td style="width: 30%;"><b>Select Department :</b></td>
                    <td>
                        <select class="form-control" name="department" id="department" onchange="fetch_dept_employees(this.value)">
                            <option value="">-- Choose Department --</option>
                            <?php
                            $dept_query = $con->query("SELECT * FROM z_department_master ORDER BY dept_name ASC");
                            while ($dept = $dept_query->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="'.$dept['id'].'">'.$dept['dept_name'].'</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td><b>Select Employee :</b></td>
                    <td>
                        <select class="form-control" name="employee_id" id="employee_id">
                            <option value="">-- Choose Employee --</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" align="center">
                        <button type="button" class="btn btn-success" onclick="submit_assignment()">Assign Employee</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<script>
// Same file-kku request anupi z_user_master la irundhu full_name edukkura AJAX
function fetch_dept_employees(dept_id) {
    if (dept_id !== '') {
        $.ajax({
            type: "POST",
            url: "qvision/CRM/assign_emp_form.php",
            data: {
                action: 'get_employees',
                dept_id: dept_id
            },
            success: function(response) {
                $("#employee_id").html(response);
            }
        });
    } else {
        $("#employee_id").html('<option value="">-- Choose Employee --</option>');
    }
}

// Assignment save pandra AJAX
function submit_assignment() {
    var dept = $('#department').val();
    var emp = $('#employee_id').val();

    if (dept == '') {
        alert("Please select Department!");
        return false;
    }
    if (emp == '') {
        alert("Please select Employee!");
        return false;
    }

    var formData = $('#assign_form').serialize() + '&action=save_assignment';

    $.ajax({
        type: "POST",
        url: "qvision/CRM/assign_emp_form.php",
        data: formData,
        dataType: "json",
        success: function(res) {
            if (res.status == 1) {
                alert(res.message);
                back_to_po();
            } else {
                alert(res.message);
            }
        }
    });
}

function back_to_po() {
    if (typeof po_status === "function") {
        po_status();
    } else {
        location.reload();
    }
}
</script>