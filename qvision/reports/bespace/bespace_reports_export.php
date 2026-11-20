
<?php
/*
 * BEspace - Export to Excel (.xlsx)
 * Exports the same records shown in the report.
 * Columns: S.No, Date, Employee, Department, Attendance,
 * Half day reason, Work done, Machines, Work status, Remarks.
 */

date_default_timezone_set('Asia/Kolkata');

/* ---------- DATABASE SETTINGS ---------- */
$BE_HOST = 'localhost';
$BE_NAME = 'demobluebase_aeronero';
$BE_USER = 'root';
$BE_PASS = '';

/* ---------- HELPER FUNCTIONS ---------- */

function validDate($d) {
    $x = DateTime::createFromFormat('Y-m-d', $d);
    return $x && $x->format('Y-m-d') === $d;
}

function fail($msg) {
    http_response_code(400);
    header('Content-Type: text/plain; charset=utf-8');
    exit($msg);
}

/* XML-safe text for Excel cells */
function x($v) {
    $v = (string)($v ?? '');

    $v = preg_replace(
        '/[^\x{9}\x{A}\x{D}\x{20}-\x{D7FF}\x{E000}-\x{FFFD}]/u',
        '',
        $v
    );

    return htmlspecialchars($v, ENT_XML1 | ENT_QUOTES, 'UTF-8');
}

/* Excel column number */
function col($i) {
    $name = '';

    while ($i >= 0) {
        $name = chr(($i % 26) + 65) . $name;
        $i = (int)floor($i / 26) - 1;
    }

    return $name;
}

/* ---------- CHECK ZIP EXTENSION ---------- */

if (!class_exists('ZipArchive')) {
    fail('The PHP zip extension is not enabled. Enable extension=zip in php.ini and restart Apache.');
}

/* ---------- FILTER VALUES ---------- */

$fromDate = $_GET['from_date'] ?? date('Y-m-01');
$toDate   = $_GET['to_date'] ?? date('Y-m-d');
$employee = trim($_GET['employee'] ?? '');

if (!validDate($fromDate) || !validDate($toDate)) {
    fail('Enter valid dates.');
}

if ($fromDate > $toDate) {
    fail('From date cannot be after To date.');
}

/* ---------- GET DATA ---------- */

