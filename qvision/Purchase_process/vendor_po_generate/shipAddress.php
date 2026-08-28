<?php
require '../../../connect.php';

$shipTo = $_REQUEST['shipTo'];
$clientId = $_REQUEST['clientId'];

if($shipTo == 1){
?>

<td> Address </td>
        <td colspan="5">
        <textarea class="form-control" name="address1" readonly>
        SS Information Systems Pvt Ltd
        No:1/102,Periyar Pathai West
        100 Feet Road ,Arumbakkam,
        Chennai -600106
        rajkumar@ssinformation.in
        Landline No:044-23623544
        e-mail : karthick@ssinformation.in
        GSTIN/UIN : 33AARCS9223K1ZU
        State Name : Tamil Nadu, Code : 33
        </textarea>
		</td>


<?php
}else{

    $plantDetails = $con ->query("SELECT id,location FROM `new_plant_master` WHERE client_id ='$clientId' ");
   
?>
 <td> Plant Address </td>
 <td colspan="5">
    <select class="form-control" name="plant_id" onchange="plantAddress(this.value)">
		<option>  -- Select -- </option>
<?php 
 while($plant = $plantDetails -> fetch()){ 
?>
		<option value="<?php echo $plant['id']; ?>"> <?php echo $plant['location']; ?> </option>
<?php } ?>

	</select>
 </td>
<?php 
}
?>
