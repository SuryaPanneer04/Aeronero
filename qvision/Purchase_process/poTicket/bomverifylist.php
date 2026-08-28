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
            <font size="5">BOM Verification</font>
        </h3>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover display nowrap" id="example1" style="width:100%">
            <?php
            $roll_query = $con->prepare("Select a.*,e.bom,e.id as bom_id,e.status as bomsts from po_ticket a LEFT JOIN bom_component e ON (a.id = e.po_ticket_id) order by a.id desc");
            $roll_query->execute();
            $i = 1;
            while ($row = $roll_query->fetch()) {
            ?>
                <thead>
                    <th> S.No</th>
                    <th> SO Number </th>
                    <th>Cost Sheet No</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>

                    <tr>
                        <td> <?php echo $i++; ?> </td>
                        <td><?php echo $row['so_number']; ?></td>
                        <td><?php echo $row['cost_sheet_no']; ?></td>
                        <th style="color: #003fe0;">
                            <?php
                            if ($row['bomsts'] == 0) {
                                echo '<span style="color: blue;text-align:center;"><b> Pending </b></span>';
                            } else if ($row['bomsts'] == 1) {
                                echo '<span style="color: green;text-align:center;"><b> Approved </b></span>';
                            } else if ($row['bomsts'] == 2) {
                                echo '<span style="color: red;text-align:center;"><b> Rejected </b></span>';
                            }

                            ?>
                        </th>

                        <td>
                            <button class="btn btn-danger" onclick="bom_verify(<?php echo $row['id']; ?>,<?php echo $row['bom_id']; ?>)"><i class="fa fa-eye"></i></button>
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
    function bom_verify(v, id) {
        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/poTicket/bomverifyView.php?id=" + v + "&bomId=" + id,
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