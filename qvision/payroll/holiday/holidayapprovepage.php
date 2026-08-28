<?php
require '../../../connect.php';
$id = $_REQUEST['id'];

$stmt = $con->prepare("SELECT * FROM `holiday_master` WHERE id='$id'");
$stmt->execute();
$row = $stmt->fetch();
?>
<div class="container-fluid">
    <div class="card mb-3">
        <div class="card-header" style="background-color:#ff8b3d !important;">
          <span style="color:white;font-size:20px;">Holiday  Approve</span>
            <a onclick="back_holiday()" style="float: right;background:gray;color:white;border:1px solid orange;border-radius:11px;" data-toggle="modal" class="btn btn-primary">Back</a>
        </div>
        <div class="card-body" id="printableArea">
            <form method="POST" action="" enctype="multipart/type">
                <table class="table table-bordered">
                   
                    <tr rowspan="6">
                        <td >Year</td>
					<td>
                    <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo $row[0]; ?>"></td>
                    <td colspan="5">
                     <input type="text" class="form-control" id="year" name="year" value="<?php echo $row[1]; ?>" disabled>
					 <input type="hidden" class="form-control" id="year" name="year" value="<?php echo $row[1]; ?>" >
                    </td>
                    </tr>

                    <tr rowspan="6">
                        <td >Date</td>
                        <td colspan="5"><input type="date" class="form-control" id="date" name="date" value="<?php echo $row[2]; ?>" disabled>
						<input type="hidden" class="form-control" id="date" name="date" value="<?php echo $row[2]; ?>" >
						</td>
                    </tr>
                    <tr rowspan="6">
                        <td>Holiday Name</td>
                        <td colspan="5"><input type="text" class="form-control" id="holiday_name" name="holiday_name" value="<?php echo $row[3]; ?>" disabled>
						<input type="hidden" class="form-control" id="holiday_name" name="holiday_name" value="<?php echo $row[3]; ?>" >
						</td>
                    </tr>

                    <tr>
                        <td>Status</td>
                        <td colspan="5">
                            <select id="status" name="status" class="form-control"  disabled>

                                <?php
                                if ($row[4] == 1) {
                                    ?>
                                    <option value="1">Active</option>
                                    <option value="2"> IN Active</option>
                                <?php } else { ?>
                                    <option value="2"> IN Active</option>
                                    <option value="1">Active</option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>

                </table>
				<?php 
				if ($row[5] == 0) {
				?>
                <input type="button" class="btn btn-primary btn-md"  style="float:right;" name="Update" onclick="holiday_update()" value="Approved"> 
                <input type="button" class="btn btn-primary btn-md"  style="border:none;background:red;" name="Update" onclick="holiday_rejected()" value="Rejected"> 
<?php
				}
?>
			</form>
        </div>
    </div>
</div>
<script>
    function back_holiday()
    {  holidays_approve()
                
    }
    function holiday_update()
    {
        var id = $('#get_id').val();
        var data = $('form').serialize();
        $.ajax({
            type: 'GET',
            data: data + "&" + "id=" + id,
            url: 'qvision/payroll/holiday/approveleve_update.php',
            success: function (data)
            {
				console.warn("jhgf:"+data);
            // alert("Update Successfully")
             //holidays_approve()
            }
        });
    }
	 function holiday_rejected()
    {
        var id = $('#get_id').val();
        var data = $('form').serialize();
        $.ajax({
            type: 'GET',
            data: data + "&" + "id=" + id,
            url: 'qvision/payroll/holiday/rejectedleve_update.php',
            success: function (data)
            {
             alert("Update Successfully")
             holidays_approve()
            }
        });
    }
</script>