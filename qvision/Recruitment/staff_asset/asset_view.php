<?php
require '../../../connect.php';
include("../../../user.php");

$staid = $_SESSION['candidateid'];

// Fetch employee details
$staffsel = $con->prepare("SELECT id, emp_name FROM staff_master WHERE candid_id = ?");
$staffsel->execute([$staid]);
$data1 = $staffsel->fetch(PDO::FETCH_ASSOC);

if (!$data1) {
    die("Error: Employee not found.");
}

$emp_id = $data1['id'];  
$emp_name = $data1['emp_name'];

// Fetch staff asset
$staff_asset = $con->prepare("SELECT id FROM staff_asset WHERE emp_name = ?");
$staff_asset->execute([$emp_id]);
$asset = $staff_asset->fetch(PDO::FETCH_ASSOC);
$asset_id = $asset['id'] ?? null; 

// Fetch life insurance details
$stmt = $con->prepare("SELECT * FROM life_insurance WHERE emp_id = ?");
$stmt->execute([$emp_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];

// Fetch mediclaim insurance details
$medi = $con->prepare("SELECT * FROM mediclamim_insurance WHERE emp_name = ?");
$medi->execute([$emp_id]);
$medi_row = $medi->fetch(PDO::FETCH_ASSOC) ?: [];

?>
<style>
.bold {
    font-weight: bold;
}
</style>

<div class="col-12">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Staff Asset Detail</h3>
        </div>
        <form class="form-horizontal" method="POST">
            <input type="hidden" name="staff_id" id="staff_id" value="<?php echo htmlspecialchars($staid); ?>">
            <table class="table table-bordered">
                <tr>
                    <td>Employee Name:</td>
                    <td colspan="2">
                        <input type="text" class="form-control" name="emp_name" value="<?php echo htmlspecialchars($emp_name); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <th>S.No</th>
                    <th>Asset Name</th>
                    <th>Serial Number / Model Number</th>
                </tr>
                <?php
                if ($asset_id) {
                    $assetData = $con->prepare("SELECT * FROM staff_asset_serial_no WHERE staff_asset_id = ?");
                    $assetData->execute([$asset_id]);
                    $i = 1;
                    while ($serialno = $assetData->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <td><?php echo $i++; ?>
                                <input type="hidden" class="form-control" name="get_id[]" value="<?php echo htmlspecialchars($serialno['id']); ?>">
                            </td>
                            <td><input type="text" class="form-control" name="asset_name[]" value="<?php echo htmlspecialchars($serialno['asset_name']); ?>" readonly></td>
                            <td><input type="text" class="form-control" name="serial_number[]" value="<?php echo htmlspecialchars($serialno['serial_number']); ?>" readonly></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='3'>No assets found.</td></tr>";
                }
                ?>
            </table>
        </form>
    </div>
</div>

<div class="col-12">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Life Insurance Details</h3>
        </div>
        <form class="form-horizontal" method="POST">
            <table class="table table-bordered">
                <tr>
                    <td>Insurance Name</td>
                    <td colspan="2">
                        <input type="text" class="form-control" name="life_insurance_name" value="<?php echo htmlspecialchars($row['insurance_name'] ?? ''); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Insurance Number</td>
                    <td colspan="2">
                        <input type="text" class="form-control" name="life_insurance_number" value="<?php echo htmlspecialchars($row['insurance_no'] ?? ''); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Validity From</td>
                    <td colspan="2">
                        <input type="date" class="form-control" name="validity_from" value="<?php echo htmlspecialchars($row['validity_from'] ?? ''); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Validity To</td>
                    <td colspan="2">
                        <input type="date" class="form-control" name="validity_to" value="<?php echo htmlspecialchars($row['validity_to'] ?? ''); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Policy Period</td>
                    <td colspan="2">
                        <input type="text" class="form-control" name="policy_period" value="<?php echo htmlspecialchars($row['policy_period'] ?? ''); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Eligible criteria</td>
                    <td colspan="2">
                        <input type="text" class="form-control" name="eligibility" value="<?php echo htmlspecialchars($row['eligiblity'] ?? ''); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Document Upload</td>
                    <td>
                        <?php if (!empty($row['Insurance_doc'])): ?>
                            <a href="qvision/Recruitment/staff_asset/life_insurance/lifeInsuranceDoc/<?php echo htmlspecialchars($row['Insurance_doc']); ?>" download><?php echo htmlspecialchars($row['Insurance_doc']); ?></a>
                            <input type="hidden" name="life_insure_attach" value="<?php echo htmlspecialchars($row['Insurance_doc']); ?>">
                        <?php else: ?>
                            No document uploaded.
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<div class="col-12">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Mediclaim Insurance</h3>
        </div>
        <form class="form-horizontal" method="POST">
            <table class="table table-bordered">
                <tr>
                    <td>Insurance Name:</td>
                    <td colspan="5">
                        <input type="text" class="form-control" name="insurance_name" value="<?php echo htmlspecialchars($medi_row['insurance_name'] ?? ''); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Insurance Number:</td>
                    <td colspan="5">
                        <input type="number" class="form-control" name="insurance_number" value="<?php echo htmlspecialchars($medi_row['insurance_number'] ?? ''); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Validate From:</td>
                    <td colspan="5">
                        <input type="date" class="form-control" name="validate_from" value="<?php echo htmlspecialchars($medi_row['validate_from'] ?? ''); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Validate To:</td>
                    <td colspan="5">
                        <input type="date" class="form-control" name="validate_to" value="<?php echo htmlspecialchars($medi_row['validate_to'] ?? ''); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Premium Insurance Policy</td>
                    <td colspan="5">
                        <input type="text" class="form-control" name="premium_insurance_policy" value="<?php echo htmlspecialchars($medi_row['premium_insurance_policy'] ?? ''); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Document Upload</td>
                    <td>
                        <?php if (!empty($medi_row['document_approved'])): ?>
                            <a href="qvision/Recruitment/staff_asset/mediclaim_insurance/documentUpload/<?php echo htmlspecialchars($medi_row['document_approved']); ?>" download><?php echo htmlspecialchars($medi_row['document_approved']); ?></a>
                        <?php else: ?>
                            No document uploaded.
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
