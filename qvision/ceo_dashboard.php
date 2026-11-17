<?php

/**
 * CEO Executive Dashboard
 * Accessible exclusively to Managing Director / CEO (Role R001)
 * Aeronero Solutions Private Limited
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../connect.php';

// Security check: Only R001 can view this dashboard
if (!isset($_SESSION['userrole']) || $_SESSION['userrole'] !== 'R001') {
    exit;
}

$today = date('Y-m-d');

// ---------------------------------------------------------
// 1. PROJECTS METRICS & DATA
// ---------------------------------------------------------
$projects_list = [];
$total_projects = 0;
$active_projects = 0;
$completed_projects = 0;
$overdue_projects = 0;
$due_soon_projects = 0;
$safe_projects = 0;

try {
    $p_stmt = $con->query("SELECT p.*, c.collaborator_name, c.collab_type 
        FROM z_projects p 
        LEFT JOIN z_collaborations c ON p.collab_id = c.id 
        ORDER BY 
            CASE 
                WHEN p.deadline < CURDATE() AND (p.status != 'Completed' OR p.status IS NULL) THEN 1
                WHEN p.deadline <= DATE_ADD(CURDATE(), INTERVAL 7 DAY) AND (p.status != 'Completed' OR p.status IS NULL) THEN 2
                WHEN p.status != 'Completed' OR p.status IS NULL THEN 3
                ELSE 4
            END,
            p.deadline ASC
    ");
    $projects_list = $p_stmt->fetchAll(PDO::FETCH_ASSOC);
    $total_projects = count($projects_list);

    foreach ($projects_list as $p) {
        $st = strtolower(trim($p['status'] ?? ''));
        if ($st === 'completed') {
            $completed_projects++;
            continue;
        }
        $active_projects++;

        if (!empty($p['deadline']) && $p['deadline'] !== '0000-00-00') {
            $d_time = strtotime($p['deadline']);
            $t_time = strtotime($today);
            $diff_days = floor(($d_time - $t_time) / 86400);

            if ($diff_days < 0) {
                $overdue_projects++;
            } elseif ($diff_days <= 7) {
                $due_soon_projects++;
            } else {
                $safe_projects++;
            }
        } else {
            $safe_projects++;
        }
    }
} catch (Exception $e) {
    // Graceful error handling
}

// ---------------------------------------------------------
// 2. CSR METRICS & DATA
// ---------------------------------------------------------
$csr_list = [];
$total_csr = 0;
$csr_working = 0;
$csr_not_working = 0;
$total_csr_visits = 0;

try {
    $csr_stmt = $con->query("SELECT * FROM z_csr ORDER BY id DESC");
    $csr_list = $csr_stmt->fetchAll(PDO::FETCH_ASSOC);
    $total_csr = count($csr_list);

    foreach ($csr_list as $c) {
        if (trim($c['condition_status']) === 'Working') {
            $csr_working++;
        } else {
            $csr_not_working++;
        }
        $total_csr_visits += intval($c['visits_completed'] ?? 0);
    }
} catch (Exception $e) {
}

// ---------------------------------------------------------
// 3. COLLABORATIONS METRICS
// ---------------------------------------------------------
$total_collab = 0;
$collab_mous = 0;
$collab_ndas = 0;

try {
    $col_stmt = $con->query("SELECT * FROM z_collaborations");
    $col_list = $col_stmt->fetchAll(PDO::FETCH_ASSOC);
    $total_collab = count($col_list);

    foreach ($col_list as $cl) {
        if (strtolower(trim($cl['mou_status'] ?? '')) === 'yes' || strtolower(trim($cl['mou_status'] ?? '')) === 'signed') {
            $collab_mous++;
        }
        if (strtolower(trim($cl['nda_status'] ?? '')) === 'yes' || strtolower(trim($cl['nda_status'] ?? '')) === 'signed') {
            $collab_ndas++;
        }
    }
} catch (Exception $e) {
}

// ---------------------------------------------------------
// 4. LABORATORY REQUIREMENTS METRICS
// ---------------------------------------------------------
$total_lab_req = 0;
$lab_received = 0;
$lab_pending = 0;

try {
    $lab_stmt = $con->query("SELECT * FROM z_laboratory_requirements");
    $lab_list = $lab_stmt->fetchAll(PDO::FETCH_ASSOC);
    $total_lab_req = count($lab_list);

    foreach ($lab_list as $lr) {
        if (strtolower(trim($lr['received_status'] ?? '')) === 'received' || strtolower(trim($lr['received_status'] ?? '')) === 'approved') {
            $lab_received++;
        } else {
            $lab_pending++;
        }
    }
} catch (Exception $e) {
}

// ---------------------------------------------------------
// 5. INTELLECTUAL PROPERTY & GRANTS METRICS
// ---------------------------------------------------------
$total_grants = 0;
$grants_amount_total = 0;
$total_patents = 0;
$total_publications = 0;
$total_awards = 0;

try {
    $g_res = $con->query("SELECT count(*) as cnt, COALESCE(SUM(amount), 0) as tot FROM grants_master")->fetch(PDO::FETCH_ASSOC);
    $total_grants = intval($g_res['cnt'] ?? 0);
    $grants_amount_total = floatval($g_res['tot'] ?? 0);

    $total_patents = intval($con->query("SELECT count(*) FROM patents_master")->fetchColumn());
    $total_publications = intval($con->query("SELECT count(*) FROM publications_master")->fetchColumn());
    $total_awards = intval($con->query("SELECT count(*) FROM awards_master")->fetchColumn());
} catch (Exception $e) {
}

$total_ipr = $total_grants + $total_patents + $total_publications + $total_awards;

// ---------------------------------------------------------
// 6. UPCOMING CRITICAL DEADLINES TIMELINE (Radar Feed)
// ---------------------------------------------------------
$critical_radar = [];

// From Projects
foreach ($projects_list as $p) {
    if (!empty($p['deadline']) && $p['deadline'] !== '0000-00-00' && strtolower(trim($p['status'] ?? '')) !== 'completed') {
        $diff = floor((strtotime($p['deadline']) - strtotime($today)) / 86400);
        $critical_radar[] = [
            'type' => 'Project',
            'title' => $p['project_code'] . ' - ' . $p['project_name'],
            'assigned' => !empty($p['project_lead']) ? $p['project_lead'] : 'R&D Team',
            'date' => $p['deadline'],
            'diff' => $diff,
            'action' => 'projects()'
        ];
    }
}

// From CSR Next Visits
foreach ($csr_list as $c) {
    if (!empty($c['next_visit_planned']) && $c['next_visit_planned'] !== '0000-00-00') {
        $diff = floor((strtotime($c['next_visit_planned']) - strtotime($today)) / 86400);
        $critical_radar[] = [
            'type' => 'CSR Visit',
            'title' => 'CSR: ' . $c['project_name'],
            'assigned' => !empty($c['assigned_team']) ? $c['assigned_team'] : 'Service Team',
            'date' => $c['next_visit_planned'],
            'diff' => $diff,
            'action' => 'csr()'
        ];
    }
}

// From Grants Deadlines
try {
    $grants_stmt = $con->query("SELECT * FROM grants_master WHERE status != 'completed' AND deadline IS NOT NULL AND deadline != '0000-00-00'");
    while ($g = $grants_stmt->fetch(PDO::FETCH_ASSOC)) {
        $diff = floor((strtotime($g['deadline']) - strtotime($today)) / 86400);
        $critical_radar[] = [
            'type' => 'Grant Due',
            'title' => 'Grant: ' . $g['grant_name'],
            'assigned' => $g['applied_by'] ?? 'Management',
            'date' => $g['deadline'],
            'diff' => $diff,
            'action' => 'grants()'
        ];
    }
} catch (Exception $e) {
}

// Sort Radar items: Overdue first, then nearest upcoming
usort($critical_radar, function ($a, $b) {
    return $a['diff'] <=> $b['diff'];
});
?>

<!-- CEO Dashboard Custom Styles -->
<style>
    .ceo-dashboard-container {
        font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        color: #2c3e50;
        padding-bottom: 50px;
    }

    /* Executive Banner */
    .ceo-hero-banner {
        background: linear-gradient(135deg, #0b2545 0%, #134074 50%, #009EE3 100%);
        border-radius: 14px;
        padding: 24px 28px;
        color: #ffffff;
        box-shadow: 0 8px 24px rgba(11, 37, 69, 0.18);
        position: relative;
        overflow: hidden;
        margin-bottom: 24px;
    }

    .ceo-hero-banner::after {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 220px;
        height: 220px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.12) 0%, rgba(255, 255, 255, 0) 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .ceo-badge-role {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(4px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #fff;
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
    }

    /* Quick Navigation Toolbar */
    .ceo-nav-pill {
        background: rgba(255, 255, 255, 0.15);
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 8px;
        padding: 7px 14px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        margin-right: 8px;
        margin-top: 6px;
        text-decoration: none !important;
    }

    .ceo-nav-pill:hover {
        background: #ffffff;
        color: #0b2545;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Stat Cards */
    .ceo-stat-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 20px 18px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        border: 1px solid #edf2f7;
        transition: all 0.25s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }

    .ceo-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.09);
        border-color: #cbd5e1;
    }

    .ceo-stat-card.alert-border {
        border-left: 5px solid #dc3545;
    }

    .ceo-stat-card.warning-border {
        border-left: 5px solid #f59e0b;
    }

    .ceo-stat-card.success-border {
        border-left: 5px solid #10b981;
    }

    .ceo-stat-card.primary-border {
        border-left: 5px solid #009EE3;
    }

    .ceo-stat-card.purple-border {
        border-left: 5px solid #8b5cf6;
    }

    .ceo-stat-card.cyan-border {
        border-left: 5px solid #06b6d4;
    }

    .ceo-stat-icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .ceo-stat-number {
        font-size: 28px;
        font-weight: 700;
        line-height: 1.2;
        margin-top: 10px;
        margin-bottom: 2px;
    }

    .ceo-stat-title {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin: 0;
    }

    .ceo-stat-meta {
        font-size: 12px;
        color: #64748b;
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px dashed #e2e8f0;
    }

    /* Charts & Section Cards */
    .ceo-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        border: 1px solid #edf2f7;
        margin-bottom: 24px;
        overflow: hidden;
    }

    .ceo-card-header {
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        padding: 16px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .ceo-card-title {
        font-size: 16px;
        font-weight: 700;
        color: #ed5d00;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .ceo-card-body {
        padding: 20px 22px;
    }

    /* Employee / Resource Badge Styling */
    .emp-resource-badge {
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #e2e8f0;
        padding: 4px 9px;
        border-radius: 14px;
        font-size: 11.5px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        margin: 2px 3px 2px 0;
        transition: all 0.2s;
    }

    .emp-resource-badge:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    .emp-resource-badge i {
        color: #009EE3;
        margin-right: 4px;
    }

    /* Urgency Deadlines Badge */
    .badge-urgent-overdue {
        background-color: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fca5a5;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
    }

    .badge-urgent-soon {
        background-color: #fef3c7;
        color: #b45309;
        border: 1px solid #fcd34d;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
    }

    .badge-urgent-safe {
        background-color: #dcfce7;
        color: #15803d;
        border: 1px solid #86efac;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
    }

    /* Modern Table */
    .ceo-table {
        margin-bottom: 0;
        font-size: 13.5px;
    }

    .ceo-table thead th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11.5px;
        letter-spacing: 0.5px;
        border-top: none;
        border-bottom: 2px solid #e2e8f0;
        padding: 12px 14px;
        vertical-align: middle;
    }

    .ceo-table tbody td {
        padding: 14px;
        vertical-align: middle;
        border-top: 1px solid #f1f5f9;
    }

    .ceo-table tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Radar item in deadline watchlist */
    .radar-item {
        border-left: 4px solid #cbd5e1;
        padding: 12px 14px;
        background: #f8fafc;
        border-radius: 0 8px 8px 0;
        margin-bottom: 10px;
        transition: all 0.2s;
        cursor: pointer;
    }

    .radar-item:hover {
        background: #f1f5f9;
        transform: translateX(3px);
    }

    .radar-item.radar-overdue {
        border-left-color: #ef4444;
        background: #fff5f5;
    }

    .radar-item.radar-soon {
        border-left-color: #f59e0b;
        background: #fffbeb;
    }

    .radar-item.radar-safe {
        border-left-color: #10b981;
    }

    /* Pulse Animation for Critical Alerts */
    .pulse-red {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #ef4444;
        box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
        animation: pulseRedAnim 1.6s infinite;
        margin-right: 6px;
    }

    @keyframes pulseRedAnim {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
        }

        70% {
            transform: scale(1);
            box-shadow: 0 0 0 6px rgba(239, 68, 68, 0);
        }

        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
        }
    }
