<?php
require '../config.php';
include("../user.php");
$candid = $_SESSION['candidateid'];
?>
<style>
    td {
        font-size: 20px;
    }
</style>
<div  class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">DAILY TASK LIST</font></h3>
        <a onclick="add()" style="float: right;" data-toggle="modal" class="btn btn-primary">ADD</a>
    </div>
    <!-- /.card-header --><br>

    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Task Name</th>
                    <th>Description</th>
                    <th>Assign Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>


            <tbody>
                <?php
                $emp_sql = $con->query("SELECT * FROM daily_task WHERE candid_id = '$candid'");
                $i = 1;
                while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
                    $date = $emp_res['date'];
                    $last_date = date('d-m-Y',strtotime($date) );
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
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
                        <td>
                    <?php 
                     if($emp_res['status']==1){
                        ?>
                        <button class="btn btn-success btn-sm edit btn-flat"  onclick="daily_task_edit(<?php echo $emp_res['id']; ?>)"> Completed </button>
                    <?php
                     }
                     ?>    
                        </td>
                    </tr>
                    <?php
                    $i = $i + 1;
                }
                
                ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    function daily_task_edit(v) {
        $.ajax({
            type: "POST",
            url: "Daily_Task/daily_task_update.php?id=" + v,

            success: function (data)
            {
                work()  
            }
        })
    }
  
    function add()
    {
        $.ajax({
            type: "POST",
            url: "Daily_Task/daily_task.php",
            success: function (data) {
                $("#main_content").html(data);
            }
        })
    }
</script>
