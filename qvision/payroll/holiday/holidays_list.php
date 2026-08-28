<?php
require '../../../connect.php';
//include '../../user.php';
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
	
        <h3 class="card-title"><font size="5">HOLIDAYS</font></h3>
		

    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
            <thead>
            <th>S.No</th>
            <th>Holiday</th>
            <th>Date</th>
            <th>Year </th>
            
            </thead>
            <tbody>
                <?php
                $holiday = $con->query("SELECT * FROM `holiday_master` where status='1' and md_approve_sts='1'");
                $cnt = 1;
                while ($holiday_master = $holiday->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $cnt; ?>.</td>
                        <td><?php echo $holiday_master['leave_name']; ?></td>
                        <td><?php echo $holiday_master['leave_date']; ?></td>
                        <td><?php echo $holiday_master['year']; ?></td>

                        
						
                        
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
    
</script>

</body>
</html>