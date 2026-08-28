<?php
// Begin output buffering
ob_start();
require '../../../connect.php';

$emp_id = $_REQUEST['emp_name'];
$sr_month = $_REQUEST['sr_month'];

$fromDate = preg_split("/\-/", $sr_month);
$from_year = $fromDate[0];
$from_month = $fromDate[1];

// SQL Query
$staff_sql = $con->query("
    SELECT a.*, p.* FROM staff_master a  
    JOIN payroll_salary_deduction p ON p.employee_code = a.candid_id 
    WHERE a.id = '$emp_id' AND a.status = 1 
    AND p.payroll_year = '$from_year' AND p.payroll_month = '$from_month' 
    GROUP BY p.employee_code
");

?>
<!DOCTYPE html>
<html>
<head>
    <title>Export Salary Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <div class="text-right mb-3">
            <button class="btn btn-success" onclick="ExportToExcel('xlsx')">
                <span class="fa fa-download"></span>&nbsp;Export to Excel
            </button>
        </div>

        <table class="table table-bordered" id="tbl_exporttable_to_xls">
            <thead class="thead-dark">
                <tr>
                    <th>S.No</th>
                    <th>PF No</th>
                    <th>UAN NO</th>
                    <th>ESIC No</th>
                    <th>Employee No</th>
                    <th>DOJ</th>
                    <th>DOMC</th>
                    <th>Experience</th>
                    <th>Location</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Total Gross Salary</th>
                    <th>N.O. Leave Taken (Eligible)</th>
                    <th>NOA</th>
                    <th>LOP/Late</th>
                    <th>Prorrata Salary Deduction</th>
                    <th>Working Days</th>
                    <th>Paid Days Salary</th>
                    <th>Basic</th>
                    <th>HRA</th>
                    <th>OtherAllowance</th>
                    <th>SiteAllowance</th>
                    <th>GrossTotal</th>
                    <th>PF</th>
                    <th>ESI</th>
                    <th>PF Days Deduction</th>
                    <th>ESI Days Deduction</th>
                    <th>PT Deduction</th>
                    <th>Advance</th>
                    <th>TDS</th>
                    <th>E-Claim</th>
                    <th>Net Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $p = 1;
                while($row = $staff_sql->fetch(PDO::FETCH_ASSOC)) {
                    $department_id = $row['dep_id'];
                    $designation_id = $row['design_id'];

                    // Department Name
                    $dept_stmt = $con->query("SELECT dept_name FROM z_department_master WHERE id = '$department_id'");
                    $dept_row = $dept_stmt->fetch(PDO::FETCH_ASSOC);
                    $dept_name = $dept_row['dept_name'] ?? '';

                    // Designation Name
                    $des_stmt = $con->query("SELECT designation_name FROM designation_master WHERE id = '$designation_id'");
                    $des_row = $des_stmt->fetch(PDO::FETCH_ASSOC);
                    $designation_name = $des_row['designation_name'] ?? '';

                    echo "<tr>
                        <td>{$p}</td>
                        <td>{$row['pf_number']}</td>
                        <td>{$row['uan_number']}</td>
                        <td>{$row['esic_number']}</td>
                        <td>{$row['emp_code']}</td>
                        <td>{$row['DOJ']}</td>
                        <td>{$row['DOMC']}</td>
                        <td>{$row['experience']}</td>
                        <td>{$row['location']}</td>
                        <td>{$row['emp_name']}</td>
                        <td>{$dept_name}</td>
                        <td>{$designation_name}</td>
                        <td>{$row['salary_amount']}</td>
                        <td>{$row['no_leave_eligible']}</td>
                        <td>{$row['noa']}</td>
                        <td>{$row['lop']}</td>
                        <td>{$row['pro_rata']}</td>
                        <td>{$row['working_days']}</td>
                        <td>{$row['paid_days']}</td>
                        <td>{$row['basic']}</td>
                        <td>{$row['hra']}</td>
                        <td>{$row['other_allowance']}</td>
                        <td>{$row['site_allowance']}</td>
                        <td>{$row['gross_total']}</td>
                        <td>{$row['pf']}</td>
                        <td>{$row['esi']}</td>
                        <td>{$row['pf_days_deduction']}</td>
                        <td>{$row['esi_days_deduction']}</td>
                        <td>{$row['pt_deduction']}</td>
                        <td>{$row['advance']}</td>
                        <td>{$row['tds']}</td>
                        <td>{$row['eclaim']}</td>
                        <td>{$row['net_amount']}</td>
                    </tr>";
                    $p++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Excel Export Script -->
    <script>
        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('tbl_exporttable_to_xls');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "Sheet1" });
            return dl
                ? XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' })
                : XLSX.writeFile(wb, fn || ('Payroll_Report.' + (type || 'xlsx')));
        }
    </script>
</body>
</html>
