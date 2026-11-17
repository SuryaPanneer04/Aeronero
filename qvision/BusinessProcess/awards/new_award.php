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
        <h3 style="float: left;"><font size="5">ADD AWARD DETAILS</font></h3>
        <a onclick="back_award()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
    </div>

    <form method="POST" action="">
        <input type="hidden" name="userrole" id="userrole" value="<?php echo $userrole; ?>">
        <table class="table table-bordered">
            <tr>
                <td>Date</td>
                <td colspan="2"><input type="date" class="form-control" id="date" name="date"></td>
            </tr>
            <tr>
                <td>Award Name</td>
                <td colspan="2"><input type="text" class="form-control" id="award_name" name="award_name"></td>
            </tr>
            <tr>
                <td>Category</td>
                <td colspan="2"><input type="text" class="form-control" id="category" name="category"></td>
            </tr>
            <tr>
                <td>Applied by</td>
                <td colspan="2"><input type="text" class="form-control" id="applied_by" name="applied_by"></td>
            </tr>
            <tr>
                <td>Deadline</td>
                <td colspan="2"><input type="date" class="form-control" id="deadline" name="deadline"></td>
            </tr>
            <tr>
                <td>Result</td>
                <td colspan="2"><input type="text" class="form-control" id="result" name="result"></td>
            </tr>
        </table>

        <input type="button" name="submit" value="Submit" class="btn btn-primary btn-md" style="float:right;position: relative;left: -5px;" onclick="save_award()">
        <br><br>
    </form>
</div>

<script>
    function back_award() {
        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/awards/awards_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        });
    }

    function save_award() {
        var data = $('form').serialize();
        $.ajax({
            type: "POST",
            data: data,
            url: "qvision/BusinessProcess/awards/award_submit.php",
            success: function(response) {
                alert("Submitted Successfully");
                $.ajax({
                    type: "POST",
                    url: "qvision/BusinessProcess/awards/awards_list.php",
                    success: function(listData) {
                        $("#main_content").html(listData);
                    }
                });
            }
        });
    }
</script>