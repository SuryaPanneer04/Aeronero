<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../../connect.php';   // $con (PDO)
date_default_timezone_set("Asia/Kolkata");
$session_username = trim($_SESSION['username'] ?? '');
if ($session_username === '') {
    echo "<p style='color:red;'>Please login first.</p>";
    exit;
}
$rows = [];
$employees = [];          // for dropdown
$is_admin = false;
$today = date('Y-m-d');
$OFFICE_IN = 9 * 60 + 30;    // 09:30 -> before this = Early Coming
$GRACE_END = 9 * 60 + 45;    // 09:45 -> 09:30 to 09:45 = On Time, after 09:45 = Late Coming
$OFFICE_OUT = 17 * 60 + 30;  // 17:30 -> before this = Early Going, after = Late Going
$min_of_day = function ($dt) {
    $t = strtotime($dt);
    return ((int) date('G', $t)) * 60 + (int) date('i', $t);
};
$fmt_hm = function ($m) {
    return sprintf('%02d:%02d', intdiv($m, 60), $m % 60);
};
try {
    // 1. Login username -> user_id + user_group_code
    $stmt = $con->prepare("SELECT user_id, user_group_code FROM z_user_master
                           WHERE user_name = :uname LIMIT 1");
    $stmt->execute([':uname' => $session_username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $groups = array_map('trim', explode(',', (string) $user['user_group_code']));
        $admin_groups = ['R003', 'R001'];
        $is_admin = !empty(array_intersect($admin_groups, $groups));
        if ($is_admin) {
            $stmt2 = $con->prepare("SELECT a.*, u.full_name, m.full_name AS modify_name
                                    FROM employee_attendance_mob a
                                    LEFT JOIN z_user_master u ON u.user_id = a.employee_id
                                    LEFT JOIN z_user_master m ON m.user_name = a.modify_by
                                    ORDER BY a.in_time DESC, a.id DESC");
            $stmt2->execute();
            // Employee name dropdown -> full_name from z_user_master
            $stmt3 = $con->prepare("SELECT DISTINCT full_name
                                    FROM z_user_master
                                    WHERE full_name IS NOT NULL AND full_name <> ''
                                    ORDER BY full_name ASC");
            $stmt3->execute();
            $employees = $stmt3->fetchAll(PDO::FETCH_COLUMN);
        } else {
            $stmt2 = $con->prepare("SELECT a.*, u.full_name
                                    FROM employee_attendance_mob a
                                    LEFT JOIN z_user_master u
                                        ON u.user_id = a.employee_id
                                    WHERE a.employee_id = :eid
                                    ORDER BY a.in_time DESC, a.id DESC");
            $stmt2->execute([':eid' => (string) $user['user_id']]);
        }
        $rows = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) {
    echo "<p style='color:red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<style>
    .content.ms-10 {
        margin-left: 0% !important;
        max-width: 100% !important;
    }

    div.dataTables_wrapper div.dataTables_length select {
        width: 40% !important;
        display: inline-block;
    }

    .dataTables_wrapper .dt-top,
    .dataTables_wrapper .dt-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 10px 0;
        gap: 10px;
        flex-wrap: wrap;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0 !important;
    }

    .dt-filters {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .dt-filters label {
        margin: 0;
        font-weight: 600;
        font-size: 13px;
    }

    .dt-filters input[type="date"],
    .dt-filters select {
        height: 32px;
        padding: 2px 6px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: auto !important;
    }

    .align-middle {
        vertical-align: middle;
    }

    .text-mutted {
        color: #666666 !important;
        font-weight: 300 !important;
    }

    .w-25 {
        width: 25% !important;
    }

    .att-badge {
        display: inline-block;
        padding: 1px 8px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
        margin: 1px 0;
    }

    .att-early {
        background: #e3f2fd;
        color: #1565c0;
    }

    .att-ontime {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .att-late {
        background: #ffebee;
        color: #c62828;
    }

    .att-none {
        background: #f5f5f5;
        color: #757575;
    }

    #attendanceTable_length {
        margin-right: 15px !important;
    }

    /* ---------- Edit Modal (custom, no bootstrap dependency) ---------- */
    .att-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .5);
        z-index: 99999;
        align-items: center;
        justify-content: center;
    }

    .att-modal-overlay.show {
        display: flex;
    }

    .att-modal {
        background: #fff;
        width: 95%;
        max-width: 480px;
        border-radius: 6px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .3);
        overflow: hidden;
    }

    .att-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px;
        background: #1f4e78;
        color: #fff;
    }

    .att-modal-header h5 {
        margin: 0;
        font-size: 17px;
    }

    .att-modal-close {
        background: none;
        border: 0;
        color: #fff;
        font-size: 24px;
        line-height: 1;
        cursor: pointer;
    }

    .att-modal-body {
        padding: 16px;
    }

    .att-modal-body .att-fg {
        margin-bottom: 12px;
    }

    .att-modal-body label {
        display: block;
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .att-modal-body input,
    .att-modal-body textarea {
        width: 100%;
        padding: 6px 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .att-modal-body input[readonly] {
        background: #f3f3f3;
    }

    .att-modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        padding: 12px 16px;
        border-top: 1px solid #eee;
    }

    #attEditMsg {
        font-size: 13px;
        margin-top: 4px;
    }
</style>
<section class="content w-100 ms-10">
    <div class="container-fluid">
        <!-- Moved into .dt-filters when DataTable initializes -->
        <div id="filterTemplate" style="display:none;">
            <label for="fromDate">From</label>
            <input type="date" id="fromDate" value="<?= $today ?>">
            <label for="toDate">To</label>
            <input type="date" id="toDate" value="<?= $today ?>">
            <?php if ($is_admin) { ?>
                <label for="empFilter">Employee</label>
                <select id="empFilter">
                    <option value="">All Employees</option>
                    <?php foreach ($employees as $emp) { ?>
                        <option value="<?= htmlspecialchars($emp) ?>">
                            <?= htmlspecialchars($emp) ?>
                        </option>
                    <?php } ?>
                </select>
                <label for="typeFilter">Attendance Type</label>
                <select id="typeFilter">
                    <option value="">All</option>
                    <optgroup label="In Time">
                        <option value="in:early">Early Coming (before 09:30)</option>
                        <option value="in:ontime">On Time (09:30 - 09:45)</option>
                        <option value="in:late">Late Coming (after 09:45)</option>
                    </optgroup>
                    <optgroup label="Out Time">
                        <option value="out:early">Early Going (before 05:30 PM)</option>
                        <option value="out:ontime">On Time (05:30 PM)</option>
                        <option value="out:late">Late Going (after 05:30 PM)</option>
                    </optgroup>
                </select>
                <button type="button" id="exceldown" class="btn btn-success">Excel</button>
                <button type="button" id="printdown" class="btn btn-success">Print</button>
            <?php } ?>
        </div>
        <div class="table-responsive">
            <table id="attendanceTable" class="display table table-bordered">
                <thead>
                    <tr>
                        <th class="align-middle">S.No</th>
                        <th>Employee Name</th>
                        <?php if ($is_admin) { ?>
                            <th class="align-middle">Attendance Type</th>
                        <?php } ?>
                        <th class="align-middle">Latitude</th>
                        <th class="align-middle">Longitude</th>
                        <th class="align-middle">Area</th>
                        <th class="align-middle">City</th>
                        <th class="align-middle">In Time</th>
                        <th class="align-middle">Out Time</th>
                        <?php if ($is_admin) { ?>
                            <th class="align-middle">Early Coming <span class="text-mutted">(HH:MM)</span></th>
                            <th class="align-middle">Late Coming <span class="text-mutted">(HH:MM)</span></th>
                            <th class="align-middle">Early Going <span class="text-mutted">(HH:MM)</span></th>
                            <th class="align-middle">Late Going <span class="text-mutted">(HH:MM)</span></th>
                        <?php } ?>
                        <th class="align-middle">Log Device</th>
                        <?php if ($is_admin) { ?>
                            <th class="align-middle">Modified_at</th>
                            <th class="align-middle">Modified_by</th>
                            <th class="align-middle">Manage</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($rows as $row) {
                        // Date used for filtering (in_time, or created_at if in_time is empty)
                        $base = $row['in_time'] ?: ($row['created_at'] ?? '');
                        $row_date = $base ? date('Y-m-d', strtotime($base)) : '';
                        /* ---------- Coming calculation ---------- */
                        $in_status = '';          // early | ontime | late
                        $early_coming = '-';
                        $late_coming = '-';
                        $in_label = '';
                        if (!empty($row['in_time'])) {
                            $m = $min_of_day($row['in_time']);
                            if ($m < $OFFICE_IN) {
                                $in_status = 'early';
                                $early_coming = $fmt_hm($OFFICE_IN - $m);
                                $in_label = 'Early Coming';
                            } elseif ($m <= $GRACE_END) {
                                $in_status = 'ontime';
                                $in_label = 'On Time';
                            } else {
                                $in_status = 'late';
                                $late_coming = $fmt_hm($m - $GRACE_END);
                                $in_label = 'Late Coming';
                            }
                        }
                        /* ---------- Going calculation ---------- */
                        $out_status = '';         // early | ontime | late
                        $early_going = '-';
                        $late_going = '-';
                        $out_label = '';
                        if (!empty($row['out_time'])) {
                            $m = $min_of_day($row['out_time']);
                            if ($m < $OFFICE_OUT) {
                                $out_status = 'early';
                                $early_going = $fmt_hm($OFFICE_OUT - $m);
                                $out_label = 'Early Going';
                            } elseif ($m == $OFFICE_OUT) {
                                $out_status = 'ontime';
                                $out_label = 'On Time';
                            } else {
                                $out_status = 'late';
                                $late_going = $fmt_hm($m - $OFFICE_OUT);
                                $out_label = 'Late Going';
                            }
                        }
                        ?>
                        <tr data-date="<?= $row_date ?>" data-emp="<?= htmlspecialchars($row['full_name'] ?? '') ?>"
                            data-in="<?= $in_status ?>" data-out="<?= $out_status ?>">
                            <td><?= $i++ ?></td>
                            <td><?= htmlspecialchars($row['full_name'] ?? '-') ?></td>
                            <?php if ($is_admin) { ?>
                                <td>
                                    <?php if ($in_status !== '') { ?>
                                        <span class="att-badge att-<?= $in_status ?>">IN: <?= $in_label ?></span>
                                    <?php } else { ?>
                                        <span class="att-badge att-none">IN: -</span>
                                    <?php } ?>
                                    <br>
                                    <?php if ($out_status !== '') { ?>
                                        <span class="att-badge att-<?= $out_status ?>">OUT: <?= $out_label ?></span>
                                    <?php } else { ?>
                                        <span class="att-badge att-none">OUT: -</span>
                                    <?php } ?>
                                </td>
                            <?php } ?>
                            <td><?= htmlspecialchars($row['latitude'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['longitude'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['area'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['city'] ?? '') ?></td>
                            <td><?= $row['in_time'] ? date("d-m-Y h:i A", strtotime($row['in_time'])) : '-' ?></td>
                            <td><?= $row['out_time'] ? date("d-m-Y h:i A", strtotime($row['out_time'])) : '-' ?></td>
                            <?php if ($is_admin) { ?>
                                <td><?= $early_coming ?></td>
                                <td><?= $late_coming ?></td>
                                <td><?= $early_going ?></td>
                                <td><?= $late_going ?></td>
                            <?php } ?>
                            <td>
                                <?= $row['log_device'] == 0 ? 'Web' : ($row['log_device'] == 1 ? 'App' : 'Unknown') ?>
                            </td>
                            <?php if ($is_admin) { ?>
                                <td><?= !empty($row['modify_at']) ? date('d-m-Y h:i A', strtotime($row['modify_at'])) : '-' ?>
                                </td>
                                <td><?= htmlspecialchars(($row['modify_name'] ?? '') !== '' ? $row['modify_name'] : (($row['modify_by'] ?? '') !== '' ? $row['modify_by'] : '-')) ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-edit" data-id="<?= (int) $row['id'] ?>"
                                        data-name="<?= htmlspecialchars($row['full_name'] ?? '-') ?>"
                                        data-in="<?= $row['in_time'] ? date('d-m-Y h:i A', strtotime($row['in_time'])) : '-' ?>"
                                        data-intime="<?= $row['in_time'] ? date('Y-m-d\TH:i', strtotime($row['in_time'])) : '' ?>"
                                        data-outtime="<?= $row['out_time'] ? date('Y-m-d\TH:i', strtotime($row['out_time'])) : '' ?>"
                                        data-remark="<?= htmlspecialchars($row['remark'] ?? '') ?>">Edit</button>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php if ($is_admin) { ?>
    <!-- ================= EDIT MODAL ================= -->
    <div class="att-modal-overlay" id="attEditOverlay">
        <div class="att-modal">
            <div class="att-modal-header">
                <h5>Edit Attendance</h5>
                <button type="button" class="att-modal-close" id="attEditClose">&times;</button>
            </div>
            <div class="att-modal-body">
                <input type="hidden" id="attEditId">
                <div class="att-fg">
                    <label>Employee Name</label>
                    <input type="text" id="attEditName" readonly>
                </div>
                <div class="att-fg">
                    <label>In Time</label>
                    <input type="text" id="attEditIn" readonly>
                </div>
                <div class="att-fg">
                    <label for="attEditOut">
                        Out Time
                        <i class="fas fa-trash text-danger" id="clearAttOut" style="cursor:pointer; margin-left:5px;"
                            title="Clear Out Time"></i>
                    </label>
                    <input type="datetime-local" id="attEditOut">
                </div>
                <div class="att-fg">
                    <label for="attEditRemark">Remark</label>
                    <textarea id="attEditRemark" rows="3" maxlength="200" placeholder="Remark (optional)"></textarea>
                </div>
                <div id="attEditMsg"></div>
            </div>
            <div class="att-modal-footer">
                <button type="button" class="btn btn-secondary" id="attEditCancel">Cancel</button>
                <button type="button" class="btn btn-success" id="attEditSave">Update</button>
            </div>
        </div>
    </div>
<?php } ?>
<script>
    (function () {
        var isAdmin = <?= $is_admin ? 'true' : 'false' ?>;
        var XLSX_URL = 'https://cdn.jsdelivr.net/npm/xlsx-js-style@1.2.0/dist/xlsx.bundle.js';
        var UPDATE_URL = '<?= rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') ?>/update_attendance.php';

        /* ---------- Helper: filtered rows -> headers + data ---------- */
        // function getFilteredData(table) {
        //     var headers = [];
        //     $('#attendanceTable thead th').each(function () {
        //         headers.push($(this).text().replace(/\s+/g, ' ').trim());
        //         if (h === 'Manage') return;          // Manage column skip
        //         headers.push(h);
        //     });
        //     var data = [];
        //     // search: 'applied' -> only filtered rows (across all pages)
        //     var nodes = table.rows({search: 'applied', order: 'applied'}).nodes();
        //     $(nodes).each(function (idx, tr) {
        //         var rowArr = [];
        //         $(tr).children('td').each(function (colIdx) {
        //             if (colIdx === 0) {
        //                 rowArr.push(idx + 1);               // S.No re-number
        //             } else {
        //                 var txt = $(this).text().replace(/\s+/g, ' ').trim();
        //                 rowArr.push(txt);
        //             }
        //         });
        //         data.push(rowArr);
        //     });
        //     return {headers: headers, data: data};
        // }
        /* ---------- Helper: filtered rows -> headers + data ---------- */
function getFilteredData(table) {
    var headers = [];
    $('#attendanceTable thead th').each(function () {
        var h = $(this).text().replace(/\s+/g, ' ').trim();
        if (h === 'Manage') return;          // Manage column skip
        headers.push(h);
    });
    var data = [];
    // search: 'applied' -> only filtered rows (across all pages)
    var nodes = table.rows({ search: 'applied', order: 'applied' }).nodes();
    $(nodes).each(function (idx, tr) {
        var rowArr = [];
        var $tds = $(tr).children('td');
        $tds.each(function (colIdx) {
            // Manage = last column (admin only) -> skip
            if (isAdmin && colIdx === $tds.length - 1) return;
            if (colIdx === 0) {
                rowArr.push(idx + 1);               // S.No re-number
            } else {
                var txt = $(this).text().replace(/\s+/g, ' ').trim();
                rowArr.push(txt);
            }
        });
        data.push(rowArr);
    });
    return { headers: headers, data: data };
}
        /* ---------- Helper: current filter summary ---------- */
        function getFilterSummary() {
            var parts = [];
            var from = $('#fromDate').val();
            var to = $('#toDate').val();
            if (from) parts.push('From: ' + from.split('-').reverse().join('-'));
            if (to) parts.push('To: ' + to.split('-').reverse().join('-'));
            if (isAdmin) {
                var emp = $('#empFilter').val();
                parts.push('Employee: ' + (emp || 'All Employees'));
                var typeTxt = $('#typeFilter option:selected').text().trim();
                var typeVal = $('#typeFilter').val();
                parts.push('Attendance Type: ' + (typeVal ? typeTxt : 'All'));
            }
            return parts.join('  |  ');
        }
        function escapeHtml(s) {
            return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;')
                .replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }
        /* ---------- EXCEL ---------- */
        function exportExcel(table) {
            var res = getFilteredData(table);
            if (!res.data.length) {
                alert('No data to export. Please change the filter.');
                return;
            }
            function doExport() {
                var colCount = res.headers.length;
                var HEADER_ROW = 3;                       // 0-based row index of table header
                var aoa = [];
                aoa.push(['Attendance Report']);
                aoa.push([getFilterSummary()]);
                aoa.push([]);
                aoa.push(res.headers);
                res.data.forEach(function (r) {aoa.push(r);});
                var ws = XLSX.utils.aoa_to_sheet(aoa);
                // Title & summary -> merge across all columns and center
                ws['!merges'] = [
                    {s: {r: 0, c: 0}, e: {r: 0, c: colCount - 1}},
                    {s: {r: 1, c: 0}, e: {r: 1, c: colCount - 1}}
                ];
                ws['A1'].s = {
                    font: {bold: true, sz: 16},
                    alignment: {horizontal: 'center', vertical: 'center'}
                };
                ws['A2'].s = {
                    font: {sz: 11},
                    alignment: {horizontal: 'center', vertical: 'center'}
                };
                // ---- Table design ----
                var thin = {style: 'thin', color: {rgb: '999999'}};
                var border = {top: thin, bottom: thin, left: thin, right: thin};
                // Header row: dark blue background, white bold text, border
                for (var c = 0; c < colCount; c++) {
                    var hAddr = XLSX.utils.encode_cell({r: HEADER_ROW, c: c});
                    if (ws[hAddr]) {
                        ws[hAddr].s = {
                            font: {bold: true, color: {rgb: 'FFFFFF'}, sz: 11},
                            fill: {patternType: 'solid', fgColor: {rgb: '1F4E78'}},
                            alignment: {horizontal: 'center', vertical: 'center', wrapText: true},
                            border: border
                        };
                    }
                }
                // Data rows: border + zebra striping, S.No centered
                for (var r = HEADER_ROW + 1; r < aoa.length; r++) {
                    var isAlt = ((r - HEADER_ROW) % 2 === 0);
                    for (var cc = 0; cc < colCount; cc++) {
                        var addr = XLSX.utils.encode_cell({r: r, c: cc});
                        if (!ws[addr]) {
                            ws[addr] = {t: 's', v: ''};
                        }
                        var style = {
                            font: {sz: 11},
                            alignment: {
                                horizontal: (cc === 0) ? 'center' : 'left',
                                vertical: 'center',
                                wrapText: true
                            },
                            border: border
                        };
                        if (isAlt) {
                            style.fill = {patternType: 'solid', fgColor: {rgb: 'EAF1F8'}};
                        }
                        ws[addr].s = style;
                    }
                }
                // Row heights
                ws['!rows'] = [{hpt: 26}, {hpt: 20}, {hpt: 8}, {hpt: 24}];
                // Auto column width
                ws['!cols'] = res.headers.map(function (h, c) {
                    var max = h.length;
                    res.data.forEach(function (row) {
                        var len = String(row[c] == null ? '' : row[c]).length;
                        if (len > max) max = len;
                    });
                    return {wch: Math.min(max + 3, 40)};
                });
                // Freeze header row + filter dropdowns on header
                ws['!freeze'] = {xSplit: 0, ySplit: HEADER_ROW + 1};
                ws['!autofilter'] = {
                    ref: XLSX.utils.encode_range(
                        {r: HEADER_ROW, c: 0},
                        {r: aoa.length - 1, c: colCount - 1}
                    )
                };
                var wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, 'Attendance');
                var from = $('#fromDate').val() || 'all';
                var to = $('#toDate').val() || 'all';
                XLSX.writeFile(wb, 'Attendance_' + from + '_to_' + to + '.xlsx');
            }
            if (window.XLSX) {
                doExport();
            } else {
                $.getScript(XLSX_URL, doExport).fail(function () {
                    alert('Failed to load the Excel library. Please check your internet connection.');
                });
            }
        }
        /* ---------- PRINT ---------- */
        function printTable(table) {
            var res = getFilteredData(table);
            if (!res.data.length) {
                alert('No data to print. Please change the filter.');
                return;
            }
            var html = '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Attendance Report</title>' +
                '<style>' +
                'body{font-family:Arial,sans-serif;font-size:12px;margin:15px;color:#000;}' +
                'h2{margin:0 0 5px 0;text-align:center;font-size:20px;}' +
                '.meta{margin-bottom:10px;font-size:12px;color:#444;text-align:center;}' +
                'table{border-collapse:collapse;width:100%;}' +
                'th,td{border:1px solid #444;padding:4px 6px;text-align:left;vertical-align:middle;}' +
                'th{background:#eee;text-align:center;}' +
                'thead{display:table-header-group;}' +
                'tr{page-break-inside:avoid;}' +
                '@page{size:landscape;margin:10mm;}' +
                '</style></head><body>' +
                '<h2>Attendance Report</h2>' +
                '<div class="meta">' + escapeHtml(getFilterSummary()) +
                '<br>Total Records: ' + res.data.length + '</div>' +
                '<table><thead><tr>';
            res.headers.forEach(function (h) {html += '<th>' + escapeHtml(h) + '</th>';});
            html += '</tr></thead><tbody>';
            res.data.forEach(function (r) {
                html += '<tr>';
                r.forEach(function (c) {html += '<td>' + escapeHtml(c) + '</td>';});
                html += '</tr>';
            });
            html += '</tbody></table></body></html>';
            var w = window.open('', '_blank', 'width=1100,height=700');
            if (!w) {
                alert('Popup is blocked. Please allow popups for this site.');
                return;
            }
            w.document.open();
            w.document.write(html);
            w.document.close();
            w.onload = function () {
                w.focus();
                w.print();
            };
        }
        /* ---------- EDIT MODAL ---------- */
        var $editBtn = null;   // currently edited button

        function openEditModal(btn) {
            $editBtn = $(btn);
            $('#attEditId').val($editBtn.attr('data-id'));
            $('#attEditName').val($editBtn.attr('data-name'));
            $('#attEditIn').val($editBtn.attr('data-in'));
            // existing values fetch -> empty na empty ah irukkum
            $('#attEditOut').val($editBtn.attr('data-outtime') || '');
            $('#attEditOut').attr('min', $editBtn.attr('data-intime') || '');
            $('#attEditRemark').val($editBtn.attr('data-remark') || '');
            $('#attEditMsg').text('');
            $('#attEditSave').prop('disabled', false).text('Update');
            $('#attEditOverlay').addClass('show');
        }
        function closeEditModal() {
            $('#attEditOverlay').removeClass('show');
            $editBtn = null;
        }
        function saveEdit(table) {
            if (!$editBtn) return;
            var $msg = $('#attEditMsg');
            var outVal = $('#attEditOut').val();
            var inVal = $editBtn.attr('data-intime');
            if (outVal && inVal && outVal < inVal) {
                $msg.css('color', 'red').text('Out Time cannot be earlier than In Time.');
                return;
            }
            $('#attEditSave').prop('disabled', true).text('Saving...');
            $.ajax({
                url: UPDATE_URL,
                type: 'POST',
                dataType: 'json',
                data: {
                    id: $('#attEditId').val(),
                    out_time: outVal,
                    remark: $('#attEditRemark').val()
                }
            }).done(function (res) {
                if (!res || !res.success) {
                    $msg.css('color', 'red').text((res && res.message) ? res.message : 'Update failed.');
                    $('#attEditSave').prop('disabled', false).text('Update');
                    return;
                }
                // ---- Row UI update (page reload illama) ----
                var $tr = $editBtn.closest('tr');
                var tds = $tr.children('td');
                $tr.attr('data-out', res.out_status);
                // Attendance Type -> OUT badge
                var $badge = tds.eq(2).find('.att-badge').eq(1);
                if (res.out_status) {
                    $badge.attr('class', 'att-badge att-' + res.out_status).text('OUT: ' + res.out_label);
                } else {
                    $badge.attr('class', 'att-badge att-none').text('OUT: -');
                }
                tds.eq(8).text(res.out_display);      // Out Time
                tds.eq(11).text(res.early_going);     // Early Going
                tds.eq(12).text(res.late_going);      // Late Going
                tds.eq(14).text(res.modify_at);       // Modified_at
                tds.eq(15).text(res.modify_name);     // Modified_by
                // Button data -> next edit click la latest value fetch aagum
                $editBtn.attr('data-outtime', res.out_value);
                $editBtn.attr('data-remark', res.remark);
                table.row($tr).invalidate().draw(false);
                closeEditModal();
            }).fail(function () {
                $msg.css('color', 'red').text('Server error. Please try again.');
                $('#attEditSave').prop('disabled', false).text('Update');
            });
        }
        /* ---------- DataTable init ---------- */
        function initTable() {
            if ($.fn.DataTable.isDataTable('#attendanceTable')) {
                $('#attendanceTable').DataTable().destroy();
            }
            // If the page is reloaded, remove the old filter function
            if (window.__attFilterFn) {
                var idx = $.fn.dataTable.ext.search.indexOf(window.__attFilterFn);
                if (idx > -1) $.fn.dataTable.ext.search.splice(idx, 1);
                window.__attFilterFn = null;
            }
            var table = $('#attendanceTable').DataTable({
                dom: '<"dt-top"l<"dt-filters">f>rt<"dt-bottom"ip>',
                pagingType: 'simple_numbers',
                order: [],
                pageLength: 10,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
                columnDefs: [
                    {targets: 0, orderable: false, searchable: false}
                ]
            });
            // From/To -> everyone ; Employee/Type/Excel/Print -> admin only
            $('#filterTemplate').children().appendTo($('.dt-filters'));
            window.__attFilterFn = function (settings, data, dataIndex) {
                if (settings.nTable.id !== 'attendanceTable') return true;
                var node = table.row(dataIndex).node();
                var rowDate = node.getAttribute('data-date') || '';
                var from = $('#fromDate').val();
                var to = $('#toDate').val();
                if (from && (!rowDate || rowDate < from)) return false;
                if (to && (!rowDate || rowDate > to)) return false;
                if (isAdmin) {
                    var rowEmp = node.getAttribute('data-emp') || '';
                    var emp = $('#empFilter').val();
                    if (emp && rowEmp !== emp) return false;
                    var type = $('#typeFilter').val();
                    if (type) {
                        var parts = type.split(':');
                        var rowVal = node.getAttribute('data-' + parts[0]) || '';
                        if (rowVal !== parts[1]) return false;
                    }
                }
                return true;
            };
            $.fn.dataTable.ext.search.push(window.__attFilterFn);
            $('#fromDate, #toDate').on('change', function () {
                table.draw();
            });
            if (isAdmin) {
                $('#empFilter, #typeFilter').on('change', function () {
                    table.draw();
                });
                // Excel / Print buttons (filtered data only)
                $('#exceldown').off('click').on('click', function () {
                    exportExcel(table);
                });
                $('#printdown').off('click').on('click', function () {
                    printTable(table);
                });
                // Edit button -> open modal (delegated, pagination la work aagum)
                $('#attendanceTable').off('click.attEdit').on('click.attEdit', '.btn-edit', function () {
                    openEditModal(this);
                });
                $('#attEditClose, #attEditCancel').off('click').on('click', closeEditModal);
                $('#attEditSave').off('click').on('click', function () {
                    saveEdit(table);
                });
                $('#attEditOverlay').off('click').on('click', function (e) {
                    if (e.target === this) closeEditModal();
                });
                // Out Time clear (trash icon)
                $('#clearAttOut').off('click').on('click', function () {
                    $('#attEditOut').val('');
                });
            }
            // S.No re-number
            table.on('order.dt search.dt draw.dt', function () {
                var start = table.page.info().start;
                table.column(0, {search: 'applied', order: 'applied', page: 'current'})
                    .nodes()
                    .each(function (cell, i) {
                        cell.innerHTML = start + i + 1;
                    });
            }).draw();   // apply the default "today" filter on first load
        }
        if ($.fn.DataTable) {
            initTable();
        } else {
            $.getScript('https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js', initTable);
        }
    })();
</script>