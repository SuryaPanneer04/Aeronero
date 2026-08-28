<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<body>
<div  class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">Holiday  Add</font></h3>
        <input type="button" style="float:right;" class="btn btn-primary" name="back" value="Back" onclick="back_holiday()">

    </div>
    <form method="POST" enctype="multipart/form-data">
        <!-- Post -->
        <table class="table table-bordered">
           
            <tr>
                <td colspan="6"><center><b>Add Holiday</b></center></td>
            </tr>
            <tr>
                <td>Year</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="Year" id="Year" name="Year" ></td>
            </tr>
            <tr>
                <td>Date</td>
                <td colspan="5"><input type="date" class="form-control"  id="date" name="date" ></td>
            </tr>
            <tr>
                <td>Holiday Name</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="Holiday Name" id="holiday_name" name="holiday_name"></td>
            </tr>
           
		   <tr>
            <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_holiday()" value="Save"> </td>
            </tr>
        </table>
        <!-- /.post -->
    </form>
</div>

<script>
    function back_holiday()
    {
       holidays()
    }
    function insert_holiday()
    {
        var data = $('form').serialize();
        $.ajax({
            type: 'GET',
            data:  data,
            url: 'qvision/payroll/holiday/insert_holiday.php',
            success: function (data)
            {
                alert("Entry Successfully");
                holidays()
            }
        });
    }
</script>
</body>
</html>