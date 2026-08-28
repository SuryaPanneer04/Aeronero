<?php
require '../../../connect.php';

// 👇 PUDHU CODE: Puthu file create pannathuku bathila ithe file-la AJAX request-ah handle pandrom
if(isset($_POST['action']) && $_POST['action'] == 'get_division') {
    $dept_id = $_POST['department_id'];
    
    // Division data fetch pandrom
    $sql = $con->query("SELECT id, div_name FROM division_master WHERE dep_id = '$dept_id' AND status = 1");
    
    echo '<option value="0">-- Select Division --</option>';
    while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="'.$row['id'].'">'.$row['div_name'].'</option>';
    }
    exit; // Mukkiyam: HTML kela load aagama irukka intha 'exit' theva.
}
// 👆 PUDHU CODE MUDINJATHU

include("../../../user.php");
$userrole = $_SESSION['userrole'];
?>
<style>
	.card-primary:not(.card-outline)>.card-header {
		background-color: #f1cc61 !important;
	}
	.card-primary:not(.card-outline)>.card-header {
		color: black !important;
	}
	.btn-dark {
		background-color: #ed5d00 !important;
		border-color: #ed5d00 !important;
	}
	.card-primary:not(.card-outline)>.card-header a {
		color: black !important;
	}	
</style>
<div class="container-fluid">
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">
				<font size="5">ADD DESIGNATION DETAILS</font>
			</h3>
			<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
		</div>

		<form method="POST" action="">
			<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
			<table class="table table-bordered">
				<tr>
					<td>Department Id</td>
					<td colspan="2">
                        <!-- onchange add pannirukom -->
                        <select class="form-control" name="department" id="department" onchange="get_division(this.value)">
							<option value="0">-- Select Department --</option>
							<?php
							$dep_sql = $con->query("SELECT id, dept_name, status, created_by, created_on FROM z_department_master");
							while ($dep_sql_res = $dep_sql->fetch(PDO::FETCH_ASSOC)) {
							?>
								<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
							<?php
							}
							?>
						</select>
                    </td>
				</tr>
				<tr>
                    <td>Division Name</td>
                    <td colspan="2">
                        <select class="form-control" name="division" id="division">
                            <option value="0">-- Select Division --</option>
                        </select>
                    </td>
                </tr>
				<tr>
					<td>Designation Name</td>
					<td colspan="2"><input type="text" class="form-control" id="designation_name" name="designation_name"></td>
				</tr>
				<tr>
					<td>Status</td>
					<td colspan="2">
						<select class="form-control" name="status" id="status">
							<option value="1">Active</option>
							<option value="0">InActive</option>
						</select>
					</td>
				</tr>
			</table>

			<input type="button" name="submit" value="Submit" class="btn btn-dark btn-md" style="float:right;position:relative;left:-5px;" onclick="save_designation()">
			<br>
			<br>
		</form>
	</div>
</div>
<script>
	function back() {
		designation_master();
	}

    // 👇 AJAX call: Ithe file-ku thirumba request anupurom
    function get_division(dept_id) {
        if(dept_id == "0" || dept_id == "") {
            $("#division").html('<option value="0">-- Select Division --</option>');
            return;
        }
        
        $.ajax({
            type: "POST",
            url: "qvision/masters/designation_master/new_designation.php", // Puthu file ilama ithe file-ku call pandrom
            data: { 
                action: 'get_division', // PHP-la atha kandu pudika intha action parameter
                department_id: dept_id 
            },
            success: function(data) {
                $("#division").html(data);
            }
        });
    }

	function save_designation() {
		var id = 0;
		var data = $('form').serialize();
		$.ajax({
			type: "POST",
			data: data + "&" + "id=" + id,
			url: "qvision/masters/designation_master/designationmaster_submit.php",
			success: function(data) {
				alert("Submited Successfully");
				designation_master();
			}
		})
	}
</script>