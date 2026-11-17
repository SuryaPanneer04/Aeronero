<?php
require_once __DIR__ . '/../../../connect.php';

$from_date = isset($_GET['from_date']) ? trim($_GET['from_date']) : '';
$to_date = isset($_GET['to_date']) ? trim($_GET['to_date']) : '';

// Also check legacy candate parameter if passed
if (empty($from_date) && !empty($_GET['candate'])) {
    $from_date = trim($_GET['candate']);
    $to_date = trim($_GET['candate']);
}

// Build WHERE clause based on created_on
$where = [];
$params = [];

if (!empty($from_date) && !empty($to_date)) {
    $where[] = "a.created_on BETWEEN :from_date AND :to_date";
    $params[':from_date'] = $from_date;
    $params[':to_date'] = $to_date;
    $fileSuffix = "_{$from_date}_to_{$to_date}";
} elseif (!empty($from_date)) {
    $where[] = "a.created_on >= :from_date";
    $params[':from_date'] = $from_date;
    $fileSuffix = "_from_{$from_date}";
} elseif (!empty($to_date)) {
    $where[] = "a.created_on <= :to_date";
    $params[':to_date'] = $to_date;
    $fileSuffix = "_upto_{$to_date}";
} else {
    $fileSuffix = "_all";
}

$where_sql = count($where) > 0 ? "WHERE " . implode(" AND ", $where) : "";

$query = "SELECT a.id, a.client_org, a.client_name, a.created_on, a.created_by, a.status,
       u.full_name AS created_by_name,
       fb.feedback, fb.feedback_date, fb.date AS followup_date
FROM crm_calls a
LEFT JOIN (
    SELECT f1.calls_id, f1.feedback, f1.feedback_date, f1.date
    FROM crm_calls_feedback f1
    INNER JOIN (
        SELECT calls_id, MAX(id) as max_id FROM crm_calls_feedback GROUP BY calls_id
    ) f2 ON f1.id = f2.max_id
) fb ON a.id = fb.calls_id
LEFT JOIN z_user_master u ON a.created_by = u.user_id
{$where_sql}
ORDER BY a.id DESC";

$stmt = $con->prepare($query);
$stmt->execute($params);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$filename = "Enquiry_Report" . $fileSuffix . ".xlsx";

$autoloadPath = __DIR__ . '/../../../vendor/autoload.php';
$hasPhpSpreadsheet = false;

if (file_exists($autoloadPath)) {
    require_once $autoloadPath;
    if (class_exists('PhpOffice\PhpSpreadsheet\Spreadsheet')) {
        $hasPhpSpreadsheet = true;
    }
}

