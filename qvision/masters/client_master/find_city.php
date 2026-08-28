<?php
require '../../../connect.php';
include("../../../user.php");
$state = $_REQUEST["state_id"];


$sql=$con->query("SELECT * FROM  cities where state_id ='$state'");

?>
<option value="">Select City</option>

<?php
   while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
?>

<option value="<?php echo $row["id"];?>"><?php echo $row["city_name"];?></option>
<?php
}

?>