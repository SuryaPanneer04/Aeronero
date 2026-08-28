<?php
require '../../../connect.php';
$id = $_REQUEST['id'];

$stmt = $con->prepare("SELECT * FROM hod WHERE id='$id'");
$stmt->execute(); 
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Error Fix 1 & 3: Safe ah values edukurom (Warnings Varathu)
$sid = isset($row['emp_name']) ? $row['emp_name'] : '';
$did = isset($row['dept_name']) ? $row['dept_name'] : '';
$aid = isset($row['asset']) ? $row['asset'] : '';
$mail_id = isset($row['mail_id']) ? $row['mail_id'] : '';
$others = isset($row['others']) ? $row['others'] : '';

$asset_array = explode(',', $aid);
$first_asset = $asset_array[0];
?>
<style>
.btn-danger{
	background-color: #ed5d00;
    border-color: #ed5d00;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black;
}
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
</style>
<div class="container-fluid">
<div class="card card-primary">
<div class="card-header">
 <h3 class="card-title" style="color:black !important;"><font size="5">EDIT HOD DETAILS</font></h3>
<a onclick="return back()" style="float: right; cursor: pointer;" class="btn btn-danger">BACK</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="qvision/Recruitment/hod/update_hod.php" method="post" enctype="multipart/form-data">

<table class="table table-bordered">
<tr> 
     <td>Department Name</td>
	 <td colspan="2">
	    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id;?>">
		<select class="form-control" name="dept_name" id="dept_name">
		<?php
        if($did != '') {
            $dep_sql1 = $con->query("SELECT * FROM z_department_master WHERE id='$did'");
            if($fet = $dep_sql1->fetch()){
                echo "<option value='".$fet['id']."'>".$fet['dept_name']."</option>";
            }
        } else {
            echo "<option value=''>-- Select Department --</option>";
        }

		$dep_sql_all = $con->query("SELECT * FROM z_department_master WHERE id!='1'");
		while($dep_res = $dep_sql_all->fetch(PDO::FETCH_ASSOC)) {
			echo "<option value='".$dep_res['id']."'>".$dep_res['dept_name']."</option>";
		}
		?>
		</select>
	 </td>
<td>Employee Name</td>
<td colspan="2">
        <select class="form-control" name="emp_name" id="emp_name">
        <?php
        if($sid != '') {
            $emp_sql1 = $con->query("SELECT * FROM staff_master WHERE id='$sid' ");
            if($efet = $emp_sql1->fetch()){
                echo "<option value='".$efet['id']."'>".$efet['emp_name']."</option>";
            }
        } else {
            echo "<option value=''>-- Select Employee --</option>";
        }

		$emp_sql_all = $con->query("SELECT * FROM staff_master");
		while($eres = $emp_sql_all->fetch(PDO::FETCH_ASSOC)) {
			echo "<option value='".$eres['id']."'>".$eres['emp_name']."</option>";
		}
		?>
		</select>
</td>
</tr>
<tr id="new_tab">
<td>Asset</td>
<td colspan="2">
        <select class="form-control" id="asset" name="asset">
        <?php 
        if($first_asset != '') {
            $ast_sql1 = $con->query("SELECT * FROM staff_asset_master WHERE id='$first_asset'");
            if($afet = $ast_sql1->fetch()){
                echo "<option value='".$afet['id']."'>".$afet['asset']."</option>";
            }
        } else {
            echo "<option value=''>-- Select Asset --</option>";
        }

		$ast_sql_all = $con->query("SELECT * FROM staff_asset_master");
		while($ares = $ast_sql_all->fetch(PDO::FETCH_ASSOC)) {
			echo "<option value='".$ares['id']."'>".$ares['asset']."</option>";
		}
		?>
		</select>
</td>
<td>
    <input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
</td>
</tr>
<tr>
<td>Mail Id</td>
<td colspan="2">
<input type="text" class="form-control" id="mail_id" name="mail_id" value="<?php echo htmlspecialchars($mail_id);?>"></td>
</tr>
<tr>
<td>Others</td>
<td colspan="2">
<input type="text" class="form-control" id="others" name="others" value="<?php echo htmlspecialchars($others);?>"></td>
</tr>
</table>
<div style="width:100%; text-align:right;">
    <input type="submit" name="submit" class="btn btn-primary btn-md">
</div>
</form>
</div>
</div>
</div>

<script>
    function back() {
        hod();
    }

    function check() {
        var len=$('#new_tab tr').length;	
        len=len+1; 
        $('#new_tab').append('<tr class="row_'+len+'"><td colspan="3"><select class="form-control" name="asset[]"><option value="">Select Asset</option><option value="3">Files</option><option value="2">Visiting Cards</option><option value="1">Office Stationary</option><option value="4">Keys</option><option value="5">System</option><option value="6">Laptop</option><option value="7">ID Card</option><option value="8">CUG</option><option value="9">Access Card</option><option value="10">ERP Access</option></select></td></tr>'); 
    }

    $(document).ready(function() {
        $('#dept_name').on('change', function() {
            var department_id = this.value;
            $.ajax({
                url: "qvision/CRM/find_emp.php",
                type: "POST",
                data: { department_id: department_id },
                cache: false,
                success: function(result){
                    $("#emp_name").html(result);
                }
            });
        });
    });
</script>