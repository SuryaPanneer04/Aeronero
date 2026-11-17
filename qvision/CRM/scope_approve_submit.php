<?php
require "../../connect.php";
if(isset($_POST["id"])) {
    $id = $_POST["id"];
    $stmt = $con->prepare("UPDATE enquiry SET status = 32 WHERE id = :id");
    if($stmt->execute([":id" => $id])) {
        echo 1;
    } else {
        echo 0;
    }
}
?>
