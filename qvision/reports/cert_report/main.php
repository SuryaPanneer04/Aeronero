<?php
require '../../../connect.php';
session_start();

$filter = isset($_POST['filter']) ? $_POST['filter'] : 'all';

// Build the base query with JOIN to get uploaded user's name
$query = "SELECT c.*, u.full_name, u.user_name, u.ass_emp_id FROM z_certifications c LEFT JOIN z_user_master u ON c.created_by = u.user_id WHERE 1=1";

if($filter == 'expired') {
    // Expired: expiry_date is less than today
    $query .= " AND c.expiry_date < CURDATE() AND c.expiry_date != '0000-00-00'";
} else if ($filter == '1_month') {
    // Expiring in 1 Month: from today up to 31 days
    $query .= " AND c.expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 31 DAY) AND c.expiry_date != '0000-00-00'";
}

$query .= " ORDER BY c.id DESC";
$sql = $con->query($query);
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">Certificates Report</font></h3>
    </div>
    <div class="card-body">
        
        <!-- Filter Form -->
        <form method="post" id="cert_report_filter_form" class="mb-4">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Filter By Status</label>
                        <select class="form-control" name="filter" id="filter">
                            <option value="all" <?php if($filter == 'all') echo 'selected'; ?>>All Certificates</option>
                            <option value="1_month" <?php if($filter == '1_month') echo 'selected'; ?>>Expiring in 1 Month</option>
                            <option value="expired" <?php if($filter == 'expired') echo 'selected'; ?>>Expired</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-success form-control"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="row mb-3">
            <div class="col-sm-12">
                <strong>Color Legend:</strong> &nbsp;
                <span style="display:inline-block; width:15px; height:15px; background-color:#f8d7da; border:1px solid #f5c6cb; vertical-align:middle; margin-left:10px;"></span> <span style="vertical-align:middle;">Expired</span>
                <span style="display:inline-block; width:15px; height:15px; background-color:#fff3cd; border:1px solid #ffeeba; vertical-align:middle; margin-left:10px;"></span> <span style="vertical-align:middle;">Expiring in &le; 1 Month</span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="dataTables-example table table-striped table-bordered table-hover" id="cert_report_table" style="width:100%;">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Cert Name</th>
                        <th>Cert Number</th>
                        <th>Expiry Date</th>
                        <th>Surveillance Completed</th>
                        <th>Next Surveillance</th>
                        <th>Vendor Type</th>
                        <th>Contact Person</th>
                        <th>Contact Number</th>
                        <th>Remarks</th>
                        <th>Uploaded By</th>
                        <th>Certificate</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                while($res = $sql->fetch(PDO::FETCH_ASSOC)) {
                    $docs_html = '';
                    if(!empty($res['certificate_doc'])) {
                        $docs_html .= "<a href='qvision/BusinessProcess/certifications/uploads/".$res['certificate_doc']."' target='_blank' style='display:block; margin-bottom:5px;' class='btn btn-xs btn-info'><i class='fa fa-download'></i> View</a>";
                    } else {
                        $docs_html = "-";
                    }
                    
                    $expiry_date = (!empty($res['expiry_date']) && $res['expiry_date'] != '0000-00-00') ? date('d-m-Y', strtotime($res['expiry_date'])) : '-';
                    $surveillance_completed_on = (!empty($res['surveillance_completed_on']) && $res['surveillance_completed_on'] != '0000-00-00') ? date('d-m-Y', strtotime($res['surveillance_completed_on'])) : '-';
                    $next_surveillance_date = (!empty($res['next_surveillance_date']) && $res['next_surveillance_date'] != '0000-00-00') ? date('d-m-Y', strtotime($res['next_surveillance_date'])) : '-';
                    
                    $row_style = "";
                    if(!empty($res['expiry_date']) && $res['expiry_date'] != '0000-00-00') {
                        $diff = (strtotime($res['expiry_date']) - time()) / (60 * 60 * 24);
                        if($diff >= 0 && $diff <= 31) {
                            $row_style = "background-color: #fff3cd; color: #856404;";
                        } else if ($diff < 0) {
                            $row_style = "background-color: #f8d7da; color: #721c24;";
                        }
                    }
                    
                    $uploaded_by_name = !empty($res['full_name']) ? $res['full_name'] : (!empty($res['user_name']) ? $res['user_name'] : 'Admin');
                    $emp_code = !empty($res['ass_emp_id']) ? $res['ass_emp_id'] : (!empty($res['user_name']) ? $res['user_name'] : '');
                    if(!empty($emp_code) && $uploaded_by_name != 'Admin' && $emp_code != $uploaded_by_name) {
                        $uploaded_by = $uploaded_by_name . " (" . $emp_code . ")";
                    } else {
                        $uploaded_by = $uploaded_by_name;
                    }
                ?>
                    <tr style="<?php echo $row_style; ?>">
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $res['cert_name']; ?></td>
                        <td><?php echo $res['cert_number']; ?></td>
                        <td><?php echo $expiry_date; ?></td>
                        <td><?php echo $surveillance_completed_on; ?></td>
                        <td><?php echo $next_surveillance_date; ?></td>
                        <td><?php echo $res['vendor_type'] == 'Offline' ? $res['offline_vendor_name'] : $res['vendor_type']; ?></td>
                        <td><?php echo $res['contact_person']; ?></td>
                        <td><?php echo $res['contact_number']; ?></td>
                        <td><?php echo $res['remarks']; ?></td>
                        <td><b><?php echo $uploaded_by; ?></b></td>
                        <td><?php echo $docs_html; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#cert_report_table').DataTable({
        scrollX: true,
        pageLength: 25,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    $('#cert_report_filter_form').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'qvision/Reports/cert_report/main.php',
            data: formData,
            success: function(data) {
                $('#main_content').html(data);
            }
        });
    });
});
</script>
