<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">GRANTS LIST</font></h3>
        <a onclick="add_grant()" style="float: right;" data-toggle="modal" class="btn btn-primary">ADD</a>
    </div>
    
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover display nowrap" id="example1" style="width:100%">
            <thead>
                <th>Date</th>
                <th>Grant Name</th>
                <th>Project Applied</th>
                <th>Applied by</th>
                <th>Amount</th>
                <th>Deadline</th>
                <th>Result</th>
                <th>Status</th>
                <th>Tools</th>
            </thead>
            <tbody>
                <?php
                $emp_sql = $con->query("SELECT * FROM grants_master ORDER BY id DESC");

                while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
                {
                ?>
                    <tr>
                        <td><?php echo $emp_res['date']; ?></td>
                        <td><?php echo $emp_res['grant_name']; ?></td>
                        <td><?php echo $emp_res['project_applied']; ?></td>
                        <td><?php echo $emp_res['applied_by']; ?></td>
                        <td><?php echo $emp_res['amount']; ?></td>
                        <td><?php echo $emp_res['deadline']; ?></td>
                        <td><?php echo $emp_res['result']; ?></td>

                        <td>
                            <?php
                            if($emp_res['status'] == 'completed') {
                                echo '<span style="color:green;text-align:center;"><b>Completed</b></span>';
                            } elseif($emp_res['status'] == 'processing') {
                                echo '<span style="color:blue;text-align:center;"><b>Processing</b></span>';
                            } else {
                                echo '<span style="color:orange;text-align:center;"><b>Pending</b></span>';
                            }
                            ?>
                        </td>

                        <td>
                            <button class="btn btn-success btn-sm edit btn-flat"
                                data-id="<?php echo $emp_res['id']; ?>"
                                onclick="grant_edit(<?php echo $emp_res['id']; ?>)">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#example1').DataTable({
        "scrollX": true,
        "order": [[0, "desc"]]
    });
});
</script>

<script>
    function add_grant()
    {
        $.ajax({
            type:"POST",
            url:"qvision/BusinessProcess/grants/new_grant.php",
            success:function(data){
                $("#main_content").html(data);
            }
        })
    }
    
    function grant_edit(v)
    {
        $.ajax({
            type:"POST",
            url:"qvision/BusinessProcess/grants/edit_grant.php?id="+v,
            success:function(data){
                $("#main_content").html(data);
            }
        })
    }
</script>