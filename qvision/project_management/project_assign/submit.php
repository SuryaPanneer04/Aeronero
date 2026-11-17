<?php
require '../../../connect.php';
session_start();

$project_id = $_POST['project_id'];
$employees = $_POST['employee_id']; // Array

$uploaded_paths = [];

// Handle File Uploads first
if(isset($_FILES['project_docs'])) {
    $file_count = count($_FILES['project_docs']['name']);
    for($i = 0; $i < $file_count; $i++) {
        if($_FILES['project_docs']['error'][$i] == 0) {
            $filename = time() . '_' . $_FILES['project_docs']['name'][$i];
            $tmp_name = $_FILES['project_docs']['tmp_name'][$i];
            $destination = '../uploads/' . $filename; // Relative to this script, it goes to project_management/uploads
            if(move_uploaded_file($tmp_name, $destination)) {
                $doc_name = isset($_POST['doc_names'][$i]) && !empty(trim($_POST['doc_names'][$i])) ? trim($_POST['doc_names'][$i]) : $_FILES['project_docs']['name'][$i];
                $uploaded_paths[] = [
                    'name' => $doc_name,
                    'path' => 'qvision/project_management/uploads/' . $filename
                ];
            }
        } 
    }
}

if(!empty($employees)) {
    $assigned_by = isset($_SESSION['candidateid']) ? $_SESSION['candidateid'] : 0;
    $stmt = $con->prepare("INSERT INTO y_project_employees (project_id, employee_id, deadline_date, assigned_by) VALUES (:project_id, :employee_id, :deadline_date, :assigned_by)");
    $doc_stmt = $con->prepare("INSERT INTO y_project_documents (project_employee_id, document_name, document_path) VALUES (:pe_id, :doc_name, :doc_path)");

    foreach($employees as $emp_id) {
        $deadline = isset($_POST['deadline_'.$emp_id]) && $_POST['deadline_'.$emp_id] != '' ? $_POST['deadline_'.$emp_id] : NULL;
        
        // Check if already assigned
        $chk = $con->prepare("SELECT id FROM y_project_employees WHERE project_id = :project_id AND employee_id = :employee_id");
        $chk->execute([':project_id' => $project_id, ':employee_id' => $emp_id]);
        
        $pe_id = null;
        if($chk->rowCount() == 0) {
            $stmt->execute([
                ':project_id' => $project_id,
                ':employee_id' => $emp_id,
                ':deadline_date' => $deadline,
                ':assigned_by' => $assigned_by
            ]);
            $pe_id = $con->lastInsertId();
        } else {
            $row = $chk->fetch(PDO::FETCH_ASSOC);
            $pe_id = $row['id'];
        }

        // Insert documents for this assignment
        if($pe_id && count($uploaded_paths) > 0) {
            foreach($uploaded_paths as $doc) {
                $doc_stmt->execute([
                    ':pe_id' => $pe_id,
                    ':doc_name' => $doc['name'],
                    ':doc_path' => $doc['path']
                ]);
            }
        }
    }
}

echo "Success";
?>