</style>

<div class="ceo-dashboard-container mt-2">

    <!-- 1. EXECUTIVE HERO BANNER -->
    <div class="ceo-hero-banner">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="d-flex align-items-center mb-2">
                    <span class="ceo-badge-role mr-2">
                        <i class="fas fa-crown text-warning mr-1"></i> Managing Director / CEO Dashboard
                    </span>
                    <span class="text-white-50 small">
                        <i class="far fa-calendar-alt ml-1 mr-1"></i> <?php echo date('D, d M Y'); ?>
                    </span>
                </div>
                <h3 class="font-weight-bold mb-1" style="color: #ffffff; letter-spacing: -0.5px;">
                    Welcome, <?php echo htmlspecialchars($_SESSION['fullname'] ?? 'Chief Executive Officer'); ?>
                </h3>
                <p class="text-white-50 mb-3" style="font-size: 14px;">
                    Strategic oversight of R&D projects, personnel allocation, field deployments, and operational deliverables.
                </p>

                <!-- Quick Navigation Action Toolbar -->
                <div class="d-flex flex-wrap align-items-center">
                    <a href="javascript:void(0)" onclick="projects()" class="ceo-nav-pill">
                        <i class="fas fa-project-diagram mr-2 text-info"></i> Projects (<?php echo $total_projects; ?>)
                    </a>
                    <a href="javascript:void(0)" onclick="csr()" class="ceo-nav-pill">
                        <i class="fas fa-hands-helping mr-2 text-success"></i> CSR Field (<?php echo $total_csr; ?>)
                    </a>
                    <a href="javascript:void(0)" onclick="collaborations()" class="ceo-nav-pill">
                        <i class="fas fa-handshake mr-2 text-warning"></i> Collaborations (<?php echo $total_collab; ?>)
                    </a>
                    <a href="javascript:void(0)" onclick="laboratory_requirement()" class="ceo-nav-pill">
                        <i class="fas fa-flask mr-2 text-cyan"></i> Lab Indents (<?php echo $total_lab_req; ?>)
                    </a>
                    <a href="javascript:void(0)" onclick="grants()" class="ceo-nav-pill">
                        <i class="fas fa-award mr-2 text-warning"></i> Grants & IPR (<?php echo $total_ipr; ?>)
                    </a>
                    <a href="index.php" class="ceo-nav-pill" title="Refresh Dashboard">
                        <i class="fas fa-sync-alt mr-1"></i> Refresh
                    </a>
                </div>
            </div>

            <!-- Urgent Attention Highlight Pill in Banner -->
            <div class="col-lg-5 text-lg-right mt-3 mt-lg-0">
                <div class="d-inline-block text-left p-3 rounded" style="background: rgba(0, 0, 0, 0.25); border: 1px solid rgba(255,255,255,0.15); min-width: 280px;">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-white small font-weight-bold text-uppercase">
                            <i class="fas fa-bell text-warning mr-1"></i> Executive Attention
                        </span>
                        <?php if ($overdue_projects > 0): ?>
                            <span class="badge badge-danger"><span class="pulse-red"></span><?php echo $overdue_projects; ?> Overdue</span>
                        <?php else: ?>
                            <span class="badge badge-success"><i class="fas fa-check-circle mr-1"></i>On Schedule</span>
                        <?php endif; ?>
                    </div>
                    <div class="small text-white-50 mb-1">
                        • <strong><?php echo $overdue_projects; ?></strong> Projects past deadline<br>
                        • <strong><?php echo $due_soon_projects; ?></strong> Projects due in next 7 days<br>
                        • <strong><?php echo $csr_not_working; ?></strong> CSR machines requiring maintenance
                    </div>
                    <div class="mt-2 text-right">
                        <button onclick="$('html, body').animate({scrollTop: $('#projectsMatrixSection').offset().top - 80}, 500);" class="btn btn-xs btn-outline-light font-weight-bold">
                            Review Deliverables <i class="fas fa-arrow-down ml-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. EXECUTIVE KPI CARDS ROW -->
    <div class="row mb-4">
        <!-- Card 1: Projects Total -->
        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
            <div class="ceo-stat-card primary-border" onclick="projects()" style="cursor: pointer;">
                <div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ceo-stat-title">Total Projects</span>
                        <div class="ceo-stat-icon-wrapper" style="background: #e0f2fe; color: #0284c7;">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                    </div>
                    <div class="ceo-stat-number text-dark"><?php echo $total_projects; ?></div>
                </div>
                <div class="ceo-stat-meta">
                    <span class="text-success font-weight-bold"><i class="fas fa-circle mr-1" style="font-size: 8px;"></i><?php echo $active_projects; ?> Active</span>
                    <span class="text-muted ml-2">| <?php echo $completed_projects; ?> Done</span>
                </div>
            </div>
        </div>

        <!-- Card 2: Deadlines Urgency -->
        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
            <div class="ceo-stat-card <?php echo ($overdue_projects > 0) ? 'alert-border' : ($due_soon_projects > 0 ? 'warning-border' : 'success-border'); ?>">
                <div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ceo-stat-title">Critical Due</span>
                        <div class="ceo-stat-icon-wrapper" style="background: <?php echo ($overdue_projects > 0) ? '#fee2e2' : '#fef3c7'; ?>; color: <?php echo ($overdue_projects > 0) ? '#dc2626' : '#d97706'; ?>;">
                            <i class="fas fa-stopwatch"></i>
                        </div>
                    </div>
                    <div class="ceo-stat-number <?php echo ($overdue_projects > 0) ? 'text-danger' : 'text-warning'; ?>">
                        <?php echo ($overdue_projects + $due_soon_projects); ?>
                    </div>
                </div>
                <div class="ceo-stat-meta">
                    <span class="text-danger font-weight-bold"><?php echo $overdue_projects; ?> Overdue</span>
                    <span class="text-warning font-weight-bold ml-1">| <?php echo $due_soon_projects; ?> &le; 7d</span>
                </div>
            </div>
        </div>

        <!-- Card 3: CSR Field Health -->
        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
            <div class="ceo-stat-card success-border" onclick="csr()" style="cursor: pointer;">
                <div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ceo-stat-title">CSR Units</span>
                        <div class="ceo-stat-icon-wrapper" style="background: #dcfce7; color: #16a34a;">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                    </div>
                    <div class="ceo-stat-number text-dark"><?php echo $total_csr; ?></div>
                </div>
                <div class="ceo-stat-meta">
                    <span class="text-success font-weight-bold"><?php echo $csr_working; ?> Working</span>
                    <span class="text-danger font-weight-bold ml-2"><?php echo $csr_not_working; ?> Service</span>
                </div>
            </div>
        </div>

        <!-- Card 4: Collaborations -->
        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
            <div class="ceo-stat-card purple-border" onclick="collaborations()" style="cursor: pointer;">
                <div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ceo-stat-title">Collaborations</span>
                        <div class="ceo-stat-icon-wrapper" style="background: #f3e8ff; color: #9333ea;">
                            <i class="fas fa-handshake"></i>
                        </div>
                    </div>
                    <div class="ceo-stat-number text-dark"><?php echo $total_collab; ?></div>
                </div>
                <div class="ceo-stat-meta">
                    <span class="text-purple font-weight-bold"><?php echo $collab_mous; ?> MoUs</span>
                    <span class="text-muted ml-2">| <?php echo $collab_ndas; ?> NDAs</span>
                </div>
            </div>
        </div>

        <!-- Card 5: Grants & IPR -->
        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
            <div class="ceo-stat-card warning-border" onclick="grants()" style="cursor: pointer;">
                <div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ceo-stat-title">R&D / IPR</span>
                        <div class="ceo-stat-icon-wrapper" style="background: #fef3c7; color: #d97706;">
                            <i class="fas fa-award"></i>
                        </div>
                    </div>
                    <div class="ceo-stat-number text-dark"><?php echo $total_ipr; ?></div>
                </div>
                <div class="ceo-stat-meta">
                    <span class="text-dark font-weight-bold"><?php echo $total_patents; ?> Pat | <?php echo $total_publications; ?> Pub</span>
                    <span class="text-muted ml-1">| <?php echo $total_grants; ?> Grnt</span>
                </div>
            </div>
        </div>

        <!-- Card 6: Laboratory Indents -->
        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
            <div class="ceo-stat-card cyan-border" onclick="laboratory_requirement()" style="cursor: pointer;">
                <div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ceo-stat-title">Lab Indents</span>
                        <div class="ceo-stat-icon-wrapper" style="background: #cffafe; color: #0891b2;">
                            <i class="fas fa-flask"></i>
                        </div>
                    </div>
                    <div class="ceo-stat-number text-dark"><?php echo $total_lab_req; ?></div>
                </div>
                <div class="ceo-stat-meta">
                    <span class="text-success font-weight-bold"><?php echo $lab_received; ?> Done</span>
                    <span class="text-warning font-weight-bold ml-2"><?php echo $lab_pending; ?> Pending</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. VISUAL ANALYTICS & CHARTS ROW -->
    <div class="row mb-4">
        <!-- Chart 1: Project Timeline Urgency -->
        <div class="col-lg-4 mb-3">
            <div class="ceo-card h-100">
                <div class="ceo-card-header">
                    <h5 class="ceo-card-title">
                        <i class="fas fa-chart-pie mr-2 text-primary"></i> Project Timeline Health
                    </h5>
                    <span class="badge badge-light border">Deadlines</span>
                </div>
                <div class="ceo-card-body d-flex flex-column justify-content-between">
                    <div style="position: relative; height: 210px; width: 100%;">
                        <canvas id="chartProjectUrgency"></canvas>
                    </div>
                    <div class="row text-center mt-3 pt-2 border-top">
                        <div class="col-3">
                            <span class="d-block font-weight-bold text-danger"><?php echo $overdue_projects; ?></span>
                            <small class="text-muted" style="font-size: 11px;">Overdue</small>
                        </div>
                        <div class="col-3">
                            <span class="d-block font-weight-bold text-warning"><?php echo $due_soon_projects; ?></span>
                            <small class="text-muted" style="font-size: 11px;">&le; 7 Days</small>
                        </div>
                        <div class="col-3">
                            <span class="d-block font-weight-bold text-success"><?php echo $safe_projects; ?></span>
                            <small class="text-muted" style="font-size: 11px;">On Track</small>
                        </div>
                        <div class="col-3">
                            <span class="d-block font-weight-bold text-info"><?php echo $completed_projects; ?></span>
                            <small class="text-muted" style="font-size: 11px;">Done</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart 2: CSR Field Condition -->
        <div class="col-lg-4 mb-3">
            <div class="ceo-card h-100">
                <div class="ceo-card-header">
                    <h5 class="ceo-card-title">
                        <i class="fas fa-tachometer-alt mr-2 text-success"></i> CSR Deployment Health
                    </h5>
                    <button class="btn btn-xs btn-outline-success font-weight-bold" onclick="csr()">
                        Manage <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                </div>
                <div class="ceo-card-body d-flex flex-column justify-content-between">
                    <div style="position: relative; height: 210px; width: 100%;">
                        <canvas id="chartCsrHealth"></canvas>
                    </div>
                    <div class="mt-3 pt-2 border-top d-flex justify-content-around text-center">
                        <div>
                            <span class="text-muted small d-block">Working Units</span>
                            <span class="font-weight-bold text-success" style="font-size: 16px;">
                                <i class="fas fa-check-circle mr-1"></i><?php echo $csr_working; ?> / <?php echo $total_csr; ?>
                            </span>
                        </div>
                        <div style="border-left: 1px solid #e2e8f0;"></div>
                        <div>
                            <span class="text-muted small d-block">Visits Logged</span>
                            <span class="font-weight-bold text-primary" style="font-size: 16px;">
                                <i class="fas fa-route mr-1"></i><?php echo $total_csr_visits; ?> Visits
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart 3: Business Process Assets Breakdown -->
        <div class="col-lg-4 mb-3">
            <div class="ceo-card h-100">
                <div class="ceo-card-header">
                    <h5 class="ceo-card-title">
                        <i class="fas fa-chart-bar mr-2 text-warning"></i> Business Process Pipeline
                    </h5>
                    <span class="badge badge-warning text-dark font-weight-bold">Summary</span>
                </div>
                <div class="ceo-card-body">
                    <div style="position: relative; height: 250px; width: 100%;">
                        <canvas id="chartPipelineOverview"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. CORE MODULE: PROJECTS & ALLOCATED PERSONNEL ROSTER -->
    <!-- "projects yaru yaru entha project la work pannura important details la oru main page la show agaure matiri venum" -->
    <div class="ceo-card mb-4" id="projectsMatrixSection">
        <div class="ceo-card-header flex-wrap">
            <div>
                <h5 class="ceo-card-title">
                    <i class="fas fa-users-cog mr-2 text-primary"></i> Projects &amp; Personnel Resource Matrix
                </h5>
                <small class="text-muted">
                    Real-time visibility into project deadlines, leads, and allocated team members working on each deliverable.
                </small>
            </div>
            <div class="d-flex align-items-center mt-2 mt-md-0">
                <div class="input-group input-group-sm mr-2" style="width: 260px;">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-right-0"><i class="fas fa-search text-muted"></i></span>
                    </div>
                    <input type="text" id="filterProjectInput" class="form-control border-left-0" placeholder="Filter by project or staff...">
                </div>
                <button onclick="projects()" class="btn btn-sm btn-primary shadow-sm font-weight-bold">
                    <i class="fas fa-external-link-alt mr-1"></i> Open Projects
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table ceo-table table-hover" id="ceoProjectsTable">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th style="width: 220px;">Project &amp; Code</th>
                        <th style="width: 180px;">Project Lead</th>
                        <th>Personnel Working on Project (Resources Allocated)</th>
                        <th style="width: 170px;">Partner / MoU</th>
                        <th style="width: 180px;">Deadline &amp; Urgency</th>
                        <th style="width: 110px;">Status</th>
                        <th style="width: 90px; text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($projects_list)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="fas fa-folder-open fa-2x mb-2 d-block"></i>
                                No projects recorded yet in the Business Process module.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $sno = 1;
                        foreach ($projects_list as $row):
                            // Urgency calculations
                            $deadline_display = '-';
                            $urgency_badge = '';
                            $row_class = '';
                            $is_overdue = false;

                            if (!empty($row['deadline']) && $row['deadline'] !== '0000-00-00') {
                                $d_time = strtotime($row['deadline']);
                                $t_time = strtotime($today);
                                $diff_days = floor(($d_time - $t_time) / 86400);
                                $deadline_formatted = date('d M Y', $d_time);

                                if (strtolower(trim($row['status'] ?? '')) === 'completed') {
                                    $urgency_badge = '<span class="badge-urgent-safe"><i class="fas fa-check mr-1"></i> Completed</span><div class="small text-muted mt-1">' . $deadline_formatted . '</div>';
                                } elseif ($diff_days < 0) {
                                    $is_overdue = true;
                                    $row_class = 'table-danger-subtle';
                                    $urgency_badge = '<span class="badge-urgent-overdue"><i class="fas fa-exclamation-circle mr-1"></i> Overdue (' . abs($diff_days) . 'd)</span><div class="small text-danger font-weight-bold mt-1">' . $deadline_formatted . '</div>';
                                } elseif ($diff_days <= 7) {
                                    $urgency_badge = '<span class="badge-urgent-soon"><i class="fas fa-hourglass-half mr-1"></i> Due in ' . $diff_days . 'd</span><div class="small text-warning font-weight-bold mt-1">' . $deadline_formatted . '</div>';
                                } else {
                                    $urgency_badge = '<span class="badge-urgent-safe"><i class="fas fa-calendar-alt mr-1"></i> ' . $diff_days . ' days left</span><div class="small text-muted mt-1">' . $deadline_formatted . '</div>';
                                }
                            } else {
                                $urgency_badge = '<span class="badge badge-light text-muted">No deadline set</span>';
                            }

                            // Parse resource_used into separate employee badges
                            $resources_raw = trim($row['resource_used'] ?? '');
                            $resource_badges_html = '';
                            if (!empty($resources_raw)) {
                                $emp_arr = array_map('trim', explode(',', $resources_raw));
                                foreach ($emp_arr as $emp_str) {
                                    if (!empty($emp_str)) {
                                        $resource_badges_html .= '<span class="emp-resource-badge"><i class="fas fa-user-check"></i> ' . htmlspecialchars($emp_str) . '</span> ';
                                    }
                                }
                            } else {
                                $resource_badges_html = '<span class="text-muted small font-italic"><i class="fas fa-user-slash mr-1"></i> No personnel assigned</span>';
                            }

                            // Status badge
                            $st = trim($row['status'] ?? 'Pending');
                            $status_badge_class = 'badge-secondary';
                            if ($st === 'In Progress') $status_badge_class = 'badge-primary';
                            elseif ($st === 'Under Review') $status_badge_class = 'badge-warning text-dark';
                            elseif ($st === 'Completed') $status_badge_class = 'badge-success';
                            elseif ($st === 'On Hold') $status_badge_class = 'badge-danger';
                        ?>
                            <tr class="project-table-row <?php echo $row_class; ?>">
                                <td class="font-weight-bold text-muted"><?php echo $sno++; ?></td>

                                <!-- Project Code & Name -->
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-2">
                                            <span class="badge badge-info font-weight-bold" style="font-size: 11px;">
                                                <?php echo htmlspecialchars($row['project_code'] ?? 'AN-'); ?>
                                            </span>
                                        </div>
                                        <div>
                                            <strong class="d-block text-dark font-weight-bold" style="font-size: 14px;">
                                                <?php echo htmlspecialchars($row['project_name'] ?? 'Untitled Project'); ?>
                                            </strong>
                                            <?php if (!empty($row['report_file'])): ?>
                                                <a href="qvision/BusinessProcess/projects/uploads/<?php echo htmlspecialchars($row['report_file']); ?>" target="_blank" class="small text-primary font-weight-bold">
                                                    <i class="fas fa-paperclip mr-1"></i> View Report
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>

                                <!-- Project Lead -->
                                <td>
                                    <?php if (!empty($row['project_lead'])): ?>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-light border text-primary d-flex align-items-center justify-content-center mr-2" style="width: 30px; height: 30px; font-size: 12px;">
                                                <i class="fas fa-user-tie"></i>
                                            </div>
                                            <span class="font-weight-bold text-dark">
                                                <?php echo htmlspecialchars($row['project_lead']); ?>
                                            </span>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted small">-</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Personnel Working on Project -->
                                <td>
                                    <div class="d-flex flex-wrap align-items-center">
                                        <?php echo $resource_badges_html; ?>
                                    </div>
                                </td>

                                <!-- Collaborated Partner -->
                                <td>
                                    <?php if (!empty($row['collaborator_name'])): ?>
                                        <div>
                                            <strong class="text-primary font-weight-bold">
                                                <i class="fas fa-handshake mr-1"></i><?php echo htmlspecialchars($row['collaborator_name']); ?>
                                            </strong>
                                            <?php if (!empty($row['collab_type'])): ?>
                                                <span class="badge badge-light border d-block mt-1" style="width: fit-content; font-size: 10px;">
                                                    <?php echo htmlspecialchars($row['collab_type']); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="badge badge-light text-muted border">Internal</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Deadline & Urgency Highlight -->
                                <td>
                                    <?php echo $urgency_badge; ?>
                                </td>

                                <!-- Status -->
                                <td>
                                    <span class="badge <?php echo $status_badge_class; ?> px-2 py-1" style="font-size: 11.5px;">
                                        <?php echo htmlspecialchars($st); ?>
                                    </span>
                                </td>

                                <!-- Action -->
                                <td style="text-align: center;">
                                    <button onclick="projects()" class="btn btn-xs btn-outline-primary" title="View details in Projects Module">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- 5. OPERATIONAL WATCHLISTS (CSR FIELD & CRITICAL DEADLINES RADAR) -->
    <div class="row">
        <!-- CSR Field Deployments Feed -->
        <div class="col-lg-6 mb-3">
            <div class="ceo-card h-100">
                <div class="ceo-card-header">
                    <div>
                        <h5 class="ceo-card-title">
                            <i class="fas fa-hands-helping mr-2 text-success"></i> CSR Field Machines Overview
                        </h5>
                        <small class="text-muted">Field operations, maintenance health, and next scheduled service visits.</small>
                    </div>
                    <button onclick="csr()" class="btn btn-xs btn-outline-success font-weight-bold">
                        View All <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                </div>
                <div class="ceo-card-body p-0">
                    <div class="table-responsive">
                        <table class="table ceo-table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Project Unit</th>
                                    <th>Condition</th>
                                    <th>Visits</th>
                                    <th>Next Scheduled Visit</th>
                                    <th>Service Team</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($csr_list)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-3 text-muted">No CSR units logged.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach (array_slice($csr_list, 0, 5) as $csr_item):
                                        $cond = trim($csr_item['condition_status'] ?? 'Working');
                                        $cond_badge = ($cond === 'Working')
                                            ? '<span class="badge badge-success"><i class="fas fa-check-circle mr-1"></i>Working</span>'
                                            : '<span class="badge badge-danger"><i class="fas fa-tools mr-1"></i>Service Req</span>';
                                    ?>
                                        <tr>
                                            <td>
                                                <strong class="text-dark"><?php echo htmlspecialchars($csr_item['project_name']); ?></strong>
                                                <div class="small text-muted"><?php echo htmlspecialchars($csr_item['installation_status'] ?? ''); ?></div>
                                            </td>
                                            <td><?php echo $cond_badge; ?></td>
                                            <td>
                                                <span class="badge badge-light border font-weight-bold">
                                                    <?php echo intval($csr_item['visits_completed']); ?> Visits
                                                </span>
                                            </td>
                                            <td>
                                                <?php if (!empty($csr_item['next_visit_planned']) && $csr_item['next_visit_planned'] !== '0000-00-00'): ?>
                                                    <span class="font-weight-bold text-dark">
                                                        <i class="far fa-calendar-alt text-primary mr-1"></i>
                                                        <?php echo date('d M Y', strtotime($csr_item['next_visit_planned'])); ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="text-muted small">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <small class="font-weight-bold text-secondary">
                                                    <?php echo htmlspecialchars($csr_item['assigned_team'] ?? '-'); ?>
                                                </small>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Critical Deadlines & Deliverables Radar -->
        <div class="col-lg-6 mb-3">
            <div class="ceo-card h-100">
                <div class="ceo-card-header">
                    <div>
                        <h5 class="ceo-card-title">
                            <i class="fas fa-crosshairs mr-2 text-danger"></i> Critical Deliverables &amp; Deadlines Radar
                        </h5>
                        <small class="text-muted">Priority items sorted by nearest urgency for CEO monitoring.</small>
                    </div>
                    <span class="badge badge-danger font-weight-bold"><?php echo count($critical_radar); ?> Tracked</span>
                </div>
                <div class="ceo-card-body p-3" style="max-height: 380px; overflow-y: auto;">
                    <?php if (empty($critical_radar)): ?>
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-calendar-check fa-2x mb-2 text-success d-block"></i>
                            All deliverables and milestones are currently on track!
                        </div>
                    <?php else: ?>
                        <?php foreach (array_slice($critical_radar, 0, 8) as $item):
                            $r_class = 'radar-safe';
                            $r_badge = '';
                            if ($item['diff'] < 0) {
                                $r_class = 'radar-overdue';
                                $r_badge = '<span class="badge badge-danger font-weight-bold"><span class="pulse-red"></span>Overdue by ' . abs($item['diff']) . 'd</span>';
                            } elseif ($item['diff'] <= 7) {
                                $r_class = 'radar-soon';
                                $r_badge = '<span class="badge badge-warning text-dark font-weight-bold"><i class="fas fa-clock mr-1"></i>Due in ' . $item['diff'] . 'd</span>';
                            } else {
                                $r_badge = '<span class="badge badge-success font-weight-bold"><i class="fas fa-calendar-check mr-1"></i>In ' . $item['diff'] . 'd</span>';
                            }
                        ?>
                            <div class="radar-item <?php echo $r_class; ?>" onclick="<?php echo $item['action']; ?>">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <span class="badge badge-light border text-uppercase font-weight-bold" style="font-size: 10px;">
                                        <?php echo htmlspecialchars($item['type']); ?>
                                    </span>
                                    <?php echo $r_badge; ?>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <strong class="text-dark d-block" style="font-size: 13.5px;">
                                            <?php echo htmlspecialchars($item['title']); ?>
                                        </strong>
                                        <small class="text-muted">
                                            <i class="fas fa-user-circle mr-1"></i> <?php echo htmlspecialchars($item['assigned']); ?>
                                        </small>
                                    </div>
                                    <div class="text-right">
                                        <span class="small font-weight-bold text-dark d-block">
                                            <?php echo date('d M Y', strtotime($item['date'])); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Chart.js & Dashboard Interactivity Scripts -->
