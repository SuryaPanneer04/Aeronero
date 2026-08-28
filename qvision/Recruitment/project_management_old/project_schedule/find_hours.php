<?php
require '../../../../config.php';
include("../../../../user.php");

$employees_id = $_REQUEST["employees_id"];

$sql=$con->query("SELECT * FROM project where employees = $employees_id");
?>
<option value="">Select No Of Working Hours</option>
<?php
while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
?>

<option value="<?php echo $row["id"];?>"><?php echo $row["no_of_working_hours"];?></option><?php
}
?>