<?php
require_once '../../../connect.php';
if (!headers_sent() && session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<style>
.csr-title-red {
    color: #e60000;
    font-weight: 800;
    font-size: 22px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}
</style>

<div class="card card-primary">
    <div class="card-header bg-white" style="border-bottom: 2px solid #e9ecef;">
        <h3 class="card-title csr-title-red mb-0">CSR</h3>
        <button type="button" onclick="add_csr()" style="float: right;" class="btn btn-dark"><i class="fa fa-plus"></i> Add New CSR</button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="dataTables-example table table-striped table-bordered table-hover" id="csr_table" style="width:100%;">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 5%;">S.No</th>
                        <th>Project</th>
                        <th>Installations / running status (give access to installation and service team)</th>
                        <th>Condition ( Working/ Not Working)</th>
                        <th>Impact Report ( Attach Report)</th>
                        <th>Visits Completed</th>
                        <th>Next Vist Planned</th>
                        <th style="width: 8%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = $con->query("
                    SELECT c.*, p.project_code, p.project_name AS orig_project_name 
                    FROM z_csr c 
                    LEFT JOIN y_project_details p ON c.project_id = p.project_id 
                    ORDER BY 
                        CASE 
                            WHEN c.next_visit_planned IS NULL OR c.next_visit_planned = '0000-00-00' THEN 1 
                            ELSE 0 
                        END ASC,
                        c.next_visit_planned ASC,
                        c.id DESC
                ");

                $i = 1;
                $today = new DateTime();
                $today->setTime(0, 0, 0);

                while ($res = $sql->fetch(PDO::FETCH_ASSOC)) {
                    // Project Display
                    $proj_display = !empty($res['project_code']) 
                        ? htmlspecialchars($res['project_code'] . ' - ' . $res['project_name']) 
                        : htmlspecialchars($res['project_name']);

                    // Installations / Running Status Display
                    $inst_status = $res['installation_status'];
                    $inst_badge = 'badge-secondary';
                    $inst_icon = 'fa-info-circle';
                    if ($inst_status == 'Installed & Running') {
                        $inst_badge = 'badge-success';
                        $inst_icon = 'fa-check-circle';
                    } else if ($inst_status == 'Installation In Progress') {
                        $inst_badge = 'badge-primary';
                        $inst_icon = 'fa-tools';
                    } else if ($inst_status == 'Installation Pending') {
                        $inst_badge = 'badge-warning';
                        $inst_icon = 'fa-clock';
                    } else if ($inst_status == 'Under Service / Maintenance') {
                        $inst_badge = 'badge-info';
                        $inst_icon = 'fa-wrench';
                    } else if ($inst_status == 'Completed') {
                        $inst_badge = 'badge-success';
                        $inst_icon = 'fa-check-double';
                    } else if ($inst_status == 'Decommissioned') {
                        $inst_badge = 'badge-dark';
                        $inst_icon = 'fa-ban';
                    }

                    $inst_html = "<span class='badge p-2 $inst_badge'><i class='fa $inst_icon mr-1'></i> " . htmlspecialchars($inst_status) . "</span>";
                    if (!empty($res['assigned_team'])) {
                        $inst_html .= "<div class='small text-muted mt-1'><i class='fa fa-user-cog text-info'></i> <strong>Team:</strong> " . htmlspecialchars($res['assigned_team']) . "</div>";
                    }

                    // Condition (Working / Not Working) Display
                    $cond = $res['condition_status'];
                    $cond_badge = 'badge-secondary';
                    $cond_icon = 'fa-question-circle';
                    if ($cond == 'Working') {
                        $cond_badge = 'badge-success';
                        $cond_icon = 'fa-check-circle';
                    } else if ($cond == 'Not Working') {
                        $cond_badge = 'badge-danger';
                        $cond_icon = 'fa-times-circle';
                    } else if ($cond == 'Partially Working') {
                        $cond_badge = 'badge-warning';
                        $cond_icon = 'fa-exclamation-triangle';
                    } else if ($cond == 'Under Maintenance') {
                        $cond_badge = 'badge-info';
                        $cond_icon = 'fa-wrench';
                    }
                    $cond_html = "<span class='badge p-2 $cond_badge' style='font-size: 12px;'><i class='fa $cond_icon mr-1'></i> " . htmlspecialchars($cond) . "</span>";

                    // Impact Report (Attach Report) Display
                    $report_html = "<span class='text-muted'>-</span>";
                    if (!empty($res['impact_report'])) {
                        $report_html = "<a href='qvision/BusinessProcess/csr/uploads/" . htmlspecialchars($res['impact_report']) . "' target='_blank' class='btn btn-xs btn-info'><i class='fa fa-download'></i> Report</a>";
                    }

                    // Next Visit Planned Display with Urgency Badges
                    $next_visit = $res['next_visit_planned'];
                    $visit_str = (!empty($next_visit) && $next_visit != '0000-00-00') ? date('d-m-Y', strtotime($next_visit)) : '-';
                    $visit_badge_class = 'badge-secondary';
                    $visit_badge_style = '';
                    $visit_label = '';
                    $visit_icon = 'fa-calendar-alt';

                    if (!empty($next_visit) && $next_visit != '0000-00-00') {
                        try {
                            $v_date = new DateTime($next_visit);
                            $v_date->setTime(0, 0, 0);
                            $diff = $today->diff($v_date);
                            $days = $diff->invert ? -$diff->days : $diff->days;
                        } catch (Exception $e) {
                            $days = 0;
                        }

                        if ($days < 0) {
                            $visit_badge_class = 'badge-danger';
                            $visit_icon = 'fa-exclamation-triangle';
                            $visit_label = abs($days) . ' day(s) Overdue';
                        } else if ($days == 0) {
                            $visit_badge_class = 'badge-danger';
                            $visit_badge_style = 'background-color: #dc3545; color: #fff;';
                            $visit_icon = 'fa-bell';
                            $visit_label = 'Planned Today';
                        } else if ($days <= 3) {
                            $visit_badge_class = 'badge-warning';
                            $visit_badge_style = 'background-color: #fd7e14; color: #fff;';
                            $visit_icon = 'fa-clock';
                            $visit_label = $days . ' day(s) left';
                        } else if ($days <= 7) {
                            $visit_badge_class = 'badge-warning';
                            $visit_badge_style = 'background-color: #ffc107; color: #212529;';
                            $visit_icon = 'fa-hourglass-half';
                            $visit_label = $days . ' days left';
                        } else {
                            $visit_badge_class = 'badge-success';
                            $visit_icon = 'fa-calendar-check';
                            $visit_label = $days . ' days left';
                        }
                    }
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><strong><?php echo $proj_display; ?></strong></td>
                        <td><?php echo $inst_html; ?></td>
                        <td class="text-center"><?php echo $cond_html; ?></td>
                        <td class="text-center"><?php echo $report_html; ?></td>
                        <td class="text-center">
                            <span class="badge badge-light border text-dark p-2" style="font-size: 13px; font-weight: bold; min-width: 45px;">
                                <i class="fa fa-calendar-check text-primary mr-1"></i> <?php echo intval($res['visits_completed']); ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <?php if ($visit_str != '-'): ?>
                                <span class="badge p-2 <?php echo $visit_badge_class; ?>" style="<?php echo $visit_badge_style; ?>" title="<?php echo $visit_label; ?>">
                                    <i class="fa <?php echo $visit_icon; ?> mr-1"></i> <?php echo $visit_str; ?>
                                    <br><small style="font-size: 10px;"><?php echo $visit_label; ?></small>
                                </span>
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-sm" onclick="edit_csr(<?php echo $res['id']; ?>)" title="Edit CSR Record">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#csr_table').DataTable({
        scrollX: true,
        pageLength: 25,
        ordering: false // Retains smart nearest planned visit sorting
    });
});

function add_csr() {
    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/csr/new.php",
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}

function edit_csr(id) {
    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/csr/edit.php",
        data: { id: id },
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}
</script>
