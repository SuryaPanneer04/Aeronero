<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require('../../connect.php');

// Fetch candidate details for active staff (status = 1 in staff_master)
$sql = "SELECT 
            s.emp_code,
            c.first_name, 
            c.last_name, 
            c.father_name, 
            c.dob, 
            c.address, 
            c.phone, 
            c.adharnumber, 
            c.pannumber, 
            c.joining_date, 
            c.approved_ctc 
        FROM staff_master s 
        INNER JOIN candidate_form_details c ON s.candid_id = c.id 
        WHERE s.status = 1 
        ORDER BY s.id DESC";

$stmt = $con->query($sql);
$staff_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- DataTables Buttons CSS for Export functionality -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">


<style>
/* Main Staff Card */
.staff-card {
    border: none !important;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
}

/* Header Layout */
.staff-card .card-header {
    padding: 18px 22px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* Title */
.staff-card .card-title {
    font-size: 21px;
    font-weight: 600;
    margin: 0;
}

/* Export Buttons */
.staff-export {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    margin-left: auto;
}

.staff-export .btn {
    padding: 7px 18px;
    border-radius: 5px;
    font-weight: 600;
    transition: 0.2s;
}

.staff-export .btn:hover {
    opacity: 0.85;
    transform: translateY(-1px);
}

/* Table Area */
.staff-card .card-body {
    padding: 22px;
    background: #ffffff;
}

/* Table Header */
#staffDetailsTable thead th {
    background-color: #f1f4f8;
    color: #343a40;
    font-size: 13px;
    font-weight: 600;
    padding: 13px 10px;
    white-space: nowrap;
    vertical-align: middle;
}

/* Table Rows */
#staffDetailsTable tbody td {
    padding: 12px 10px;
    font-size: 13px;
    vertical-align: middle;
}

#staffDetailsTable tbody tr:hover {
    background-color: #f2f8fc;
}

/* Table Borders */
#staffDetailsTable {
    border-collapse: collapse !important;
    width: 100% !important;
}

/* Mobile Responsive */
@media (max-width: 576px) {
    .staff-card .card-header {
        flex-wrap: wrap;
        gap: 15px;
    }

    .staff-export {
        width: 100%;
    }

    .staff-export .btn {
        flex: 1;
    }

    .staff-card .card-body {
        padding: 12px;
    }
}
</style>



