<?php
require '../../../connect.php';
session_start();

$id = $_POST['id'];
$deadline_date = $_POST['deadline_date'];

$stmt = $con->prepare("UPDATE y_project_employees SET deadline_date = :deadline_date WHERE id = :id");
$stmt->execute([':deadline_date' => $deadline_date, ':id' => $id]);

// Handle File Uploads
if(isset($_FILES['project_docs'])) {
    $doc_stmt = $con->prepare("INSERT INTO y_project_documents (project_employee_id, document_name, document_path) VALUES (:pe_id, :doc_name, :doc_path)");
    $file_count = count($_FILES['project_docs']['name']);
    
    for($i = 0; $i < $file_count; $i++) {
        if($_FILES['project_docs']['error'][$i] == 0 && $_FILES['project_docs']['name'][$i] != '') {
            $filename = time() . '_' . $_FILES['project_docs']['name'][$i];
            $tmp_name = $_FILES['project_docs']['tmp_name'][$i];
            $destination = '../uploads/' . $filename; 
            
            if(move_uploaded_file($tmp_name, $destination)) {
                $doc_name = isset($_POST['doc_names'][$i]) && !empty(trim($_POST['doc_names'][$i])) ? trim($_POST['doc_names'][$i]) : $_FILES['project_docs']['name'][$i];
                $doc_stmt->execute([
                    ':pe_id' => $id,
                    ':doc_name' => $doc_name,
                    ':doc_path' => 'qvision/project_management/uploads/' . $filename
                ]);
            }
        }
    }
}

echo "Success";
?>