try {

    $pdo = new PDO(
        "mysql:host=$BE_HOST;dbname=$BE_NAME;charset=utf8mb4",
        $BE_USER,
        $BE_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

    $sql = "SELECT
                work_date,
                worker_name,
                department,
                attendance,
                half_day_reason,
                work_done,
                machines,
                work_status,
                remarks
            FROM daily_work_records
            WHERE work_date BETWEEN :from AND :to";

    $params = [
        ':from' => $fromDate,
        ':to' => $toDate
    ];

    if ($employee !== '') {
        $sql .= " AND worker_name = :emp";
        $params[':emp'] = $employee;
    }

    $sql .= " ORDER BY work_date DESC, worker_name ASC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    $rows = $stmt->fetchAll();

} catch (PDOException $ex) {

    error_log($ex->getMessage());
    fail('Could not connect to the BEspace database.');
}

/* ---------- EXCEL HEADERS ---------- */

$headers = [
    'S.No',
    'Date',
    'Employee',
    'Department',
    'Attendance',
    'Half day reason',
    'Work done',
    'Machines',
    'Work status',
    'Remarks'
];

$widths = [
    7, 12, 22, 18, 13,
    28, 36, 11, 16, 36
];

/* ---------- BUILD EXCEL ROWS ---------- */

$sheetRows = '<row r="1">';

foreach ($headers as $i => $h) {

    $column = col($i);

    $sheetRows .= '<c r="' . $column . '1" t="inlineStr" s="1">
        <is><t>' . x($h) . '</t></is>
    </c>';
}

$sheetRows .= '</row>';

foreach ($rows as $n => $r) {

    $rn = $n + 2;

    $sheetRows .= '<row r="' . $rn . '">';

    /* A - S.No */
    $sheetRows .= '<c r="A' . $rn . '" s="2">
        <v>' . ($n + 1) . '</v>
    </c>';

    /* B - Date */
    $date = !empty($r['work_date'])
        ? date('d/m/Y', strtotime($r['work_date']))
        : '';

    $text = [
        1 => $date,                       // B - Date
        2 => $r['worker_name'],           // C - Employee
        3 => $r['department'],            // D - Department
        4 => $r['attendance'],            // E - Attendance
        5 => $r['half_day_reason'],       // F - Half day reason
        6 => $r['work_done'],             // G - Work done
        8 => $r['work_status'],           // I - Work status
        9 => $r['remarks']                // J - Remarks
    ];

    foreach ($text as $i => $v) {

        $column = col($i);

        $sheetRows .= '<c r="' . $column . $rn . '" t="inlineStr" s="2">
            <is><t xml:space="preserve">' . x($v) . '</t></is>
        </c>';
    }

    /* H - Machines */
    $sheetRows .= '<c r="H' . $rn . '" s="2">
        <v>' . (int)($r['machines'] ?? 0) . '</v>
    </c>';

    $sheetRows .= '</row>';
}

/* ---------- COLUMN WIDTHS ---------- */

$cols = '';

foreach ($widths as $i => $w) {

    $columnNumber = $i + 1;

    $cols .= '<col min="' . $columnNumber . '"
        max="' . $columnNumber . '"
        width="' . $w . '"
        customWidth="1"/>';
}

/* ---------- LAST ROW ---------- */

$lastRow = count($rows) + 1;

/* ---------- WORKSHEET XML ---------- */

$sheetXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
    . '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
    . '<sheetViews><sheetView workbookViewId="0">'
    . '<pane ySplit="1" topLeftCell="A2" activePane="bottomLeft" state="frozen"/>'
    . '</sheetView></sheetViews>'
    . '<cols>' . $cols . '</cols>'
    . '<sheetData>' . $sheetRows . '</sheetData>'
    . '<autoFilter ref="A1:J' . $lastRow . '"/>'
    . '</worksheet>';

/* ---------- EXCEL STYLES ---------- */

$stylesXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
    . '<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
    . '<fonts count="2">'
    . '<font><sz val="11"/><name val="Calibri"/></font>'
    . '<font><b/><sz val="11"/><color rgb="FFFFFFFF"/><name val="Calibri"/></font>'
    . '</fonts>'
    . '<fills count="3">'
    . '<fill><patternFill patternType="none"/></fill>'
    . '<fill><patternFill patternType="gray125"/></fill>'
    . '<fill><patternFill patternType="solid"><fgColor rgb="FF009FE3"/><bgColor indexed="64"/></patternFill></fill>'
    . '</fills>'
    . '<borders count="2">'
    . '<border><left/><right/><top/><bottom/><diagonal/></border>'
    . '<border>'
    . '<left style="thin"><color rgb="FFD9E2EA"/></left>'
    . '<right style="thin"><color rgb="FFD9E2EA"/></right>'
    . '<top style="thin"><color rgb="FFD9E2EA"/></top>'
    . '<bottom style="thin"><color rgb="FFD9E2EA"/></bottom>'
    . '<diagonal/>'
    . '</border>'
    . '</borders>'
    . '<cellStyleXfs count="1">'
    . '<xf numFmtId="0" fontId="0" fillId="0" borderId="0"/>'
    . '</cellStyleXfs>'
    . '<cellXfs count="3">'
    . '<xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0"/>'
    . '<xf numFmtId="0" fontId="1" fillId="2" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment vertical="center"/></xf>'
    . '<xf numFmtId="0" fontId="0" fillId="0" borderId="1" xfId="0" applyBorder="1" applyAlignment="1"><alignment vertical="top" wrapText="1"/></xf>'
    . '</cellXfs>'
    . '<cellStyles count="1">'
    . '<cellStyle name="Normal" xfId="0" builtinId="0"/>'
    . '</cellStyles>'
    . '</styleSheet>';

/* ---------- CONTENT TYPES ---------- */

$contentTypes = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
    . '<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">'
    . '<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>'
    . '<Default Extension="xml" ContentType="application/xml"/>'
    . '<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>'
    . '<Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>'
    . '<Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/>'
    . '</Types>';

/* ---------- ROOT RELATIONSHIPS ---------- */

$rootRels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
    . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
    . '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>'
    . '</Relationships>';

/* ---------- WORKBOOK ---------- */

$workbook = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
    . '<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" '
    . 'xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">'
    . '<sheets><sheet name="BEspace Work Report" sheetId="1" r:id="rId1"/></sheets>'
    . '<definedNames>'
    . '<definedName name="_xlnm._FilterDatabase" localSheetId="0" hidden="1">'
    . '\'BEspace Work Report\'!$A$1:$J$' . $lastRow
    . '</definedName>'
    . '</definedNames>'
    . '</workbook>';

/* ---------- WORKBOOK RELATIONSHIPS ---------- */

$workbookRels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
    . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
    . '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>'
    . '<Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>'
    . '</Relationships>';

/* ---------- CREATE XLSX FILE ---------- */

$tmp = tempnam(sys_get_temp_dir(), 'bexl');

if ($tmp === false) {
    fail('Could not create temporary Excel file.');
}

$zip = new ZipArchive();

if ($zip->open($tmp, ZipArchive::OVERWRITE) !== true) {

    @unlink($tmp);
    fail('Could not create the Excel file.');
}

$zip->addFromString('[Content_Types].xml', $contentTypes);
$zip->addFromString('_rels/.rels', $rootRels);
$zip->addFromString('xl/workbook.xml', $workbook);
$zip->addFromString('xl/_rels/workbook.xml.rels', $workbookRels);
$zip->addFromString('xl/styles.xml', $stylesXml);
$zip->addFromString('xl/worksheets/sheet1.xml', $sheetXml);

$zip->close();

/* ---------- DOWNLOAD ---------- */

$who = $employee === ''
    ? 'All_Employees'
    : preg_replace('/[^A-Za-z0-9_-]+/', '_', $employee);

$file = "BEspace_Work_Report_{$who}_{$fromDate}_to_{$toDate}.xlsx";

/* Clear output buffer */
while (ob_get_level()) {
    ob_end_clean();
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Length: ' . filesize($tmp));
header('Cache-Control: no-store, no-cache, must-revalidate');

readfile($tmp);

unlink($tmp);
exit;
