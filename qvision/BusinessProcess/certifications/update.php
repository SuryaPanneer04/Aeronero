<?php
require '../../../connect.php';

$id = $_POST['id'];
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
$certificate_doc = isset($_POST['old_certificate_doc']) ? $_POST['old_certificate_doc'] : '';

if(!empty($_FILES['certificate_doc']['name'])) {
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $certificate_doc = time() . "_" . basename($_FILES['certificate_doc']['name']);
    move_uploaded_file($_FILES['certificate_doc']['tmp_name'], $upload_dir . $certificate_doc);
}

$stmt = $con->prepare("UPDATE z_certifications SET cert_name=?, cert_number=?, expiry_date=?, surveillance_completed_on=?, next_surveillance_date=?, vendor_type=?, offline_vendor_name=?, contact_person=?, contact_number=?, remarks=?, certificate_doc=? WHERE id=?");
$res = $stmt->execute([$cert_name, $cert_number, $expiry_date, $surveillance_completed_on, $next_surveillance_date, $vendor_type, $offline_vendor_name, $contact_person, $contact_number, $remarks, $certificate_doc, $id]);

if($res) {
    echo "Certification Updated Successfully!";
} else {
    echo "Error: Failed to update.";
}
?>
