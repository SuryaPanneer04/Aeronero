<?php
require '../../../../../../connect.php';
include("../../../../../../user.php");
 $department_id = $_REQUEST["department_id"];

$sql = $con->query("SELECT * FROM designation_master where dep_id = $department_id");
echo "SELECT * FROM designation_master where dep_id = $department_id";

?>
<option value="">Select Designation</option>

<?php
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
    ?>

    <option value="<?php echo $row["id"]; ?>"><?php echo $row["designation_name"]; ?></option>
    <?php
}
?>