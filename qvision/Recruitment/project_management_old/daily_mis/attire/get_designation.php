<?php
require '../../../../../connect.php';
include("../../../../../user.php");
 $department_id = $_REQUEST["department_id"];

$sql = $con->query("SELECT * FROM designation_master where dep_id = $department_id and dep_id!='1'");

?>
<option value="">Select Designation</option>

<?php
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
	if($row["id"]==33 ||$row["id"]==32 || $row["id"]==5 || $row["id"]==8 || $row["id"]==3){
    ?>

    <option value="<?php echo $row["id"]; ?>"><?php echo $row["designation_name"]; ?></option>
    <?php
	}
}
?>