<?php
require "../../connect.php";
if(isset($_POST["enquiry_id"])) {
    $id = $_POST["enquiry_id"];
    $scope_text = $_POST["scope_text"];
    
    // Insert into new table
    $stmt1 = $con->prepare("INSERT INTO software_quotation_flow (enquiry_id, scope_text) VALUES (:id, :scope)");
    $res1 = $stmt1->execute([":id" => $id, ":scope" => $scope_text]);
    
    // Update status in enquiry table
    $stmt2 = $con->prepare("UPDATE enquiry SET status = 31 WHERE id = :id");
    $res2 = $stmt2->execute([":id" => $id]);
    
    if($res1 && $res2) {
        echo 1;
    } else {
        echo 0;
    }
}
?>
