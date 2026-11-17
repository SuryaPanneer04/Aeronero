
<?php
require '../../../connect.php';
include("../../../user.php");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    echo '<div class="alert alert-danger">Invalid Lead ID.</div>';
    exit;
}

$stmt = $con->prepare("SELECT * FROM crm_leads WHERE id = :id LIMIT 1");
$stmt->execute(['id' => $id]);
$lead = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$lead) {
    echo '<div class="alert alert-danger">Lead not found.</div>';
    exit;
}

function leadValue($value) {
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
}

$sourceStmt = $con->query(
    "SELECT id, name FROM lead_sources WHERE status = 1 ORDER BY name"
);
$sources = $sourceStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">

            <div class="card-header">
                <i class="fa fa-edit"></i> Edit Lead

                <button type="button"
                        class="btn btn-primary btn-sm"
                        style="float:right"
                        onclick="editLeadBack()">
                    Back
                </button>
            </div>

            <div class="card-body">
                <form id="editLeadForm">

                    <input type="hidden" name="id"
                           value="<?= (int)$lead['id'] ?>">

                    <table class="table table-bordered">
                        <tr>
                            <th style="width:25%">Call Source</th>
                            <td>
                                <select class="form-control"
                                        name="Call_type" required>
                                    <option value="">Choose Source</option>

                                    <?php foreach ($sources as $source): ?>
                                        <option
                                            value="<?= (int)$source['id'] ?>"
                                            <?= (string)$lead['call_source'] ===
                                                (string)$source['id'] ? 'selected' : '' ?>>
                                            <?= leadValue($source['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th>Client Organisation Name</th>
                            <td>
                                <input type="text"
                                       class="form-control"
                                       name="client_org1"
                                       value="<?= leadValue($lead['client_org']) ?>">
                            </td>
                        </tr>

                        <tr>
                            <th>Client Name</th>
                            <td>
                                <input type="text"
                                       class="form-control"
                                       name="client_name"
                                       value="<?= leadValue($lead['client_name']) ?>">
                            </td>
                        </tr>

                        <tr>
                            <th>Contact Number</th>
                            <td>
                                <input type="text"
                                       class="form-control"
                                       name="contact"
                                       value="<?= leadValue($lead['contact']) ?>">
                            </td>
                        </tr>

                        <tr>
                            <th>WhatsApp Number</th>
                            <td>
                                <input type="text"
                                       class="form-control"
                                       name="whatsapp"
                                       value="<?= leadValue($lead['whatsapp']) ?>">
                            </td>
                        </tr>

                        <tr>
                            <th>Email ID</th>
                            <td>
                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       value="<?= leadValue($lead['email']) ?>">
                            </td>
                        </tr>

                        <tr>
                            <th>Alternative Email</th>
                            <td>
                                <input type="email"
                                       class="form-control"
                                       name="mail"
                                       value="<?= leadValue($lead['alternative_email']) ?>">
                            </td>
                        </tr>

                        <tr>
                            <th>Website</th>
                            <td>
                                <input type="text"
                                       class="form-control"
                                       name="website"
                                       value="<?= leadValue($lead['website']) ?>">
                            </td>
                        </tr>

                        <tr>
                            <th>Address</th>
                            <td>
                                <textarea class="form-control"
                                          name="address"
                                          rows="3"><?= leadValue($lead['address']) ?></textarea>
                            </td>
                        </tr>

                        <tr>
                            <th>Product / Service</th>
                            <td>
                                <select class="form-control" name="Product" id="Product" required>
                                    <option value="">Select</option>
                                    <option value="1" <?= (string)$lead['product_service'] === '1' ? 'selected' : '' ?>>Product</option>
                                    <option value="2" <?= (string)$lead['product_service'] === '2' ? 'selected' : '' ?>>Services</option>
                                </select>
                            </td>
                        </tr>
                                        
                        <tr>
                            <th>Remarks</th>
                            <td>
                                <textarea class="form-control"
                                          name="remarks"
                                          rows="3"><?= leadValue($lead['remarks']) ?></textarea>
                            </td>
                        </tr>
                    </table>

                    <button type="button"
                            class="btn btn-primary"
                            onclick="updateLead()">
                        <i class="fa fa-save"></i> Update Lead
                    </button>

                    <button type="button"
                            class="btn btn-secondary"
                            onclick="editLeadBack()">
                        Cancel
                    </button>

                </form>

                <div id="leadEditMessage" style="margin-top:12px"></div>
            </div>
        </div>
    </div>
</section>

<script>
function editLeadBack() {
    if (typeof loadLeadsList === 'function') {
        loadLeadsList();
    } else {
        $('#main_content').load('qvision/CRM/calls/leads_list.php');
    }
}

function updateLead() {
    var formData = $('#editLeadForm').serialize();

    $.ajax({
        type: 'POST',
        url: 'qvision/CRM/calls/leads_update.php',
        data: formData,
        dataType: 'json',

        success: function(response) {
            if (response.status == 1) {
                alert(response.message);
                editLeadBack();
            } else {
                $('#leadEditMessage').html(
                    '<div class="alert alert-danger"></div>'
                );
                $('#leadEditMessage .alert').text(response.message);
            }
        },

        error: function(xhr) {
            console.error(xhr.responseText);
            alert('Unable to update lead. Check the PHP error log.');
        }
    });
}
</script>
