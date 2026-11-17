<?php
require '../../../connect.php';
session_start();

$id = $_POST['id'];
$sql = $con->query("SELECT * FROM z_certifications WHERE id = $id");
$res = $sql->fetch(PDO::FETCH_ASSOC);
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Certification</h3>
    </div>
    <form role="form" name="" action="" method="post" enctype="multipart/form-data" id="edit_cert_form">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Certificate Name</label>
                        <input type="text" class="form-control" name="cert_name" id="cert_name" value="<?php echo $res['cert_name']; ?>" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Certificate Number</label>
                        <input type="text" class="form-control" name="cert_number" id="cert_number" value="<?php echo $res['cert_number']; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Expiry Date</label>
                        <input type="date" class="form-control" name="expiry_date" id="expiry_date" value="<?php echo $res['expiry_date']; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Surveillance Completed on</label>
                        <input type="date" class="form-control" name="surveillance_completed_on" id="surveillance_completed_on" value="<?php echo $res['surveillance_completed_on']; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Next Surveillance Date</label>
                        <input type="date" class="form-control" name="next_surveillance_date" id="next_surveillance_date" value="<?php echo $res['next_surveillance_date']; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Vendor (Online/Offline)</label>
                        <select class="form-control" name="vendor_type" id="vendor_type" onchange="toggleVendorName()">
                            <option value="">Select Vendor Type</option>
                            <option value="Online" <?php if($res['vendor_type'] == 'Online') echo 'selected'; ?>>Online</option>
                            <option value="Offline" <?php if($res['vendor_type'] == 'Offline') echo 'selected'; ?>>Offline</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6" id="offline_vendor_div" style="display: <?php echo ($res['vendor_type'] == 'Offline') ? 'block' : 'none'; ?>;">
                    <div class="form-group">
                        <label>If offline Vendor Name</label>
                        <input type="text" class="form-control" name="offline_vendor_name" id="offline_vendor_name" value="<?php echo $res['offline_vendor_name']; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Contact Person</label>
                        <input type="text" class="form-control" name="contact_person" id="contact_person" value="<?php echo $res['contact_person']; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" class="form-control" name="contact_number" id="contact_number" value="<?php echo $res['contact_number']; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Remarks</label>
                        <textarea class="form-control" name="remarks" id="remarks" rows="2"><?php echo $res['remarks']; ?></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Certificate Upload</label>
                        <input type="file" class="form-control" name="certificate_doc" id="certificate_doc">
                        <?php if(!empty($res['certificate_doc'])): ?>
                            <small><a href="qvision/BusinessProcess/certifications/uploads/<?php echo $res['certificate_doc']; ?>" target="_blank">View Current Document</a></small>
                            <input type="hidden" name="old_certificate_doc" value="<?php echo $res['certificate_doc']; ?>">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Update</button>
            <a onclick="certifications()" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>

<script>
function toggleVendorName() {
    var vendorType = document.getElementById('vendor_type').value;
    if(vendorType == 'Offline') {
        document.getElementById('offline_vendor_div').style.display = 'block';
    } else {
        document.getElementById('offline_vendor_div').style.display = 'none';
        document.getElementById('offline_vendor_name').value = '';
    }
}

$(document).ready(function() {
    $('#edit_cert_form').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'qvision/BusinessProcess/certifications/update.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                alert(response);
                certifications();
            }
        });
    });
});
</script>
