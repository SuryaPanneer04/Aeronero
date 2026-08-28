<?php
require '../../../connect.php';

if(isset($_REQUEST['submit'])) {
    $dept_name = $_REQUEST['dept_name'];
    $emp_name = $_REQUEST['emp_name'];
    $assets = implode(',', $_REQUEST['asset']); // Serialize the array into a comma-separated string
    $mail_id = $_REQUEST['mail_id'];
    $others = $_REQUEST['others'];

    $sql = $con->query("INSERT INTO hod (dept_name, emp_name, asset, mail_id, others, created_by, created_on) VALUES ('$dept_name','$emp_name','$assets','$mail_id','$others', '2', now())");

    if($sql) {
        echo "<script>alert('Inserted Successfully');</script>";
        echo "<script>window.location.href='../../../index.php'</script>";
    } else {
        echo "<script>alert('Error inserting data');</script>";
    }
}
?>
