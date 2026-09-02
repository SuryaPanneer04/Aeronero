<?php
require '../../../connect.php';
require '../../../vendor/autoload.php'; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$headers = ['SL.No', 'Emp Code', 'Employee Name', 'Date', '9 AM - 10 AM', '10 AM - 11 AM', '11 AM - 12 PM', '12 PM - 1 PM', '1 PM - 2 PM', '2 PM - 3 PM', '3 PM - 4 PM', '4 PM - 5 PM', '5 PM - 6 PM', 'Over Time'];

$col = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($col . '1', $header);
    $sheet->getStyle($col . '1')->getFont()->setBold(true);
    $col++;
}

$query = $con->query("SELECT a.*, b.emp_code, b.emp_name FROM time_sheet a LEFT JOIN staff_master b ON a.staff_id = b.candid_id ORDER BY a.date DESC");

$rowNum = 2; 
$i = 1;
while($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $sheet->setCellValue('A' . $rowNum, $i);
    $sheet->setCellValue('B' . $rowNum, $row['emp_code']);
    $sheet->setCellValue('C' . $rowNum, $row['emp_name']);
    $sheet->setCellValue('D' . $rowNum, $row['date']);
    $sheet->setCellValue('E' . $rowNum, $row['one']);
    $sheet->setCellValue('F' . $rowNum, $row['two']);
    $sheet->setCellValue('G' . $rowNum, $row['three']);
    $sheet->setCellValue('H' . $rowNum, $row['four']);
    $sheet->setCellValue('I' . $rowNum, $row['five']);
    $sheet->setCellValue('J' . $rowNum, $row['six']);
    $sheet->setCellValue('K' . $rowNum, $row['seven']);
    $sheet->setCellValue('L' . $rowNum, $row['eight']);
    $sheet->setCellValue('M' . $rowNum, $row['nine']);
    $sheet->setCellValue('N' . $rowNum, $row['over_time']);
    
    $rowNum++;
    $i++;
}
foreach (range('A', 'N') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Time_Sheet_Report_' . date('Y-m-d') . '.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>