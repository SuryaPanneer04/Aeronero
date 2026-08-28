<?php
require '../../../connect.php';
include("../../../user.php");

$userrole = $_SESSION['userrole'];

// Only allow R003 (HR)
// if($userrole != 'R003') {
//     die("Access Denied. Only HR can access this page.");
// }

// =========================================================================
// 1. AJAX BACKEND LOGIC (Action Routing)
// =========================================================================
$action = isset($_POST['action']) ? $_POST['action'] : 'ui';

// Action A: Get Employees based on Department
if ($action == 'get_employees') {
    $dept_id = $_POST['dept_id'];
    $stmt = $con->prepare("SELECT user_name, full_name, user_group_code FROM z_user_master WHERE department = ? AND status = 1");
    $stmt->execute([$dept_id]);
    
    echo "<option value=''>-- Select Employee --</option>";
    while($emp = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='".$emp['user_group_code']."'>".$emp['full_name']." (".$emp['user_name'].") - Role: ".$emp['user_group_code']."</option>";
    }
    exit; // Stop execution here for AJAX response
}

// Action B: Get Sub Menus based on clicked Main Menu
if ($action == 'get_submenus') {
    $menu_id = $_POST['menu_id'];
    $role_code = $_POST['role_code'];
    
    $sub_sql = $con->prepare("SELECT id, name FROM z_masters_sub_menu WHERE menu_id = ? AND status = 1");
    $sub_sql->execute([$menu_id]);
    
    echo '<div class="row">';
    while($sub = $sub_sql->fetch(PDO::FETCH_ASSOC)) {
        $submenu_id = $sub['id'];
        
        $check_access = $con->prepare("SELECT id FROM z_role_detail WHERE code = ? AND menu_id = ? AND submenu_id = ?");
        $check_access->execute([$role_code, $menu_id, $submenu_id]);
        $has_access = $check_access->rowCount() > 0 ? "checked" : "";
        
        echo '
        <div class="col-md-6 mb-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="submenus[]" value="'.$submenu_id.'" id="sub_'.$submenu_id.'" '.$has_access.'>
                <label class="form-check-label" for="sub_'.$submenu_id.'">
                    '.$sub['name'].'
                </label>
            </div>
        </div>';
    }
    echo '</div>';
    exit; // Stop execution here for AJAX response
}

// Action C: Save Mapping to Database
if ($action == 'save_mapping') {
    $role_code = $_POST['role_code'];
    $menu_id = $_POST['menu_id'];
    $created_by = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; 

    if(empty($role_code) || empty($menu_id)) {
        echo "Error: Missing Role or Menu details.";
        exit;
    }

    // Delete existing mappings for this role and menu combination
    $del_stmt = $con->prepare("DELETE FROM z_role_detail WHERE code = ? AND menu_id = ?");
    $del_stmt->execute([$role_code, $menu_id]);

    // Insert newly checked menus
    if(isset($_POST['submenus']) && is_array($_POST['submenus'])) {
        $insert_stmt = $con->prepare("INSERT INTO z_role_detail (code, menu_id, submenu_id, view_only, edit_only, all_only, approval, created_by, created_on) VALUES (?, ?, ?, 1, 1, 1, 1, ?, NOW())");
        foreach($_POST['submenus'] as $submenu_id) {
            $insert_stmt->execute([$role_code, $menu_id, $submenu_id, $created_by]);
        }
    }
    echo "Menu mapping updated successfully!";
    exit; // Stop execution here for AJAX response
}

// =========================================================================
// 2. FRONTEND UI LOGIC (If action == 'ui')
// =========================================================================
?>

<style>
    /* Custom Bluebase Theme Styles */
    .custom-theme-header {
        background-color: #dc8460 !important; /* Matches Staff Asset List header */
        color: #333 !important;
        border-radius: 4px 4px 0 0;
    }
    .custom-theme-title {
        font-size: 1.1rem;
        margin: 0;
        font-weight: 500;
    }
    .active-menu-item {
        background-color: #fff4ef !important; /* Light peach background */
        color: #e65c00 !important; /* Dark orange text */
        font-weight: bold;
        border-left: 4px solid #e65c00 !important; /* Left highlight border */
    }
    .btn-theme-orange {
        background-color: #f06418; /* Matches the Accept button */
        color: white;
        border: none;
    }
    .btn-theme-orange:hover {
        background-color: #cf5513;
        color: white;
    }
</style>

