<?php
require '../../config.php';
include("../../user.php");
echo $department_id = $_POST["department_id"];

$sql=$con->query("SELECT * FROM candidate_form_details where department = $department_id");

?>
<option value="">Select Employee</option>

<?php
   while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
?>

<option value="<?php echo $row["candid_id"];?>"><?php echo $row["first_name"];?></option>
<?php
}
?>