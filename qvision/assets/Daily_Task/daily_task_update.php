<?php
require '../config.php';
 
    $id = $_REQUEST['id'];
    $sql = $con->query("UPDATE `daily_task` SET  `completed_date`=now(),`status`= 0  WHERE id = '$id'");

    //echo "UPDATE `daily_task` SET  `completed_date`=now(),`status`= 0  WHERE id = '$id'";

    if ($sql) {
        echo 0;
    }
    else{
        echo 1;
    }


?>