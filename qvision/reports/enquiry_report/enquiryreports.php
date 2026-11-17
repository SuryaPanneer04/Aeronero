<?php
require_once __DIR__ . '/../../../connect.php';

$from_date = isset($_GET['from_date']) ? trim($_GET['from_date']) : '';
$to_date = isset($_GET['to_date']) ? trim($_GET['to_date']) : '';

// Legacy parameter fallback
if (empty($from_date) && !empty($_GET['candate'])) {
    $from_date = trim($_GET['candate']);
    $to_date = trim($_GET['candate']);
}

// Build WHERE clause based on created_on
$where = [];
$params = [];

if (!empty($from_date) && !empty($to_date)) {
    $where[] = "a.created_on BETWEEN :from_date AND :to_date";
    $params[':from_date'] = $from_date;
    $params[':to_date'] = $to_date;
} elseif (!empty($from_date)) {
    $where[] = "a.created_on >= :from_date";
    $params[':from_date'] = $from_date;
} elseif (!empty($to_date)) {
    $where[] = "a.created_on <= :to_date";
    $params[':to_date'] = $to_date;
}

$where_sql = count($where) > 0 ? "WHERE " . implode(" AND ", $where) : "";

$query = "SELECT a.id, a.client_org, a.client_name, a.created_on, a.created_by, a.status,
       u.full_name AS created_by_name,
       fb.feedback, fb.feedback_date, fb.date AS followup_date
FROM crm_calls a
LEFT JOIN (
    SELECT f1.calls_id, f1.feedback, f1.feedback_date, f1.date
    FROM crm_calls_feedback f1
    INNER JOIN (
        SELECT calls_id, MAX(id) as max_id FROM crm_calls_feedback GROUP BY calls_id
    ) f2 ON f1.id = f2.max_id
) fb ON a.id = fb.calls_id
LEFT JOIN z_user_master u ON a.created_by = u.user_id
{$where_sql}
ORDER BY a.id DESC";

$stmt = $con->prepare($query);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalRecords = count($results);
?>

<!-- SheetJS for client-side fallback if needed -->
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

<div class="row" style="margin-bottom: 12px; align-items: center;">
    <div class="col-md-7 col-sm-12" style="margin-bottom: 8px;">
        <span style="font-weight: 600; font-size: 14px; color: #495057;">
            <?php if (!empty($from_date) && !empty($to_date)): ?>
                <span class="badge badge-info" style="font-size: 13px; padding: 6px 10px; background-color: #17a2b8; color: #fff;">
                    <i class="fa fa-calendar"></i> <?= htmlspecialchars($from_date) ?> to <?= htmlspecialchars($to_date) ?>
                </span>
            <?php elseif (!empty($from_date)): ?>
                <span class="badge badge-info" style="font-size: 13px; padding: 6px 10px; background-color: #17a2b8; color: #fff;">
                    <i class="fa fa-calendar"></i> From: <?= htmlspecialchars($from_date) ?>
                </span>
            <?php elseif (!empty($to_date)): ?>
                <span class="badge badge-info" style="font-size: 13px; padding: 6px 10px; background-color: #17a2b8; color: #fff;">
                    <i class="fa fa-calendar"></i> Up to: <?= htmlspecialchars($to_date) ?>
                </span>
            <?php else: ?>
                <span class="badge badge-secondary" style="font-size: 13px; padding: 6px 10px; background-color: #6c757d; color: #fff;">
                    <i class="fa fa-list"></i> All Records
                </span>
            <?php endif; ?>

            <span class="badge badge-primary" style="font-size: 13px; padding: 6px 10px; background-color: #009EE3; color: #fff; margin-left: 6px;">
                <i class="fa fa-check-circle"></i> Total: <?= $totalRecords ?>
            </span>
        </span>
    </div>

    <div class="col-md-5 col-sm-12" style="text-align: right; margin-bottom: 8px;">
        <button type="button" class="btn btn-success" onclick="downloadFilteredExcel()" style="font-size: 14px; font-weight: 600; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <i class="fa fa-download"></i> Download Excel (.xlsx)
        </button>
    </div>
</div>

