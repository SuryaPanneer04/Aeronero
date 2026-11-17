<?php
require '../../../connect.php';

$id = $_POST['id'];

// Get existing attachments to append to
$stmt = $con->prepare("SELECT attach_manuscript FROM publications_master WHERE id = :id");
$stmt->execute([':id' => $id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$attachments = json_decode($row['attach_manuscript'], true) ?? [];

// Append new link
if (!empty($_POST['manuscript_link']) && !in_array($_POST['manuscript_link'], $attachments)) {
    $attachments[] = $_POST['manuscript_link'];
}

// Append new files
$uploadDir = 'uploads/';
if(isset($_FILES['manuscript_files'])) {
    foreach($_FILES['manuscript_files']['tmp_name'] as $key => $tmp_name) {
        if(!empty($_FILES['manuscript_files']['name'][$key])) {
            $fileName = time() . '_' . basename($_FILES['manuscript_files']['name'][$key]);
            $targetFilePath = $uploadDir . $fileName;
            
            if(move_uploaded_file($_FILES['manuscript_files']['tmp_name'][$key], $targetFilePath)) {
                $attachments[] = 'qvision/BusinessProcess/publications/' . $targetFilePath;
            }
        }
    }
}

$attach_manuscript = json_encode($attachments);

$sql = "UPDATE publications_master SET 
        date = :date, 
        title_of_manuscript = :title, 
        prepared_by = :prepared_by, 
        journal_name = :journal_name, 
        attach_manuscript = :attach_manuscript, 
        communication_date = :comm_date, 
        status = :status 
        WHERE id = :id";

$update = $con->prepare($sql);
$update->execute([
    ':id' => $id,
    ':date' => $_POST['date'],
    ':title' => $_POST['title_of_manuscript'],
    ':prepared_by' => $_POST['prepared_by'],
    ':journal_name' => $_POST['journal_name'],
    ':attach_manuscript' => $attach_manuscript,
    ':comm_date' => $_POST['communication_date'],
    ':status' => $_POST['status']
]);

echo "Success";
?>