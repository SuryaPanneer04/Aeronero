<?php
require "../../connect.php";
if(isset($_POST["enquiry_id"]) && isset($_FILES["software_file"])) {
    $id = $_POST["enquiry_id"];
    $uploadDir = "calls/uploads/";
    $fileName = basename($_FILES["software_file"]["name"]);
    $targetFilePath = $uploadDir . $fileName;
    if(move_uploaded_file($_FILES["software_file"]["tmp_name"], $targetFilePath)) {
        $stmt = $con->prepare("UPDATE enquiry SET verified_file = :file, status = 33 WHERE id = :id");
        if($stmt->execute([":file" => $fileName, ":id" => $id])) {
            echo 1;
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
}
?>
