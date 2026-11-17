<?php
require "../../connect.php";
if(isset($_POST["id"])) {
    $id = $_POST["id"];
    $stmt = $con->prepare("SELECT scope_text FROM software_quotation_flow WHERE enquiry_id = :id ORDER BY id DESC LIMIT 1");
    $stmt->execute([":id" => $id]);
    $row = $stmt->fetch();
    if($row) {
        echo "<b>Scope:</b><br/>" . nl2br(htmlspecialchars($row["scope_text"])) . "<br/><br/>";
    } else {
        echo "No scope found.";
    }
}
?>
