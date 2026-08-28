<?php
require '../../connect.php';
$id = $_REQUEST['id'];

$stmt = $con->prepare("SELECT * FROM manual_att a INNER JOIN staff_master b on a.emp_code=b.id WHERE a.id='$id'");
$stmt->execute();
$row = $stmt->fetch();
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
		<style>
.card-primary:not(.card-outline)>.card-header{
background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
.btn-dark{
	background-color: #ed5d00 !important;
    border-color: #ed5d00 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black !important;
}
</style>


<div class="card card-primary">
<div class="card-header">
<h3 class="card-title"><font size="5">OD  EDIT</font></h3>
 <a onclick="return back_od()" style="float: right;" data-toggle="modal" class="btn">Back</a>
</div>

<form method="POST" action="">

 <table class="table table-bordered">
   <tr>
    <td>Date</td>
    <td colspan="5"><input type="date" class="form-control"  id="date" name="date" value="<?php echo $row[4]; ?>" readonly></td>
   </tr>
   <tr>
    <td>Employee Name</td>
	<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo $id; ?>"readonly>
    <td>
     <?php
        $emp_id = $row['emp_code'];
        $sql = $con->query("SELECT * FROM staff_master where emp_code='$emp_id'");
        $stmt->execute();
        $row1 = $stmt->fetch();
     ?>
    <input type="text" class="form-control" id="Employee_name" name="Employee_name" value="<?php echo $row1['emp_name']; ?>"readonly>                    
   </td>
    </tr>	
     <tr>
     <td>Customer Name</td>
    <td colspan="5"><input type="text" class="form-control" placeholder="Enter Customer Name" id="Customer_name" name="Customer_name" value="<?php echo $row[2]; ?>" readonly></td>
    </tr>

    <tr>
    <td>Location</td>
    <td colspan="5"><input type="text" class="form-control" placeholder="Enter Location" id="Location" name="Location"
	value="<?php echo $row[3]; ?>" readonly></td>
    </tr>
    <tr>
    <td>Purpose of Visit</td>
    <td colspan="5"><input type="text" class="form-control" placeholder="Enter Purpose" id="Purpose" name="Purpose"  
	value="<?php echo $row[5]; ?>" readonly></td>
    </tr>
										
	<tr>
    <td>Distance</td>
    <td colspan="5"><input type="text" class="form-control" placeholder="Enter Distance" id="distance" name="distance" 
	value="<?php echo $row[6]; ?>" readonly></td>
    </tr>
	<tr>
    <td>Amount</td>
    <td colspan="5"><input type="text" class="form-control" placeholder="Enter Amount" id="amount" name="amount" 
	value="<?php echo $row[7]; ?>" readonly></td>
    </tr>

    <tr>
      <td colspan="6"><input type="button" class="btn btn-primary btn-md"  style="float:right;" name="Reject" onclick="od_reject()" value="Reject">
      <input type="button" class="btn btn-primary btn-md"  style="float:right; margin-right: 20px;" name="Approve" onclick="od_approve()" value="Approve">	  </td>
    </tr>
	 </table>
</form>
<br>
</div>


<script>
 function back_od()
   {
   $.ajax({
   type: "POST",
   url: "qvision/payroll/od.php",
   success: function (data) {
   $("#main_content").html(data);
   }
  })
 }
 
 
 function od_approve()
    {   
	    var value= 1;
        var id = $('#get_id').val();
        var data = $('form').serialize();
        $.ajax({
            type: 'GET',
            data: data + "&" + "id=&" + id +"value="+value,
            url:'/ssinfo1/qvision/payroll/od_approve_update.php',
            success: function (data)
            {
                if (data == 0)
                {
                    alert('Not updated');

                } else
                {
                    alert("Update Successfully");
                    od()
                }

            }
        });
    }
	
	function od_reject()
    {
        var id = $('#get_id').val();
        var data = $('form').serialize();
        $.ajax({
            type: 'GET',
            data: data + "&" + "id=" + id,
            url:'/ssinfo1/qvision/payroll/od_approve_update.php',
            success: function (data)
            {
                if (data == 0)
                {
                    alert('Not updated');

                } else
                {
                    alert("Update Successfully");
                    od()
                }

            }
        });
    }
</script>
