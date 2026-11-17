<?php
session_start();
$_SESSION['userid'] = 40;
$_SESSION['candidateid'] = 'BBE123';
$_POST = [
    'get_id' => 39,
    'quote_no' => 'QOT08/26-27/00038/1',
    'po_date' => '2026-08-31',
    'enquiry_id' => 46,
    'business_id' => 1,
    'cost_sheet_no' => 'SSSW0/26-27/1'
];
$_FILES = [
    'attachment' => [
        'name' => ['test.pdf'],
        'tmp_name' => ['test.pdf']
    ]
];
include 'c:/xampp/htdocs/bbvision/qvision/BusinessProcess/po_approval/po_upload_submit.php';
?>
