
<?php
require_once __DIR__ . '/../../../connect.php';
include_once __DIR__ . '/../../../user.php';

$user_id = $_SESSION['userid'] ?? '';
$allowed_import_userid = 45;
?>

<style>
.lead-action-buttons {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    min-width: 250px;
}

.lead-action-btn {
    padding: 4px 8px !important;
    font-size: 11px !important;
    line-height: 1.4 !important;
    border-radius: 4px !important;
    white-space: nowrap;
}

.lead-action-btn i {
    margin-right: 3px;
}

.lead-action-btn:hover {
    opacity: 0.85;
}

.lead-select-checkbox {
    width: 17px;
    height: 17px;
    cursor: pointer;
}

#bulkMoveBtn {
    background: #198754;
    border: 1px solid white;
    color: white;
}

#bulkMoveBtn:disabled {
    opacity: 0.6;
}

#bulkAssignBtn {
    background: #f0ad4e;
    border: 1px solid white;
    color: white;
}

#bulkAssignBtn:disabled {
    opacity: 0.6;
}

#leadsTable_wrapper {
    width: 100%;
}

#leadsTable td {
    vertical-align: middle;
}
</style>

<div class="card card-primary">

    <div class="card-header"
         style="background:#009EE3;color:white;">

        <h3 class="card-title">
            Leads List
        </h3>

        <button type="button"
                onclick="leadsAdd()"
                class="btn btn-primary"
                style="float:right;background:#009EE3;border:1px solid white;margin-left:8px;">
            <i class="fa fa-plus"></i> ADD
        </button>

        <button type="button"
                id="bulkAssignBtn"
                class="btn btn-warning"
                onclick="openAssignModal()"
                style="float:right;margin-left:8px;"
                disabled>

            <i class="fa fa-user-plus"></i>
            Assign
            (<span id="selectedAssignCount">0</span>)
        </button>

        <button type="button"
                id="bulkMoveBtn"
                class="btn btn-success"
                onclick="moveSelectedLeads()"
                style="float:right;margin-left:8px;"
                disabled>

            <i class="fa fa-exchange"></i>
            Move Selected
            (<span id="selectedLeadCount">0</span>)
        </button>

        <?php if ((int)$user_id === $allowed_import_userid): ?>

        <button type="button"
                onclick="openImportModal()"
                class="btn btn-success"
                style="float:right;border:1px solid white;">

            <i class="fa fa-file-excel-o"></i>
            Import Excel
        </button>

        <?php endif; ?>

    </div>

    <div class="card-body">

        <div id="leadsError"
             class="alert alert-danger"
             style="display:none;">
        </div>

        <div class="table-responsive">

            <table id="leadsTable"
                   class="table table-bordered table-striped display nowrap"
                   style="width:100%;">

                <thead>
                    <tr>
                        <th>
                            <input type="checkbox"
                                   class="lead-select-checkbox select-all-leads"
                                   title="Select current page">
                        </th>
                        <th>#</th>
                        <th>Date</th>
                        <th>Organisation</th>
                        <th>Client</th>
                        <th>Call Source</th>
                        <th>Contact No</th>
                        <th>Feedback</th>
                        <th>Feedback Date</th>
                        <th>Followup Date</th>
                        <th>Created By</th>
                        <th>Assigned</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody></tbody>

            </table>

        </div>
    </div>
</div>

<!-- Excel Import Modal -->
<div id="excelImportModal"
     style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;">

    <div style="background:#fff;width:500px;max-width:90%;margin:8% auto;padding:20px;border-radius:6px;">

        <h4>
            Import Leads from Excel

            <span onclick="closeImportModal()"
                  style="float:right;cursor:pointer;">
                &times;
            </span>
        </h4>

        <form id="excelImportForm">

            <div class="form-group">
                <label>Select Excel File</label>

                <input type="file"
                       id="excelFileInput"
                       class="form-control"
                       accept=".xlsx,.xls,.csv"
                       required>
            </div>

            <div id="importStatus"
                 style="display:none;margin-top:10px;">
            </div>

            <div style="text-align:right;margin-top:20px;">

                <button type="button"
                        class="btn btn-secondary"
                        onclick="closeImportModal()">
                    Cancel
                </button>

                <button type="submit"
                        id="importSubmitBtn"
                        class="btn btn-success">
                    Upload & Insert
                </button>

            </div>
        </form>
    </div>
