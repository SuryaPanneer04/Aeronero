<?php
require '../../../connect.php';
$q = $con->query("SHOW COLUMNS FROM software_quotation_flow");
print_r($q->fetchAll(PDO::FETCH_COLUMN));
?>