<script>
    function initCeoDashboard() {
        // 1. Live Filter for Projects & Staff Table
        $('#filterProjectInput').off('keyup').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('#ceoProjectsTable tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        // 2. Initialize Charts when Chart.js is ready
        if (typeof Chart !== 'undefined') {
            initCeoCharts();
        } else {
            var chartInterval = setInterval(function() {
                if (typeof Chart !== 'undefined') {
                    clearInterval(chartInterval);
                    initCeoCharts();
                }
            }, 200);
        }
    }

    if (document.readyState === 'loading') {
        $(document).ready(initCeoDashboard);
    } else {
        initCeoDashboard();
    }

    function initCeoCharts() {
        // Chart 1: Project Urgency (Doughnut)
        var ctxProj = document.getElementById('chartProjectUrgency');
        if (ctxProj) {
            new Chart(ctxProj.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Overdue', 'Due <= 7 Days', 'On Track', 'Completed'],
                    datasets: [{
                        data: [
                            <?php echo $overdue_projects; ?>,
                            <?php echo $due_soon_projects; ?>,
                            <?php echo $safe_projects; ?>,
                            <?php echo $completed_projects; ?>
                        ],
                        backgroundColor: ['#ef4444', '#f59e0b', '#10b981', '#0ea5e9'],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            fontSize: 11,
                            fontColor: '#475569'
                        }
                    },
                    cutoutPercentage: 65
                }
            });
        }

        // Chart 2: CSR Field Condition (Doughnut)
        var ctxCsr = document.getElementById('chartCsrHealth');
        if (ctxCsr) {
            new Chart(ctxCsr.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Working', 'Service / Needs Repair'],
                    datasets: [{
                        data: [<?php echo $csr_working; ?>, <?php echo $csr_not_working; ?>],
                        backgroundColor: ['#10b981', '#ef4444'],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            fontSize: 11,
                            fontColor: '#475569'
                        }
                    },
                    cutoutPercentage: 65
                }
            });
        }

        // Chart 3: Pipeline Overview (Bar Chart)
        var ctxPipeline = document.getElementById('chartPipelineOverview');
        if (ctxPipeline) {
            new Chart(ctxPipeline.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Projects', 'CSR Units', 'Collabs', 'Grants', 'Patents', 'Pubs', 'Awards'],
                    datasets: [{
                        label: 'Total Assets / Records',
                        data: [
                            <?php echo $total_projects; ?>,
                            <?php echo $total_csr; ?>,
                            <?php echo $total_collab; ?>,
                            <?php echo $total_grants; ?>,
                            <?php echo $total_patents; ?>,
                            <?php echo $total_publications; ?>,
                            <?php echo $total_awards; ?>
                        ],
                        backgroundColor: [
                            'rgba(0, 158, 227, 0.8)',
                            'rgba(16, 185, 129, 0.8)',
                            'rgba(147, 51, 234, 0.8)',
                            'rgba(245, 158, 11, 0.8)',
                            'rgba(239, 68, 68, 0.8)',
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(236, 72, 153, 0.8)'
                        ],
                        borderColor: [
                            '#009EE3', '#10b981', '#9333ea', '#f59e0b', '#ef4444', '#3b82f6', '#ec4899'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                precision: 0,
                                fontColor: '#64748b'
                            },
                            gridLines: {
                                color: '#f1f5f9',
                                zeroLineColor: '#cbd5e1'
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                fontColor: '#64748b',
                                fontSize: 11
                            },
                            gridLines: {
                                display: false
                            }
                        }]
                    }
                }
            });
        }
    }
</script>