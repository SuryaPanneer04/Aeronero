<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = $_SESSION['userrole'];
?>

<head>
	<link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<!--div class="container-fluid"-->
<div class="card card-primary mb-3">

	<div class="card-header">
		<h3 class="card-title">
			<font size="5">New Staff Asset </font>
		</h3>
		<a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-minus"></i>BACK</a>
	</div>

	<form method="POST" name="fupname" enctype="multipart/form-data">
		<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
		<table class="table table-bordered" id="new_tab">

			<tr>
				<td>Employee Name:</td>
				<td colspan="3"><select class="form-control" name="emp_name">
						<option value="0">-- Select Employee Name --</option>
						<?php
						
                         $dep_sql = $con->query("SELECT * FROM staff_master WHERE emp_name IS NOT NULL AND TRIM(emp_name) != ''");
						while ($dep_sql_res = $dep_sql->fetch(PDO::FETCH_ASSOC)) {
						?>
							<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['emp_name']; ?></option>
						<?php
						}
						?>
					</select></td>
			</tr>
			<tr>
          <th>S.No</th>
          <th>Asset Name</th>
		  <th>Serial Number / Model Number</th>
          <th>Action</th>
        </tr>


		<tr>
          <td><input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;" /></td>

          <td><input type="text" class="form-control" id="asset_name" name="asset_name[]"></td>
		  <td><input type="text" class="form-control" id="serial_number" name="serial_number[]"></td>


          <td>
            <input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
            <input type="button" class="btn btn-danger" id="row_remove" value="Remove">
          </td>
        </tr>

		</table>
		<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
	</form>

	<script>
		function back() {
			staff_assets()
		}

		$(document).ready(function() {

			$("form[name='fupname']").on("submit", function(ev) {
				ev.preventDefault();
				var formData = new FormData(this);
				$.ajax({
					url: 'qvision/Recruitment/staff_asset/staff_asset_submit.php',
					method: "POST",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,
					success: function(data) {
						alert("Entry Successfull");
						staff_assets()
					}
				});
			});
		});


		function check() // Row Append
  {
    var len = $('#new_tab tr').length;
    len = len + 1;
    $('#new_tab').append('<tr class="row_' + len + '"> <td><input type="checkbox" class="chk" name="chk[]" id="chk_' + len + '" value="' + len + '"</td> <td><input type="text" class="form-control" id="section_name_' + len + '" name="asset_name[]"></td><td><input type="text" class="form-control" id="section_name_' + len + '" name="serial_number[]"></td></tr>');
  }

  $('#row_remove').click(function() {
    $('input:checkbox:checked.chk').map(function() {
      var id = $(this).val();
      var le = $('#new_tab tr').length;

      if (le == 1) {
        alert("You Can't Delete All the Rows");
      } else {
        $('.row_' + id).remove();
      }

    });
  });
	</script>