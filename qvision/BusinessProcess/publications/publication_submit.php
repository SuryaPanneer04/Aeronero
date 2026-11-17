<?php
require '../../../connect.php';

$date = $_POST['date'];
$title = $_POST['title_of_manuscript'];
$prepared_by = $_POST['prepared_by'];
$journal_name = $_POST['journal_name'];
$comm_date = $_POST['communication_date'];
$status = $_POST['status'];

$attachments = [];

// Handle Link
if (!empty($_POST['manuscript_link'])) {
    $attachments[] = $_POST['manuscript_link'];
}

// Handle Multiple Files
$uploadDir = 'uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if(isset($_FILES['manuscript_files'])) {
    foreach($_FILES['manuscript_files']['tmp_name'] as $key => $tmp_name) {
        if(!empty($_FILES['manuscript_files']['name'][$key])) {
            $fileName = time() . '_' . basename($_FILES['manuscript_files']['name'][$key]);
            $targetFilePath = $uploadDir . $fileName;
            
            if(move_uploaded_file($_FILES['manuscript_files']['tmp_name'][$key], $targetFilePath)) {
                // Save path relative to the list file viewing it
                $attachments[] = 'qvision/BusinessProcess/publications/' . $targetFilePath;
            }
        }
    }
}

// Convert array to JSON to store in a single column
$attach_manuscript = json_encode($attachments);

$sql = "INSERT INTO publications_master (date, title_of_manuscript, prepared_by, journal_name, attach_manuscript, communication_date, status) 
        VALUES (:date, :title, :prepared_by, :journal_name, :attach_manuscript, :comm_date, :status)";

$stmt = $con->prepare($sql);
$stmt->execute([
    ':date' => $date,
    ':title' => $title,
    ':prepared_by' => $prepared_by,
    ':journal_name' => $journal_name,
    ':attach_manuscript' => $attach_manuscript,
    ':comm_date' => $comm_date,
    ':status' => $status
]);

echo "Success";
?>