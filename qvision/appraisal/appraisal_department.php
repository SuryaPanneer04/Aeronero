<?php
 require '../../connect.php';
 $id = $_REQUEST['id'];
?>
<td>Employee Name</td>
<td colspan="2">
<select class="form-control" name="emp_name" id="emp_name" onchange="self_appraisal();qstn_entered();"> 
		<option value="0">-- Select Employee --</option>
		<?php
		$emp_sql=$con->query("SELECT id,candid_id, emp_name, status FROM staff_master WHERE status = 1 AND dep_id='$id'");
		while($emp_sql_res=$emp_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
		<option value="<?php echo $emp_sql_res['id']; ?>" data-id="<?php echo $emp_sql_res['candid_id']; ?>"><?php echo $emp_sql_res['emp_name']; ?></option>
			<?php
		}
		?>
</select></td>

