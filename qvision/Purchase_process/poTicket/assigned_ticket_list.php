<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid = $_SESSION['candidateid'];
?>

<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<style>
    .card-primary:not(.card-outline)>.card-header {
        background-color: #f1cc61 !important;
    }
</style>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title" style="float: left;">
            <font size="5">CUSTOMIZATION ASSIGNED</font>
        </h3>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover display nowrap" id="example1" style="width:100%">
            <?php
            $roll_query = $con->prepare("Select a.*,e.full_name from po_ticket a LEFT JOIN z_user_master e ON (a.employee=e.candidate_id) WHERE a.employee='$candidateid' order by a.id desc");
            $roll_query->execute();
            $i = 1;
            while ($row = $roll_query->fetch()) {
            ?>
                <thead>
                    <th> S.No</th>
                    <th> SO Number </th>
                    <th>Cost Sheet No</th>
                    <th>Assigned To </th>
                    <th>Work Status</th>
                    <th>Action</th>
                </thead>
                <tbody>

                    <tr>
                        <td> <?php echo $i++; ?> </td>
                        <td><?php echo $row['so_number']; ?></td>
                        <td><?php echo $row['cost_sheet_no']; ?></td>
                        <td><?php echo $row['full_name']; ?></td>
                        <th style="color: #003fe0;">
                            <?php
                            if ($row['status'] == 0) {
                                echo '<span style="color: red;text-align:center;"><b> Pending to customization</b></span>'; //Data Inserted.
                            } else if ($row['status'] == 1) {
                                echo '<span style="color: blue;text-align:center;"><b> In Process </b></span>'; //Work Assign to Employee.
                            } else if ($row['status'] == 2) {
                                echo '<span style="color: green;text-align:center;"><b> Customization Completed </b></span>'; //Work completed.
                            } else if ($row['status'] == 3) {
                                echo '<span style="color: green;text-align:center;"><b> BOM Verification </b></span>'; //Work completed.
                            } else if ($row['status'] == 4) {
                                echo '<span style="color: green;text-align:center;"><b> Component Approve </b></span>'; //Work completed.
                            } else if ($row['status'] == 5) {
                                echo '<span style="color: green;text-align:center;"><b> Component Reject </b></span>'; //Work completed.
                            }
                            ?>
                        </th>

                        <td>
                            <button class="btn btn-info" onclick="Task_status(<?php echo $row['id']; ?>)"><i class="fa fa-eye"></i>Complete</button>
                            <button class="btn btn-danger" onclick="bom_verification(<?php echo $row['id']; ?>)"><i class="fa fa-eye"></i>BOM</button>
                        </td>
                    </tr>
                <?php
            }
                ?>
                </tbody>
        </table>
    </div>
</div>
<script>
    function Task_status(v) {
        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/poTicket/task_status.php?id=" + v,
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function bom_verification(v) {
        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/poTicket/bom_verification.php?id=" + v,
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    $(document).ready(function() {
        $('#example1').DataTable({
            "scrollY": 400,
            "scrollX": true
        });
    });
</script>
<script>
    $(function() {
        $("#dataTable").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#dataTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>