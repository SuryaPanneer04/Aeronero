<?php
require '../../../connect.php';
session_start();

$id = $_POST['id'];
$stage = $_POST['stage'];

// Get User Info
$user_name = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : (isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin');
$dept_id = isset($_SESSION['department_id']) ? $_SESSION['department_id'] : '';
$dept_name = '';
if($dept_id) {
    $dept_query = $con->query("SELECT dept_name FROM z_department_master WHERE id = '$dept_id'");
    if($dept_res = $dept_query->fetch(PDO::FETCH_ASSOC)) {
        $dept_name = $dept_res['dept_name'];
    }
}
$updated_by_str = $user_name . ($dept_name ? " ($dept_name)" : "");

$upload_dir = '../../BusinessProcess/laboratory_requirement/uploads/';
$update_fields = [];
$params = [];

if($stage == 'proc_indent') {
    $indent_date = $_POST['indent_date'];
    $indent_doc = isset($_POST['old_indent_doc']) ? $_POST['old_indent_doc'] : '';
    
    if(!empty($_FILES['indent_doc']['name'])) {
        $indent_doc = time() . "_indent_" . basename($_FILES['indent_doc']['name']);
        move_uploaded_file($_FILES['indent_doc']['tmp_name'], $upload_dir . $indent_doc);
    }
    
    $update_fields[] = "indent_date=?";
    $update_fields[] = "indent_doc=?";
    $update_fields[] = "indent_updated_by=?";
    $params = [$indent_date, $indent_doc, $updated_by_str];
}
else if($stage == 'finance') {
    $finance_status = $_POST['finance_status'];
    $finance_doc = isset($_POST['old_finance_doc']) ? $_POST['old_finance_doc'] : '';
    
    if(!empty($_FILES['finance_doc']['name'])) {
        $finance_doc = time() . "_fin_" . basename($_FILES['finance_doc']['name']);
        move_uploaded_file($_FILES['finance_doc']['tmp_name'], $upload_dir . $finance_doc);
    }
    
    $update_fields[] = "finance_status=?";
    $update_fields[] = "finance_doc=?";
    $update_fields[] = "finance_updated_by=?";
    $params = [$finance_status, $finance_doc, $updated_by_str];
}
else if($stage == 'proc_status') {
    $procurement_status = $_POST['procurement_status'];
    $procurement_doc = isset($_POST['old_procurement_doc']) ? $_POST['old_procurement_doc'] : '';
    
    if(!empty($_FILES['procurement_doc']['name'])) {
        $procurement_doc = time() . "_proc_" . basename($_FILES['procurement_doc']['name']);
        move_uploaded_file($_FILES['procurement_doc']['tmp_name'], $upload_dir . $procurement_doc);
    }
    
    $update_fields[] = "procurement_status=?";
    $update_fields[] = "procurement_doc=?";
    $update_fields[] = "procurement_updated_by=?";
    $params = [$procurement_status, $procurement_doc, $updated_by_str];
}
else if($stage == 'qc') {
    $qc_status = $_POST['qc_status'];
    $qc_doc = isset($_POST['old_qc_doc']) ? $_POST['old_qc_doc'] : '';
    
    if(!empty($_FILES['qc_doc']['name'])) {
        $qc_doc = time() . "_qc_" . basename($_FILES['qc_doc']['name']);
        move_uploaded_file($_FILES['qc_doc']['tmp_name'], $upload_dir . $qc_doc);
    }
    
    $update_fields[] = "qc_status=?";
    $update_fields[] = "qc_doc=?";
    $update_fields[] = "qc_updated_by=?";
    $params = [$qc_status, $qc_doc, $updated_by_str];
}
else if($stage == 'received') {
    $received_status = $_POST['received_status'];
    $received_doc = isset($_POST['old_received_doc']) ? $_POST['old_received_doc'] : '';
    
    if(!empty($_FILES['received_doc']['name'])) {
        $received_doc = time() . "_rec_" . basename($_FILES['received_doc']['name']);
        move_uploaded_file($_FILES['received_doc']['tmp_name'], $upload_dir . $received_doc);
    }
    
    $update_fields[] = "received_status=?";
    $update_fields[] = "received_doc=?";
    $update_fields[] = "received_updated_by=?";
    $params = [$received_status, $received_doc, $updated_by_str];
}
 
if(count($update_fields) > 0) {
    $params[] = $id;
    $query = "UPDATE z_laboratory_requirements SET " . implode(', ', $update_fields) . " WHERE id=?";
    $stmt = $con->prepare($query);
    $result = $stmt->execute($params);

    if($result) {
        echo "Successfully Updated!";
    } else {
        echo "Error: Failed to update.";
    }
} else {
    echo "Error: Invalid stage.";
}
?>

