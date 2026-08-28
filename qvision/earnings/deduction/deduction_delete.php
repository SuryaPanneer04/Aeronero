<?php
require '../../../connect.php';

if (isset($_POST['deduct_id']) && !empty($_POST['deduct_id'])) {

    $id = $_POST['deduct_id'];
    $deduct_id = implode(',', array_map('intval', $id));

    $sql = "DELETE FROM salary_monthly_deduction WHERE id IN ($deduct_id)";
    $con->query($sql);
}

echo "success";
?>