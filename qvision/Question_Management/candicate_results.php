<?php
require '../../connect.php';
?>

    <head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>

<div class="card card-primary">

    <div class="card-header">
    <h3 class="card-title">
      <!-- <font size="5">Candidate Resuls</font> -->
    </h3>

    <!-- <a onclick="add_department()" style="float: right;" data-toggle="modal" class="btn">ADD</a> -->
   </div>

   
   <div class="card-body">
    <table class="table table-striped table-bordered table-hover display nowrap" id="example1" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="center"> S.NO </th>
                                        <th> NAME </th>
                                        <th> EMAIL ID </th>
                                        <th> DATE </th>
                                        <th> CONTACT NUMBER </th>
                                        <th> EXAMINATION MARKS </th>
                                        <th> OUT OF MARKS </th>
                                        <th> Status </th>
                                        <th> Accept </th>
                                        <th> Reject </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sql = $con->query("select distinct ueser_id from candicate_results ");
                                    //echo "select distinct ueser_id from candicate_results";
                                    $cnt = 1;
                                    while ($row_user = $sql->fetch(PDO::FETCH_ASSOC)) {
                                        $eid = $row_user['ueser_id'];

                                        $que = $con->query("select * from candidate_form_details where id='$eid'");
                                        // print_r($que);
                                        // die();
                                        $row_qn = $que->fetch(PDO::FETCH_ASSOC);
                                        if (!$row_qn) {
                                            continue;
                                        }
                                        $que->execute();
                                        $counts = $que->rowCount();
                                        $qn_name = $row_qn['qn_name_id'];


                                        /*$sec=$con->query("select * from question_master where qn_name='$qn_name'");
$row_sec = $sec->fetch(PDO::FETCH_ASSOC);
$section=$row_sec['section'];*/

                                        $query = "select * from question_master where qn_name='$qn_name'"; // Replace with actual table & condition
                                        $result = $con->query($query);

                                        if (!$result) {
                                            die("SQL Error: " . $con->errorInfo()[2]); // Show SQL error
                                        }

                                        $row_sec = $result->fetch(PDO::FETCH_ASSOC);

                                        if (!$row_sec) {
                                            continue; // Skip instead of dying to keep table layout
                                        }

                                        // Now it's safe to use $row_sec['section']
                                        $section = $row_sec['section'];










                                        $res = $con->query("select * from candicate_results where ueser_id='$eid' and qn_name_id='$qn_name'");
                                        $i = 1;
                                        $qnCnt = $res->rowCount();
                                        $cou = [];
                                        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                                            $qn = $row['question'];
                                            $ans = $row['answer'];


                                            $qn_mas = $con->query("select * from question_master where id='$qn' and answer_key='$ans' ");
                                            //echo "select * from assessment_qn_master where id='$qn' and  answer_key='$ans' and section='$section'";
                                            $row_answers = $qn_mas->fetch(PDO::FETCH_ASSOC);

                                            $correct_answer = $row_answers['answer_key'];

                                            $row_count = $qn_mas->rowCount();

                                            $qn_count = $i++;
                                            if ($row_count != 0) {
                                                $cou[] = $row_count;
                                            }
                                        }
                                    ?>

                                        <tr>
                                            <td class="center"><?php echo $cnt; ?>.</td>
                                            <td><?php echo $row_qn['first_name'] . ' ' . $row_qn['last_name']; ?></td>
                                            <td><?php echo $row_qn['mail']; ?></td>
                                            <td><?php echo $row_qn['created_on']; ?></td>
                                            <td><?php echo $row_qn['phone']; ?></td>
                                            <!-- <td><?php echo $qn_count; ?></td> -->
                                            <!-- <td><?php echo count($cou); ?></td> -->

                                            <td><?php echo count($cou); ?></td>
                                            <td><?php echo $qnCnt; ?></td>
                                            <td>
                                                <?php if (($row_qn['status'] == 11)) {

                                                    echo '<span style="color:green;text-align:center;"><b>Selected in Assessment</b></span>';
                                                }
                                                if (($row_qn['status'] == 12)) {
                                                    echo '<span style="color:red;text-align:center;"><b>Rejected in Assessment</b></span>';
                                                }
                                                if (($row_qn['status'] == 0)) {
                                                    echo '<span style="color:green;text-align:center;"><b>SELECTED FOR  TECHNICAL</b></span>';
                                                }
                                                if (($row_qn['status'] == 1)) {
                                                    echo '<span style="color:blue;text-align:center;"><b>Waiting List</b></span>';
                                                }
                                                if (($row_qn['status'] == 3)) {
                                                    echo '<span style="color:red;text-align:center;"><b>Rejected</b></span>';
                                                }
                                                if (($row_qn['status'] == 4)) {
                                                    echo '<span style="color:green;text-align:center;"><b>Selected For Second Level</b></span>';
                                                }
                                                if (($row_qn['status'] == 5)) {
                                                    echo '<span style="color:blue;text-align:center;"><b>Technical one Waiting List</b></span>';
                                                }
                                                if (($row_qn['status'] == 6)) {
                                                    echo '<span style="color:red;text-align:center;"><b>Technical one Rejected</b></span>';
                                                }
                                                if (($row_qn['status'] == 7)) {
                                                    echo '<span style="color:green;text-align:center;"><b>APPROVED BY MD</b></span>';
                                                }
                                                if (($row_qn['status'] == 8)) {
                                                    echo '<span style="color:blue;text-align:center;"><b>NOT APPROVED BY MD</b></span>';
                                                }
                                                if (($row_qn['status'] == 9)) {
                                                    echo '<span style="color:red;text-align:center;"><b>REJECTED BY MD</b></span>';
                                                }
                                                if (($row_qn['status'] == 13)) {
                                                    echo '<span style="color:red;text-align:center;"><b>Selected For Third Level</b></span>';
                                                }
                                                if (($row_qn['status'] == 14)) {
                                                    echo '<span style="color:red;text-align:center;"><b>Technical two Waiting List</b></span>';
                                                }
                                                if (($row_qn['status'] == 15)) {
                                                    echo '<span style="color:red;text-align:center;"><b>Technical two Rejected</b></span>';
                                                }
                                                if (($row_qn['status'] == 30)) {
                                                    echo '<span style="color:red;text-align:center;"><b>Waiting For Assessment Approve</b></span>';
                                                }

                                                ?>
                                            </td>

                                            <!-- <td><?php if ($row_qn['status'] == '2') : ?><button class="btn btn-success"   name="Acccept" onclick="updatestatus1(this.id,this.value)" id="1" value="<?php echo $row_qn['id']; ?>">Acccept</button><?php endif ?></td>
