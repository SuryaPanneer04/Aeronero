 <?php
require '../../config.php';
?>
 <td>Referal Name</td>
        <td colspan="5">
		<input list="get_ref_name" name="browser" id="browser" class="form-control">
		<datalist  id="get_ref_name" name="get_ref_name" >
		<option value="">Choose Referal</option>
		<?php $stmt1 = $con->query("SELECT * FROM staff_master ");
		while ($row1 = $stmt1->fetch()) 
		{
		?>
		<option value="<?php echo $row1['id']; ?>"> <?php echo $row1['emp_name']; ?> </option>
		<?php 
		} 
	   ?>
		</datalist>
		</td>