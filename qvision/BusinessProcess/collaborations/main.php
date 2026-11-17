<?php
require '../../../connect.php';
session_start();
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">Collaborations</font></h3>
        <a onclick="return add_collaboration()" style="float: right;" class="btn btn-dark"><i class="fa fa-plus"></i> Add New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="dataTables-example table table-striped table-bordered table-hover" id="collab_table" style="width:100%;">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Collaboration type</th>
                        <th>Name of the collaborator/Institute/organisation</th>
                        <th>NDA</th>
                        <th>Attach NDA</th>
                        <th>Date of Signing (NDA)</th>
                        <th>MoU</th>
                        <th>Attach MoU</th>
                        <th>Date of Signing (MoU)</th>
                        <th>Description of work</th>
                        <th>Next Steps/follow-ups</th>
                        <th>Attach Results</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = $con->query("SELECT * FROM z_collaborations ORDER BY id DESC");
                $i = 1;
                while($res = $sql->fetch(PDO::FETCH_ASSOC)) {
                    $nda_doc = !empty($res['nda_file']) ? "<a href='qvision/BusinessProcess/collaborations/uploads/".$res['nda_file']."' target='_blank' class='btn btn-xs btn-info'><i class='fa fa-download'></i> Download</a>" : "-";
                    $mou_doc = !empty($res['mou_file']) ? "<a href='qvision/BusinessProcess/collaborations/uploads/".$res['mou_file']."' target='_blank' class='btn btn-xs btn-info'><i class='fa fa-download'></i> Download</a>" : "-";
                    $res_doc = !empty($res['results_file']) ? "<a href='qvision/BusinessProcess/collaborations/uploads/".$res['results_file']."' target='_blank' class='btn btn-xs btn-info'><i class='fa fa-download'></i> Download</a>" : "-";
                    
                    $nda_date = !empty($res['nda_date']) ? date('d-m-Y', strtotime($res['nda_date'])) : '-';
                    $mou_date = !empty($res['mou_date']) ? date('d-m-Y', strtotime($res['mou_date'])) : '-';
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $res['collab_type']; ?></td>
                        <td><?php echo $res['collaborator_name']; ?></td>
                        <td><?php echo $res['nda_status']; ?></td>
                        <td><?php echo $nda_doc; ?></td>
                        <td><?php echo $nda_date; ?></td>
                        <td><?php echo $res['mou_status']; ?></td>
                        <td><?php echo $mou_doc; ?></td>
                        <td><?php echo $mou_date; ?></td>
                        <td><?php echo nl2br($res['work_description']); ?></td>
                        <td><?php echo nl2br($res['next_steps']); ?></td>
                        <td><?php echo $res_doc; ?></td>
                        <td><?php echo $res['status']; ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="edit_collaboration(<?php echo $res['id']; ?>)"><i class="fa fa-edit"></i></button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#collab_table').DataTable({
        scrollX: true,
        pageLength: 25
    });
});

function add_collaboration() {
    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/collaborations/new.php",
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}

function edit_collaboration(id) {
    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/collaborations/edit.php",
        data: { id: id },
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}
</script>
