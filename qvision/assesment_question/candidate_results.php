<?php
require '../../connect.php';
?>
<div class="content-wrapper" style="padding-left: 50px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Assessment Results</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="center">SNO</th>
                                        <th>NAME</th>

                                        <th>DATE</th>
                                        <th>CONTACT NUMBER</th>
                                        <th> Total Qns </th>
                                        <th> Total MARKS </th>
                                        <th> Status</th>
                                        <th> Accept</th>
                                        <th> Reject</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sql = $con->query("SELECT DISTINCT emp_id FROM employee_assessment_result");
                                    $cnt = 1;

                                    while ($row_user = $sql->fetch(PDO::FETCH_ASSOC)) {
                                        $eid = $row_user['emp_id'];

                                        // Get employee details
                                        $que = $con->query("SELECT * FROM emp_assessment_login_detail WHERE staff_id='$eid'");
                                        $row_qn = $que ? $que->fetch(PDO::FETCH_ASSOC) : null;

                                        if (!$row_qn) {
                                            // Skip if employee login detail missing
                                            continue;
                                        }

                                        $qn_name = $row_qn['qn_name_id'];

                                        // Fetch section info
                                        $sec = $con->query("SELECT * FROM assessment_qn_master WHERE qn_name='$qn_name' LIMIT 1");
                                        $row_sec = $sec ? $sec->fetch(PDO::FETCH_ASSOC) : null;
                                        $section = $row_sec ? $row_sec['section'] : '';

                                        // Fetch results
                                        $res = $con->query("SELECT * FROM employee_assessment_result WHERE emp_id='$eid' AND qn_name_id='$qn_name'");

                                        $i = 1;
                                        $cou = []; // initialize counter array
                                        $qn_count = 0;

                                        if ($res) {
                                            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                                                $qn = $row['question'];
                                                $ans = $row['answer'];

                                                // Check if this question-answer pair matches
                                                $qn_mas = $con->query("SELECT * FROM assessment_qn_master WHERE id='$qn' AND answer_key='$ans'");
                                                if ($qn_mas && $qn_mas->rowCount() > 0) {
                                                    $cou[] = 1; // count correct answers
                                                }

                                                $qn_count = $i++;
                                            }
                                        }

                                        $total_questions = $qn_count;
                                        $correct_answers = count($cou);
                                    ?>
                                        <tr>
                                            <td class="center"><?php echo $cnt; ?>.</td>
                                            <td><?php echo htmlspecialchars($row_qn['first_name'] . ' ' . $row_qn['last_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row_qn['created_on']); ?></td>
                                            <td><?php echo htmlspecialchars($row_qn['phone']); ?></td>
                                            <td><?php echo $total_questions; ?></td>
                                            <td><?php echo $correct_answers; ?></td>
                                            <td>
                                                <?php 
                                                    if($row_qn['status'] == 1) { echo "<span class='badge badge-warning'>Pending</span>"; } 
                                                    else if($row_qn['status'] == 2) { echo "<span class='badge badge-success'>Accepted</span>"; }
                                                    else if($row_qn['status'] == 3) { echo "<span class='badge badge-danger'>Rejected</span>"; } 
                                                    else { echo "<span class='badge badge-secondary'>Unknown</span>"; }
                                                ?>
                                            </td>
                                            <td><a class="btn btn-success btn-sm" style="color:white;cursor:pointer;" onclick="updatestatus(2, <?php echo $eid; ?>)">Accept</a></td>
                                            <td><a class="btn btn-danger btn-sm" style="color:white;cursor:pointer;" onclick="updatestatus(3, <?php echo $eid; ?>)">Reject</a></td>
                                        </tr>

                                    <?php
                                        $cnt = $cnt + 1;
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script>
    function updatestatus(sta, id) {
        $.ajax({
            type: "GET",
            url: "qvision/assesment_question/status_update.php",
            data: 'sta=' + sta + '&id=' + id,
            success: function(data) {
                if (data == 1) {
                    alert('Update Successfully');
                    assessment_result();
                } else {
                    alert("not updated");
                }
            }
        });
    }
</script>