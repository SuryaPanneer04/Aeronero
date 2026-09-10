<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require('../../../connect.php');

if (!isset($_SESSION['username'])) {
    echo "Session expired. Please login again.";
    exit;
}

$referred_by = $_SESSION['username'];
$referral_type = $_POST['referral_type'] ?? '';
$name = $_POST['name'] ?? '';
$mobile = $_POST['mobile'] ?? '';
$email = $_POST['email'] ?? '';
$location = $_POST['location'] ?? '';
$designation_or_company = $_POST['designation_or_company'] ?? '';
$comments = $_POST['comments'] ?? '';

if(empty($referral_type) || empty($name)) {
    echo "Please fill required fields.";
    exit;
}

$resume_filename = '';

// Handle file upload if present
if(isset($_FILES['resume']) && $_FILES['resume']['error'] == UPLOAD_ERR_OK) {
    $upload_dir = 'uploads/';
    
    // Create directory if not exists
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_ext = strtolower(pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION));
    $allowed_exts = ['pdf', 'doc', 'docx'];
    
    if(in_array($file_ext, $allowed_exts)) {
        $resume_filename = 'ref_'.time().'_'.rand(1000,9999).'.'.$file_ext;
        if(!move_uploaded_file($_FILES['resume']['tmp_name'], $upload_dir.$resume_filename)) {
            $resume_filename = ''; // Reset if upload fails
        }
    }
}

$stmt = $con->prepare("INSERT INTO referral_master (referral_type, name, mobile, email, location, designation_or_company, resume, comments, referred_by, status, created_on) VALUES (:rtype, :name, :mob, :email, :loc, :desig, :resume, :comments, :refby, 1, NOW())");

$result = $stmt->execute([
    'rtype' => $referral_type,
    'name' => $name,
    'mob' => $mobile,
    'email' => $email,
    'loc' => $location,
    'desig' => $designation_or_company,
    'resume' => $resume_filename,
    'comments' => $comments,
    'refby' => $referred_by
]);

if($result) {
    echo "success";
} else {
    echo "Error saving referral.";
}
?>
