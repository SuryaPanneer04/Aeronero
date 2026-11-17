<?php
require '../../../connect.php';
session_start();

if (!function_exists('getStatusBadge')) {
    function getStatusBadge($status) {
        $s = strtolower((string)$status);
        if ($s == 'approved' || $s == 'passed' || $s == 'received') return 'status-approved';
        if ($s == 'rejected' || $s == 'failed') return 'status-rejected';
        if ($s == 'in progress' || $s == 'ordered') return 'status-inprogress';
        return 'status-pending';
    }
}

$stage = $_POST['stage'];
$stage_titles = [
    'proc_indent' => 'Procurement Indent Approval',
    'finance' => 'Finance Approval',
    'proc_status' => 'Procurement Status Update',
    'qc' => 'QC Status',
    'received' => 'Received Goods Confirmation'
];
$title = "Laboratory Requirement - " . $stage_titles[$stage];
?>
<style>
.status-badge { padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; }
.status-pending { background: #ffeeba; color: #856404; }
.status-approved, .status-passed, .status-received { background: #d4edda; color: #155724; }
.status-rejected, .status-failed { background: #f8d7da; color: #721c24; }
.status-inprogress { background: #cce5ff; color: #004085; }
.updated-by { font-size: 10px; color: #6c757d; display: block; margin-top: 3px; }
</style>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5"><?php echo $title; ?></font></h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="dataTables-example table table-striped table-bordered table-hover" id="approval_table" style="width:100%;">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Stock Type</th>
                        <th>Items</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Req Date</th>
                        <th>Indent (Procurement)</th>
                        <th>Approval (Finance)</th>
                        <th>Status (Procurement)</th>
                        <th>QC Status (QC Dept)</th>
                        <th>Received Goods</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = $con->query("SELECT * FROM z_laboratory_requirements ORDER BY id DESC");
                $i = 1;
                while($res = $sql->fetch(PDO::FETCH_ASSOC)) {
                    $req_date = (!empty($res['date_of_request']) && $res['date_of_request'] != '0000-00-00') ? date('d-m-Y', strtotime($res['date_of_request'])) : '-';
                    $indent_date = (!empty($res['indent_date']) && $res['indent_date'] != '0000-00-00') ? date('d-m-Y', strtotime($res['indent_date'])) : 'Pending';
                    
                    // Indent Display
                    $indent_html = "<b>Date:</b> $indent_date";
                    if(!empty($res['indent_doc'])) $indent_html .= "<br><a href='qvision/BusinessProcess/laboratory_requirement/uploads/".$res['indent_doc']."' target='_blank' class='btn btn-xs btn-info mt-1'><i class='fa fa-download'></i> Doc</a>";
                    if(!empty($res['indent_updated_by'])) $indent_html .= "<span class='updated-by'>By: ".$res['indent_updated_by']."</span>";
                    
                    // Finance Display
                    $fin_badge = getStatusBadge($res['finance_status']);
                    $fin_html = "<span class='status-badge $fin_badge'>".$res['finance_status']."</span>";
                    if(!empty($res['finance_doc'])) $fin_html .= "<br><a href='qvision/BusinessProcess/laboratory_requirement/uploads/".$res['finance_doc']."' target='_blank' class='btn btn-xs btn-info mt-1'><i class='fa fa-download'></i> Doc</a>";
                    if(!empty($res['finance_updated_by'])) $fin_html .= "<span class='updated-by'>By: ".$res['finance_updated_by']."</span>";
                    
                    // Procurement Status Display
                    $pro_badge = getStatusBadge($res['procurement_status']);
                    $pro_html = "<span class='status-badge $pro_badge'>".$res['procurement_status']."</span>";
                    if(!empty($res['procurement_doc'])) $pro_html .= "<br><a href='qvision/BusinessProcess/laboratory_requirement/uploads/".$res['procurement_doc']."' target='_blank' class='btn btn-xs btn-info mt-1'><i class='fa fa-download'></i> Doc</a>";
                    if(!empty($res['procurement_updated_by'])) $pro_html .= "<span class='updated-by'>By: ".$res['procurement_updated_by']."</span>";
                    
                    // QC Display
                    $qc_badge = getStatusBadge($res['qc_status']);
                    $qc_html = "<span class='status-badge $qc_badge'>".$res['qc_status']."</span>";
                    if(!empty($res['qc_doc'])) $qc_html .= "<br><a href='qvision/BusinessProcess/laboratory_requirement/uploads/".$res['qc_doc']."' target='_blank' class='btn btn-xs btn-info mt-1'><i class='fa fa-download'></i> Doc</a>";
                    if(!empty($res['qc_updated_by'])) $qc_html .= "<span class='updated-by'>By: ".$res['qc_updated_by']."</span>";
                    
                    // Received Display
                    $rec_badge = getStatusBadge($res['received_status']);
                    $rec_html = "<span class='status-badge $rec_badge'>".$res['received_status']."</span>";
                    if(!empty($res['received_doc'])) $rec_html .= "<br><a href='qvision/BusinessProcess/laboratory_requirement/uploads/".$res['received_doc']."' target='_blank' class='btn btn-xs btn-info mt-1'><i class='fa fa-download'></i> Doc</a>";
                    if(!empty($res['received_updated_by'])) $rec_html .= "<span class='updated-by'>By: ".$res['received_updated_by']."</span>";
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $res['stock_type']; ?></td>
                        <td><?php echo $res['items']; ?></td>
                        <td><?php echo $res['quantity']; ?></td>
                        <td><?php echo $res['price']; ?></td>
                        <td><?php echo $req_date; ?></td>
                        <td><?php echo $indent_html; ?></td>
                        <td><?php echo $fin_html; ?></td>
                        <td><?php echo $pro_html; ?></td>
                        <td><?php echo $qc_html; ?></td>
                        <td><?php echo $rec_html; ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="edit_lab_approval(<?php echo $res['id']; ?>, '<?php echo $stage; ?>')"><i class="fa fa-edit"></i> Update</button>
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
    $('#approval_table').DataTable({
        scrollX: true,
        pageLength: 25
    });
});

function edit_lab_approval(id, stage) {
    $.ajax({
        type: "POST",
        url: "qvision/Approval/lab_req_approval/edit.php",
        data: { id: id, stage: stage },
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}
</script>
