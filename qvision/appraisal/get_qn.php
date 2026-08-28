<?php
require '../../connect.php';
require '../../user.php';

$roundid=$_REQUEST['id'];
?>
     <td>  </td>
     <td colspan="4"> 
	  <select class="form-control" id="allocate_person" name="allocate_person">
		<option value=""> Select round </option>
		<?php 
		$stmt2 = $con->query("SELECT * FROM appraisal_rounds_mapping a 
		                      LEFT JOIN staff_master b 
							  ON a.person_name = b.id 
		                      WHERE a.status='1' AND a.round_id='$roundid' ");
		while ($row2 = $stmt2->fetch()) 
		{
		?>
		<option value="<?php echo $row2['id'];?>"> <?php echo $row2['emp_name'];?> </option>
		<?php 
		}
		?>
		</select>
	 </td>
