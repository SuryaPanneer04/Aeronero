<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">CHANGE PASSWORD</font></h3>
    </div>
    <div class="card-body">
        <form id="changePasswordForm" onsubmit="event.preventDefault(); update_password();">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Old Password <span style="color:red">*</span></label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Enter Old Password" required>
                        <div class="input-group-append" onclick="togglePassword('old_password', 'icon_old')" style="cursor: pointer;">
                            <span class="input-group-text"><i class="fas fa-eye" id="icon_old"></i></span>
                        </div>
                    </div>
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
                    <button type="reset" class="btn btn-default" style="width: 100px; margin-left: 10px;">Clear</button>
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

function update_password() {
    var old_pw = $('#old_password').val();
    var new_pw = $('#new_password').val();
    var conf_pw = $('#confirm_password').val();
    
    if (old_pw == '' || new_pw == '' || conf_pw == '') {
        alert("Please fill all required fields.");
        return;
    }
    
    if (new_pw !== conf_pw) {
        alert("New password and confirm password do not match.");
        return;
    }
    
    $.ajax({
        type: "POST",
        url: "qvision/password/password_master/password_submit.php",
        data: $('#changePasswordForm').serialize(),
        success: function(data) {
            if(data.trim() == "success") {
                alert("Password updated successfully.");
                $('#changePasswordForm')[0].reset();
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
