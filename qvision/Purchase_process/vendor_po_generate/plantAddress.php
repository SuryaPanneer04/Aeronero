<?php
require '../../../connect.php';

$plantid = $_REQUEST['plantid'];
$plantDetails = $con ->query("SELECT * FROM `new_plant_master` WHERE client_id ='$plantid' ");
$plant = $plantDetails -> fetch();
   
?>
 <td> 
    <textarea class="form-control" name="address1" value="<?php echo $plant['address']; ?>" readonly>
    <?php echo $plant['address']; ?>
</textarea>
</td>
 <td colspan="5">
 <input type="text" class="form-control" name="area" value="<?php echo $plant['area']; ?>" readonly> 
 <input type="text" class="form-control" name="pincode" value="<?php echo $plant['pincode']; ?>" readonly> 
</td>
