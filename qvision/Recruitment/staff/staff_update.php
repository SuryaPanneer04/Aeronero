<?php 
require '../../../connect.php';
require '../../../user.php';

$user         = $_SESSION['userid'];
$candidid     = $_REQUEST['cid']; // This is staff_master.id
$cname        = $_REQUEST['cname'];
$ccode        = $_REQUEST['ccode'];
$exploeepcode = explode('**', $ccode);
$prefix_code  = isset($exploeepcode[0]) ? $exploeepcode[0] : '';
$suff_code    = isset($exploeepcode[1]) ? $exploeepcode[1] : '';
$emp_code     = isset($exploeepcode[2]) ? $exploeepcode[2] : $ccode;
$deprt        = $_REQUEST['deprt'];
$div          = $_REQUEST['div'];
$desig        = $_REQUEST['desig'];
$reporting    = $_REQUEST['reporting'];
$head_status  = $_REQUEST['head_status'];
$status       = $_REQUEST['status'];
$date         = date('Y-m-d');

// New fields for candidate_form_details
$father_name  = isset($_REQUEST['father_name']) ? $_REQUEST['father_name'] : '';
$dob          = isset($_REQUEST['dob']) ? $_REQUEST['dob'] : '';
$address      = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';
$phone        = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : '';
$adharnumber  = isset($_REQUEST['adharnumber']) ? $_REQUEST['adharnumber'] : '';
$pannumber    = isset($_REQUEST['pannumber']) ? $_REQUEST['pannumber'] : '';

// 1. Update staff_master
$update = $con->query("
    UPDATE staff_master 
    SET 
        prefix_code = '$prefix_code',
        suff_code = '$suff_code',
        emp_code = '$emp_code',
        emp_name = '$cname',
        dep_id = '$deprt',
        div_id = '$div',
        design_id = '$desig',
        reporting_person = '$reporting',
        head_status = '$head_status',
        status = '$status',
        modified_by = '$user',
        modified_on = '$date'
    WHERE id = '$candidid'
");

if ($update) {

    // 2. Update or Insert into candidate_form_details
    $get_cand = $con->query("SELECT candid_id FROM staff_master WHERE id = '$candidid'");
    $cand_row = $get_cand->fetch(PDO::FETCH_ASSOC);
    $actual_candid_id = isset($cand_row['candid_id']) ? $cand_row['candid_id'] : '';

    if (!empty($actual_candid_id) && $actual_candid_id != '0') {
        // Check if row exists in candidate_form_details
        $check_cfd = $con->query("SELECT id FROM candidate_form_details WHERE id = '$actual_candid_id'");
        if ($check_cfd && $check_cfd->rowCount() > 0) {
            // Update existing record in candidate_form_details
            $stmt_cfd = $con->prepare("
                UPDATE candidate_form_details 
                SET 
                    father_name = :father_name,
                    dob = :dob,
                    address = :address,
                    phone = :phone,
                    adharnumber = :adharnumber,
                    pannumber = :pannumber
                WHERE id = :candid_id
            ");
            $stmt_cfd->execute([
                ':father_name' => $father_name,
                ':dob'         => $dob,
                ':address'     => $address,
                ':phone'       => $phone,
                ':adharnumber' => $adharnumber,
                ':pannumber'   => $pannumber,
                ':candid_id'   => $actual_candid_id
            ]);
        } else {
            // Insert new record with that specific id if missing
            $stmt_cfd = $con->prepare("
                INSERT INTO candidate_form_details (id, first_name, father_name, dob, address, phone, adharnumber, pannumber)
                VALUES (:candid_id, :first_name, :father_name, :dob, :address, :phone, :adharnumber, :pannumber)
            ");
            $stmt_cfd->execute([
                ':candid_id'   => $actual_candid_id,
                ':first_name'  => $cname,
                ':father_name' => $father_name,
                ':dob'         => $dob,
                ':address'     => $address,
                ':phone'       => $phone,
                ':adharnumber' => $adharnumber,
                ':pannumber'   => $pannumber
            ]);
        }
    } else {
        // If staff_master had candid_id = 0 or NULL, insert a new record in candidate_form_details and link it back to staff_master
        $stmt_cfd = $con->prepare("
            INSERT INTO candidate_form_details (first_name, father_name, dob, address, phone, adharnumber, pannumber)
            VALUES (:first_name, :father_name, :dob, :address, :phone, :adharnumber, :pannumber)
        ");
        if ($stmt_cfd->execute([
            ':first_name'  => $cname,
            ':father_name' => $father_name,
            ':dob'         => $dob,
            ':address'     => $address,
            ':phone'       => $phone,
            ':adharnumber' => $adharnumber,
            ':pannumber'   => $pannumber
        ])) {
            $new_candid_id = $con->lastInsertId();
            $con->query("UPDATE staff_master SET candid_id = '$new_candid_id' WHERE id = '$candidid'");
        }
    }

    // 3. Update z_user_master
    $update1 = $con->query("
        UPDATE z_user_master 
        SET 
            ass_emp_id = '$emp_code',
            department = '$deprt'
        WHERE candidate_id = '$candidid'
    ");

    if ($update1) {
        echo 0;
    } else {
        $errorInfo = $con->errorInfo();
        echo "Error updating z_user_master: " . $errorInfo[2];
    }

} else {
    $errorInfo = $con->errorInfo();
    echo "Error updating staff_master: " . $errorInfo[2];
}
?>