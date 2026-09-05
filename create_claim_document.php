<?php
require 'connect.php';

$sql = "CREATE TABLE IF NOT EXISTS claim_document (
    id INT AUTO_INCREMENT PRIMARY KEY,
    claim_id INT NOT NULL,
    document_name VARCHAR(255) NOT NULL,
    created_on DATETIME NOT NULL
)";

if($con->query($sql)) {
    echo "Table claim_document created successfully.";
} else {
    print_r($con->errorInfo());
}
?>
