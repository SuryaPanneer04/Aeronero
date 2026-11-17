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
        <h3 class="card-title"><font size="5">AWARDS LIST</font></h3>
        <a onclick="add_award()" style="float: right;" data-toggle="modal" class="btn btn-primary">ADD</a>
    </div>
    
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover display nowrap" id="example1" style="width:100%">
            <thead>
                <th>Date</th>
                <th>Award Name</th>
                <th>Category</th>
                <th>Applied by</th>
                <th>Deadline</th>
                <th>Result</th>
                <th>Tools</th>
            </thead>
            <tbody>
                <?php
                $emp_sql = $con->query("SELECT * FROM awards_master ORDER BY `date` DESC");
                while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
                {
                ?>
                <tr>
                    <td><?php echo $emp_res['date']; ?></td>
                    <td><?php echo $emp_res['award_name']; ?></td>
                    <td><?php echo $emp_res['category']; ?></td>
                    <td><?php echo $emp_res['applied_by']; ?></td>
                    <td><?php echo $emp_res['deadline']; ?></td>
                    <td><?php echo $emp_res['result']; ?></td>
                    <td>
                        <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" onclick="award_edit(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
    function add_award() {
        $.ajax({
            type:"POST",
            url:"qvision/BusinessProcess/awards/new_award.php",
            success:function(data){
                $("#main_content").html(data);
            }
        })
    }
    
    function award_edit(v) {
        $.ajax({
            type:"POST",
            url:"qvision/BusinessProcess/awards/edit_award.php?id="+v,
            success:function(data){
                $("#main_content").html(data);
            }
        })
    }
</script>