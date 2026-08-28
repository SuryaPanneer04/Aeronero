<?php
require '../../connect.php';
include("../../user.php");
$asset_name = $_REQUEST["id"];

$sqlzz=$con->query("SELECT * FROM `products_description` where product_id='$asset_name'");


?>
<option value="">Select Description</option>

<?php
   while($row11 = $sqlzz->fetch(PDO::FETCH_ASSOC))
{
?>

<option value="<?php echo $row11["id"];?>"><?php echo $row11["description"];?></option>
<?php
} 
?>
 