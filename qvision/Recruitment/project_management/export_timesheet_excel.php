<?php
session_start();
require '../../../connect.php';
require '../../../user.php';
require '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

date_default_timezone_set('Asia/Kolkata');

$userrole = $_SESSION['userrole'];

$f_from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
$f_to_date   = isset($_GET['to_date'])   ? $_GET['to_date']   : '';
$f_dept      = isset($_GET['dept_id'])   ? $_GET['dept_id']   : '';
$f_emp       = isset($_GET['emp_id'])    ? $_GET['emp_id']    : '';

// ---------- Project id -> name map ----------
$project_map = [];
$pq = $con->query("SELECT project_id, project_name, project_code FROM y_project_details");
while ($p = $pq->fetch(PDO::FETCH_ASSOC)) {
    $label = $p['project_name'];
    if (!empty($p['project_code'])) {
        $label .= ' (' . $p['project_code'] . ')';
    }
    $project_map[(string)$p['project_id']] = $label;
}

function project_names($val, $project_map)
{
    $val = (string)$val;
    if ($val === '') {
        return '';
    }
    $ids = json_decode($val, true);
    if (!is_array($ids)) {
        $ids = [$val];
    }
    $names = [];
    foreach ($ids as $id) {
        $id = (string)$id;
        if ($id === 'Others') {
            $names[] = 'Others';
        } elseif (isset($project_map[$id])) {
            $names[] = $project_map[$id];
        } else {
            $names[] = $id;
        }
    }
    return implode(', ', $names);
}

// label, plan column, actual column, project column
$slots = [
    ['9.30-10.30',  'two',   'a_two',   'p_two'],
    ['10.30-11.30', 'three', 'a_three', 'p_three'],
    ['11.30-12.30', 'four',  'a_four',  'p_four'],
    ['12.30-01.30', 'five',  'a_five',  'p_five'],
    ['01.30-02.30', 'six',   'a_six',   'p_six'],
    ['02.30-03.30', 'seven', 'a_seven', 'p_seven'],
    ['03.30-04.30', 'eight', 'a_eight', 'p_eight'],
    ['04.30-05.30', 'nine',  'a_nine',  'p_nine'],
    ['05.30-06.30', 'ten',   'a_ten',   'p_ten'],
];

// ---------- Logged-in user ----------
$user_id = $_SESSION['userid'];
$logged_in_staff_id = 0;
$logged_in_dep_id = 0;
$logged_in_head_status = 0;

