<?php
require '../../config.php';
include("../../user.php");
 $department_id = $_REQUEST["department_id"];
$candidate_id = $_SESSION['candidateid'];
$sql = $con->query("SELECT * FROM staff_master where dep_id = '$department_id' and candid_id != '$candidate_id'");

?>
<option value="">Select Employee</option>

<?php
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
    ?>

    <option value="<?php echo $row["candid_id"]; ?>"><?php echo $row["emp_name"]; ?></option>
    <?php
}
?>