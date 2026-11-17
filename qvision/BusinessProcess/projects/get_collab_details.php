<?php
require_once '../../../connect.php';
if (!headers_sent() && session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$stmt = $con->prepare("SELECT * FROM z_collaborations WHERE id = ?");
$stmt->execute([$id]);
$res = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$res) {
    echo "<div class='alert alert-warning'>Collaboration details not found.</div>";
    exit;
}

$nda_doc = !empty($res['nda_file']) ? "<a href='qvision/BusinessProcess/collaborations/uploads/".$res['nda_file']."' target='_blank' class='btn btn-xs btn-info'><i class='fa fa-download'></i> Download NDA</a>" : "<span class='text-muted'>No Document</span>";
$mou_doc = !empty($res['mou_file']) ? "<a href='qvision/BusinessProcess/collaborations/uploads/".$res['mou_file']."' target='_blank' class='btn btn-xs btn-info'><i class='fa fa-download'></i> Download MoU</a>" : "<span class='text-muted'>No Document</span>";
$res_doc = !empty($res['results_file']) ? "<a href='qvision/BusinessProcess/collaborations/uploads/".$res['results_file']."' target='_blank' class='btn btn-xs btn-info'><i class='fa fa-download'></i> Download Results</a>" : "<span class='text-muted'>No Document</span>";

$nda_date = !empty($res['nda_date']) && $res['nda_date'] != '0000-00-00' ? date('d-m-Y', strtotime($res['nda_date'])) : '-';
$mou_date = !empty($res['mou_date']) && $res['mou_date'] != '0000-00-00' ? date('d-m-Y', strtotime($res['mou_date'])) : '-';
?>
<div class="table-responsive">
    <table class="table table-bordered table-striped" style="margin-bottom: 0;">
        <tbody>
            <tr>
                <th style="width: 35%; background: #f8f9fa;">Collaborator Name</th>
                <td><strong><?php echo htmlspecialchars($res['collaborator_name']); ?></strong></td>
            </tr>
            <tr>
                <th style="background: #f8f9fa;">Collaboration Type</th>
                <td><span class="badge badge-primary"><?php echo htmlspecialchars($res['collab_type']); ?></span></td>
            </tr>
            <tr>
                <th style="background: #f8f9fa;">Status</th>
                <td>
                    <span class="badge <?php echo ($res['status'] == 'Active') ? 'badge-success' : 'badge-secondary'; ?>">
                        <?php echo htmlspecialchars($res['status']); ?>
                    </span>
                </td>
            </tr>
            <tr>
                <th style="background: #f8f9fa;">NDA Status</th>
                <td>
                    <?php echo htmlspecialchars($res['nda_status']); ?> 
                    <span class="text-muted ml-2">(Date: <?php echo $nda_date; ?>)</span>
                    <div class="mt-1"><?php echo $nda_doc; ?></div>
                </td>
            </tr>
            <tr>
                <th style="background: #f8f9fa;">MoU Status</th>
                <td>
                    <?php echo htmlspecialchars($res['mou_status']); ?> 
                    <span class="text-muted ml-2">(Date: <?php echo $mou_date; ?>)</span>
                    <div class="mt-1"><?php echo $mou_doc; ?></div>
                </td>
            </tr>
            <tr>
                <th style="background: #f8f9fa;">Description of Work</th>
                <td><?php echo nl2br(htmlspecialchars($res['work_description'] ?? '')); ?></td>
            </tr>
            <tr>
                <th style="background: #f8f9fa;">Next Steps / Follow-ups</th>
                <td><?php echo nl2br(htmlspecialchars($res['next_steps'] ?? '')); ?></td>
            </tr>
            <tr>
                <th style="background: #f8f9fa;">Results Document</th>
                <td><?php echo $res_doc; ?></td>
            </tr>
        </tbody>
    </table>
</div>