$me = $con->prepare("SELECT s.id, s.dep_id, s.head_status
                     FROM z_user_master u
                     JOIN staff_master s ON u.candidate_id = s.candid_id
                     WHERE u.user_id = ?");
$me->execute([$user_id]);
if ($row = $me->fetch(PDO::FETCH_ASSOC)) {
    $logged_in_staff_id = $row['id'];
    $logged_in_dep_id = $row['dep_id'];
    $logged_in_head_status = $row['head_status'];
}

// ---------- Hierarchy ----------
$all_staff_q = $con->query("SELECT id, candid_id, reporting_person, emp_name FROM staff_master");
$direct_reports = [];
$manager_names = [];
while ($st = $all_staff_q->fetch(PDO::FETCH_ASSOC)) {
    $rep_id = (int)$st['reporting_person'];
    $direct_reports[$rep_id][] = $st;
    $manager_names[$st['id']] = $st['emp_name'];
}

$allowed_candid_ids = [];

function get_all_descendants($manager_id, $direct_reports, &$allowed_candid_ids)
{
    if (isset($direct_reports[$manager_id])) {
        foreach ($direct_reports[$manager_id] as $staff) {
            if (!in_array($staff['candid_id'], $allowed_candid_ids)) {
                $allowed_candid_ids[] = $staff['candid_id'];
                get_all_descendants($staff['id'], $direct_reports, $allowed_candid_ids);
            }
        }
    }
}

// ---------- Filters ----------
$where  = ["1=1"];
$params = [];

if ($f_from_date !== '') { $where[] = "a.date >= ?";    $params[] = $f_from_date; }
if ($f_to_date   !== '') { $where[] = "a.date <= ?";    $params[] = $f_to_date; }
if ($f_dept      !== '') { $where[] = "b.dep_id = ?";   $params[] = $f_dept; }
if ($f_emp       !== '') { $where[] = "a.staff_id = ?"; $params[] = $f_emp; }

if (!($userrole == 'R001' || $userrole == 'R003' || $userrole == 'Admin')) {
    get_all_descendants($logged_in_staff_id, $direct_reports, $allowed_candid_ids);

    if (empty($allowed_candid_ids)) {
        $in_sql = "-1";
        $in_params = [];
    } else {
        $in_sql = implode(',', array_fill(0, count($allowed_candid_ids), '?'));
        $in_params = $allowed_candid_ids;
    }

    if ($logged_in_head_status == '1') {
        $where[] = "(b.dep_id = ? OR a.staff_id IN ($in_sql))";
        $params[] = $logged_in_dep_id;
    } else {
        $where[] = "a.staff_id IN ($in_sql)";
    }
    foreach ($in_params as $ip) {
        $params[] = $ip;
    }
}

$where_sql = implode(' AND ', $where);

$stmt = $con->prepare("
    SELECT a.*, b.emp_code, b.emp_name, b.reporting_person
    FROM time_sheet a
    LEFT JOIN staff_master b ON a.staff_id = b.candid_id
    WHERE $where_sql
    ORDER BY b.reporting_person DESC, b.emp_name ASC, a.date DESC, a.id DESC
");
$stmt->execute($params);

// ---------- Spreadsheet ----------
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Time Sheet');
$spreadsheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);

$setText = function ($cell, $value) use ($sheet) {
    // Always store as text so a value starting with "=" is never read as a formula
    $sheet->setCellValueExplicit($cell, (string)$value, DataType::TYPE_STRING);
};

// --- Layout: columns 1-6 info, then 3 columns (Project, Plan, Actual) per slot, then Over Time (Project, Task)
$info_headers = ['SL.No', 'Emp Code', 'Employee Name', 'Reporting Person', 'Date', 'In Time'];
$info_widths  = [7, 11, 24, 22, 12, 10];

$W_PROJECT = 24;
$W_PLAN    = 30;
$W_ACTUAL  = 50;

$HDR_COLORS = ['009EE3', '0B5C8A'];   // alternating slot header colors
$TINT_COLORS = ['F2F9FD', 'FFFFFF'];  // alternating body tint

// Info columns: merged over header rows 1-2
foreach ($info_headers as $i => $h) {
    $c = Coordinate::stringFromColumnIndex($i + 1);
    $sheet->setCellValue($c . '1', $h);
    $sheet->mergeCells("{$c}1:{$c}2");
    $sheet->getColumnDimension($c)->setWidth($info_widths[$i]);
    $sheet->getStyle("{$c}1:{$c}2")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('1F2937');
}

$col_index = 7;
$slot_ranges = []; // [startIndex, endIndex, bandIndex, kind]

foreach ($slots as $k => $s) {
    $start = $col_index;
    $c1 = Coordinate::stringFromColumnIndex($start);
    $c2 = Coordinate::stringFromColumnIndex($start + 1);
    $c3 = Coordinate::stringFromColumnIndex($start + 2);

    $sheet->setCellValue($c1 . '1', $s[0]);
    $sheet->mergeCells("{$c1}1:{$c3}1");
    $sheet->setCellValue($c1 . '2', 'Project');
    $sheet->setCellValue($c2 . '2', 'Plan (To-do)');
    $sheet->setCellValue($c3 . '2', 'Actual (Completed)');

    $sheet->getColumnDimension($c1)->setWidth($W_PROJECT);
    $sheet->getColumnDimension($c2)->setWidth($W_PLAN);
    $sheet->getColumnDimension($c3)->setWidth($W_ACTUAL);

    $band = $k % 2;
    $sheet->getStyle("{$c1}1:{$c3}2")->getFill()->setFillType(Fill::FILL_SOLID)
          ->getStartColor()->setRGB($HDR_COLORS[$band]);

    $slot_ranges[] = [$start, $start + 2, $band];
    $col_index += 3;
}

// Over Time (Project + Task)
$ot1 = Coordinate::stringFromColumnIndex($col_index);
$ot2 = Coordinate::stringFromColumnIndex($col_index + 1);
$sheet->setCellValue($ot1 . '1', 'Over Time');
$sheet->mergeCells("{$ot1}1:{$ot2}1");
$sheet->setCellValue($ot1 . '2', 'Project');
$sheet->setCellValue($ot2 . '2', 'Task');
$sheet->getColumnDimension($ot1)->setWidth($W_PROJECT);
$sheet->getColumnDimension($ot2)->setWidth($W_ACTUAL);
$otBand = count($slots) % 2;
$sheet->getStyle("{$ot1}1:{$ot2}2")->getFill()->setFillType(Fill::FILL_SOLID)
      ->getStartColor()->setRGB($HDR_COLORS[$otBand]);
$slot_ranges[] = [$col_index, $col_index + 1, $otBand];

$lastColIndex  = $col_index + 1;
$lastColLetter = Coordinate::stringFromColumnIndex($lastColIndex);

// Header styling (rows 1-2)
$sheet->getStyle("A1:{$lastColLetter}2")->applyFromArray([
    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical'   => Alignment::VERTICAL_CENTER,
        'wrapText'   => true,
    ],
    'borders' => [
        'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FFFFFF']],
    ],
]);
$sheet->getRowDimension(1)->setRowHeight(22);
$sheet->getRowDimension(2)->setRowHeight(20);

