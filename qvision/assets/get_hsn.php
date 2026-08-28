<?php
require '../config.php';
include("../user.php");
$asset_name = $_REQUEST["id"];

$sqlzz=$con->query("SELECT * FROM `products_hsn` where product_id='$asset_name'");

?>
<td>HSN Code :</td>
        <td colspan="5"><select class="form-control" id="hsn_code" name="hsn_code" onchange="get_hsn(this.value)">
<?php
   while($row11 = $sqlzz->fetch(PDO::FETCH_ASSOC))
{
?>
<option value="">Choose HSN Code</option>
<option value="<?php echo $row11["id"];?>"><?php echo $row11["hsn_code"];?></option>
<?php
} 
?>
</select>
		</td>
 