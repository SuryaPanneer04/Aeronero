<?php
 require '../../connect.php';
 $id = $_REQUEST['id'];
 
 $des_sql=$con->query("SELECT a.candid_id as candidate_id,b.designation_name as des,a.design_id as des_id FROM staff_master a LEFT JOIN designation_master b ON a.design_id=b.id WHERE a.id='$id' AND a.status = 1");
 //echo "SELECT b.designation_name as des FROM staff_master a LEFT JOIN designation_master b ON a.design_id=b.id WHERE a.id='$id' AND a.status = 1";
 
 $des_sql_res=$des_sql->fetch();
 $did=$des_sql_res['des'];
 $des=$des_sql_res['des_id'];
 $can_id=$des_sql_res['candidate_id'];
 //echo $did;
?>


<td>Designation Name</td>
<td colspan="2">
<input type="hidden" class="form-control" name="candid" id="candid" value="<?php echo $can_id; ?>">
<select class="form-control" name="designation" id="designation">
		<option value="<?php echo $des;?>"><?php echo $did; ?></option>
		<?php
		$des_sql=$con->query("SELECT id, designation_name FROM designation_master WHERE status=1");
		while($des_sql_res=$des_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $des_sql_res['id']; ?>"><?php echo $des_sql_res['designation_name']; ?></option>
			<?php
		}
		?>
</select>

</td>