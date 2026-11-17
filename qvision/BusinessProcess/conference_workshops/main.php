<?php
require '../../../connect.php';
session_start();
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">Conference and Workshops</font></h3>
        <a onclick="return add_conference_workshop()" style="float: right;" class="btn btn-dark"><i class="fa fa-plus"></i> Add New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="dataTables-example table table-striped table-bordered table-hover" id="conf_table" style="width:100%;">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Date</th>
                        <th>Topics covered</th>
                        <th>Attendees</th>
                        <th>Attach Report</th>
                        <th>Inferences</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = $con->query("SELECT * FROM z_conferences_workshops ORDER BY id DESC");
                $i = 1;
                while($res = $sql->fetch(PDO::FETCH_ASSOC)) {
                    $conf_id = $res['id'];
                    $docs_html = '';
                    $docs = $con->query("SELECT * FROM z_conferences_workshops_documents WHERE conf_id = $conf_id");
                    if($docs !== false && $docs->rowCount() > 0) {
                        while($d = $docs->fetch(PDO::FETCH_ASSOC)) {
                            $docs_html .= "<a href='qvision/BusinessProcess/conference_workshops/uploads/".$d['document_path']."' target='_blank' style='display:block; margin-bottom:5px;' class='btn btn-xs btn-info'><i class='fa fa-download'></i> ".$d['document_name']."</a>";
                        }
                    } else {
                        // Fallback to legacy single file if exists
                        if(!empty($res['report_file'])) {
                            $docs_html = "<a href='qvision/BusinessProcess/conference_workshops/uploads/".$res['report_file']."' target='_blank' class='btn btn-xs btn-info'><i class='fa fa-download'></i> Download</a>";
                        } else {
                            $docs_html = "-";
                        }
                    }
                    $conf_date = !empty($res['conf_date']) && $res['conf_date'] != '0000-00-00' ? date('d-m-Y', strtotime($res['conf_date'])) : '-';
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $conf_date; ?></td>
                        <td><?php echo nl2br($res['topics_covered']); ?></td>
                        <td><?php echo nl2br($res['attendees']); ?></td>
                        <td><?php echo $docs_html; ?></td>
                        <td><?php echo nl2br($res['inferences']); ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="edit_conference_workshop(<?php echo $res['id']; ?>)"><i class="fa fa-edit"></i></button>
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
    $('#conf_table').DataTable({
        scrollX: true,
        pageLength: 25
    });
});

function add_conference_workshop() {
    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/conference_workshops/new.php",
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}

function edit_conference_workshop(id) {
    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/conference_workshops/edit.php",
        data: { id: id },
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}
</script>
