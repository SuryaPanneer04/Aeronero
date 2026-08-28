<?php
require 'connect.php';
$query = $con->query("SELECT id, org_name FROM new_client_master LIMIT 20");
while($row = $query->fetch(PDO::FETCH_ASSOC)) {
    print_r($row);
}
?>
