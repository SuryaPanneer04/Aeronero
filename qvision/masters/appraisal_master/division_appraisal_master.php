<?php
 require '../../../connect.php';
 $id = $_REQUEST['id'];
?>

<td>Division Name</td>
<td colspan="2">
<select class="form-control" name="division">
		<option value="0">-- Select Division --</option>
		<?php
		$div_sql=$con->query("SELECT id, div_name, status FROM division_master");
		while($div_sql_res=$div_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $div_sql_res['id']; ?>"><?php echo $div_sql_res['div_name']; ?></option>
			<?php
		}
		?>
</select></td>