<?php
require '../../../connect.php';
session_start();
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">Certifications</font></h3>
        <a onclick="return add_certification()" style="float: right;" class="btn btn-dark"><i class="fa fa-plus"></i> Add New</a>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-sm-12">
                <strong>Color Legend:</strong> &nbsp;
                <span style="display:inline-block; width:15px; height:15px; background-color:#f8d7da; border:1px solid #f5c6cb; vertical-align:middle; margin-left:10px;"></span> <span style="vertical-align:middle;">Expired</span>
                <span style="display:inline-block; width:15px; height:15px; background-color:#fff3cd; border:1px solid #ffeeba; vertical-align:middle; margin-left:10px;"></span> <span style="vertical-align:middle;">Expiring in &le; 1 Month</span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="dataTables-example table table-striped table-bordered table-hover" id="cert_table" style="width:100%;">
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
                        <th>Certificate</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = $con->query("SELECT * FROM z_certifications ORDER BY id DESC");
                $i = 1;
                while($res = $sql->fetch(PDO::FETCH_ASSOC)) {
                    $docs_html = '';
                    if(!empty($res['certificate_doc'])) {
                        $docs_html .= "<a href='qvision/BusinessProcess/certifications/uploads/".$res['certificate_doc']."' target='_blank' style='display:block; margin-bottom:5px;' class='btn btn-xs btn-info'><i class='fa fa-download'></i> View Cert</a>";
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
                        <td><?php echo $docs_html; ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="edit_certification(<?php echo $res['id']; ?>)"><i class="fa fa-edit"></i></button>
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
    $('#cert_table').DataTable({
        scrollX: true,
        pageLength: 25
    });
});

function add_certification() {
    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/certifications/new.php",
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}

function edit_certification(id) {
    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/certifications/edit.php",
        data: { id: id },
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}
</script>
