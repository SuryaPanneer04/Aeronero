<?php
require 'connect.php';
$sql = "ALTER TABLE claim_document ADD document_title VARCHAR(255) NULL AFTER claim_id";
if($con->query($sql)) {
    echo "Added document_title\n";
} else {
    print_r($con->errorInfo());
}
?>
