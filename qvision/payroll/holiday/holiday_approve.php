<?php
//require '../../../connect.php';
//include '../../user.php';
require '../../../connect.php';
require __DIR__ . "/../../../user.php";
 $userrole=$_SESSION['userrole'];
 $candid_id=$_SESSION['candidateid'];
?>
<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<body>
<div  class="card card-primary">
    <div class="card-header" style="background-color:#ff8b3d !important;">
	
        <h3 class="card-title"><font size="5">Holiday Master</font></h3>
		<?php
		if($userrole=='R003')
		{
		?>
        <a onclick="return add_employee()"  style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i>  Add Holidays</a>
		<?php
		}
		?>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
            <thead>
            <th>S.No</th>
            <th>Holiday Name</th>
            <th>Date</th>
            <th>Year </th>
            <th>Status</th>
			<th>Md_approve</th>
            <th>Action</th>
            </thead>
            <tbody>
                <?php
                $holiday = $con->query("SELECT * FROM `holiday_master`");
                $cnt = 1;
                while ($holiday_master = $holiday->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $cnt; ?>.</td>
                        <td><?php echo $holiday_master['leave_name']; ?></td>
                        <td><?php echo $holiday_master['leave_date']; ?></td>
                        <td><?php echo $holiday_master['year']; ?></td>

                        <td>
    <?php
    if ($holiday_master['status'] == 1) {
        echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
        ?>
                                <?php
                            } else {
                                echo '<span style="color:red;text-align:center;"><b>INActive</b></span>';
                            }
                            ?>


                        </td>
						<td>
    <?php
    if ($holiday_master['md_approve_sts'] == 1) {
        echo '<span style="color:green;text-align:center;"><b>Approved</b></span>';
        ?>
                                <?php
                            } else if($holiday_master['md_approve_sts'] == 2) {
                                echo '<span style="color:red;text-align:center;"><b>Rejected</b></span>';
                            }
							else
							{
								echo '<span style="color:orange;text-align:center;"><b>Waiting For MD Approval</b></span>';
							}
                            ?>


                        </td>
						
                        <td>
						<?php if ($holiday_master['md_approve_sts'] == 0){?>
                <input type="button" class="btn btn-primary btn-md"  style="float:left;background:green !important;border:1px solid green !important" name="Update" onclick="holiday_update(<?php echo $holiday_master['id'];?>)" value="Approve"> 
                <input type="button" class="btn btn-primary btn-md"  style="float:right;border:none;background:red;" name="Update" onclick="holiday_rejected(<?php echo $holiday_master['id'];?>)" value="Reject">                       

<?php
						}
						?>
					   </td>
                    </tr>
    <?php
    $cnt = $cnt + 1;
}
?>
            </tbody>
        </table>

    </div>
    <!-- /.card-body -->
</div>

<!-- /#page-wrapper -->
<script>
    $(document).ready(function ()
    {
        $('.dataTables-example').DataTable({
            responsive: true
        });
    });
</script>
<script>
    
    function holiday_update(id)
    {
       // var id = $('#get_id').val();
        //var data = $('form').serialize();
        $.ajax({
            type: 'GET',
            data: "id=" + id,
            url: 'qvision/payroll/holiday/approveleve_update.php',
            success: function (data)
            {
				console.warn("jhgf:"+data);
            alert("Approved Successfully")
             holidays_approve()
            }
        });
    }
	 function holiday_rejected(id)
    {
        //var id = $('#get_id').val();
        //var data = $('form').serialize();
        $.ajax({
            type: 'GET',
            data: "id=" + id,
            url: 'qvision/payroll/holiday/rejectedleve_update.php',
            success: function (data)
            {
             alert("Rejected Successfully")
             holidays_approve()
            }
        });
    }
</script>

</body>
</html>
