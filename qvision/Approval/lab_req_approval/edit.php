<?php
require '../../../connect.php';
session_start();

$id = $_POST['id'];
$stage = $_POST['stage'];
$sql = $con->query("SELECT * FROM z_laboratory_requirements WHERE id = $id");
$res = $sql->fetch(PDO::FETCH_ASSOC);

$stage_titles = [
    'proc_indent' => 'Procurement Indent Approval',
    'finance' => 'Finance Approval',
    'proc_status' => 'Procurement Status Update',
    'qc' => 'QC Status',
    'received' => 'Received Goods Confirmation'
];
$title = "Update " . $stage_titles[$stage];
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><?php echo $title; ?></h3>
    </div>
    <form role="form" name="" action="" method="post" enctype="multipart/form-data" id="edit_approval_form">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="stage" value="<?php echo $stage; ?>">
        
        <div class="card-body">
            <!-- Basic Details (Read Only) -->
            <h5 class="text-primary border-bottom pb-2 mb-3">Requirement Details</h5>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>STOCKS (filters)</label>
                        <input type="text" class="form-control" value="<?php echo $res['stock_type']; ?>" readonly>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Items</label>
                        <input type="text" class="form-control" value="<?php echo $res['items']; ?>" readonly>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control" value="<?php echo $res['quantity']; ?>" readonly>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" step="0.01" class="form-control" value="<?php echo $res['price']; ?>" readonly>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Date of Request</label>
                        <input type="date" class="form-control" value="<?php echo $res['date_of_request']; ?>" readonly>
                    </div>
                </div>
            </div>

            <?php if($stage == 'proc_indent'): ?>
            <!-- Procurement Indent -->
            <h5 class="text-info border-bottom pb-2 mb-3 mt-4">Indent (Procurement Team)</h5>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Date of Indent raised</label>
                        <input type="date" class="form-control" name="indent_date" id="indent_date" value="<?php echo $res['indent_date']; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Attach Indent Document</label>
                        <input type="file" class="form-control" name="indent_doc" id="indent_doc">
                        <?php if(!empty($res['indent_doc'])): ?>
                            <small><a href="qvision/BusinessProcess/laboratory_requirement/uploads/<?php echo $res['indent_doc']; ?>" target="_blank">View current Document</a></small>
                            <input type="hidden" name="old_indent_doc" value="<?php echo $res['indent_doc']; ?>">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if($stage == 'finance'): ?>
            <!-- Finance Approval -->
            <h5 class="text-success border-bottom pb-2 mb-3 mt-4">Indent Approval (Finance)</h5>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Finance Status</label>
                        <select class="form-control" name="finance_status" id="finance_status">
                            <option value="Pending" <?php if($res['finance_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                            <option value="Approved" <?php if($res['finance_status'] == 'Approved') echo 'selected'; ?>>Approved</option>
                            <option value="Rejected" <?php if($res['finance_status'] == 'Rejected') echo 'selected'; ?>>Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Attach Finance Document</label>
                        <input type="file" class="form-control" name="finance_doc" id="finance_doc">
                        <?php if(!empty($res['finance_doc'])): ?>
                            <small><a href="qvision/BusinessProcess/laboratory_requirement/uploads/<?php echo $res['finance_doc']; ?>" target="_blank">View current Document</a></small>
                            <input type="hidden" name="old_finance_doc" value="<?php echo $res['finance_doc']; ?>">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if($stage == 'proc_status'): ?>
            <!-- Procurement Status -->
            <h5 class="text-info border-bottom pb-2 mb-3 mt-4">Procurement Status (Procurement Team)</h5>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Procurement Status</label>
                        <select class="form-control" name="procurement_status" id="procurement_status">
                            <option value="Pending" <?php if($res['procurement_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                            <option value="Ordered" <?php if($res['procurement_status'] == 'Ordered') echo 'selected'; ?>>Ordered</option>
                            <option value="In Progress" <?php if($res['procurement_status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                            <option value="Completed" <?php if($res['procurement_status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Attach Procurement Document</label>
                        <input type="file" class="form-control" name="procurement_doc" id="procurement_doc">
                        <?php if(!empty($res['procurement_doc'])): ?>
                            <small><a href="qvision/BusinessProcess/laboratory_requirement/uploads/<?php echo $res['procurement_doc']; ?>" target="_blank">View current Document</a></small>
                            <input type="hidden" name="old_procurement_doc" value="<?php echo $res['procurement_doc']; ?>">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if($stage == 'qc'): ?>
            <!-- QC Dept -->
            <h5 class="text-warning border-bottom pb-2 mb-3 mt-4">QC Passed/Failed (QC Dept)</h5>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>QC Status</label>
                        <select class="form-control" name="qc_status" id="qc_status">
                            <option value="Pending" <?php if($res['qc_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                            <option value="Passed" <?php if($res['qc_status'] == 'Passed') echo 'selected'; ?>>Passed</option>
                            <option value="Failed" <?php if($res['qc_status'] == 'Failed') echo 'selected'; ?>>Failed</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Attach QC Document</label>
                        <input type="file" class="form-control" name="qc_doc" id="qc_doc">
                        <?php if(!empty($res['qc_doc'])): ?>
                            <small><a href="qvision/BusinessProcess/laboratory_requirement/uploads/<?php echo $res['qc_doc']; ?>" target="_blank">View current Document</a></small>
                            <input type="hidden" name="old_qc_doc" value="<?php echo $res['qc_doc']; ?>">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if($stage == 'received'): ?>
            <!-- Received Goods -->
            <h5 class="text-success border-bottom pb-2 mb-3 mt-4">Received goods</h5>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Received Status</label>
                        <select class="form-control" name="received_status" id="received_status">
                            <option value="Pending" <?php if($res['received_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                            <option value="Received" <?php if($res['received_status'] == 'Received') echo 'selected'; ?>>Received</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Attach Delivery/Received Document</label>
                        <input type="file" class="form-control" name="received_doc" id="received_doc">
                        <?php if(!empty($res['received_doc'])): ?>
                            <small><a href="qvision/BusinessProcess/laboratory_requirement/uploads/<?php echo $res['received_doc']; ?>" target="_blank">View current Document</a></small>
                            <input type="hidden" name="old_received_doc" value="<?php echo $res['received_doc']; ?>">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>
        <div class="card-footer">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Update Status</button>
            <a onclick="lab_req_<?php echo $stage; ?>()" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    $('#edit_approval_form').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'qvision/Approval/lab_req_approval/update.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                alert(response);
                // Call the correct function to reload the table
                var stage = "<?php echo $stage; ?>";
                if(stage == 'proc_indent') lab_req_proc_indent();
                else if(stage == 'finance') lab_req_finance();
                else if(stage == 'proc_status') lab_req_proc_status();
                else if(stage == 'qc') lab_req_qc();
                else if(stage == 'received') lab_req_received();
            }
        });
    });
});
</script>