</div>

<!-- Assign Leads Modal -->
<div id="assignLeadModal"
     style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;">

    <div style="background:#fff;width:500px;max-width:90%;margin:8% auto;padding:20px;border-radius:6px;">

        <h4>
            Assign Selected Leads (<span id="assignModalLeadCount">0</span>)

            <span onclick="closeAssignModal()"
                  style="float:right;cursor:pointer;">
                &times;
            </span>
        </h4>

        <form id="assignLeadForm">

            <div class="form-group" style="margin-top:15px;">
                <label for="assignDepartment">Department</label>
                <select id="assignDepartment"
                        name="department_id"
                        class="form-control"
                        required>
                    <option value="">-- Select Department --</option>
                </select>
            </div>

            <div class="form-group" style="margin-top:15px;">
                <label for="assignMember">Department Member</label>
                <select id="assignMember"
                        name="member_id"
                        class="form-control"
                        required
                        disabled>
                    <option value="">-- Select Department First --</option>
                </select>
            </div>

            <div id="assignStatus"
                 style="display:none;margin-top:10px;">
            </div>

            <div style="text-align:right;margin-top:20px;">

                <button type="button"
                        class="btn btn-secondary"
                        onclick="closeAssignModal()">
                    Cancel
                </button>

                <button type="submit"
                        id="assignSubmitBtn"
                        class="btn btn-primary">
                    Assign
                </button>

            </div>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>

// Global initialization function.
// Can be called whenever the Leads page is opened.
window.initLeadsTable = function () {

    if (!window.jQuery || !$.fn.DataTable) {
        console.error('DataTables library is missing.');
        return;
    }

    var $table = $('#leadsTable');

    if (!$table.length) {
        return;
    }

    // Prevent duplicate initialization.
    if ($.fn.DataTable.isDataTable($table[0])) {
        return;
    }

    $('#leadsError').hide().text('');

    $table.DataTable({

        processing: true,
        serverSide: true,

        pageLength: 10,
        lengthChange: false,
        paging: true,
        searching: true,
        ordering: true,
        info: true,

        searchDelay: 400,
        scrollX: true,
        autoWidth: false,

        order: [[1, 'desc']],

        // Search, pagination and information controls.
        dom: 'Bfrtip',

        buttons: $.fn.dataTable.Buttons ? [
            {
                extend: 'excelHtml5',
                text: 'Export Current Page',
                title: 'Aeronero_Leads',
                exportOptions: {
                    columns: [1,2,3,4,5,6,7,8,9,10,11,12]
                }
            }
        ] : [],

        ajax: {
            url: 'qvision/CRM/calls/leads_data.php',
            type: 'POST',
            dataType: 'json',

            error: function (xhr) {

                console.error(
                    'Leads loading error:',
                    xhr.status,
                    xhr.responseText
                );

                $('#leadsError')
                    .text(
                        'Unable to load leads. ' +
                        'Please check the server response.'
                    )
                    .show();
            }
        },

        columnDefs: [
            {
                targets: [0, 13],
                orderable: false,
                searchable: false
            },
            {
                targets: [5, 6, 7, 8, 9, 10, 11, 12],
                orderable: false
            }
        ],

        drawCallback: function () {

            $('.select-all-leads')
                .prop('checked', false)
                .prop('indeterminate', false);

            updateSelectedLeadCount();
        },

        initComplete: function () {
            console.log('Leads DataTable initialized.');
        }
    });
};


// Initialize when content is available.
if (typeof window.initLeadsTable === "function") {
    window.initLeadsTable();
}


// Add Lead
function leadsAdd() {

    $.ajax({
        type: 'POST',
        url: 'qvision/CRM/calls/leads_add.php',

        success: function (html) {
            $('#main_content').html(html);
        },

        error: function () {
            alert('Unable to open the Add Lead form.');
        }
    });
}


// Edit Lead
function calls_edit(id) {

    $.ajax({
        type: 'POST',
        url: 'qvision/CRM/calls/leads_edit.php?id=' + id,

        success: function (html) {
            $('#main_content').html(html);
        },

        error: function (xhr) {
            console.error(xhr.responseText);
            alert('Unable to open Edit Lead form.');
        }
    });
}


