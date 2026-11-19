
<?php
/*
 * Employee Contact Details - Export to Excel (.xlsx)
 * Exports the same records the report shows, for the chosen filters.
 * Needs the PHP "zip" extension (switch it on in php.ini: extension=zip).
 */

require_once __DIR__ . '/contact_reports_lib.php';

/* ---- Add your Aeronero login check here so only logged-in staff can export ----
 * Example (change the session key to the one your Aeronero login uses):
 * session_start();
 * if (empty($_SESSION['user_id'])) {
 *     http_response_code(403);
 *     exit('Not allowed');
 * }
 */

function cd_fail($msg) {
    http_response_code(400);
    header('Content-Type: text/plain; charset=utf-8');
    exit($msg);
}

/* XML-safe text for Excel cells */
function cd_x($v) {
    $v = preg_replace(
        '/[^\x{9}\x{A}\x{D}\x{20}-\x{D7FF}\x{E000}-\x{FFFD}]/u',
        '',
        (string)$v
    );

    return htmlspecialchars($v, ENT_XML1 | ENT_QUOTES, 'UTF-8');
}

/* Convert zero-based column index to Excel column name */
function cd_col($i) {
    return chr(65 + $i);
}

/* ---------- CHECK ZIP EXTENSION ---------- */

if (!class_exists('ZipArchive')) {
    cd_fail(
        'The PHP zip extension is not enabled. In XAMPP open php.ini, ' .
        'remove the ; before extension=zip, then restart Apache.'
    );
}

/* ---------- GET FILTERS ---------- */

list($f, $errors) = cd_filters($_GET);

if ($errors) {
    cd_fail($errors[0]);
}

/* ---------- FETCH DATA ---------- */

try {
    $rows = cd_fetch(cd_pdo(), $f);

} catch (PDOException $ex) {
    error_log($ex->getMessage());
    cd_fail('Could not connect to the database.');
}

/* ---------- BUILD SHEET ---------- */

$headers = [
    'S.No',
    'Employee ID',
    'Employee Name',
    'Email',
    'Department',
    'Designation',
    'Mobile',
    'Emergency contact',
    'Blood group',
    'Address',
    'Date of Joining'
];

$widths = [
    7, 14, 24, 30, 18, 20,
    14, 18, 12, 40, 16
];

/* ---------- HEADER ROW ---------- */

$sheetRows = '<row r="1">';

foreach ($headers as $i => $h) {
    $sheetRows .= '<c r="' . cd_col($i) . '1" t="inlineStr" s="1"><is><t>'
        . cd_x($h)
        . '</t></is></c>';
}

$sheetRows .= '</row>';

/* ---------- DATA ROWS ---------- */

foreach ($rows as $n => $r) {

    $rn = $n + 2;

    $text = [
        1  => $r['employee_id'] ?? '',       // B - Employee ID
        2  => $r['employee_name'] ?? '',     // C - Employee Name
        3  => $r['email'] ?? '',             // D - Email
        4  => $r['department'] ?? '',        // E - Department
        5  => $r['designation'] ?? '',       // F - Designation
        6  => $r['mobile_number'] ?? '',     // G - Mobile
        7  => $r['emg_mobile'] ?? '',        // H - Emergency Contact
        8  => $r['blood_group'] ?? '',       // I - Blood Group
        9  => $r['address'] ?? '',           // J - Address

        10 => !empty($r['date_of_joining'])
            ? date('d/m/Y', strtotime($r['date_of_joining']))
            : ''                            // K - Date of Joining
    ];

    $sheetRows .= '<row r="' . $rn . '">';

    /* A - S.No */

    $sheetRows .= '<c r="A' . $rn . '" s="2"><v>'
        . ($n + 1)
        . '</v></c>';

    /* B to K - Employee Details */

    foreach ($text as $i => $v) {

        $sheetRows .= '<c r="' . cd_col($i) . $rn . '" t="inlineStr" s="2"><is><t xml:space="preserve">'
            . cd_x($v)
            . '</t></is></c>';
    }

    $sheetRows .= '</row>';
}

/* ---------- COLUMN WIDTHS ---------- */

$cols = '';

foreach ($widths as $i => $w) {

    $cols .= '<col min="' . ($i + 1)
        . '" max="' . ($i + 1)
        . '" width="' . $w
        . '" customWidth="1"/>';
}

