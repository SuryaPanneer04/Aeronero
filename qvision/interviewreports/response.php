<?php
require '../../connect.php';
?>

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Department</th>
            <th>Position</th>
            <th>Mail</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $fromdate = $_REQUEST['from_date'];
        $todate = $_REQUEST['to_Date'];
        $interview = $con->query("SELECT * FROM interview_schedule_detail WHERE interview_date BETWEEN '$fromdate' AND '$todate' ORDER BY id DESC");
        $i = 1;
        while ($getdata = $interview->fetch(PDO::FETCH_ASSOC)) {
            $resource_id = $getdata['resource_id'];
            $sql = $con->query("SELECT first_name, department, position, mail, phone, address, status FROM candidate_form_details WHERE resource_id='$resource_id'");
            $res = $sql->fetch(PDO::FETCH_ASSOC);
            if ($res) {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $res['first_name']; ?></td>
                    <td><?php echo $res['department']; ?></td>
                    <td><?php echo $res['position']; ?></td>
                    <td><?php echo $res['mail']; ?></td>
                    <td><?php echo $res['phone']; ?></td>
                    <td><?php echo $res['address']; ?></td>
                    <td>
                        <?php
                        if ($res['status'] == 1) {
                            echo '<span style="color: orange;"><b>Active</b></span>';
                        } else {
                            echo '<span style="color: green;"><b>Inactive</b></span>';
                        }
                        ?>
                    </td>
                </tr>
            <?php
                $i++;
            }
        }
        ?>
    </tbody>
</table>
