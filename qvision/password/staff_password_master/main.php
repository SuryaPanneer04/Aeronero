<?php
include '../../../connect.php';

// Fetch departments
$dept_query = $con->query("SELECT id, dept_name FROM z_department_master WHERE status = 1");
$departments = $dept_query->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">STAFF PASSWORD MANAGEMENT</font></h3>
    </div>
    <div class="card-body">
        <form id="staffPasswordForm" onsubmit="event.preventDefault(); update_staff_password();">
            
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Department <span style="color:red">*</span></label>
                <div class="col-sm-6">
                    <select class="form-control" name="department" id="department" onchange="get_divisions(this.value); get_employees();" required>
                        <option value="">Select Department</option>
                        <?php foreach($departments as $dept) { ?>
                            <option value="<?php echo $dept['id']; ?>"><?php echo htmlspecialchars($dept['dept_name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Division</label>
                <div class="col-sm-6">
                    <select class="form-control" name="division" id="division" onchange="get_employees();">
                        <option value="">Select Division</option>
                        <!-- Loaded via AJAX -->
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Employee <span style="color:red">*</span></label>
                <div class="col-sm-6">
                    <select class="form-control" name="employee" id="employee" required>
                        <option value="">Select Employee</option>
                        <!-- Loaded via AJAX -->
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">New Password <span style="color:red">*</span></label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Enter New Password" required>
                        <div class="input-group-append" onclick="togglePassword('new_password', 'icon_new')" style="cursor: pointer;">
                            <span class="input-group-text"><i class="fas fa-eye" id="icon_new"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Confirm Password <span style="color:red">*</span></label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm New Password" required>
                        <div class="input-group-append" onclick="togglePassword('confirm_password', 'icon_conf')" style="cursor: pointer;">
                            <span class="input-group-text"><i class="fas fa-eye" id="icon_conf"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 text-center">
                    <button type="submit" class="btn btn-primary" style="width: 100px;">Submit</button>
                    <button type="reset" class="btn btn-default" style="width: 100px; margin-left: 10px;" onclick="resetForm()">Clear</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function togglePassword(inputId, iconId) {
    var input = document.getElementById(inputId);
    var icon = document.getElementById(iconId);
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}

function get_divisions(dept_id) {
    $.ajax({
        type: "POST",
        url: "qvision/password/staff_password_master/get_divisions.php",
        data: { dept_id: dept_id },
        success: function(data) {
            $('#division').html(data);
        }
    });
}

function get_employees() {
    var dept_id = $('#department').val();
    var div_id = $('#division').val();
    if(dept_id) {
        $.ajax({
            type: "POST",
            url: "qvision/password/staff_password_master/get_employees.php",
            data: { dept_id: dept_id, div_id: div_id },
            success: function(data) {
                $('#employee').html(data);
            }
        });
    } else {
        $('#employee').html('<option value="">Select Employee</option>');
    }
}

function resetForm() {
    $('#division').html('<option value="">Select Division</option>');
    $('#employee').html('<option value="">Select Employee</option>');
}

function update_staff_password() {
    var emp = $('#employee').val();
    var new_pw = $('#new_password').val();
    var conf_pw = $('#confirm_password').val();
    
    if (emp == '' || new_pw == '' || conf_pw == '') {
        alert("Please fill all required fields.");
        return;
    }
    
    if (new_pw !== conf_pw) {
        alert("New password and confirm password do not match.");
        return;
    }
    
    $.ajax({
        type: "POST",
        url: "qvision/password/staff_password_master/password_submit.php",
        data: $('#staffPasswordForm').serialize(),
        success: function(data) {
            if(data.trim() == "success") {
                alert("Password updated successfully for the employee.");
                $('#staffPasswordForm')[0].reset();
                resetForm();
            } else {
                alert(data);
            }
        },
        error: function() {
            alert("An error occurred while updating password.");
        }
    });
}
</script>
