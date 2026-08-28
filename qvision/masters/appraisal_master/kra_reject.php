<?php
require '../../../connect.php';

$lineid = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

$count = isset($_REQUEST['count']) ? $_REQUEST['count'] : array();
$count_name_count = count($count);

if(!empty($lineid)) {
    $sql = $con->query("UPDATE appraisal_master SET status = 2 WHERE id = '$lineid'");
}
for($i = 0; $i < $count_name_count; $i++) { 
    if(isset($_REQUEST['get_id'.$i])) {
        $get_id = $_REQUEST['get_id'.$i];
        $sql = $con->query("UPDATE appraisal_question SET status = 2 WHERE id = '$get_id'");
    }
}

echo 0;
?>