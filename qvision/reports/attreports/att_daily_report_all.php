<?php
require '../../../connect.php';
include("../../../user.php");
$user = $_SESSION['userid'];

$from_date1 = $_REQUEST['from_date'];
$from_date = date("Y-m-d", strtotime($from_date1));
$to_date1 = $_REQUEST['to_date'];
$to_date = date("Y-m-d", strtotime($to_date1));
// Define the fixed office times
$fixed_in_time = strtotime("09:00:00");
$fixed_out_time = strtotime("18:00:00");

// Prepare the base SQL query
$sql = "SELECT a.*, b.emp_name AS name, c.designation_name AS design, d.dept_name AS dept, a.daily_in, a.daily_out 
        FROM attire_form a 
        JOIN staff_master b ON a.emp_no = b.candid_id 
        JOIN designation_master c ON a.design_id = c.id 
        JOIN z_department_master d ON a.dep_id = d.id 
        WHERE (a.date BETWEEN :from_date AND :to_date) 
        ";



$sql .= " GROUP BY a.id 
          ORDER BY a.date DESC";

// Prepare and execute the statement
$stmt = $con->prepare($sql);
$stmt->bindParam(':from_date', $from_date);
$stmt->bindParam(':to_date', $to_date);
// $stmt->bindParam(':dept_name', $dept_name);
// $stmt->bindParam(':division', $division);



$stmt->execute();

// Check if any data is returned
if ($stmt->rowCount() > 0) {
    $cnt = 1;
    ?>
    <div class="table-responsive">
        <table id="summarySplitTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Department</th>
                    <th>In Time</th>
                    <th>Out Time</th>
                   
                    <th>Early Coming</th>
                   
                    <th>Late Coming</th>
                   
                    <th>Early Going</th>
                   
                    <th>Late Going</th>
                   
                </tr>
            </thead>
            <tbody>
            <?php
            while ($rep = $stmt->fetch()) {
                // Convert actual times to timestamps for comparison
                $actual_in_time = strtotime($rep['daily_in']);
                $actual_out_time = strtotime($rep['daily_out']);

                // Calculate Early Coming (before 9:00 AM)
                $earlyComing = $actual_in_time < $fixed_in_time ? gmdate("H:i", $fixed_in_time - $actual_in_time) : "-";

                // Calculate Late Coming (after 9:00 AM)
                $lateComing = $actual_in_time > $fixed_in_time ? gmdate("H:i", $actual_in_time - $fixed_in_time) : "-";

                // Calculate Early Going (before 6:00 PM)
                $earlyGoing = $actual_out_time < $fixed_out_time ? gmdate("H:i", $fixed_out_time - $actual_out_time) : "-";

                // Calculate Late Going (after 6:00 PM)
                $lateGoing = $actual_out_time > $fixed_out_time ? gmdate("H:i", $actual_out_time - $fixed_out_time) : "-";
                ?>
                <tr>
                    <td><?php echo $cnt; ?>.</td>
                    <td><?php echo $rep['date']; ?></td>
                    <td><?php echo $rep['name']; ?></td>
                    <td><?php echo $rep['design']; ?></td>
                    <td><?php echo $rep['dept']; ?></td>
                    <td><?php echo $rep['daily_in'].'(24hrs)'; ?></td>
                    <td><?php echo $rep['daily_out'].'(24hrs)'; ?></td>
                   
                    <td><?php echo ($earlyComing !== "-" ? $earlyComing . ' (HH:MM)' : '-'); ?></td>
<td><?php echo ($lateComing !== "-" ? $lateComing . ' (HH:MM)' : '-'); ?></td>
<td><?php echo ($earlyGoing !== "-" ? $earlyGoing . ' (HH:MM)' : '-'); ?></td>
<td><?php echo ($lateGoing !== "-" ? $lateGoing . ' (HH:MM)' : '-'); ?></td>





                   
                </tr>
                <?php
                $cnt++;
            }
            ?>
            </tbody>
        </table>
    </div>
<?php
} else {
    echo "<div>No records found for the selected criteria.</div>";
}
?>