<div class="card" style="box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);">
    <div class="card-header custom-theme-header">
        <h3 class="card-title custom-theme-title">Menu Mapping</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Department Selection -->
            <div class="col-md-4">
                <label>Select Department</label>
                <select class="form-control" id="dept_id" onchange="get_employees(this.value)">
                    <option value="">-- Select Department --</option>
                    <?php
                    $dept_sql = $con->query("SELECT * FROM z_department_master WHERE status = 1");
                    while($dept = $dept_sql->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='".$dept['id']."'>".$dept['dept_name']."</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Employee Selection -->
            <div class="col-md-4">
                <label>Select Employee</label>
                <select class="form-control" id="emp_id" onchange="get_main_menus(this.value)">
                    <option value="">-- Select Employee --</option>
                    <!-- Filled by AJAX -->
                </select>
            </div>
            
            <input type="hidden" id="selected_role_code" value="">
        </div>

        <hr>

        <div class="row" id="menu_container" style="display:none;">
            <!-- Main Menus (Left Side) -->
            <div class="col-md-4">
                <h5>Main Menus</h5>
                <ul class="list-group" id="main_menu_list">
                    <?php
                    $menu_sql = $con->query("SELECT * FROM z_masters_menu ORDER BY menu_order ASC");
                    while($menu = $menu_sql->fetch(PDO::FETCH_ASSOC)) {
                        echo "<li class='list-group-item' style='cursor:pointer;' onclick='get_sub_menus(".$menu['id'].", this)'>".$menu['menu_name']."</li>";
                    }
                    ?>
                </ul>
            </div>

            <!-- Sub Menus with Checkboxes (Right Side) -->
            <div class="col-md-8">
                <h5>Sub Menus Access</h5>
                <div class="card p-3 shadow-sm border">
                    <form id="menu_mapping_form">
                        <input type="hidden" name="action" value="save_mapping">
                        <input type="hidden" name="menu_id" id="active_menu_id" value="">
                        <input type="hidden" name="role_code" id="form_role_code" value="">
                        
                        <div id="sub_menu_checkboxes">
                            <p class="text-muted">Select a Main Menu to view sub-menus.</p>
                        </div>
                        
                        <div class="mt-3" id="submit_btn_div" style="display:none;">
                            <hr>
                            <button type="button" class="btn btn-theme-orange" onclick="save_mapping()"> Save Mapping</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Keep track of the current file path for all AJAX requests
var current_url = "qvision/masters/menu_mapping/menu_mapping_ui.php";

// 1. Get Employees based on Department
function get_employees(dept_id) {
    if(dept_id != "") {
        $.ajax({
            type: "POST",
            url: current_url,
            data: { action: 'get_employees', dept_id: dept_id },
            success: function(data) {
                $("#emp_id").html(data);
                $("#menu_container").hide();
            }
        });
    }
}

// 2. Set Role Code when Employee is selected
function get_main_menus(user_group_code) {
    if(user_group_code != "") {
        $("#selected_role_code").val(user_group_code);
        $("#form_role_code").val(user_group_code);
        $("#menu_container").fadeIn();
        $("#sub_menu_checkboxes").html('<p class="text-muted">Select a Main Menu to view sub-menus.</p>');
        $("#submit_btn_div").hide();
        $(".list-group-item").removeClass("active-menu-item");
    } else {
        $("#menu_container").fadeOut();
    }
}

// 3. Load Sub Menus based on clicked Main Menu
function get_sub_menus(menu_id, element) {
    var role_code = $("#selected_role_code").val();
    $("#active_menu_id").val(menu_id);
    
    $(".list-group-item").removeClass("active-menu-item");
    $(element).addClass("active-menu-item");

    $.ajax({
        type: "POST",
        url: current_url,
        data: { action: 'get_submenus', menu_id: menu_id, role_code: role_code },
        success: function(data) {
            $("#sub_menu_checkboxes").html(data);
            $("#submit_btn_div").show();
        }
    });
}

// 4. Save Mapping Data
function save_mapping() {
    var formData = $("#menu_mapping_form").serialize();
    $.ajax({
        type: "POST",
        url: current_url,
        data: formData,
        success: function(response) {
            alert(response);
            // If you want to reload the checkboxes for the current active menu to show updated state
            var current_menu_id = $("#active_menu_id").val();
            var active_element = $(".list-group-item.active");
            if(current_menu_id) {
                get_sub_menus(current_menu_id, active_element);
            }
        }
    });
}
</script>