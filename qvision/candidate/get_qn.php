<?php
require '../../connect.php';
require '../../user.php';

$roundid=$_REQUEST['id'];
$sql=$con->query("select * from interview_rounds where id='$roundid'");
$fet=$sql->fetch();
$roundname=$fet['name'];

							  
if($roundname=="Assessment")
{
?>

    <td> </td>
    <td colspan="2">
		<select class="form-control" id="qn_type" name="qn_type">
		<option value=""> Select round </option>
		<?php 
		$stm_2 = $con->query("SELECT * FROM question_name_master where status=1");
		while ($row_2 = $stm_2->fetch()) 
		{
		?>
		<option value="<?php echo $row_2['id'];?>" > <?php echo $row_2['name'];?> </option>
		<?php 
		}
		?>
		</select>
	</td>
   
<?php	
}

else
{
	
?>

    <td>  </td>
     <td colspan="4"> 
	  <select class="form-control" id="allocate_person" name="allocate_person">
		<option value=""> --Select Employee Name-- </option>
		<?php 
		$stmt2 = $con->query("SELECT a.person_name, b.emp_name FROM interview_rounds_mapping a 
		                      INNER JOIN staff_master b 
							  ON a.person_name = b.id 
		                      WHERE a.status='1' AND a.round_id='$roundid'");
							  
		// $stmt2 ="SELECT * FROM interview_rounds_mapping a 
		//                       LEFT JOIN staff_master b 
		// 					  ON a.person_name = b.id 
		//                       WHERE a.status='1' AND a.round_id='$roundid'";
		// 					  echo $stmt2;exit();
		// 					  $sdd=$con->query($stmt2);
		while ($row2 = $stmt2->fetch()) 
		{
		?>
		<option value="<?php echo $row2['person_name'];?>"> <?php echo $row2['emp_name'];?> </option>
		<?php 
		}
		?>
		</select>
	 </td>
<?php
}
?>