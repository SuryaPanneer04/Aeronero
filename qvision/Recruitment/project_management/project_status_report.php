<?php
require '../../../connect.php';
require '../../../user.php';
$userrole=$_SESSION['userrole'];

$f_project = isset($_POST['project_id']) ? $_POST['project_id'] : '';
$f_employee = isset($_POST['employee_id']) ? $_POST['employee_id'] : '';

// Data for Graph: Count of assignments per project
$graph_sql = $con->query("SELECT pd.project_name, COUNT(pe.id) as emp_count FROM y_project_employees pe JOIN y_project_details pd ON pe.project_id = pd.project_id GROUP BY pd.project_id");
$chart_labels = [];
$chart_data = [];
while($g = $graph_sql->fetch(PDO::FETCH_ASSOC)) {
    $chart_labels[] = $g['project_name'];
    $chart_data[] = $g['emp_count'];
}
?>
<div class="card card-primary">
    <div class="card-header" style="background-color: #009EE3; padding: 10px 15px;">
        <h3 class="card-title" style="margin: 0;"><font size="5">Projects Report</font></h3>
    </div>
    
    <div class="card-body">
        
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h3 class="card-title text-primary"><i class="fa fa-bar-chart"></i> Project Assignment Overview</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="projectOverviewChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <form id="pr_filter_form" style="margin-bottom: 20px; padding: 15px; border: 1px solid #ccc; background: #f9f9f9;">
            <div class="row">
                <div class="col-md-4">
                    <label>Project</label>
                    <select name="project_id" class="form-control">
                        <option value="">-- All Projects --</option>
                        <?php
                        $proj_sql=$con->query("SELECT * FROM y_project_details");
                        while($p = $proj_sql->fetch(PDO::FETCH_ASSOC)) {
                            $sel = ($f_project == $p['project_id']) ? 'selected' : '';
                            $pcode = !empty($p['project_code']) ? " (" . $p['project_code'] . ")" : "";
                            echo '<option value="'.$p['project_id'].'" '.$sel.'>'.$p['project_name'].$pcode.'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Employee</label>
                    <select name="employee_id" class="form-control">
                        <option value="">-- All Employees --</option>
                        <?php
                        $emp_sql=$con->query("SELECT candid_id, emp_name, emp_code FROM staff_master WHERE status=1 and dep_id = 56 ORDER BY emp_name ASC");
                        while($e = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
                            $sel = ($f_employee == $e['candid_id']) ? 'selected' : '';
                            echo '<option value="'.$e['candid_id'].'" '.$sel.'>'.$e['emp_code'].' - '.$e['emp_name'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>&nbsp;</label><br>
                    <button type="button" class="btn btn-primary" onclick="filter_project_status_report()">Filter</button>
                    <button type="button" class="btn btn-default" onclick="project_status_report()">Reset</button>
                </div>
            </div>
        </form>

                <!-- Legend for Deadline Highlight -->
        <div class="alert alert-light border shadow-sm mb-3" role="alert" style="border-left: 5px solid #009EE3; background-color: #fcfcfc;">
            <h6 class="mb-2 font-weight-bold text-secondary" style="font-size: 14px;"><i class="fa fa-info-circle text-info"></i> How to read the deadline colors:</h6>
            <div class="d-flex flex-wrap align-items-center" style="font-size: 13px;">
                <div class="mr-4 mb-1">
                    <span class="badge badge-success p-2 mr-1" style="min-width: 70px;">Safe</span> <span class="text-muted">More than 2 days left</span>
                </div>
                <div class="mr-4 mb-1">
                    <span class="badge badge-warning p-2 mr-1" style="min-width: 70px;">Nearing</span> <span class="text-muted">2 days or less left</span>
                </div>
                <div class="mr-4 mb-1">
                    <span class="badge badge-danger p-2 mr-1" style="min-width: 70px;">Overdue</span> <span class="text-muted">Deadline has passed</span>
                </div>
                <div class="mr-4 mb-1">
                    <span class="badge badge-primary p-2 mr-1" style="min-width: 70px;">Completed</span> <span class="text-muted">Project is finished</span>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="dataTables-example table table-striped table-bordered table-hover" id="projectsReportTable" style="width: 100%;">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Project Name</th>
                        <th>Project Code</th>
                        <th>Employee Name</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
<?php

$where_sql = "1=1";
if($f_project != '') {
    $where_sql .= " AND pe.project_id = '$f_project'";
}
if($f_employee != '') {
    $where_sql .= " AND pe.employee_id = '$f_employee'";
}

$query = "
    SELECT pe.*, pd.project_name, pd.project_code, sm.emp_name, sm.emp_code 
    FROM y_project_employees pe 
    JOIN y_project_details pd ON pe.project_id = pd.project_id 
    JOIN staff_master sm ON pe.employee_id = sm.candid_id 
    WHERE $where_sql 
    ORDER BY pe.id DESC
";

$result = $con->query($query); if(!$result) { echo "<tr><td colspan=\"7\" style=\"color:red\">Database Error: " . print_r($con->errorInfo(), true) . "</td></tr>"; } else { $i = 1; while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $deadline_date = $row['deadline_date'];
    $deadline = ($deadline_date && $deadline_date != '0000-00-00') ? date('d-m-Y', strtotime($deadline_date)) : 'Not Set';
    
    // Status Logic
    $status = $row['acceptance_status'];
    if(empty($status) || $status == 'Pending') {
        $status = 'Assigned';
        $badge = 'badge-primary';
    } else if($status == 'Completed') {
        $badge = 'badge-success';
    } else {
        $badge = 'badge-info';
    }
    
    // Deadline Highlight Logic
    $dl_badge = '';
    $dl_title = '';
    if($deadline_date && $deadline_date != '0000-00-00' && $row['acceptance_status'] != 'Completed') {
        $today = new DateTime();
        $today->setTime(0,0,0);
        try { $dl = new DateTime($deadline_date); $diff = $today->diff($dl); $days = $diff->invert ? -$diff->days : $diff->days; } catch (Exception $e) { $days = 0; }
        
        if($days < 0) {
            $dl_badge = 'badge badge-danger p-2';
            $dl_title = 'Overdue by ' . abs($days) . ' day(s)';
        } else if($days <= 2) {
            $dl_badge = 'badge badge-warning p-2';
            $dl_title = 'Nearing Deadline: ' . $days . ' day(s) left';
        } else {
            $dl_badge = 'badge badge-success p-2';
            $dl_title = 'Safe: ' . $days . ' day(s) left';
        }
    } else if ($row['acceptance_status'] == 'Completed') {
        $dl_badge = 'badge badge-primary p-2';
        $dl_title = 'Completed Project';
    }
?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><strong><?php echo $row['project_name']; ?></strong></td>
                        <td><?php echo $row['project_code']; ?></td>
                        <td><?php echo $row['emp_code'] . ' - ' . $row['emp_name']; ?></td>
                        <td><span class="<?php echo $dl_badge; ?>" title="<?php echo $dl_title; ?>"><?php echo $deadline; ?></span></td>
                        <td><span class="badge <?php echo $badge; ?>"><?php echo $status; ?></span></td>
                        <td>
                            <button class="btn btn-info btn-sm" onclick="view_project_details(<?php echo $row['id']; ?>)">
                                <i class="fa fa-eye"></i> View
                            </button>
                        </td></tr><?php } } ?></tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    $('#projectsReportTable').DataTable({
        scrollX: true
    });

    // Render Chart
    var ctx = document.getElementById('projectOverviewChart').getContext('2d');
    var projectOverviewChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($chart_labels); ?>,
            datasets: [{
                label: 'Number of Employees Assigned',
                data: <?php echo json_encode($chart_data); ?>,
                backgroundColor: 'rgba(0, 158, 227, 0.7)',
                borderColor: 'rgba(0, 158, 227, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});

function filter_project_status_report() {
    var fd = new FormData(document.getElementById('pr_filter_form'));
    $.ajax({
        type: "POST",
        url: "qvision/Recruitment/project_management/project_status_report.php",
        data: fd,
        contentType: false,
        processData: false,
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}

function view_project_details(pe_id) {
    $.ajax({
        type: "POST",
        url: "qvision/Recruitment/project_management/view_project_report.php",
        data: { id: pe_id },
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}
</script>





