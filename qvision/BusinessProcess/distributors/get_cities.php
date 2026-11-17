<?php
require_once __DIR__ . '/../../../connect.php';

$state_id = isset($_POST['state_id']) ? intval($_POST['state_id']) : 0;
$selected_id = isset($_POST['selected_id']) ? intval($_POST['selected_id']) : 0;

echo '<option value="">-- Select City --</option>';
if ($state_id > 0) {
    $stmt = $con->prepare("SELECT id, city_name FROM cities WHERE state_id = ? ORDER BY city_name ASC");
    $stmt->execute([$state_id]);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $selected = ($selected_id == $row['id']) ? 'selected' : '';
        echo '<option value="' . $row['id'] . '" data-name="' . htmlspecialchars($row['city_name']) . '" ' . $selected . '>' . htmlspecialchars($row['city_name']) . '</option>';
    }
}
?>
