<?php
require '../../connect.php';
require '../../user.php';
$userid = $_SESSION['userid'];
$userrole = $_SESSION['userrole'];
$candidateid = $_SESSION['candidateid'];
?>
<head>
    <link rel="stylesheet" href="qvision/commonstyle.css">
</head>
<style>
.card-primary:not(.card-outline)>.card-header {
    background-color:#009EE3 !important;
}
.card-primary:not(.card-outline)>.card-header {
    color: black !important;
}
.btn-dark {
    background-color: #ed5d00 !important;
    border-color: #ed5d00 !important;
}
.card-primary:not(.card-outline)>.card-header a {
    color: black !important;
}
</style>
<div class="card card-info">
    <div class="card-header" style="background-color:#009EE3 !important;">
        <center><h3 class="card-title"><b>Add Claim</b></h3></center>
        <a onclick="back_od()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
    </div>
    <form method="POST" id="fupForm" name="fupForm" action="">
        <table class="table table-bordered">
            <tr>
                <td>Employee Name</td>
                <?php
                $stmts = $con->prepare("SELECT user_id, full_name, candidate_id FROM z_user_master WHERE candidate_id='$candidateid'");
                $stmts->execute();
                $rows = $stmts->fetch();
                $emp_name = $rows['full_name'];
                $candid_id = $rows['candidate_id'];
                ?>
                <td><input type="text" name="Employee_name" value="<?php echo $emp_name; ?>" id="Employee_name" class="form-control" readonly></td>
                <td><input type="hidden" name="candidate_id" value="<?php echo $candid_id; ?>" id="candidate_id" class="form-control" readonly></td>
            </tr>
            <tr>
                <td>Date</td>
                <td colspan="5"><input type="date" class="form-control" id="date" name="date" max="" min=""></td>
            </tr>
            <tr>
                <td>Claim Type</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="Enter Claim Type" id="travel" name="travel"></td>
            </tr>
            <tr>
                <td>Location</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="Enter Location" id="Location" name="Location"></td>
            </tr>
            <tr>
                <td>Purpose of Visit</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="Enter Purpose" id="Purpose" name="Purpose"></td>
            </tr>
            <tr>
                <td>Amount</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="Enter Amount" id="amount" name="amount"></td>
            </tr>
            <tr>
                <td>Attach File(s)</td>
                <td colspan="5">
                    <table id="document_table" style="width: 100%; border: none;">
                        <tr>
                            <td style="border: none; padding-left: 0; padding-right: 10px;">
                                <input type="text" class="form-control" name="doc_titles[]" placeholder="Document Name (e.g. Bill, Ticket)">
                            </td>
                            <td style="border: none; padding-left: 0;">
                                <input type="file" class="form-control" name="attachfile[]">
                            </td>
                            <td style="border: none; width: 50px;">
                                <button type="button" class="btn btn-primary" onclick="add_document_row()"><i class="fa fa-plus"></i>Add</button>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="6"><center><input type="submit" name="submit" class="btn btn-success submitBtn" value="Save"></center></td>
            </tr>
        </table>
    </form>
    <br>
</div>
<script>

$(document).ready(function() {
    $("form[name='fupForm']").on("submit", function(ev) {
        ev.preventDefault();
        if (!validateDate()) {
            alert('Please select a date within the past 30 days and not in the future.');
            return;
        }
        var formData = new FormData(this);
        $.ajax({
            url: 'qvision/claim/insert_od.php',
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                alert('Claim Requested Successfully');
                back_od();
            }
        });
    });
});

function validateDate() {
    var selectedDate = new Date($('#date').val());
    var today = new Date();
    var minDate = new Date(today);
    minDate.setDate(today.getDate() - 30);

    if (selectedDate > today || selectedDate < minDate) {
        return false;
    }
    return true;
}

function back_od() {
    $.ajax({
        type: "POST",
        url: "qvision/claim/od.php",
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}

function add_document_row() {
    var tr = '<tr>' +
             '<td style="border: none; padding-left: 0; padding-right: 10px;"><input type="text" class="form-control" name="doc_titles[]" placeholder="Document Name"></td>' +
             '<td style="border: none; padding-left: 0;"><input type="file" class="form-control" name="attachfile[]"></td>' +
             '<td style="border: none; width: 50px;"><button type="button" class="btn btn-danger" onclick="remove_document_row(this)"><i class="fa fa-minus"></i></button></td>' +
             '</tr>';
    $('#document_table').append(tr);
}

function remove_document_row(btn) {
    $(btn).closest('tr').remove();
}

</script>
