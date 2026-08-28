<?php
 require '../../../connect.php';
 $designid = $_REQUEST['id'];
?>

<td>Employee Name</td>
<td colspan="2">
<select class="form-control" name="employeeName" id="employeeName">
		<option value="0">-- Select Employee --</option>
		<?php
		$employee_sql=$con->query("SELECT id, emp_name FROM staff_master WHERE design_id='$designid' && status =1");
		while($emp_sql_list=$employee_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $emp_sql_list['id']; ?>"><?php echo $emp_sql_list['emp_name']; ?></option>
			<?php
		}
		?>
</select></td>