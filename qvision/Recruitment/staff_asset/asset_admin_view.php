<?php
require '../../../connect.php';

// Get Employee ID from request
$emp_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

// Fetch Employee Details
$staffsel = $con->prepare("SELECT id, emp_name FROM staff_master WHERE id = ?");
$staffsel->execute([$emp_id]);
$data1 = $staffsel->fetch(PDO::FETCH_ASSOC);
$emp_name = $data1 ? $data1['emp_name'] : 'N/A';

// Fetch Staff Asset ID
$staff_asset = $con->prepare("SELECT id FROM staff_asset WHERE emp_name = ?");
$staff_asset->execute([$emp_id]);
$asset = $staff_asset->fetch(PDO::FETCH_ASSOC);
$asset_id = $asset ? $asset['id'] : null;

// Fetch Life Insurance Details
$stmt = $con->prepare("SELECT * FROM life_insurance WHERE emp_id = ?");
$stmt->execute([$emp_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch Mediclaim Insurance Details
$medi = $con->prepare("SELECT * FROM mediclamim_insurance WHERE emp_name = ?");
$medi->execute([$emp_id]);
$medi_row = $medi->fetch(PDO::FETCH_ASSOC);
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
        <form class="form-horizontal">
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
                $i = 1;
                if ($asset_id) {
                    $assetData = $con->prepare("SELECT * FROM staff_asset_serial_no WHERE staff_asset_id = ?");
                    $assetData->execute([$asset_id]);

                    while ($serialno = $assetData->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?>
                                <input type="hidden" name="get_id[]" value="<?php echo $serialno['id']; ?>">
                            </td>
                            <td><input type="text" class="form-control" name="asset_name[]" value="<?php echo htmlspecialchars($serialno['asset_name']); ?>" readonly></td>
                            <td><input type="text" class="form-control" name="serial_number[]" value="<?php echo htmlspecialchars($serialno['serial_number']); ?>" readonly></td>
                        </tr>
                        <?php
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>No assets found.</td></tr>";
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
        <form class="form-horizontal">
            <table class="table table-bordered">
                <tr>
                    <td>Insurance Name</td>
                    <td colspan="2"><input type="text" class="form-control" name="life_insurance_name" value="<?php echo isset($row['insurance_name']) ? htmlspecialchars($row['insurance_name']) : 'N/A'; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Insurance Number</td>
                    <td colspan="2"><input type="text" class="form-control" name="life_insurance_number" value="<?php echo isset($row['insurance_no']) ? htmlspecialchars($row['insurance_no']) : 'N/A'; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Validity From</td>
                    <td colspan="2"><input type="date" class="form-control" name="validity_from" value="<?php echo isset($row['validity_from']) ? $row['validity_from'] : ''; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Validity To</td>
                    <td colspan="2"><input type="date" class="form-control" name="validity_to" value="<?php echo isset($row['validity_to']) ? $row['validity_to'] : ''; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Policy Period</td>
                    <td colspan="2"><input type="text" class="form-control" name="policy_period" value="<?php echo isset($row['policy_period']) ? htmlspecialchars($row['policy_period']) : 'N/A'; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Eligible criteria</td>
                    <td colspan="2"><input type="text" class="form-control" name="eligiblity" value="<?php echo isset($row['eligiblity']) ? htmlspecialchars($row['eligiblity']) : 'N/A'; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Document Upload</td>
                    <td>
                        <?php if (!empty($row['Insurance_doc'])) : ?>
                            <a href="qvision/Recruitment/staff_asset/life_insurance/lifeInsuranceDoc/<?php echo htmlspecialchars($row['Insurance_doc']); ?>" download><?php echo htmlspecialchars($row['Insurance_doc']); ?></a>
                        <?php else : ?>
                            No document available.
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
        <form class="form-horizontal">
            <table class="table table-bordered">
                <tr>
                    <td>Insurance Name:</td>
                    <td colspan="5"><input type="text" class="form-control" name="insurance_name" value="<?php echo isset($medi_row['insurance_name']) ? htmlspecialchars($medi_row['insurance_name']) : 'N/A'; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Insurance Number:</td>
                    <td colspan="5"><input type="number" class="form-control" name="insurance_number" value="<?php echo isset($medi_row['insurance_number']) ? htmlspecialchars($medi_row['insurance_number']) : 'N/A'; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Validate From:</td>
                    <td colspan="5"><input type="date" class="form-control" name="validate_from" value="<?php echo isset($medi_row['validate_from']) ? $medi_row['validate_from'] : ''; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Validate To:</td>
                    <td colspan="5"><input type="date" class="form-control" name="validate_to" value="<?php echo isset($medi_row['validate_to']) ? $medi_row['validate_to'] : ''; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Document Upload</td>
                    <td>
                        <?php if (!empty($medi_row['document_approved'])) : ?>
                            <a href="qvision/Recruitment/staff_asset/mediclaim_insurance/documentUpload/<?php echo htmlspecialchars($medi_row['document_approved']); ?>" download><?php echo htmlspecialchars($medi_row['document_approved']); ?></a>
                        <?php else : ?>
                            No document available.
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
