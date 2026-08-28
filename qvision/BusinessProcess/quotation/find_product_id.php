<?php
require '../../../connect.php';
include("../../../user.php");
$Product = $_REQUEST["product"];

$sql=$con->query("SELECT * FROM `product_master` where name='$Product'");

?>

<option value="">Select Product ID</option>

<?php
   while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
?>

<option value="<?php echo $row["product_id"];?>"><?php echo $row["product_id"];?></option>
<?php
} 
?>