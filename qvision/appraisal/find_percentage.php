<?php
require '../../connect.php';

$depId = $_REQUEST['depId'];
$total = $_REQUEST['total'];
$firstValue = str_split((string)$total);
$rating = $firstValue[0]; 


$find_salary = $con->query("SELECT percentage_hike FROM `hike_master` a LEFT JOIN  `hike_value_percent` b ON a.id = b.hike_master_id WHERE (a.dept_id='$depId') && (b.`rating_point` like '$rating%')");

$salaryCount = $find_salary->rowCount();
if ($salaryCount > 0) {
    $salary = $find_salary->fetch();
    $percent = $salary['percentage_hike'];
} 
else if($total <= 70 ){
    $sql = $con->query("SELECT percentage_hike FROM `hike_master` a LEFT JOIN  `hike_value_percent` b ON a.id = b.hike_master_id WHERE (a.dept_id='$depId') && (b.`rating_point` like '<%')");

        $salaryHike = $sql->fetch();
        $percent = $salaryHike['percentage_hike'];
}
else if($total >= 100) {
    $sql = $con->query("SELECT percentage_hike FROM `hike_master` a LEFT JOIN  `hike_value_percent` b ON a.id = b.hike_master_id WHERE (a.dept_id='$depId') && (b.`rating_point` like '>%')");

        $salaryHike = $sql->fetch();
        $percent = $salaryHike['percentage_hike'];
}
?>

<input type="text" class="form-control" id="salary" name="salary" value="<?php echo $percent; ?>" readonly>