<?php
require '../../../connect.php';
include("../../../user.php");
$client_id = $_GET['idd'];
echo "SELECT * FROM new_plant_master where client_id = '$client_id'";
$sql=$con->query("SELECT * FROM new_plant_master where client_id = '$client_id'");

?>
<option value="">Select Plant</option>

<?php
   while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
?>

<option value="<?php echo $row["id"];?>"><?php echo $row["location"];?></option>
<?php
}
?>