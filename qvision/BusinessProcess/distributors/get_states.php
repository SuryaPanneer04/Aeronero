<?php
require_once __DIR__ . '/../../../connect.php';

$country_id = isset($_POST['country_id']) ? intval($_POST['country_id']) : 0;
$selected_id = isset($_POST['selected_id']) ? intval($_POST['selected_id']) : 0;

echo '<option value="">-- Select State --</option>';
if ($country_id > 0) {
    $stmt = $con->prepare("SELECT id, statename FROM states WHERE country_id = ? ORDER BY statename ASC");
    $stmt->execute([$country_id]);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $selected = ($selected_id == $row['id']) ? 'selected' : '';
        echo '<option value="' . $row['id'] . '" data-name="' . htmlspecialchars($row['statename']) . '" ' . $selected . '>' . htmlspecialchars($row['statename']) . '</option>';
    }
}
?>
