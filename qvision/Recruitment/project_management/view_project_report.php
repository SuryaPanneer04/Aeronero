<?php
require '../../../connect.php';
require '../../../user.php';

$pe_id = $_POST['id'];

// Get project and employee info
$q = $con->prepare("
    SELECT pe.*, pd.project_name, pd.project_code, sm.emp_name, sm.emp_code 
    FROM y_project_employees pe 
    JOIN y_project_details pd ON pe.project_id = pd.project_id 
    JOIN staff_master sm ON pe.employee_id = sm.candid_id 
    WHERE pe.id = :id
");
$q->execute([':id' => $pe_id]);
$assign_info = $q->fetch(PDO::FETCH_ASSOC);

if(!$assign_info) {
    echo "<div class='alert alert-danger'>Assignment not found.</div>";
    exit;
}

$project_id = $assign_info['project_id'];
$candid_id = $assign_info['employee_id'];
$project_name = $assign_info['project_name'];
$project_code = $assign_info['project_code'];
if(!empty($project_code)) {
    $project_name .= " (" . $project_code . ")";
}
$emp_name = $assign_info['emp_name'];

// Get time sheets for this employee
$ts_sql = $con->query("SELECT * FROM time_sheet WHERE staff_id = '$candid_id' ORDER BY date DESC");

$slots = [
    ['p'=>'p_two', 't'=>'two', 'c'=>'a_two', 'label'=>'9.30-10.30'],
    ['p'=>'p_three', 't'=>'three', 'c'=>'a_three', 'label'=>'10.30-11.30'],
    ['p'=>'p_four', 't'=>'four', 'c'=>'a_four', 'label'=>'11.30-12.30'],
    ['p'=>'p_five', 't'=>'five', 'c'=>'a_five', 'label'=>'12.30-01.30'],
    ['p'=>'p_six', 't'=>'six', 'c'=>'a_six', 'label'=>'01.30-02.30'],
    ['p'=>'p_seven', 't'=>'seven', 'c'=>'a_seven', 'label'=>'02.30-03.30'],
    ['p'=>'p_eight', 't'=>'eight', 'c'=>'a_eight', 'label'=>'03.30-04.30'],
    ['p'=>'p_nine', 't'=>'nine', 'c'=>'a_nine', 'label'=>'04.30-05.30'],
    ['p'=>'p_ten', 't'=>'ten', 'c'=>'a_ten', 'label'=>'05.30-06.30'],
    ['p'=>'p_over_time', 't'=>'over_time', 'c'=>'a_over_time', 'label'=>'Over Time']
];

$daily_reports = [];
$chart_labels = [];
$chart_data = [];

while($ts = $ts_sql->fetch(PDO::FETCH_ASSOC)) {
    $date = $ts['date'];
    $tasks = [];
    $hours = 0;
    
    foreach($slots as $slot) {
        if($ts[$slot['p']] == $project_id) {
            $tasks[] = [
                'time' => $slot['label'],
                'todo' => $ts[$slot['t']],
                'completed' => $ts[$slot['c']]
            ];
            $hours++;
        }
    }
    
    if(count($tasks) > 0) {
        $daily_reports[] = [
            'date' => $date,
            'tasks' => $tasks,
            'hours' => $hours
        ];
    }
}

// For chart, reverse to show chronological order
$rev_reports = array_reverse($daily_reports);
foreach($rev_reports as $r) {
    $chart_labels[] = date('M d', strtotime($r['date']));
    $chart_data[] = $r['hours'];
}

?>
<div class="card card-primary">
    <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #009EE3; padding: 10px 15px;">
        <h3 class="card-title" style="margin: 0;"><font size="5">Project Daily Reports</font></h3>
        <button class="btn btn-danger btn-sm text-white" onclick="project_status_report()">
            <i class="fa fa-arrow-left"></i> Back to Reports
        </button>
    </div>
    
    <div class="card-body">
        <!-- Details Header -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h5><strong>Project:</strong> <span class="text-info"><?php echo $project_name; ?></span></h5>
                <h5><strong>Employee:</strong> <?php echo $emp_name; ?></h5>
            </div>
            <div class="col-md-6 text-right">
                <h5><strong>Total Hours Logged:</strong> <span class="badge badge-success" style="font-size: 1rem;"><?php echo array_sum($chart_data); ?></span></h5>
            </div>
        </div>

        <?php if(count($daily_reports) > 0): ?>
        <!-- Chart Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h3 class="card-title text-primary"><i class="fa fa-line-chart"></i> Hours Logged per Day</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="employeeProjectChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Accordion Timeline Section -->
        <h4 class="mb-3 text-secondary">Daily Task Updates</h4>
        <div class="accordion" id="accordionReports">
            <?php foreach($daily_reports as $index => $dr): ?>
            <div class="card shadow-sm mb-2">
                <div class="card-header p-0" id="heading<?php echo $index; ?>" style="background-color: #009EE3;">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left font-weight-bold d-flex justify-content-between align-items-center text-white" type="button" data-toggle="collapse" data-target="#collapse<?php echo $index; ?>" aria-expanded="true" aria-controls="collapse<?php echo $index; ?>" style="text-decoration: none; padding: 15px;">
                            <span><i class="fa fa-calendar text-white mr-2"></i> <?php echo date('d-M-Y (l)', strtotime($dr['date'])); ?> <span class="badge badge-light text-dark ml-2"><?php echo $dr['hours']; ?> hours</span></span>
                            <i class="fa fa-chevron-down text-white"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapse<?php echo $index; ?>" class="collapse <?php echo ($index == 0) ? 'show' : ''; ?>" aria-labelledby="heading<?php echo $index; ?>" data-parent="#accordionReports">
                    <div class="card-body p-0">
                        <table class="table table-bordered mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th width="20%">Time Slot</th>
                                    <th width="40%">To-do List</th>
                                    <th width="40%">Task Completed</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($dr['tasks'] as $task): ?>
                                <tr>
                                    <td class="align-middle text-center"><strong><?php echo $task['time']; ?></strong></td>
                                    <td><?php echo nl2br(htmlspecialchars($task['todo'])); ?></td>
                                    <td><?php echo nl2br(htmlspecialchars($task['completed'])); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
            <div class="alert alert-warning text-center mt-5">
                <h4><i class="fa fa-exclamation-triangle"></i> No Daily Reports Found</h4>
                <p>This employee hasn't logged any hours for this project in their timesheet yet.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
$(document).ready(function() {
    // Accordion Icon Toggle
    $('.collapse').on('shown.bs.collapse', function () {
        $(this).parent().find(".fa-chevron-down").removeClass("fa-chevron-down").addClass("fa-chevron-up");
    }).on('hidden.bs.collapse', function () {
        $(this).parent().find(".fa-chevron-up").removeClass("fa-chevron-up").addClass("fa-chevron-down");
    });

    <?php if(count($daily_reports) > 0): ?>
    // Render Chart
    var ctx2 = document.getElementById('employeeProjectChart').getContext('2d');
    var employeeProjectChart = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($chart_labels); ?>,
            datasets: [{
                label: 'Hours Logged',
                data: <?php echo json_encode($chart_data); ?>,
                backgroundColor: 'rgba(40, 167, 69, 0.2)',
                borderColor: 'rgba(40, 167, 69, 1)',
                borderWidth: 2,
                pointBackgroundColor: 'rgba(40, 167, 69, 1)',
                pointRadius: 4,
                fill: true,
                tension: 0.3
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
    <?php endif; ?>
});
</script>
