<?php
require '../../../../../../connect.php';
include("../../../../../../user.php");
 $department_id = $_REQUEST["Department"];
  $Designation = $_REQUEST["Designation"];


$sql = $con->query("SELECT * FROM staff_master where dep_id = '$department_id' and design_id = '$Designation'");
echo "SELECT * FROM staff_master where dep_id = '$department_id' and design_id = '$Designation'";
?>
<option value="">Select Employee</option>

<?php
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
    ?>

    <option value="<?php echo $row["candid_id"]; ?>"><?php echo $row["emp_name"]; ?></option>
    <?php
}
?>