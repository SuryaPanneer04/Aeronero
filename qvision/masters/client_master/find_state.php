<?php
require '../../../connect.php';
include("../../../user.php");
echo $country = $_REQUEST["country_id"];

$sql=$con->query("SELECT * FROM states where country_id = $country");
echo "SELECT * FROM states where country_id = $country"
?>
<option value="">Select State</option>

<?php
   while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
?>

<option value="<?php echo $row["id"];?>"><?php echo $row["statename"];?></option>
<?php
}
?>