<div class="table-responsive">
    <table class="dataTables-example table table-striped table-bordered table-hover" id="tbl_exporttable_to_xls" style="width: 100%;">
        <thead>
            <tr style="background-color: #f1f4f6;">
                <th style="width: 40px; text-align: center;">#</th>
                <th style="width: 100px; text-align: center;">Date</th>
                <th>Organisation</th>
                <th>Client</th>
                <th>Feedback</th>
                <th style="width: 110px; text-align: center;">Feedback Date</th>
                <th style="width: 110px; text-align: center;">Followup Date</th>
                <th>Created By</th>
                <th style="width: 80px; text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $cnt = 1;
            if ($totalRecords > 0) {
                foreach ($results as $row) {
                    $fbDate = (!empty($row['feedback_date']) && $row['feedback_date'] != '0000-00-00') ? htmlspecialchars($row['feedback_date']) : '-';
                    $foDate = (!empty($row['followup_date']) && $row['followup_date'] != '0000-00-00') ? htmlspecialchars($row['followup_date']) : '-';
                    $createdByName = !empty($row['created_by_name']) ? htmlspecialchars($row['created_by_name']) : (!empty($row['created_by']) ? htmlspecialchars($row['created_by']) : '-');
                    $status = (int)$row['status'];
                    $isActive = in_array($status, [1, 2, 3, 4]);
            ?>
                    <tr>
                        <td style="text-align: center;"><?= $cnt ?>.</td>
                        <td style="text-align: center;"><?= htmlspecialchars($row['created_on'] ?: '-') ?></td>
                        <td><?= htmlspecialchars($row['client_org'] ?: '-') ?></td>
                        <td><?= htmlspecialchars($row['client_name'] ?: '-') ?></td>
                        <td><?= htmlspecialchars($row['feedback'] ?: '-') ?></td>
                        <td style="text-align: center;"><?= $fbDate ?></td>
                        <td style="text-align: center;"><?= $foDate ?></td>
                        <td><?= $createdByName ?></td>
                        <td style="text-align: center;">
                            <?php if ($isActive): ?>
                                <span class="badge badge-success" style="background-color: #28a745; color: #fff; padding: 4px 8px; font-size: 12px;">Active</span>
                            <?php else: ?>
                                <span class="badge badge-danger" style="background-color: #dc3545; color: #fff; padding: 4px 8px; font-size: 12px;">Inactive</span>
                            <?php endif; ?>
                        </td>
                    </tr>
            <?php
                    $cnt++;
                }
            } else {
            ?>
                <tr>
                    <td colspan="9" style="text-align: center; padding: 25px; color: #888;">
                        <i class="fa fa-info-circle fa-2x" style="display:block; margin-bottom: 8px;"></i>
                        No enquiry records found for the selected criteria.
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
var currentFromDate = <?= json_encode($from_date) ?>;
var currentToDate = <?= json_encode($to_date) ?>;

function downloadFilteredExcel() {
    var fromDate = currentFromDate || $('#from_date').val() || '';
    var toDate = currentToDate || $('#to_date').val() || '';
    var url = "qvision/reports/enquiry_report/export_excel.php?from_date=" + encodeURIComponent(fromDate) + "&to_date=" + encodeURIComponent(toDate);
    window.location.href = url;
}

// Client-side SheetJS fallback export
function ExportToExcel(type, fn, dl) {
    var elt = document.getElementById('tbl_exporttable_to_xls');
    if (!elt) return;
    if (typeof XLSX === 'undefined') {
        downloadFilteredExcel();
        return;
    }
    var wb = XLSX.utils.table_to_book(elt, { sheet: "Enquiry Report" });
    var fileName = fn || ('Enquiry_Report' + (currentFromDate ? '_' + currentFromDate : '') + (currentToDate ? '_to_' + currentToDate : '') + '.' + (type || 'xlsx'));
    return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
        XLSX.writeFile(wb, fileName);
}

$(document).ready(function() {
    if ($.fn.DataTable.isDataTable('#tbl_exporttable_to_xls')) {
        $('#tbl_exporttable_to_xls').DataTable().destroy();
    }

    <?php if ($totalRecords > 0): ?>
    $('#tbl_exporttable_to_xls').DataTable({
        "scrollX": true,
        "pageLength": 50,
        "order": [], // Preserves server order (id DESC)
        "language": {
            "search": "_INPUT_",
            "searchPlaceholder": "Search enquiries..."
        }
    });
    <?php endif; ?>
});
</script>