$lastRow = count($rows) + 1;

/* ---------- WORKSHEET XML ---------- */

$sheetXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
  . '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
  . '<sheetViews><sheetView workbookViewId="0"><pane ySplit="1" topLeftCell="A2" activePane="bottomLeft" state="frozen"/></sheetView></sheetViews>'
  . '<cols>' . $cols . '</cols>'
  . '<sheetData>' . $sheetRows . '</sheetData>'
  . '<autoFilter ref="A1:K' . $lastRow . '"/>'
  . '</worksheet>';

/* ---------- STYLES XML ---------- */

$stylesXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
  . '<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
  . '<fonts count="2"><font><sz val="11"/><name val="Calibri"/></font>'
  . '<font><b/><sz val="11"/><color rgb="FFFFFFFF"/><name val="Calibri"/></font></fonts>'
  . '<fills count="3"><fill><patternFill patternType="none"/></fill><fill><patternFill patternType="gray125"/></fill>'
  . '<fill><patternFill patternType="solid"><fgColor rgb="FF009FE3"/><bgColor indexed="64"/></patternFill></fill></fills>'
  . '<borders count="2"><border><left/><right/><top/><bottom/><diagonal/></border>'
  . '<border><left style="thin"><color rgb="FFD9E2EA"/></left><right style="thin"><color rgb="FFD9E2EA"/></right>'
  . '<top style="thin"><color rgb="FFD9E2EA"/></top><bottom style="thin"><color rgb="FFD9E2EA"/></bottom><diagonal/></border></borders>'
  . '<cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0"/></cellStyleXfs>'
  . '<cellXfs count="3">'
  . '<xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0"/>'
  . '<xf numFmtId="0" fontId="1" fillId="2" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment vertical="center"/></xf>'
  . '<xf numFmtId="0" fontId="0" fillId="0" borderId="1" xfId="0" applyBorder="1" applyAlignment="1"><alignment vertical="top" wrapText="1"/></xf>'
  . '</cellXfs>'
  . '<cellStyles count="1"><cellStyle name="Normal" xfId="0" builtinId="0"/></cellStyles>'
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
  . '<sheets><sheet name="Employee Contact Details" sheetId="1" r:id="rId1"/></sheets>'
  . '<definedNames><definedName name="_xlnm._FilterDatabase" localSheetId="0" hidden="1">'
  . '\'Employee Contact Details\'!$A$1:$K$' . $lastRow
  . '</definedName></definedNames>'
  . '</workbook>';

/* ---------- WORKBOOK RELATIONSHIPS ---------- */

$workbookRels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
  . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
  . '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>'
  . '<Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>'
  . '</Relationships>';

/* ---------- ZIP + DOWNLOAD ---------- */

$tmp = tempnam(sys_get_temp_dir(), 'cdxl');

if ($tmp === false) {
    cd_fail('Could not create temporary Excel file.');
}

$zip = new ZipArchive();

if ($zip->open($tmp, ZipArchive::OVERWRITE) !== true) {
    @unlink($tmp);
    cd_fail('Could not create the Excel file.');
}

$zip->addFromString('[Content_Types].xml', $contentTypes);
$zip->addFromString('_rels/.rels', $rootRels);
$zip->addFromString('xl/workbook.xml', $workbook);
$zip->addFromString('xl/_rels/workbook.xml.rels', $workbookRels);
$zip->addFromString('xl/styles.xml', $stylesXml);
$zip->addFromString('xl/worksheets/sheet1.xml', $sheetXml);

$zip->close();

/* ---------- FILE NAME ---------- */

$parts = ['Employee_Contact_Details'];

if ($f['employee'] !== '') {
    $parts[] = preg_replace('/[^A-Za-z0-9_-]+/', '_', $f['employee']);
}

if ($f['department'] !== '') {
    $parts[] = preg_replace('/[^A-Za-z0-9_-]+/', '_', $f['department']);
}

$parts[] = date('Y-m-d');

$file = implode('_', $parts) . '.xlsx';

/* ---------- DOWNLOAD ---------- */

while (ob_get_level()) {
    ob_end_clean();
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Length: ' . filesize($tmp));
header('Cache-Control: no-store');

readfile($tmp);

unlink($tmp);
exit;
