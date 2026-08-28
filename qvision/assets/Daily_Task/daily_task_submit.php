<?php
require '../config.php';
require '../user.php';
$candid = $_SESSION["candidateid"];

    $title = $_REQUEST['title'];
    $description = $_REQUEST['description'];

    $sql = $con->query("insert into daily_task(candid_id,title,description,date,created,status)values('$candid','$title','$description',now(),now(),1)");
    //echo "insert into daily_task(candid_id,title,description,deadline,created,status)values('$candid','$title','$description','$end_date',now(),1)";

    if ($sql) {
        echo 0;
    }
    else{
        echo 1;
    }

?>