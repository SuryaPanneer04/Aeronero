<?php
require '../../../connect.php';
$site=$_REQUEST['site'];

if($site==0)
{
	?>
	<td>Location:</td>
	  <td colspan="5"><!--input type="text" class="form-control" id="designation" name="designation" value="<?php echo $des['designation_name'];?>" readonly-->
		<select class="form-control" name="location" id="location" >
		
	<option value="0">---------</option>
	</select>
	<?php
}
else
{
	?>
	
<td>Location:</td>
	  <td colspan="5"><!--input type="text" class="form-control" id="designation" name="designation" value="<?php echo $des['designation_name'];?>" readonly-->
		<select class="form-control" name="location" id="location" >
		<?php
	
	$lsel=$con->query("select * from location_master where site_id='$site'");
	$lfet=$lsel->fetch(PDO::FETCH_ASSOC);
	$location_name=$lfet['location'];
	$location=$lfet['id'];
	?>
	
	<option value="<?php  echo $location;?>"><?php echo $location_name; ?></option>
	<?php
	$loca_que=$con->query("select * from location_master where site_id ='$site' and id !='$location' ");
	while($loca_fet=$loca_que->fetch(PDO::FETCH_ASSOC))
	{
	?>
	<option value="<?php echo $loca_fet['id']; ?>"><?php echo $loca_fet['location']; ?></option>
	<?php
	}
	?>
	</select></td>
	<?php
}
?>

