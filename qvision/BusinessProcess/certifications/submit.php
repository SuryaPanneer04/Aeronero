<?php
require '../../../connect.php';
session_start();

$created_by = isset($_SESSION['userid']) ? $_SESSION['userid'] : NULL;

$cert_name = $_POST['cert_name'];
$cert_number = $_POST['cert_number'];
$expiry_date = !empty($_POST['expiry_date']) ? $_POST['expiry_date'] : NULL;
$surveillance_completed_on = !empty($_POST['surveillance_completed_on']) ? $_POST['surveillance_completed_on'] : NULL;
$next_surveillance_date = !empty($_POST['next_surveillance_date']) ? $_POST['next_surveillance_date'] : NULL;
$vendor_type = $_POST['vendor_type'];
$offline_vendor_name = $_POST['offline_vendor_name'];
$contact_person = $_POST['contact_person'];
$contact_number = $_POST['contact_number'];
$remarks = $_POST['remarks'];

$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

$certificate_doc = NULL;
if(!empty($_FILES['certificate_doc']['name'])) {
    $certificate_doc = time() . "_" . basename($_FILES['certificate_doc']['name']);
    move_uploaded_file($_FILES['certificate_doc']['tmp_name'], $upload_dir . $certificate_doc);
}

$stmt = $con->prepare("INSERT INTO z_certifications (cert_name, cert_number, expiry_date, surveillance_completed_on, next_surveillance_date, vendor_type, offline_vendor_name, contact_person, contact_number, remarks, certificate_doc, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$res = $stmt->execute([$cert_name, $cert_number, $expiry_date, $surveillance_completed_on, $next_surveillance_date, $vendor_type, $offline_vendor_name, $contact_person, $contact_number, $remarks, $certificate_doc, $created_by]);

if($res) {
    echo "Certification Saved Successfully!";
} else {
    echo "Error: Failed to save.";
}
?>
