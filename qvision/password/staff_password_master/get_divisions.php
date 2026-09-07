<?php
include '../../../connect.php';

$dept_id = $_POST['dept_id'];

if($dept_id) {
    $stmt = $con->prepare("SELECT id, div_name FROM division_master WHERE dep_id = :dept_id AND status = 1");
    $stmt->bindParam(':dept_id', $dept_id);
    $stmt->execute();
    
    echo '<option value="">Select Division</option>';
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="'.$row['id'].'">'.htmlspecialchars($row['div_name']).'</option>';
    }
} else {
    echo '<option value="">Select Division</option>';
}
?>
