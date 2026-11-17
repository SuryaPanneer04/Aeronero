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
        <h3 class="card-title"><font size="5">PATENTS AND DESIGNS LIST</font></h3>
        <a onclick="add_patent()" style="float: right;" class="btn btn-primary">ADD</a>
    </div>
    
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover display nowrap" id="example1" style="width:100%">
            <thead>
                <th>Date</th>
                <th>Title of the Patent/Design</th>
                <th>Applied by</th>
                <th>Attach the patent document</th>
                <th>Status</th>
                <th>Tools</th>
            </thead>
            <tbody>
                <?php
                $emp_sql=$con->query("SELECT * FROM patents_master ORDER BY id DESC");
                while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
                {
                ?>
                <tr>
                    <td><?php echo $emp_res['date']; ?></td>
                    <td><?php echo $emp_res['title_of_patent']; ?></td>
                    <td><?php echo $emp_res['applied_by']; ?></td>
                    <td>
                        <?php 
                        $attachments = json_decode($emp_res['attach_document'], true);
                        if (!empty($attachments)) {
                            foreach($attachments as $file) {
                                echo '<a href="'.$file.'" target="_blank">View File/Link</a><br>';
                            }
                        } else {
                            echo "None";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $status = $emp_res['status'];

                        if ($status == 'Completed') {
                            echo '<span class="text-success">Completed</span>';
                        } elseif ($status == 'Processing') {
                            echo '<span class="text-primary">Processing</span>';
                        } elseif ($status == 'Pending') {
                            echo '<span class="text-warning">Pending</span>';
                        } else {
                            echo htmlspecialchars($status);
                        }
                        ?>
                    </td>
                    <td>
                        <button class="btn btn-success btn-sm edit btn-flat" onclick="patent_edit(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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

function add_patent() {
    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/patents/new_patent.php",
        success: function(data){ $("#main_content").html(data); }
    });
}

function patent_edit(v) {
    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/patents/edit_patent.php?id="+v,
        success: function(data){ $("#main_content").html(data); }
    });
}
</script>