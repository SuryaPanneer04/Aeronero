<?php
 require '../../../connect.php';
 $id = $_REQUEST['id'];
?>

<td>Designation Name</td>
<td colspan="2">
<select class="form-control" name="design" id="design"  onchange="open_employee()">
		<option value="0">-- Select Designation --</option>
		<?php
		$des_sql=$con->query("SELECT id, designation_name FROM designation_master WHERE dep_id = '$id' AND status=1");
		while($des_sql_res=$des_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $des_sql_res['id']; ?>"><?php echo $des_sql_res['designation_name']; ?></option>
			<?php
		}
		?>
</select></td>

<script>
	 function open_employee()
 {
	let design = $('#design').val();
  console.log(design)
	$.ajax({
            type: 'GET',
            url: 'qvision/masters/appraisal_master/employee_appraisal_master.php',
            data: "id=" + design,
            success: function (data)
            {
                $("#employee_view").html(data);
            }
        })
 }
</script>