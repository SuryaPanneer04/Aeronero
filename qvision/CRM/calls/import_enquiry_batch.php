<?php
require '../../../connect.php';
include("../../../user.php");
require '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$user_id = $_SESSION['userid'] ?? 45;
$message = "";
$status = "";
$success_count = 0;
$error_count = 0;
$errors = [];

if (isset($_POST['import_submit']) && isset($_FILES['excel_file'])) {
    $file = $_FILES['excel_file'];
    
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $message = "File upload error. Please try again.";
        $status = "danger";
    } else {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['xlsx', 'xls', 'csv'])) {
            $message = "Please upload an Excel (.xlsx, .xls) or CSV (.csv) file.";
            $status = "danger";
        } else { 
            try {
                $spreadsheet = IOFactory::load($file['tmp_name']);
                $sheet = $spreadsheet->getActiveSheet();
                $rows = $sheet->toArray();
                
                // Row 1 is Title, Row 2 is Header. Data starts at Row 3 (index 2)
                $data_start_index = 2;
                
                // If row 1 is headers directly:
                if (isset($rows[0][0]) && strtolower(trim($rows[0][0])) === 's.no') {
                    $data_start_index = 1;
                }
                
                $con->beginTransaction();
                
                for ($i = $data_start_index; $i < count($rows); $i++) {
                    $row = $rows[$i];
                    
                    // Skip empty rows
                    $client_org   = trim($row[1] ?? '');
                    $client_name  = trim($row[2] ?? '');
                    $contact_raw  = trim($row[4] ?? '');
                    
                    if (empty($client_org) && empty($client_name) && empty($contact_raw)) {
                        continue;
                    }
                    
                    $cust_type_str = strtolower(trim($row[3] ?? ''));
                    $cust_type     = ($cust_type_str === 'individual') ? 2 : 1;
                    $client_type   = ($cust_type === 2) ? 3 : 2; // 2=Corp New, 3=Indiv New
                    
                    // Format contact
                    $contact = $contact_raw;
                    if (!empty($contact) && !str_starts_with($contact, '+')) {
                        $contact = '+91-' . ltrim($contact, '0');
                    }
                    
                    $whatsapp         = trim($row[5] ?? '') ?: $contact_raw;
                    $email            = trim($row[6] ?? '');
                    $alt_email        = trim($row[7] ?? '');
                    $address          = trim($row[8] ?? '');
                    $website          = trim($row[9] ?? '');
                    
                    $prod_str         = strtolower(trim($row[10] ?? ''));
                    $product          = ($prod_str === 'services' || $prod_str === 'service') ? '2' : '1';
                    $services         = 12;
                    
                    $remarks          = trim($row[11] ?? '');
                    $feedback_text    = trim($row[12] ?? '') ?: 'Initial Enquiry received';
                    
                    $feedback_date_raw= trim($row[13] ?? '');
                    $feedback_date    = !empty($feedback_date_raw) ? date('Y-m-d', strtotime($feedback_date_raw)) : date('Y-m-d');
                    
                    $follup_date_raw  = trim($row[14] ?? '');
                    $follup_date      = !empty($follup_date_raw) ? date('Y-m-d', strtotime($follup_date_raw)) : date('Y-m-d', strtotime('+7 days'));
                    
                    $created_on       = $feedback_date;
                    $role_id          = 'R018';
                    $call_type        = 4; // By Mail / Enquiry
                    $flag             = 1;
                    $initial_status   = 1;
                    
                    // 1. Insert into crm_calls
                    $stmt_calls = $con->prepare("
                        INSERT INTO crm_calls 
                        (cust_type, call_type, client_type, client_org, client_name, role_id,
                         contact, whatsapp, email, alternative_mail, website, address, Product, services,
                         created_by, created_on, status, flag, remarks)
                        VALUES 
                        (:cust_type, :call_type, :client_type, :client_org, :client_name, :role_id,
                         :contact, :whatsapp, :email, :alt_email, :website, :address, :product, :services,
                         :created_by, :created_on, :status, :flag, :remarks)
                    ");
                    
                    $stmt_calls->execute([
                        ':cust_type'   => $cust_type,
                        ':call_type'   => $call_type,
                        ':client_type' => $client_type,
                        ':client_org'  => $client_org ?: 'Individual Customer',
                        ':client_name' => $client_name ?: $client_org,
                        ':role_id'     => $role_id,
                        ':contact'     => $contact,
                        ':whatsapp'    => $whatsapp,
                        ':email'       => $email,
                        ':alt_email'   => $alt_email,
                        ':website'     => $website,
                        ':address'     => $address,
                        ':product'     => $product,
                        ':services'    => $services,
                        ':created_by'  => $user_id,
                        ':created_on'  => $created_on,
                        ':status'      => $initial_status,
                        ':flag'        => $flag,
                        ':remarks'     => $remarks
                    ]);
                    
                    $call_id = $con->lastInsertId();
                    
                    if ($call_id) {
                        // 2. Insert into crm_calls_feedback
                        $stmt_fb = $con->prepare("
                            INSERT INTO crm_calls_feedback 
                            (calls_id, feedback, feedback_date, date, created_by, created_on)
                            VALUES 
                            (:calls_id, :feedback, :feedback_date, :followup_date, :created_by, :created_on)
                        ");
                        
                        $stmt_fb->execute([
                            ':calls_id'      => $call_id,
                            ':feedback'      => $feedback_text,
                            ':feedback_date' => $feedback_date,
                            ':followup_date' => $follup_date,
                            ':created_by'    => $user_id,
                            ':created_on'    => $created_on
                        ]);
                        
                        // Update status to 2 (Contacted/Feedback Added)
                        $con->exec("UPDATE crm_calls SET status = 2 WHERE id = $call_id");
                        
                        $success_count++;
                    } else {
                        $error_count++;
                        $errors[] = "Row " . ($i + 1) . ": Failed to insert call for '$client_name'";
                    }
                }
                
                $con->commit();
                $message = "Successfully imported $success_count enquiry records into crm_calls and crm_calls_feedback!";
                $status = "success";
                
            } catch (Exception $e) {
                if ($con->inTransaction()) {
                    $con->rollBack();
                }
                $message = "Error during import: " . $e->getMessage();
                $status = "danger";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batch Enquiry Import - Aeronero CRM</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .card { border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); margin-top: 30px; }
        .card-header { background-color: #009EE3 !important; color: white; border-top-left-radius: 8px; border-top-right-radius: 8px; }
        .btn-custom { background-color: #009EE3; color: white; font-weight: 600; }
        .btn-custom:hover { background-color: #0077b5; color: white; }
        .download-box { background: #e8f4fc; border: 1px dashed #009EE3; border-radius: 6px; padding: 15px; margin-bottom: 20px; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-file-excel mr-2"></i> Bulk Enquiry & Feedback Excel Importer</h4>
                    <a href="calls_list.php" class="btn btn-sm btn-light"><i class="fas fa-arrow-left mr-1"></i> Back to Calls</a>
                </div>
                <div class="card-body">
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-<?php echo $status; ?> alert-dismissible fade show">
                            <strong><?php echo ($status === 'success') ? '<i class="fas fa-check-circle mr-1"></i> Success!' : '<i class="fas fa-exclamation-triangle mr-1"></i> Error!'; ?></strong>
                            <?php echo $message; ?>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-warning">
                            <h6>Errors Encountered:</h6>
                            <ul class="mb-0">
                                <?php foreach ($errors as $err): ?>
                                    <li><?php echo htmlspecialchars($err); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Download Template Box -->
                    <div class="download-box d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-primary mb-1"><i class="fas fa-download mr-1"></i> Client Excel Template</h6>
                            <p class="text-muted small mb-0">Use this pre-formatted Excel template to collect enquiry records from your client.</p>
                        </div>
                        <a href="Enquiry_List_Template.xlsx" class="btn btn-outline-primary btn-sm" download>
                            <i class="fas fa-file-excel mr-1"></i> Download Template (.xlsx)
                        </a>
                    </div>

                    <!-- Upload Form -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="excel_file" class="font-weight-bold">Select Filled Excel / CSV File:</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="excel_file" name="excel_file" accept=".xlsx,.xls,.csv" required>
                                <label class="custom-file-label" for="excel_file">Choose file (.xlsx, .xls, .csv)...</label>
                            </div>
                            <small class="form-text text-muted">Supports 1000+ rows. Data will be automatically inserted into <code>crm_calls</code> and linked to <code>crm_calls_feedback</code>.</small>
                        </div>

                        <div class="form-group text-center mt-4">
                            <button type="submit" name="import_submit" class="btn btn-custom btn-lg px-5">
                                <i class="fas fa-cloud-upload-alt mr-2"></i> Import to Database
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-white text-muted small">
                    <strong>Tables Affected:</strong> <code>crm_calls</code> (Main Call Record) and <code>crm_calls_feedback</code> (Linked Feedback Record).
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
</body>
</html>