// ---------- Data rows (one row per employee per day) ----------
$rowNum = 3;
$sl = 1;

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $rep_id = (int)$row['reporting_person'];
    $m_name = isset($manager_names[$rep_id]) ? $manager_names[$rep_id] : 'Direct / Admin';
    $date_txt = $row['date'] ? date('d-m-Y', strtotime($row['date'])) : '';

    $sheet->setCellValue('A' . $rowNum, $sl);
    $setText('B' . $rowNum, $row['emp_code']);
    $setText('C' . $rowNum, $row['emp_name']);
    $setText('D' . $rowNum, $m_name);
    $setText('E' . $rowNum, $date_txt);
    $setText('F' . $rowNum, $row['one']);

    $ci = 7;
    foreach ($slots as $s) {
        $setText(Coordinate::stringFromColumnIndex($ci)     . $rowNum, project_names($row[$s[3]] ?? '', $project_map));
        $setText(Coordinate::stringFromColumnIndex($ci + 1) . $rowNum, $row[$s[1]] ?? '');
        $setText(Coordinate::stringFromColumnIndex($ci + 2) . $rowNum, $row[$s[2]] ?? '');
        $ci += 3;
    }
    $setText(Coordinate::stringFromColumnIndex($ci)     . $rowNum, project_names($row['p_over_time'] ?? '', $project_map));
    $setText(Coordinate::stringFromColumnIndex($ci + 1) . $rowNum, $row['over_time'] ?? '');

    $rowNum++;
    $sl++;
}

$lastRow = max($rowNum - 1, 2);

// ---------- Body formatting ----------
if ($lastRow >= 3) {
    $body = "A3:{$lastColLetter}{$lastRow}";

    $sheet->getStyle($body)->getAlignment()
          ->setWrapText(true)
          ->setVertical(Alignment::VERTICAL_TOP);

    $sheet->getStyle($body)->getBorders()->getAllBorders()
          ->setBorderStyle(Border::BORDER_THIN)->getColor()->setRGB('D0D7DE');

    $sheet->getStyle("A3:A{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("E3:F{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    // Alternate light tint per slot so it is easy to follow while scrolling right
    foreach ($slot_ranges as $r) {
        $a = Coordinate::stringFromColumnIndex($r[0]);
        $b = Coordinate::stringFromColumnIndex($r[1]);
        if ($TINT_COLORS[$r[2]] !== 'FFFFFF') {
            $sheet->getStyle("{$a}3:{$b}{$lastRow}")->getFill()
                  ->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($TINT_COLORS[$r[2]]);
        }
    }
}

// Freeze header rows and the first 6 info columns
$sheet->freezePane('G3');

// Filter on the sub-header row
$sheet->setAutoFilter("A2:{$lastColLetter}{$lastRow}");

// Print setup
$sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
$sheet->getPageSetup()->setFitToPage(true);
$sheet->getPageSetup()->setFitToWidth(1);
$sheet->getPageSetup()->setFitToHeight(0);
$sheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 2);

// ---------- File name ----------
$file_tag = '';
if ($f_emp !== '') {
    $n = $con->prepare("SELECT emp_name FROM staff_master WHERE candid_id = ?");
    $n->execute([$f_emp]);
    $emp_name = $n->fetchColumn();
    if ($emp_name) {
        $file_tag = '_' . preg_replace('/[^A-Za-z0-9]+/', '_', $emp_name);
    }
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Time_Sheet_Report' . $file_tag . '_' . date('Y-m-d') . '.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>