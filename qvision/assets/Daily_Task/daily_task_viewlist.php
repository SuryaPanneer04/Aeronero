<?php
require '../config.php';
$id = $_REQUEST['id'];

$emp_sql = $con->query("SELECT  d.id,d.title, d.description, d.date, d.status,s.emp_name,d.completed_date FROM daily_task d left join staff_master s on d.candid_id = s.candid_id where s.id='$id'");
$i = 1;
while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
    $date = $emp_res['date'];
    $last_date = date('d-m-Y',strtotime($date) );
    $completed_date = $emp_res['completed_date'];
    if($completed_date!=''){
        $complete_date = date('d-m-Y',strtotime($completed_date) );
    }
    else{
        $complete_date = "---";
    }
    
    ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $emp_res['emp_name']; ?></td>
        <td><?php echo $emp_res['title']; ?></td>
        <td><?php echo $emp_res['description']; ?></td>
        <td><?php echo $last_date; ?></td>
        <td>
            <?php
            if ($emp_res['status'] == 1) {
                echo '<span style="color: red;text-align:center;"><b>Pending</b></span>';
            } else {
                echo '<span style="color: green;text-align:center;"><b>Completed</b></span>';
            }
            ?>
        </td>
        <td><?php echo $complete_date; ?></td>
    </tr>
    <?php
    $i = $i + 1;
}
?>