if ($hasPhpSpreadsheet) {
    try {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Enquiries');

        // Headers
        $headers = [
            'A1' => '#',
            'B1' => 'Date',
            'C1' => 'Organisation',
            'D1' => 'Client',
            'E1' => 'Feedback',
            'F1' => 'Feedback Date',
            'G1' => 'Followup Date',
            'H1' => 'Created By',
            'I1' => 'Status'
        ];

        foreach ($headers as $cell => $val) {
            $sheet->setCellValue($cell, $val);
        }

        // Header Styling
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '009EE3']
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'D0D0D0']
                ]
            ]
        ];
        $sheet->getStyle('A1:I1')->applyFromArray($headerStyle);
        $sheet->getRowDimension(1)->setRowHeight(26);

        $rowNum = 2;
        $cnt = 1;
        foreach ($rows as $data) {
            $statusText = in_array((int)$data['status'], [1, 2, 3, 4]) ? 'Active' : 'Inactive';
            $fbDate = (!empty($data['feedback_date']) && $data['feedback_date'] != '0000-00-00') ? $data['feedback_date'] : '-';
            $foDate = (!empty($data['followup_date']) && $data['followup_date'] != '0000-00-00') ? $data['followup_date'] : '-';
            $createdBy = !empty($data['created_by_name']) ? $data['created_by_name'] : ($data['created_by'] ?? '-');

            $sheet->setCellValue('A' . $rowNum, $cnt);
            $sheet->setCellValue('B' . $rowNum, !empty($data['created_on']) ? $data['created_on'] : '-');
            $sheet->setCellValue('C' . $rowNum, !empty($data['client_org']) ? $data['client_org'] : '-');
            $sheet->setCellValue('D' . $rowNum, !empty($data['client_name']) ? $data['client_name'] : '-');
            $sheet->setCellValue('E' . $rowNum, !empty($data['feedback']) ? $data['feedback'] : '-');
            $sheet->setCellValue('F' . $rowNum, $fbDate);
            $sheet->setCellValue('G' . $rowNum, $foDate);
            $sheet->setCellValue('H' . $rowNum, $createdBy);
            $sheet->setCellValue('I' . $rowNum, $statusText);

            $dataRowStyle = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => 'E0E0E0']
                    ]
                ],
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ]
            ];
            $sheet->getStyle('A' . $rowNum . ':I' . $rowNum)->applyFromArray($dataRowStyle);
            $sheet->getStyle('A' . $rowNum)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('B' . $rowNum)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('F' . $rowNum)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('G' . $rowNum)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('I' . $rowNum)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $rowNum++;
            $cnt++;
        }

        foreach (range('A', 'I') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        if (ob_get_length()) ob_end_clean();
        if (!headers_sent()) {
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    } catch (\Exception $e) {
        // Fallback to HTML Excel if PhpSpreadsheet error
    }
}

// Fallback HTML/XML Excel download (.xls)
$filenameXls = "Enquiry_Report" . $fileSuffix . ".xls";
if (ob_get_length()) ob_end_clean();
if (!headers_sent()) {
    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=\"$filenameXls\"");
    header("Pragma: no-cache");
    header("Expires: 0");
}

echo "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns=\"http://www.w3.org/TR/REC-html40\">";
echo "<head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"></head>";
echo "<body>";
echo "<table border='1' style='border-collapse:collapse;'>";
echo "<tr style='background-color:#009EE3; color:#FFFFFF; font-weight:bold; height:30px; text-align:center;'>";
echo "<th>#</th>";
echo "<th>Date</th>";
echo "<th>Organisation</th>";
echo "<th>Client</th>";
echo "<th>Feedback</th>";
echo "<th>Feedback Date</th>";
echo "<th>Followup Date</th>";
echo "<th>Created By</th>";
echo "<th>Status</th>";
echo "</tr>";

$cnt = 1;
foreach ($rows as $data) {
    $statusText = in_array((int)$data['status'], [1, 2, 3, 4]) ? 'Active' : 'Inactive';
    $fbDate = (!empty($data['feedback_date']) && $data['feedback_date'] != '0000-00-00') ? htmlspecialchars($data['feedback_date']) : '-';
    $foDate = (!empty($data['followup_date']) && $data['followup_date'] != '0000-00-00') ? htmlspecialchars($data['followup_date']) : '-';
    $createdBy = !empty($data['created_by_name']) ? htmlspecialchars($data['created_by_name']) : htmlspecialchars($data['created_by'] ?? '-');

    echo "<tr>";
    echo "<td style='text-align:center;'>{$cnt}</td>";
    echo "<td style='text-align:center;'>" . htmlspecialchars($data['created_on'] ?: '-') . "</td>";
    echo "<td>" . htmlspecialchars($data['client_org'] ?: '-') . "</td>";
    echo "<td>" . htmlspecialchars($data['client_name'] ?: '-') . "</td>";
    echo "<td>" . htmlspecialchars($data['feedback'] ?: '-') . "</td>";
    echo "<td style='text-align:center;'>{$fbDate}</td>";
    echo "<td style='text-align:center;'>{$foDate}</td>";
    echo "<td>{$createdBy}</td>";
    echo "<td style='text-align:center;'>{$statusText}</td>";
    echo "</tr>";
    $cnt++;
}
echo "</table>";
echo "</body></html>";
exit;
