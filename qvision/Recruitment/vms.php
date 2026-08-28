<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include DataTables CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
</head>
<body>
<div class="card card-primary">
    <div class="card-header" style="background-color:#ff8b3d !important;color:white !important;">
        <h3 style="float: left;color:white !important;">VISITOR MANAGEMENT SYSTEM LIST</h3>
        <a onclick="addvms();" style="float: right;color:white !important;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i>  New Visitors</a>
    </div>
    <div class="card-body">
        <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
            <thead>
                <th>S.NO</th>
                <th>GENERATED ID</th>
                <th>DATE</th>
                <th>FIRST NAME</th>
                <th>EMAIL</th>
                <th>MOBILE NUMBER</th>
                <th>PURPOSE</th>
                <th>DEPARTMENT</th>
                <th>EMPLOYEE</th>
                <th>STATUS</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
				//session_start();
				include('../../connect.php');
                include('../../user.php');
                $candidateid = $_SESSION['candidateid'];
                $userrole = $_SESSION['userrole'];
                if ($userrole == 'R003') {
                    $VMS_sql = $con->query("SELECT vms.id as vms_id,vms.status as vms_status,vms.first_name as vms_name,vms.*,z_department_master.*,candidate_form_details. * FROM `vms` INNER JOIN z_department_master ON vms.Department=z_department_master.id INNER JOIN candidate_form_details ON vms.employee = candidate_form_details.id ORDER BY vms.id DESC ");
					//echo "SELECT vms.id as vms_id,vms.status as vms_status,vms.first_name as vms_name,vms.*,z_department_master.*,candidate_form_details. * FROM `vms` INNER JOIN z_department_master ON vms.Department=z_department_master.id INNER JOIN candidate_form_details ON vms.employee = candidate_form_details.id where vms.employee='$candidateid'";
                } else {
                    $VMS_sql = $con->query("SELECT vms.id as vms_id,vms.status as vms_status,vms.first_name as vms_name,vms.*,z_department_master.*,candidate_form_details. * FROM `vms` INNER JOIN z_department_master ON vms.Department=z_department_master.id INNER JOIN candidate_form_details ON vms.employee = candidate_form_details.id ORDER BY vms.id DESC");
                }
                $i = 1;
                while ($VMS_res = $VMS_sql->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td>BB00<?php echo $VMS_res['vms_id']; ?></td>
                        <td><?php echo $VMS_res['Date']; ?></td>
                        <td><?php echo $VMS_res['vms_name']; ?></td>
                        <td><?php echo $VMS_res['email']; ?></td>
                        <td><?php echo $VMS_res['mob_num']; ?></td>
                        <td><?php echo $VMS_res['Purpose']; ?></td>
                        <td><?php echo $VMS_res['dept_name']; ?></td>
                        <td><?php echo $VMS_res['first_name']; ?></td>
                        <td>
                            <?php
                            if (($VMS_res['vms_status'] == 1)) {
                                echo '<span style="color:RED;text-align:center;"><b>PENDING</b></span>';
                            }
                            if (($VMS_res['vms_status'] == 2)) {
                                echo '<span style="color:green;text-align:center;"><b>APPROVED</b></span>';
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            //if ($VMS_res['employee'] == $candidateid) {
								if($VMS_res['employee']!=''){
                            ?>
                                <button class="btn btn-primary" data-id="<?php echo $VMS_res['vms_id']; ?>" onclick="vms_edit(<?php echo $VMS_res['vms_id']; ?>)"><i class="fa fa-eye"></i> </button>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function addvms() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/vms_add.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        });
    }

    
        function vms_edit(v) {
            $.ajax({
                type: "POST",
                url: "qvision/Recruitment/vms_view.php?id=" + v,
                success: function(data) {
                    $("#main_content").html(data);
                }
            });
        }

        // Initialize DataTable
        $('#example1').DataTable({
            responsive: true
        });
   
</script>
</body>
</html>
