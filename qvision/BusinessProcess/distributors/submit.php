<?php
require_once __DIR__ . '/../../../connect.php';
session_start();

$created_by = isset($_SESSION['userid']) ? $_SESSION['userid'] : NULL;

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

if (empty($distributor_name)) {
    echo "Distributor Name is required!";
    exit;
}

try {
    $stmt = $con->prepare("INSERT INTO z_distributors 
        (distributor_name, distributor_contact_no, country_id, country, state_id, state, city_id, city, location, contact_person, contact_person_no, contact_no, email, status, created_by, created_on) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
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
        $created_by
    ]);

    if ($res) {
        echo "Distributor Added Successfully!";
    } else {
        echo "Error: Failed to save distributor.";
    }
} catch (Exception $e) {
    echo "Database Error: " . $e->getMessage();
}
?>
