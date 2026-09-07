<?php
include '../../../connect.php';

$dept_id = $_POST['dept_id'];
$div_id = $_POST['div_id'];

if($dept_id) {
    $query = "SELECT s.emp_code, s.emp_name FROM staff_master s WHERE s.dep_id = :dept_id AND s.status = 1";
    
    if(!empty($div_id)) {
        $query .= " AND s.div_id = :div_id";
    }
    
    $stmt = $con->prepare($query);
    $stmt->bindParam(':dept_id', $dept_id);
    
    if(!empty($div_id)) {
        $stmt->bindParam(':div_id', $div_id);
    }
    
    $stmt->execute();
    
    echo '<option value="">Select Employee</option>';
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="'.$row['emp_code'].'">'.htmlspecialchars($row['emp_name']).' ('.htmlspecialchars($row['emp_code']).')</option>';
    }
} else {
    echo '<option value="">Select Employee</option>';
}
?>
