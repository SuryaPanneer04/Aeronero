<?php
require_once '../../../connect.php';
if (!headers_sent() && session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<style>
.project-title-red {
    color: #e60000;
    font-weight: 800;
    font-size: 22px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}
.collab-badge-interactive {
    display: inline-block;
    transition: transform 0.15s ease-in-out;
}
.collab-badge-interactive:hover {
    transform: scale(1.05);
    text-decoration: none;
}
.collab-popover .popover-header {
    background-color: #007bff;
    color: #fff;
    font-weight: bold;
    font-size: 13px;
}
.deadline-badge {
    display: inline-block;
    text-align: center;
    border-radius: 4px;
    font-weight: 600;
    min-width: 120px;
}
</style>

<div class="card card-primary">
    <div class="card-header bg-white" style="border-bottom: 2px solid #e9ecef;">
        <h3 class="card-title project-title-red mb-0">PROJECTS</h3>
        <button type="button" onclick="add_project()" style="float: right;" class="btn btn-dark"><i class="fa fa-plus"></i> Add New Project</button>
    </div>

    <div class="card-body">
        <!-- Legend for Deadline Highlight -->
        <div class="alert alert-light border shadow-sm mb-3" role="alert" style="border-left: 5px solid #d80831; background-color: #fdfdfd;">
            <h6 class="mb-2 font-weight-bold text-secondary" style="font-size: 14px;">
                <i class="fa fa-info-circle text-danger"></i> Deadline Urgency & Color Highlights:
            </h6>
            <div class="d-flex flex-wrap align-items-center" style="font-size: 13px;">
                <div class="mr-3 mb-1">
                    <span class="badge badge-danger p-2 mr-1" style="min-width: 80px;"><i class="fa fa-exclamation-triangle"></i> Overdue</span> 
                    <span class="text-muted">Deadline has passed</span>
                </div>
                <div class="mr-3 mb-1">
                    <span class="badge p-2 mr-1 text-white" style="min-width: 80px; background-color: #fd7e14;"><i class="fa fa-clock"></i> 1 - 3 Days</span> 
                    <span class="text-muted">Urgent (Nearing deadline)</span>
                </div>
                <div class="mr-3 mb-1">
                    <span class="badge badge-warning p-2 mr-1 text-dark" style="min-width: 80px; background-color: #ffc107;"><i class="fa fa-hourglass-half"></i> 4 - 7 Days</span> 
                    <span class="text-muted">Approaching deadline</span>
                </div>
                <div class="mr-3 mb-1">
                    <span class="badge badge-success p-2 mr-1" style="min-width: 80px;"><i class="fa fa-calendar-check"></i> > 7 Days</span> 
                    <span class="text-muted">Safe (Plenty of time)</span>
                </div>
                <div class="mr-3 mb-1">
                    <span class="badge badge-secondary p-2 mr-1" style="min-width: 80px;"><i class="fa fa-check-circle"></i> Completed</span> 
                    <span class="text-muted">Finished project</span>
                </div>
                <div class="ml-auto text-muted small">
                    <i class="fa fa-sort-amount-up text-primary"></i> <em>Sorted by nearest deadline first</em>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="dataTables-example table table-striped table-bordered table-hover" id="projects_table" style="width:100%;">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 5%;">S.No</th>
                        <th>ProjectCode</th>
                        <th>Project Name</th>
                        <th>Project Lead</th>
                        <th>Resource Used</th>
                        <th>Collaborated with (if any)</th>
                        <th>Deadline</th>
                        <th>Attach Project Reports</th>
                        <th>Status</th>
                        <th style="width: 8%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Fetch projects ordered by nearest deadline first (Overdue first, then upcoming nearest, then far, then completed)
                $sql = $con->query("
                    SELECT p.*, 
                           c.collaborator_name, 
                           c.collab_type, 
                           c.nda_status, 
                           c.nda_date, 
                           c.mou_status, 
                           c.mou_date, 
                           c.status AS collab_status,
                           c.work_description
                    FROM z_projects p 
                    LEFT JOIN z_collaborations c ON p.collab_id = c.id 
                    ORDER BY 
                        CASE 
                            WHEN p.status = 'Completed' THEN 3
                            WHEN p.deadline IS NULL OR p.deadline = '0000-00-00' THEN 2
                            WHEN p.deadline < CURDATE() THEN 0 
                            ELSE 1 
                        END ASC,
                        p.deadline ASC,
                        p.id DESC
                ");

                $i = 1;
                $today = new DateTime();
                $today->setTime(0, 0, 0);

                while ($res = $sql->fetch(PDO::FETCH_ASSOC)) {
                    // Deadline calculation and color highlights
                    $deadline = $res['deadline'];
                    $deadline_str = (!empty($deadline) && $deadline != '0000-00-00') ? date('d-m-Y', strtotime($deadline)) : '-';
                    
                    $dl_badge_class = 'badge-secondary';
                    $dl_badge_style = '';
                    $dl_label = '-';
                    $dl_icon = '';

                    if ($res['status'] == 'Completed') {
                        $dl_badge_class = 'badge-secondary';
                        $dl_icon = '<i class="fa fa-check-circle"></i>';
                        $dl_label = 'Completed';
                    } else if (!empty($deadline) && $deadline != '0000-00-00') {
                        try {
                            $dl = new DateTime($deadline);
                            $dl->setTime(0, 0, 0);
                            $diff = $today->diff($dl);
                            $days = $diff->invert ? -$diff->days : $diff->days;
                        } catch (Exception $e) {
                            $days = 0;
                        }

                        if ($days < 0) {
                            // Overdue
                            $dl_badge_class = 'badge-danger';
                            $dl_icon = '<i class="fa fa-exclamation-triangle"></i>';
                            $dl_label = abs($days) . ' day(s) Overdue';
                        } else if ($days == 0) {
                            // Due Today
                            $dl_badge_class = 'badge-danger';
                            $dl_badge_style = 'background-color: #dc3545; color: #fff;';
                            $dl_icon = '<i class="fa fa-fire"></i>';
                            $dl_label = 'Due Today!';
                        } else if ($days <= 3) {
                            // 1 - 3 days left
                            $dl_badge_class = 'badge-warning';
                            $dl_badge_style = 'background-color: #fd7e14; color: #fff;';
                            $dl_icon = '<i class="fa fa-clock"></i>';
                            $dl_label = $days . ' day(s) left';
                        } else if ($days <= 7) {
                            // 4 - 7 days left
                            $dl_badge_class = 'badge-warning';
                            $dl_badge_style = 'background-color: #ffc107; color: #212529;';
                            $dl_icon = '<i class="fa fa-hourglass-half"></i>';
                            $dl_label = $days . ' days left';
                        } else {
                            // > 7 days left
                            $dl_badge_class = 'badge-success';
                            $dl_icon = '<i class="fa fa-calendar-check"></i>';
                            $dl_label = $days . ' days left';
                        }
                    }

                    // Attach project reports
                    $report_html = '-';
                    if (!empty($res['report_file'])) {
                        $report_html = "<a href='qvision/BusinessProcess/projects/uploads/" . htmlspecialchars($res['report_file']) . "' target='_blank' class='btn btn-xs btn-info'><i class='fa fa-download'></i> Report</a>";
                    }

                    // Status display
                    $status_badge_class = 'badge-info';
                    if ($res['status'] == 'Planned') $status_badge_class = 'badge-secondary';
                    if ($res['status'] == 'In Progress') $status_badge_class = 'badge-primary';
                    if ($res['status'] == 'Under Review') $status_badge_class = 'badge-warning';
                    if ($res['status'] == 'Completed') $status_badge_class = 'badge-success';
                    if ($res['status'] == 'On Hold') $status_badge_class = 'badge-dark';

                    // Collaborated with (if any) display & hover/click setup
                    $collab_html = "<span class='text-muted'>-</span>";
                    if (!empty($res['collab_id']) && !empty($res['collaborator_name'])) {
                        $popover_content = "<strong>Type:</strong> " . htmlspecialchars($res['collab_type'] ?? '') . "<br>"
                                         . "<strong>Status:</strong> " . htmlspecialchars($res['collab_status'] ?? '') . "<br>"
                                         . "<strong>NDA:</strong> " . htmlspecialchars($res['nda_status'] ?? '-') . "<br>"
                                         . "<strong>MoU:</strong> " . htmlspecialchars($res['mou_status'] ?? '-') . "<br>"
                                         . "<span class='text-primary mt-1 d-block' style='font-size:11px;'><i class='fa fa-mouse-pointer'></i> Click to view full details</span>";
                        
                        $collab_html = "
                            <a href='javascript:void(0);' 
                               class='collab-badge-interactive' 
                               onclick='view_collab_details(" . intval($res['collab_id']) . ")' 
                               data-toggle='popover' 
                               data-trigger='hover' 
                               data-placement='top' 
                               data-html='true' 
                               data-title='<i class=\"fa fa-handshake\"></i> " . htmlspecialchars(addslashes($res['collaborator_name'])) . "' 
                               data-content='" . htmlspecialchars($popover_content) . "'>
                                <span class='badge badge-info p-2' style='cursor:pointer;'>
                                    <i class='fa fa-handshake mr-1'></i> " . htmlspecialchars($res['collaborator_name']) . "
                                </span>
                            </a>
                        ";
                    }
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><strong><?php echo htmlspecialchars($res['project_code']); ?></strong></td>
                        <td><?php echo htmlspecialchars($res['project_name']); ?></td>
                        <td><?php echo htmlspecialchars($res['project_lead']); ?></td>
                        <td>
                            <?php
                            $resource_str = $res['resource_used'] ?? '';
                            if (!empty($resource_str)) {
                                $r_list = array_map('trim', explode(',', $resource_str));
                                foreach ($r_list as $r_item) {
                                    if (!empty($r_item)) {
                                        echo "<span class='badge badge-light border text-dark p-1 mr-1 mb-1' style='font-size: 11px; display: inline-block;'><i class='fa fa-user-circle text-primary'></i> " . htmlspecialchars($r_item) . "</span>";
                                    }
                                }
                            } else {
                                echo "<span class='text-muted'>-</span>";
                            }
                            ?>
                        </td>
                        <td><?php echo $collab_html; ?></td>
                        <td>
                            <?php if ($deadline_str != '-'): ?>
                                <span class="badge deadline-badge p-2 <?php echo $dl_badge_class; ?>" style="<?php echo $dl_badge_style; ?>" title="<?php echo $dl_label; ?>">
                                    <?php echo $dl_icon . ' ' . $deadline_str; ?>
                                    <br><small style="font-size: 10px;"><?php echo $dl_label; ?></small>
                                </span>
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?php echo $report_html; ?></td>
                        <td class="text-center">
                            <span class="badge p-2 <?php echo $status_badge_class; ?>">
                                <?php echo htmlspecialchars($res['status']); ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-sm" onclick="edit_project(<?php echo $res['id']; ?>)" title="Edit Project">
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

<!-- Modal for Collaboration Details -->
<div class="modal fade" id="collabDetailModal" tabindex="-1" role="dialog" aria-labelledby="collabModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="collabModalLabel"><i class="fa fa-handshake mr-2"></i> Collaboration Details</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="collabModalBody">
                <div class="text-center py-4">
                    <i class="fa fa-spinner fa-spin fa-2x text-primary"></i>
                    <p class="mt-2 text-muted">Loading collaboration details...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize DataTables
    var table = $('#projects_table').DataTable({
        scrollX: true,
        pageLength: 25,
        ordering: false // Maintain smart backend order (nearest deadline first)
    });

    // Initialize Bootstrap popovers for collaboration hover
    $('[data-toggle="popover"]').popover({
        template: '<div class="popover collab-popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
    });
});

function add_project() {
    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/projects/new.php",
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}

function edit_project(id) {
    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/projects/edit.php",
        data: { id: id },
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}

function view_collab_details(collabId) {
    $('#collabDetailModal').modal('show');
    $('#collabModalBody').html('<div class="text-center py-4"><i class="fa fa-spinner fa-spin fa-2x text-primary"></i><p class="mt-2 text-muted">Loading collaboration details...</p></div>');
    
    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/projects/get_collab_details.php",
        data: { id: collabId },
        success: function(data) {
            $('#collabModalBody').html(data);
        },
        error: function() {
            $('#collabModalBody').html('<div class="alert alert-danger">Failed to load collaboration details.</div>');
        }
    });
}
</script>
