<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require('../../../connect.php');

$sql = "SELECT r.*, u.full_name as referred_by_name FROM referral_master r LEFT JOIN z_user_master u ON r.referred_by = u.user_name ORDER BY r.id DESC";
$stmt = $con->query($sql);
$referrals = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">Referral List</font></h3>
    </div>
    <div class="card-body" style="overflow-x: auto;">
        <table id="referralTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Designation / Company</th>
                    <th>Resume</th>
                    <th>Referred By</th>
                    <th>Comments</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 1;
                foreach($referrals as $ref) { 
                    $ref_name = !empty($ref['referred_by_name']) ? $ref['referred_by_name'] . ' (' . $ref['referred_by'] . ')' : $ref['referred_by'];
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo htmlspecialchars($ref['referral_type']); ?></td>
                    <td><?php echo htmlspecialchars($ref['name']); ?></td>
                    <td><?php echo htmlspecialchars($ref['mobile']); ?></td>
                    <td><?php echo htmlspecialchars($ref['email']); ?></td>
                    <td><?php echo htmlspecialchars($ref['location']); ?></td>
                    <td><?php echo htmlspecialchars($ref['designation_or_company']); ?></td>
                    <td>
                        <?php if(!empty($ref['resume'])) { ?>
                            <a href="qvision/HR/referral/uploads/<?php echo htmlspecialchars($ref['resume']); ?>" target="_blank" class="btn btn-xs btn-info">View Resume</a>
                        <?php } else { echo "-"; } ?>
                    </td>
                    <td><?php echo htmlspecialchars($ref_name); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($ref['comments'])); ?></td>
                    <td><?php echo date('d-M-Y h:i A', strtotime($ref['created_on'])); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    if (!$.fn.DataTable.isDataTable('#referralTable')) {
        $('#referralTable').DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    }
});
</script>