<td><?php if ($row_qn['status'] == '2') : ?><button class="btn btn-danger"   name="Rejected" onclick="updatestatus(this.id,this.value)" id="0" value="<?php echo $row_qn['id']; ?>">Rejected</button><?php endif ?></td> -->

                                            <td>
                                                <?php if ($row_qn['status'] == '30') : ?>
                                                    <button class="btn btn-success" name="Acccept" onclick="updatestatus1(this.id,this.value)" id="1" value="<?php echo $row_qn['id']; ?>">Accept</button><?php endif ?>
                                            </td>
                                            <td>
                                                <?php if ($row_qn['status'] == '30') : ?><button class="btn btn-danger" name="Rejected" onclick="updatestatus(this.id,this.value)" id="0" value="<?php echo $row_qn['id']; ?>">Rejected</button><?php endif ?>
                                            </td>

                                        </tr>
                                    <?php
                                        $cnt = $cnt + 1;
                                    } ?>
                                </tbody>
     </table>

   </div>


   </div>

    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Candidate Resuls</h1>
                </div>

            </div>
        </div> -->
        <!-- /.container-fluid -->
    <!-- </section> -->
    <!-- Main content -->



  
<!-- </div> -->

<script>
    $(document).ready(function() {
        $('#example1').DataTable({
           "scrollX": true
        });
    });

    function updatestatus1(sta, id) {

        $.ajax({
            type: "GET",
            url: "qvision/Question_Management/status.php",
            data: 'sta=' + sta + '&id=' + id,
            success: function(data) {
                if (data == 1) {
                    alert('Update Successfully');
                    candicate_results()
                } else {
                    alert("Update Failed");
                    candicate_results()
                }
            }
        });
    }


    function updatestatus(sta, id) {

        $.ajax({
            type: "GET",
            url: "qvision/Question_Management/statusss.php",
            data: 'sta=' + sta + '&id=' + id,
            success: function(data) {
                if (data == 1) {
                    alert('Update Successfully');
                    candicate_results()
                } else {
                    alert("Update Failed");
                    candicate_results()
                }
            }
        });
    }
</script>