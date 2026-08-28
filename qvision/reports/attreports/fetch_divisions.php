<?php
require '../../../connect.php';

if (isset($_GET['dept_id'])) {
	$deptId = $_GET['dept_id'];
	$stmt = $con->prepare("SELECT id, designation_name FROM designation_master WHERE status='1' AND dep_id = :deptId");
	$stmt->bindParam(':deptId', $deptId, PDO::PARAM_INT);
	$stmt->execute();
	
	echo '<option value="0">-- Select Designation --</option>';
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		echo '<option value="' . $row['id'] . '">' . $row['designation_name'] . '</option>';
	}
}
?>