<div class="card card-primary staff-card">

    <div class="card-header">

        <h3 class="card-title">
            <i class="fa fa-users mr-2"></i>
            Active Staff Details
        </h3>

        <div class="staff-export">

            <button type="button"
                    class="btn btn-success btn-sm"
                    id="btnExportExcel">
                <i class="fa fa-file-excel mr-1"></i>
                Excel
            </button>

            <button type="button"
                    class="btn btn-danger btn-sm"
                    id="btnExportPdf">
                <i class="fa fa-file-pdf mr-1"></i>
                PDF
            </button>

        </div>

    </div>

    
   <div class="card-body" style="overflow-x: auto;">
        <table id="staffDetailsTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Employee Code</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Father Name</th>
                    <th>DOB</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Aadhaar Number</th>
                    <th>PAN Number</th>
                    <th>Joining Date</th>
                    <th>Approved CTC</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 1;
                foreach($staff_list as $row) { 
                    // Clean up literal 'NULL' strings stored in the database
                    $emp_code = (!empty($row['emp_code']) && $row['emp_code'] !== 'NULL') ? $row['emp_code'] : '-';
                    $first_name   = (!empty($row['first_name']) && $row['first_name'] !== 'NULL') ? $row['first_name'] : '-';
                    $last_name    = (!empty($row['last_name']) && $row['last_name'] !== 'NULL') ? $row['last_name'] : '-';
                    $father_name  = (!empty($row['father_name']) && $row['father_name'] !== 'NULL') ? $row['father_name'] : '-';
                    $dob          = (!empty($row['dob']) && $row['dob'] !== 'NULL') ? $row['dob'] : '-';
                    $address      = (!empty($row['address']) && $row['address'] !== 'NULL') ? $row['address'] : '-';
                    $phone        = (!empty($row['phone']) && $row['phone'] !== 'NULL') ? $row['phone'] : '-';
                    $adharnumber  = (!empty($row['adharnumber']) && $row['adharnumber'] !== 'NULL') ? $row['adharnumber'] : '-';
                    $pannumber    = (!empty($row['pannumber']) && $row['pannumber'] !== 'NULL') ? $row['pannumber'] : '-';
                    $joining_date = (!empty($row['joining_date']) && $row['joining_date'] !== 'NULL') ? $row['joining_date'] : '-';
                    $approved_ctc = (!empty($row['approved_ctc']) && $row['approved_ctc'] !== 'NULL') ? $row['approved_ctc'] : '-';
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo htmlspecialchars($emp_code); ?></td>
                    <td><?php echo htmlspecialchars($first_name); ?></td>
                    <td><?php echo htmlspecialchars($last_name); ?></td>
                    <td><?php echo htmlspecialchars($father_name); ?></td>
                    <td><?php echo htmlspecialchars($dob); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($address)); ?></td>
                    <td><?php echo htmlspecialchars($phone); ?></td>
                    <td><?php echo htmlspecialchars($adharnumber); ?></td>
                    <td><?php echo htmlspecialchars($pannumber); ?></td>
                    <td><?php echo htmlspecialchars($joining_date); ?></td>
                    <td><?php echo htmlspecialchars($approved_ctc); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Required DataTables Export Scripts (JSZip for Excel, pdfmake for PDF) -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {

    if (!$.fn.DataTable.isDataTable('#staffDetailsTable')) {

        var table = $('#staffDetailsTable').DataTable({

            "responsive": true,
            "autoWidth": false,

            "buttons": [

                {
                    extend: 'excelHtml5',
                    title: 'Active_Staff_Details',
                    exportOptions: {
                        columns: ':visible'
                    }
                },

                
{
    extend: 'pdfHtml5',

    title: 'ACTIVE STAFF DETAILS',

    messageTop: function () {
        var today = new Date();

        var date = today.toLocaleDateString('en-GB');

        return 'Staff Information Report | Generated on: ' + date;
    },

    orientation: 'landscape',
    pageSize: 'A4',

    exportOptions: {
        columns: ':visible'
    },

    customize: function (doc) {

        // Page settings
        doc.pageMargins = [20, 35, 20, 30];

        // General font settings
        doc.defaultStyle = {
            fontSize: 7,
            color: '#000000'
        };

        // Title styling
        doc.styles.title = {
            fontSize: 15,
            bold: true,
            color: '#003366',
            alignment: 'center',
            margin: [0, 0, 0, 8]
        };

        // Subtitle styling
        doc.styles.message = {
            fontSize: 8,
            color: '#333333',
            alignment: 'center',
            margin: [0, 0, 0, 12]
        };

        // Find the exported table
        var tableNode = doc.content.find(function (item) {
            return item.table !== undefined;
        });

        if (tableNode) {

            // Table width
            tableNode.table.widths = [
                25, 55, 55, 55, 60, 45, '*',
                70, 70, 65, 65, 60
            ];

            // Table font size
            tableNode.fontSize = 7;

            // Header styling
            var headerCells = tableNode.table.body[0];

            headerCells.forEach(function (cell) {

                cell.fillColor = '#003366';
                cell.color = '#FFFFFF';
                cell.bold = true;
                cell.fontSize = 7;
                cell.alignment = 'center';
                cell.margin = [3, 6, 3, 6];

            });

            // Body row styling
            for (var i = 1; i < tableNode.table.body.length; i++) {

                var row = tableNode.table.body[i];

                row.forEach(function (cell) {

                    cell.fillColor =
                        (i % 2 === 0) ? '#EAF0F7' : '#FFFFFF';

                    cell.color = '#000000';
                    cell.fontSize = 7;
                    cell.margin = [3, 5, 3, 5];
                    cell.alignment = 'left';

                });

                // Center-align serial number
                row[0].alignment = 'center';

            }

            // Table borders
            tableNode.layout = {

                hLineWidth: function () {
                    return 0.5;
                },

                vLineWidth: function () {
                    return 0.5;
                },

                hLineColor: function () {
                    return '#B8CBE0';
                },

                vLineColor: function () {
                    return '#B8CBE0';
                },

                paddingLeft: function () {
                    return 3;
                },

                paddingRight: function () {
                    return 3;
                },

                paddingTop: function () {
                    return 2;
                },

                paddingBottom: function () {
                    return 2;
                }

            };

        }

    }

}


            ]

        });

        // Excel Export Button
        $('#btnExportExcel').on('click', function(e) {

            e.preventDefault();

            table.button('.buttons-excel').trigger();

        });

        // PDF Export Button
        $('#btnExportPdf').on('click', function(e) {

            e.preventDefault();

            table.button('.buttons-pdf').trigger();

        });

    }

});
</script>