// Reload Leads
function loadLeadsList() {

    if (
        $.fn.DataTable &&
        $.fn.DataTable.isDataTable('#leadsTable')
    ) {

        $('#leadsTable')
            .DataTable()
            .ajax.reload(null, false);

        return;
    }

    $.ajax({
        type: 'POST',
        url: 'qvision/CRM/calls/leads_list.php',

        success: function (html) {

            $('#main_content').html(html);

           // Initialize Leads after AJAX content is inserted.
if (
    window.jQuery &&
    typeof window.initLeadsTable === 'function'
) {
    window.initLeadsTable();
}
        },

        error: function (xhr) {
            console.error(xhr.responseText);
            alert('Unable to reload Leads List.');
        }
    });
}


// Move one Lead
function moveLead(id) {

    if (!confirm('Move this lead to Enquiry?')) {
        return;
    }

    $.ajax({
        type: 'POST',
        url: 'qvision/CRM/calls/leads_move_to_enquiry.php',

        data: { id: id },
        dataType: 'json',

        success: function (res) {

            alert(res.message);

            if (Number(res.status) === 1) {
                loadLeadsList();
            }
        },

        error: function (xhr) {
            console.error(xhr.responseText);
            alert('Unable to move lead.');
        }
    });
}


// Prevent checkbox from triggering sorting.
$(document)
.off('click.leadCheckboxSort')
.on('click.leadCheckboxSort', '.select-all-leads', function (e) {
    e.stopPropagation();
});


// Select current page only.
$(document)
.off('change.leadSelectAll')
.on('change.leadSelectAll', '.select-all-leads', function () {

    var checked = this.checked;

    $('#leadsTable tbody .lead-row-checkbox')
        .prop('checked', checked);

    updateSelectedLeadCount();
});


// Individual checkbox
$(document)
.off('change.leadRowSelect')
.on('change.leadRowSelect', '.lead-row-checkbox', function () {
    updateSelectedLeadCount();
});


// Get selected Lead IDs
function getSelectedLeadIds() {

    var ids = [];

    $('#leadsTable tbody .lead-row-checkbox:checked')
        .each(function () {
            ids.push($(this).val());
        });

    return ids;
}


// Update checkbox selection count
function updateSelectedLeadCount() {

    var selectedIds = getSelectedLeadIds();

    $('#selectedLeadCount')
        .text(selectedIds.length);

    $('#selectedAssignCount')
        .text(selectedIds.length);

    $('#bulkMoveBtn').prop(
        'disabled',
        selectedIds.length === 0
    );

    $('#bulkAssignBtn').prop(
        'disabled',
        selectedIds.length === 0
    );

    var total = $('#leadsTable tbody .lead-row-checkbox')
        .length;

    var checked = $('#leadsTable tbody .lead-row-checkbox:checked')
        .length;

    $('.select-all-leads')
        .prop('checked', total > 0 && total === checked)
        .prop(
            'indeterminate',
            checked > 0 && checked < total
        );
}


// Move selected Leads
function moveSelectedLeads() {

    var selectedIds = getSelectedLeadIds();

    if (selectedIds.length === 0) {
        alert('Please select at least one lead.');
        return;
    }

    if (!confirm(
        'Move ' + selectedIds.length +
        ' selected leads to Enquiry?'
    )) {
        return;
    }

    $('#bulkMoveBtn')
        .prop('disabled', true)
        .html(
            '<i class="fa fa-spinner fa-spin"></i> Moving...'
        );

    $.ajax({
        type: 'POST',
        url: 'qvision/CRM/calls/leads_move_to_enquiry.php',

        data: { ids: selectedIds },
        dataType: 'json',

        success: function (res) {

            alert(res.message);

            resetBulkMoveButton();

            if (Number(res.status) === 1) {
                loadLeadsList();
            } else {
                updateSelectedLeadCount();
            }
        },

        error: function (xhr) {

            console.error(xhr.responseText);
            alert('Unable to move selected leads.');

            resetBulkMoveButton();
            updateSelectedLeadCount();
        }
    });
}


