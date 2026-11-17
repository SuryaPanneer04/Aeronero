<?php
require_once __DIR__ . '/../../../connect.php';
session_start();
?>
<div class="card card-primary" style="box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-radius: 8px;">
    <div class="card-header" style="background: linear-gradient(135deg, #009EE3 0%, #007bb5 100%); color: white; display: flex; justify-content: space-between; align-items: center; border-radius: 8px 8px 0 0; padding: 12px 20px;">
        <h3 class="card-title" style="font-weight: 600; margin: 0; font-size: 1.25rem;">
            <i class="fa fa-handshake mr-2" style="color: #FBC710;"></i> Distributors
        </h3>
        <a onclick="return add_distributor()" class="btn btn-dark btn-sm" style="background-color: #ed5d00; border-color: #ed5d00; font-weight: 500; padding: 6px 14px; border-radius: 4px; cursor: pointer;">
            <i class="fa fa-plus"></i> Add New Distributor
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="dataTables-example table table-striped table-bordered table-hover" id="distributor_table" style="width:100%;">
                <thead style="background-color: #f1f5f9; color: #334155;">
                    <tr>
                        <th style="width: 45px;">S.No</th>
                        <th> Distributor Name</th>
                        <th> Distributor Contact No</th>
                        <th> Location</th>
                        <th> Contact Person</th>
                        <th> Contact Person No</th>
                        <th> Email ID</th>
                        <th style="width: 75px;" class="text-center">Status</th>
                        <th style="width: 85px;" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = $con->query("SELECT * FROM z_distributors ORDER BY id DESC");
                $i = 1;
                if ($sql) {
                    while($res = $sql->fetch(PDO::FETCH_ASSOC)) {
                        $statusBadge = ($res['status'] == 'Active') 
                            ? "<span class='badge badge-success' style='background-color:#28a745; padding: 5px 9px; font-size: 12px;'>Active</span>" 
                            : "<span class='badge badge-secondary' style='background-color:#6c757d; padding: 5px 9px; font-size: 12px;'>Inactive</span>";
                        
                        $dist_contact = !empty($res['distributor_contact_no']) ? $res['distributor_contact_no'] : $res['contact_no'];
                        $person_contact = !empty($res['contact_person_no']) ? $res['contact_person_no'] : '-';

                        $locParts = array_filter([$res['city'], $res['state'], $res['country']]);
                        $locHeader = !empty($locParts) ? implode(', ', $locParts) : '-';
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><strong style="color: #0f172a; font-size: 14px;"><?php echo htmlspecialchars($res['distributor_name']); ?></strong></td>
                        <td>
                            <?php if(!empty($dist_contact)): ?>
                                <a href="tel:<?php echo htmlspecialchars($dist_contact); ?>" style="color: #009EE3; font-weight: 600;">
                                    <i class="fa fa-phone mr-1"></i><?php echo htmlspecialchars($dist_contact); ?>
                                </a>
                            <?php else: ?>-<?php endif; ?>
                        </td>
                        <td>
                            <div style="font-weight: 600; color: #ed5d00;">
                                <i class="fa fa-map-marker-alt text-danger mr-1"></i> <?php echo htmlspecialchars($locHeader); ?>
                            </div>
                            <?php if(!empty($res['location'])): ?>
                                <div class="text-muted" style="font-size: 12px; margin-top: 2px;">
                                    <?php echo htmlspecialchars($res['location']); ?>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($res['contact_person'] ?: '-'); ?></td>
                        <td>
                            <?php if(!empty($person_contact) && $person_contact != '-'): ?>
                                <a href="tel:<?php echo htmlspecialchars($person_contact); ?>" style="color: #475569; font-weight: 500;">
                                    <i class="fa fa-mobile-alt mr-1"></i><?php echo htmlspecialchars($person_contact); ?>
                                </a>
                            <?php else: ?>-<?php endif; ?>
                        </td>
                        <td>
                            <?php if(!empty($res['email'])): ?>
                                <a href="mailto:<?php echo htmlspecialchars($res['email']); ?>" style="color: #009EE3;">
                                    <i class="fa fa-envelope mr-1"></i><?php echo htmlspecialchars($res['email']); ?>
                                </a>
                            <?php else: ?>-<?php endif; ?>
                        </td>
                        <td class="text-center"><?php echo $statusBadge; ?></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-primary" onclick="edit_distributor(<?php echo $res['id']; ?>)" title="Edit" style="background-color: #009EE3; border-color: #009EE3; padding: 3px 8px;">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="delete_distributor(<?php echo $res['id']; ?>)" title="Delete" style="padding: 3px 8px;">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php 
                    } 
                } 
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#distributor_table').DataTable({
        scrollX: true,
        pageLength: 25,
        dom: '<"top"lf>rt<"bottom"ip><"clear">'
    });
});

function add_distributor() {
    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/distributors/new.php",
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}

function edit_distributor(id) {
    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/distributors/edit.php",
        data: { id: id },
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}

function delete_distributor(id) {
    if (confirm("Are you sure you want to delete this distributor?")) {
        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/distributors/delete.php",
            data: { id: id },
            success: function(response) {
                alert(response);
                distributors();
            }
        });
    }
}
</script>
