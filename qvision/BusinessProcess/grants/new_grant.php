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
        <h3 style="float: left;"><font size="5">ADD GRANT DETAILS</font></h3>
        <a href="javascript:void(0);" onclick="back_grant();" style="float: right;" class="btn btn-dark">BACK</a>
    </div>

    <form method="POST" action="">
        <input type="hidden" name="userrole" id="userrole" value="<?php echo $userrole; ?>">
        <table class="table table-bordered">
            <tr>
                <td>Date</td>
                <td colspan="2"><input type="date" class="form-control" id="date" name="date"></td>
            </tr>
            <tr>
                <td>Grant Name</td>
                <td colspan="2"><input type="text" class="form-control" id="grant_name" name="grant_name"></td>
            </tr>
            <tr>
                <td>Project Applied</td>
                <td colspan="2"><input type="text" class="form-control" id="project_applied" name="project_applied"></td>
            </tr>
            <tr>
                <td>Applied by</td>
                <td colspan="2"><input type="text" class="form-control" id="applied_by" name="applied_by"></td>
            </tr>
            <tr>
                <td>Amount</td>
                <td colspan="2"><input type="number" step="0.01" class="form-control" id="amount" name="amount"></td>
            </tr>
            <tr>
                <td>Deadline</td>
                <td colspan="2"><input type="date" class="form-control" id="deadline" name="deadline"></td>
            </tr>
            <tr>
                <td>Result</td>
                <td colspan="2"><input type="text" class="form-control" id="result" name="result"></td>
            </tr>
            <tr>
                <td>Status</td>
                <td colspan="2">
                    <select class="form-control" name="status" id="status">
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="completed">Completed</option>
                    </select>
                </td>
            </tr>
        </table>

        <input type="button" name="submit" value="Submit" class="btn btn-primary btn-md" style="float:right;position: relative;left: -5px;" onclick="save_grant()">
        <br><br>
    </form>
</div>

<script>
    function back_grant() {
    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/grants/grants_list.php",
        success: function(data) {
            $("#main_content").html(data);
        },
        error: function(xhr, status, error) {
            console.log("Error loading grants list:", error);
            alert("Unable to load Grants List.");
        }
    });
}
</script>
<script>
    function save_grant() {
        var id = 0;
        var data = $('form').serialize();
        $.ajax({
            type: "POST",
            data: data + "&id=" + id,
            url: "qvision/BusinessProcess/grants/grant_submit.php",
            success: function(response) {
                alert("Submitted Successfully");
                
                // Redirect back to grants list using AJAX
                $.ajax({
                    type: "POST",
                    url: "qvision/BusinessProcess/grants/grants_list.php",
                    success: function(data) {
                        $("#main_content").html(data);
                    }
                });
            }
        });
    }
</script>
<script>
    function update_grant() {
        var data = $('form').serialize();
        $.ajax({
            type: "POST",
            data: data,
            url: "qvision/BusinessProcess/grants/grant_update.php",
            success: function(response) {
                alert("Updated Successfully");
                
                // Redirect back to grants list using AJAX
                $.ajax({
                    type: "POST",
                    url: "qvision/BusinessProcess/grants/grants_list.php",
                    success: function(data) {
                        $("#main_content").html(data);
                    }
                });
            }
        });
    }
</script>