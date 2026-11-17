<?php
require_once __DIR__ . '/../../../connect.php';
session_start();

$modified_by = isset($_SESSION['userid']) ? $_SESSION['userid'] : NULL;

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$distributor_name = isset($_POST['distributor_name']) ? trim($_POST['distributor_name']) : '';
$distributor_contact_no = isset($_POST['distributor_contact_no']) ? trim($_POST['distributor_contact_no']) : '';
$country_id = !empty($_POST['country_id']) ? intval($_POST['country_id']) : NULL;
$country = isset($_POST['country']) ? trim($_POST['country']) : '';
$state_id = !empty($_POST['state_id']) ? intval($_POST['state_id']) : NULL;
$state = isset($_POST['state']) ? trim($_POST['state']) : '';
$city_id = !empty($_POST['city_id']) ? intval($_POST['city_id']) : NULL;
$city = isset($_POST['city']) ? trim($_POST['city']) : '';
$location = isset($_POST['location']) ? trim($_POST['location']) : '';
$contact_person = isset($_POST['contact_person']) ? trim($_POST['contact_person']) : '';
$contact_person_no = isset($_POST['contact_person_no']) ? trim($_POST['contact_person_no']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$status = !empty($_POST['status']) ? trim($_POST['status']) : 'Active';

if (empty($id) || empty($distributor_name)) {
    echo "Invalid request or missing Distributor Name!";
    exit;
}

try {
    $stmt = $con->prepare("UPDATE z_distributors SET 
        distributor_name = ?, 
        distributor_contact_no = ?, 
        country_id = ?, 
        country = ?, 
        state_id = ?, 
        state = ?, 
        city_id = ?, 
        city = ?, 
        location = ?, 
        contact_person = ?, 
        contact_person_no = ?, 
        contact_no = ?, 
        email = ?, 
        status = ?, 
        modified_by = ?, 
        modified_on = NOW() 
        WHERE id = ?");
    $res = $stmt->execute([
        $distributor_name,
        $distributor_contact_no,
        $country_id,
        $country,
        $state_id,
        $state,
        $city_id,
        $city,
        $location,
        $contact_person,
        $contact_person_no,
        $distributor_contact_no, // keep contact_no synced
        $email,
        $status,
        $modified_by,
        $id
    ]);

    if ($res) {
        echo "Distributor Updated Successfully!";
    } else {
        echo "Error: Failed to update distributor.";
    }
} catch (Exception $e) {
    echo "Database Error: " . $e->getMessage();
}
?>
