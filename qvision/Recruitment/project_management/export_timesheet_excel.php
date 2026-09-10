<?php
session_start();
require '../../../connect.php';
require '../../../user.php';
require '../../../vendor/autoload.php'; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$userrole = $_SESSION['userrole'];

$f_from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
$f_to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
$f_dept = isset($_GET['dept_id']) ? $_GET['dept_id'] : '';

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$headers = [
    'SL.No', 'Emp Code', 'Employee Name', 'Reporting Person', 'Date', 'In Time',
    '9.30-10.30 (Plan)', '9.30-10.30 (Actual)',
    '10.30-11.30 (Plan)', '10.30-11.30 (Actual)',
    '11.30-12.30 (Plan)', '11.30-12.30 (Actual)',
    '12.30-01.30 (Plan)', '12.30-01.30 (Actual)',
    '01.30-02.30 (Plan)', '01.30-02.30 (Actual)',
    '02.30-03.30 (Plan)', '02.30-03.30 (Actual)',
    '03.30-04.30 (Plan)', '03.30-04.30 (Actual)',
    '04.30-05.30 (Plan)', '04.30-05.30 (Actual)',
    '05.30-06.30 (Plan)', '05.30-06.30 (Actual)',
    'Over Time'
];

$col = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($col . '1', $header);
    $sheet->getStyle($col . '1')->getFont()->setBold(true);
    $col++;
}

$user_id = $_SESSION['userid'];
$logged_in_staff_id = 0;
$logged_in_dep_id = 0;
$logged_in_head_status = 0;

$staff_id_query = $con->query("SELECT s.id, s.dep_id, s.head_status FROM z_user_master u JOIN staff_master s ON u.candidate_id = s.candid_id WHERE u.user_id = '$user_id'");
if($row = $staff_id_query->fetch(PDO::FETCH_ASSOC)) {
    $logged_in_staff_id = $row['id'];
    $logged_in_dep_id = $row['dep_id'];
    $logged_in_head_status = $row['head_status'];
}

$all_staff_q = $con->query("SELECT id, candid_id, reporting_person, emp_name FROM staff_master");
$direct_reports = [];
$manager_names = [];
while($st = $all_staff_q->fetch(PDO::FETCH_ASSOC)) {
    $rep_id = (int)$st['reporting_person'];
    $direct_reports[$rep_id][] = $st;
    $manager_names[$st['id']] = $st['emp_name'];
}

$allowed_candid_ids = [];

function get_all_descendants($manager_id, $direct_reports, &$allowed_candid_ids) {
    if(isset($direct_reports[$manager_id])) {
        foreach($direct_reports[$manager_id] as $staff) {
            if(!in_array($staff['candid_id'], $allowed_candid_ids)) {
                $allowed_candid_ids[] = $staff['candid_id'];
                get_all_descendants($staff['id'], $direct_reports, $allowed_candid_ids);
            }
        }
    }
}

$where_clauses = ["1=1"];

if($f_from_date != '') { $where_clauses[] = "a.date >= '$f_from_date'"; }
if($f_to_date != '') { $where_clauses[] = "a.date <= '$f_to_date'"; }
if($f_dept != '') { $where_clauses[] = "b.dep_id = '$f_dept'"; }

if($userrole == 'R001' || $userrole == 'R003' || $userrole == 'Admin') {
   
} else {
    get_all_descendants($logged_in_staff_id, $direct_reports, $allowed_candid_ids);
    $ids_str = empty($allowed_candid_ids) ? "-1" : implode(',', $allowed_candid_ids);
    
    if($logged_in_head_status == '1') {
        $where_clauses[] = "(b.dep_id = '$logged_in_dep_id' OR a.staff_id IN ($ids_str))";
    } else {
        $where_clauses[] = "a.staff_id IN ($ids_str)";
    }
}

$where_sql = implode(' AND ', $where_clauses);

$query = $con->query("
    SELECT a.*, b.emp_code, b.emp_name, b.reporting_person 
    FROM time_sheet a 
    LEFT JOIN staff_master b ON a.staff_id = b.candid_id 
    WHERE $where_sql 
    ORDER BY b.reporting_person DESC, a.date DESC, a.id DESC
");

$rowNum = 2; 
$i = 1;
while($row = $query->fetch(PDO::FETCH_ASSOC)) {
    
    $rep_id = (int)$row['reporting_person'];
    $m_name = isset($manager_names[$rep_id]) ? $manager_names[$rep_id] : 'Direct / Admin';

    $dataRow = [
        $i, 
        $row['emp_code'], 
        $row['emp_name'], 
        $m_name, 
        $row['date'], 
        $row['one'],
        $row['two'], $row['a_two'],
        $row['three'], $row['a_three'],
        $row['four'], $row['a_four'],
        $row['five'], $row['a_five'],
        $row['six'], $row['a_six'],
        $row['seven'], $row['a_seven'],
        $row['eight'], $row['a_eight'],
        $row['nine'], $row['a_nine'],
        $row['ten'], $row['a_ten'],
        $row['over_time']
    ];

    $col = 'A';
    foreach($dataRow as $val) {
        $sheet->setCellValue($col . $rowNum, $val);
        $col++;
    }
    
    $rowNum++;
    $i++;
}

// Auto size columns up to the last column
$lastCol = 'A';
for($c=0; $c<count($headers)-1; $c++) { $lastCol++; }

$curr = 'A';
while(true) {
    $sheet->getColumnDimension($curr)->setAutoSize(true);
    if($curr === $lastCol) break;
    $curr++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Time_Sheet_Report_' . date('Y-m-d') . '.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>