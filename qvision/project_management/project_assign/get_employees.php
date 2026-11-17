<?php
require '../../../connect.php';

$dep_id = $_POST['dep_id'];

$query = "SELECT candid_id, emp_code, emp_name FROM staff_master WHERE status=1";
if(!empty($dep_id)) {
    $query .= " AND dep_id = '$dep_id'";
}
$query .= " ORDER BY emp_name ASC";

$sql = $con->query($query);
if($sql->rowCount() > 0) {
    while($res = $sql->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='d-flex align-items-center mb-2'>";
        echo "<div class='form-check' style='flex: 1;'>";
        echo "<input class='form-check-input' type='checkbox' name='employee_id[]' value='".$res['candid_id']."' id='emp_".$res['candid_id']."'>";
        echo "<label class='form-check-label' for='emp_".$res['candid_id']."'>".$res['emp_code']." - ".$res['emp_name']."</label>";
        echo "</div>";
        echo "<input type='date' class='form-control form-control-sm' name='deadline_".$res['candid_id']."' style='width: 150px;'>";
        echo "</div>";
    }
} else {
    echo "<p class='text-muted'>No employees found in this department.</p>";
}
?>
