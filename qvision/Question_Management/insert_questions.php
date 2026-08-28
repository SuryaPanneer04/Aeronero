<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../../connect.php';

try {

    $qn_name = $_POST['qn_name'];
    $section = $_POST['section'];
    $Questions = addslashes($_POST['Questions']);
    $Option_A = addslashes($_POST['Option_A']);
    $Option_B = addslashes($_POST['Option_B']);
    $Option_C = addslashes($_POST['Option_C']);
    $Option_D = addslashes($_POST['Option_D']);
    $answer_key = addslashes($_POST['answer_key']);

    $sql = "INSERT INTO question_master
            (qn_name, section, Questions, Option_A, Option_B, Option_C, Option_D, answer_key)
            VALUES
            ('$qn_name','$section','$Questions','$Option_A','$Option_B','$Option_C','$Option_D','$answer_key')";

    $result = $con->query($sql);

    if ($result) {
        echo "success";
    } else {
        print_r($con->errorInfo());
    }

} catch (Exception $e) {
    echo $e->getMessage();
}
?>