// Reset Move Selected button
function resetBulkMoveButton() {

    $('#bulkMoveBtn').html(
        '<i class="fa fa-exchange"></i> ' +
        'Move Selected ' +
        '(<span id="selectedLeadCount">0</span>)'
    );
}


// Delete Lead Feedback
function deleteLeadFeedback(id) {

    if (!confirm(
        'Delete all feedback records for this lead? ' +
        'The lead itself will remain.'
    )) {
        return;
    }

    $.ajax({
        type: 'POST',
        url: 'qvision/CRM/calls/leads_delete_feedback.php',

        data: { id: id },
        dataType: 'json',

        success: function (res) {

            alert(res.message);

            if (Number(res.status) === 1) {
                loadLeadsList();
            }
        },

        error: function (xhr) {

            console.error(xhr.responseText);
            alert('Unable to delete feedback.');
        }
    });
}


// Open Import modal
function openImportModal() {

    $('#excelFileInput').val('');

    $('#importStatus')
        .hide()
        .text('');

    $('#excelImportModal').fadeIn(200);
}


// Close Import modal
function closeImportModal() {
    $('#excelImportModal').fadeOut(200);
}


// Excel Import
$(document)
.off('submit.leadExcelImport', '#excelImportForm')
.on('submit.leadExcelImport', '#excelImportForm', function (e) {

    e.preventDefault();

    var fileInput =
        document.getElementById('excelFileInput');

    if (!fileInput || !fileInput.files.length) {
        alert('Please select an Excel file.');
        return;
    }

    if (typeof XLSX === 'undefined') {
        alert('Excel library not loaded.');
        return;
    }

    var file = fileInput.files[0];
    var reader = new FileReader();

    $('#importSubmitBtn')
        .prop('disabled', true)
        .text('Processing...');

    $('#importStatus')
        .show()
        .css('color', '#0056b3')
        .text('Reading Excel file...');

    reader.onload = function (event) {

        try {

            var data = new Uint8Array(
                event.target.result
            );

            var workbook = XLSX.read(data, {
                type: 'array',
                cellDates: true
            });

            var sheetName = workbook.SheetNames[0];
            var worksheet = workbook.Sheets[sheetName];

            var rows = XLSX.utils.sheet_to_json(
                worksheet,
                {
                    defval: '',
                    raw: false
                }
            );

            if (rows.length === 0) {

                $('#importStatus')
                    .css('color', 'red')
                    .text('Excel file is empty.');

                $('#importSubmitBtn')
                    .prop('disabled', false)
                    .text('Upload & Insert');

                return;
            }

            $('#importStatus').text(
                'Uploading ' + rows.length + ' rows...'
            );

            $.ajax({

                type: 'POST',
                url: 'qvision/CRM/calls/leads_import_excel.php',

                data: JSON.stringify({
                    rows: rows
                }),

                contentType: 'application/json',
                dataType: 'json',

                success: function (res) {

                    $('#importSubmitBtn')
                        .prop('disabled', false)
                        .text('Upload & Insert');

                    if (Number(res.status) === 1) {

                        alert(res.message);
                        closeImportModal();
                        loadLeadsList();

                    } else {

                        $('#importStatus')
                            .css('color', 'red')
                            .text(
                                res.message || 'Import failed.'
                            );
                    }
                },

                error: function (xhr) {

                    console.error(xhr.responseText);

                    $('#importSubmitBtn')
                        .prop('disabled', false)
                        .text('Upload & Insert');

                    $('#importStatus')
                        .css('color', 'red')
                        .text('Server error during import.');
                }
            });

        } catch (error) {

            console.error(error);

            $('#importSubmitBtn')
                .prop('disabled', false)
                .text('Upload & Insert');

            $('#importStatus')
                .css('color', 'red')
                .text('Invalid Excel file.');
        }
    };

    reader.onerror = function () {

        $('#importSubmitBtn')
            .prop('disabled', false)    
            .text('Upload & Insert');

        $('#importStatus')
            .css('color', 'red')
            .text('Unable to read the file.');
    };

    reader.readAsArrayBuffer(file);
});


