<?php
require '../../connect.php';
date_default_timezone_set("Asia/Kolkata");
$curdate = date("d-m-y");
?>

<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-body">
           <!-- <input class="btn btn-primary" type="button" value="Earning Upload" onclick="earning_upload()"> -->
			<input class="btn btn-success" type="button" value="Deduction Report" onclick="deduction_upload()">
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <div class="card">
        <div class="card-body">
            <div id="earning_view">
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>



<script>

    function earning_upload()
    {
        $.ajax({
            type: 'GET',
            url: 'qvision/earnings/earnings_upload.php',
            data: "id=" + 1,
            success: function (data)
            {
                $("#earning_view").html(data);
            }
        })
    }

    function deduction_upload()
    {
        $.ajax({
            type: 'GET',
            url: 'qvision/earnings/deduction/deduction_upload.php',
            data: "id=" + 1,
            success: function (data)
            {
                $("#earning_view").html(data);
            }
        })
    }
</script>


