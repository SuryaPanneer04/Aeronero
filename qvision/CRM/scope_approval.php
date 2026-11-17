<?php
require "../../connect.php";
include("../../user.php");
$userrole = isset($_SESSION["userrole"]) ? $_SESSION["userrole"] : '';
?>
<div class="card card-primary">
    <div class="card-header" style="background-color:#009EE3 !important;">
        <h3 class="card-title"><font size="5">Scope Approval</font></h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Enquiry Code</th>
                    <th>Company Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = $con->query("SELECT * FROM enquiry WHERE status=31");
                $i = 1;
                while($row = $sql->fetch()) {
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row["enquiry_code"]; ?></td>
                    <td><?php echo $row["Company_name"]; ?></td>
                    <td>
                        <button class="btn btn-info" onclick="viewScope(<?php echo $row["id"]; ?>)">View/Print</button>
                        <button class="btn btn-success" onclick="approveScope(<?php echo $row["id"]; ?>)">Approve</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>

function viewScope(id) {
    $("#softwareScopeModal").remove();
    $.ajax({
        type: "POST",
        url: "qvision/CRM/scope_view.php",
        data: { id: id },
        success: function(data) {
            $("#softwareScopeContent").html(data);
            var scopeModal = $("<div class='modal fade' id='softwareScopeModal' tabindex='-1' role='dialog'><div class='modal-dialog modal-lg' role='document'><div class='modal-content'><div class='modal-header'><h4 class='modal-title'>Scope Details</h4></div><div class='modal-body' id='modal_body_content'>" + data + "</div><div class='modal-footer'><button type='button' class='btn btn-primary' onclick='printScope()'>Print</button><button type='button' class='btn btn-default' data-dismiss='modal' onclick='closeScopeModal()'>Close</button></div></div></div></div>");
            $("body").append(scopeModal);
            $("#softwareScopeModal").modal("show");
        },
        error: function(err) {
            alert("Error loading scope: " + err.statusText);
        }
    });
}
function closeScopeModal() {
    $("#softwareScopeModal").modal("hide");
}
function printScope() {
    var content = document.getElementById("modal_body_content").innerHTML;
    var printWindow = window.open("", "", "height=400,width=800");
    printWindow.document.write("<html><head><title>Print Scope</title>");
    printWindow.document.write("</head><body>");
    printWindow.document.write(content);
    printWindow.document.write("</body></html>");
    printWindow.document.close();
    printWindow.print();
}


function approveScope(id) {
    if(confirm("Are you sure you want to approve this scope?")) {
        $.ajax({
            type: "POST",
            url: "qvision/CRM/scope_approve_submit.php",
            data: { id: id },
            success: function(data) {
                if(data == 1) {
                    alert("Approved Successfully");
                    scope_approval();
                }
            }
        });
    }
}
</script>