// Open Assign Modal
function openAssignModal() {

    var selectedIds = getSelectedLeadIds();

    if (selectedIds.length === 0) {
        alert('Please select at least one lead to assign.');
        return;
    }

    $('#assignModalLeadCount').text(selectedIds.length);
    $('#assignStatus').hide().text('');

    $('#assignDepartment')
        .prop('disabled', true)
        .html('<option value="">Loading departments...</option>');

    $('#assignMember')
        .prop('disabled', true)
        .html('<option value="">-- Select Department First --</option>');

    $('#assignLeadModal').fadeIn(200);

    $.ajax({
        type: 'GET',
        url: 'qvision/CRM/calls/get_assign_options.php',
        data: { action: 'departments' },
        dataType: 'json',

        success: function (res) {

            var options = '<option value="">-- Select Department --</option>';

            if (Number(res.status) === 1 && Array.isArray(res.data)) {
                $.each(res.data, function (i, dept) {
                    options += '<option value="' + dept.id + '">' + dept.dept_name + '</option>';
                });
            }

            $('#assignDepartment')
                .html(options)
                .prop('disabled', false);
        },

        error: function (xhr) {
            console.error(xhr.responseText);
            $('#assignDepartment')
                .html('<option value="">Failed to load departments</option>')
                .prop('disabled', false);
        }
    });
}


// Close Assign Modal
function closeAssignModal() {
    $('#assignLeadModal').fadeOut(200);
}


// Load Department Members when Department changes
$(document)
.off('change.assignDept', '#assignDepartment')
.on('change.assignDept', '#assignDepartment', function () {

    var deptId = $(this).val();

    if (!deptId) {
        $('#assignMember')
            .prop('disabled', true)
            .html('<option value="">-- Select Department First --</option>');
        return;
    }

    $('#assignMember')
        .prop('disabled', true)
        .html('<option value="">Loading members...</option>');

    $.ajax({
        type: 'GET',
        url: 'qvision/CRM/calls/get_assign_options.php',
        data: {
            action: 'members',
            department_id: deptId
        },
        dataType: 'json',

        success: function (res) {

            var options = '<option value="">-- Select Member --</option>';

            if (Number(res.status) === 1 && Array.isArray(res.data) && res.data.length > 0) {
                $.each(res.data, function (i, member) {
                    options += '<option value="' + member.user_id + '">' + member.display_name + '</option>';
                });

                $('#assignMember')
                    .html(options)
                    .prop('disabled', false);
            } else {
                $('#assignMember')
                    .html('<option value="">No members found in this department</option>')
                    .prop('disabled', true);
            }
        },

        error: function (xhr) {
            console.error(xhr.responseText);
            $('#assignMember')
                .html('<option value="">Failed to load members</option>')
                .prop('disabled', true);
        }
    });
});


// Submit Assign Form
$(document)
.off('submit.assignLeads', '#assignLeadForm')
.on('submit.assignLeads', '#assignLeadForm', function (e) {

    e.preventDefault();

    var selectedIds = getSelectedLeadIds();
    var deptId = $('#assignDepartment').val();
    var memberId = $('#assignMember').val();

    if (selectedIds.length === 0) {
        alert('Please select at least one lead.');
        return;
    }

    if (!deptId || !memberId) {
        alert('Please select both a department and a member.');
        return;
    }

    $('#assignSubmitBtn')
        .prop('disabled', true)
        .text('Assigning...');

    $('#assignStatus')
        .show()
        .css('color', '#0056b3')
        .text('Assigning selected leads...');

    $.ajax({
        type: 'POST',
        url: 'qvision/CRM/calls/leads_assign.php',
        data: {
            ids: selectedIds,
            department_id: deptId,
            member_id: memberId
        },
        dataType: 'json',

        success: function (res) {

            $('#assignSubmitBtn')
                .prop('disabled', false)
                .text('Assign');

            if (Number(res.status) === 1) {
                alert(res.message || 'Leads assigned successfully.');
                closeAssignModal();
                loadLeadsList();
            } else {
                $('#assignStatus')
                    .css('color', 'red')
                    .text(res.message || 'Unable to assign leads.');
            }
        },

        error: function (xhr) {
            console.error(xhr.responseText);

            $('#assignSubmitBtn')
                .prop('disabled', false)
                .text('Assign');

            $('#assignStatus')
                .css('color', 'red')
                .text('Server error while assigning leads.');
        }
    });
});

</script>
