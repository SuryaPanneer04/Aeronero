<?php
require '../../../connect.php';

$id = $_POST['id'];
$conf_date = !empty($_POST['conf_date']) ? $_POST['conf_date'] : NULL;
$topics_covered = $_POST['topics_covered'];
$attendees = $_POST['attendees'];
$inferences = $_POST['inferences'];

$upload_dir = 'uploads/';

$stmt = $con->prepare("UPDATE z_conferences_workshops SET conf_date=?, topics_covered=?, attendees=?, inferences=? WHERE id=?");
$res = $stmt->execute([
    $conf_date, 
    $topics_covered, 
    $attendees, 
    $inferences, 
    $id
]);

if($res) {
    if(!empty($_FILES['report_files']['name'][0])) {
        $count = count($_FILES['report_files']['name']);
        for($i = 0; $i < $count; $i++) {
            if(!empty($_FILES['report_files']['name'][$i])) {
                $file_name = time() . "_" . $i . "_" . basename($_FILES['report_files']['name'][$i]);
                $doc_name = !empty($_POST['doc_names'][$i]) ? $_POST['doc_names'][$i] : basename($_FILES['report_files']['name'][$i]);
                
                if(move_uploaded_file($_FILES['report_files']['tmp_name'][$i], $upload_dir . $file_name)) {
                    $doc_stmt = $con->prepare("INSERT INTO z_conferences_workshops_documents (conf_id, document_name, document_path) VALUES (?, ?, ?)");
                    $doc_stmt->execute([$id, $doc_name, $file_name]);
                }
            }
        }
    }
    echo "Successfully Updated!";
} else {
    echo "Error: Failed to update.";
}
?>
