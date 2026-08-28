<?php
require '../../../connect.php';
require '../../../user.php';
$department = $_REQUEST["department"];
$sql=$con->query("SELECT * FROM staff_master where dep_id = $department");
?>
<option value="">-- Select Employee -- </option>
<?php
   while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
?>
<option value="<?php echo $row["candid_id"];?>"><?php echo $row["emp_name"];?></option>
<?php
}
?>