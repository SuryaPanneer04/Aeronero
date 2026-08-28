<?php
require '../../connect.php';
include '../../user.php';
$userrole = $_SESSION['userrole'];
$candid_id = $_SESSION['candidateid'];
?>

<head>
    <!-- <link rel="stylesheet" href="Qvision\commonstyle.css"> -->
</head>

<div class="card card-primary">
    <div class="card-header" style="background-color:#ff8b3d;">
        <h3 class="card-title"><font size="5">Claim Requests</font></h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered display nowrap" id="example1" style="width:100%">
            <thead>
                <th>S.No</th>
                <th>Emp Code</th>
                <th>Emp Name</th>
                <th>Date</th>
                <th>Customer Name</th>
                <th>Location</th>
                <th>Purpose</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
            <tbody>

            <?php
            $cnt = 1;

            $holiday_query = $con->prepare("
                SELECT cr.*, sm.emp_code, sm.emp_name, cr.id AS claim_id
                FROM claim_request cr
                INNER JOIN staff_master sm ON cr.candidate_id = sm.candid_id
                ORDER BY cr.id DESC
            ");
            $holiday_query->execute();

            while ($holiday_masterr = $holiday_query->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo $cnt; ?></td>
                    <td><?php echo $holiday_masterr['emp_code']; ?></td>
                    <td><?php echo $holiday_masterr['emp_name']; ?></td>
                    <td><?php echo $holiday_masterr['date']; ?></td>
                    <td><?php echo $holiday_masterr['customer_name']; ?></td>
                    <td><?php echo $holiday_masterr['location']; ?></td>
                    <td><?php echo $holiday_masterr['purpose']; ?></td>
                    <td>
                        <?php 
                        switch ($holiday_masterr['status']) {
                            case '1':
                                echo '<span style="color:red;"><b>Request Pending</b></span>';
                                break;
                            case '2':
                                echo '<span style="color:green;"><b>Approved by Finance Department</b></span>';
                                break;
                            case '3':
                                echo '<span style="color:green;"><b>Approved by HOD & Finance Head</b></span>';
                                break;
                            case '4':
                                echo '<span style="color:red;"><b>Request Rejected</b></span>';
                                break;
                        }
                        ?>
                    </td>
                    <td>
                        <button class="btn btn-success btn-sm view btn-flat" 
                            data-id="<?php echo $holiday_masterr['claim_id']; ?>"  
                            onclick="od_view(<?php echo $holiday_masterr['claim_id']; ?>)">
                            <i class="fa fa-eye"></i> View
                        </button>
                    </td>
                </tr>
                <?php
                $cnt++;
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#example1').DataTable({ "scrollX": true });
});

function od_view(v) {
    console.log("Viewing ID: ", v); // Debugging
    $.ajax({
        type: "POST",
        url: "qvision/claim/od_view.php",
        data: { id: v },
        success: function(data) {
            if ($('#main_content').length) {
                $("#main_content").html(data);
            } else {
                console.error("Error: #main_content does not exist!");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: " + error);
        }
    });
}
</script>
