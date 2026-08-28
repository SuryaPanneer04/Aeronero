<?php 
require '../../../connect.php';

$rowCount=$_REQUEST['rowCount'];
for($i=1;$i<$rowCount;$i++)
{
	?>
	<tr>
	<td><b>Vendor Name *</b></td>
	<td><select class="form-control" id="vendor_name" name="vendor_name[]" style="width:50%;" required></b>
    <option disabled selected>-- Select vendor --</option>
	
	<?php 
	$vsel=$con->query("SELECT id,vendor_name FROM doller_vendor_mastor");
	while($vfet=$vsel->fetch())
	{
		?>
		<option value="<?php echo $vfet['id'];?>"><?php echo $vfet['vendor_name'];?></option>
		<?php 
	}
	?>
	
	</td>
	<td>
		     <b><input type="file" name="file[]" id="file" /></b>
	 </td>
	  <td>
		 <b><input type="text" name="amount[]" id="amount" class="form-control" placeholder="Cost price amount" style="width:40%;"/>
	  </td>
	</tr>
	<?php
}
?>

                  