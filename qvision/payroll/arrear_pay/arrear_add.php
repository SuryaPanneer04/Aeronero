<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>

<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header" style="background-color:#ff8b3d;">
<i class="fa fa-table"></i> ADD Arrears
<a onclick="back_to_arrears()" style="float: right;background-color:black;border:1px solid black;color:white;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-minus"></i> Back</a>
</div>
<div class="card-body">
<div class="tab-content">

    <div class="active tab-pane" id="for_employment">
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td><center><img src="qvision/images/logo123.jpg" alt="quadsel" style="width:150px;height:50px;"></center></td>
        <td colspan="5"><center><b>Quadsel Systems Private Limited</b></center></td>
        </tr>
     
        <tr>
        <td>Employee Name</td>
        <td colspan="5">
          <select class="form-control"  id="emp_name" name="emp_name"> 
          <option value=""> -- Select Employee -- </option>
            <?php $showEmp = $con->query("select id,emp_name from staff_master where status =1 ");
             while($emp = $showEmp->fetch(PDO::FETCH_ASSOC)){
            ?>
             <option value="<?php echo $emp['id'];?>"> <?php echo $emp['emp_name'];?> </option>
            <?php } ?>
         </select>
        </td>
        </tr>

        <!-- <tr>
         <td>Payroll Month</td>
         <td colspan="5">
         <select class="form-control"  id="month" name="month"> 
          <option value=""> -- Select payroll Month -- </option>
            <?php $showEmp = $con->query("select month from payroll_master where flag !=2");
             while($emp = $showEmp->fetch(PDO::FETCH_ASSOC)){
            ?>
             <option value="<?php echo $emp['month'];?>"> <?php echo $emp['month'];?> </option>
            <?php } ?>
         </select>
         </td>
        </tr> -->

        <tr>
          <td>Payroll Year & Month </td>
          <td><input type="month" name="month" id="month" class="form-control" required></td>
        </tr>
      
		<tr>
         <td>Amount</td>
         <td colspan="5">
          <input type="number" class="form-control" name="arrear_amt" >
         </td>
        </tr>

        <tr>
         <td>Remark</td>
         <td colspan="5">
          <input type="text" class="form-control" name="arrear_remark" >
         </td>
        </tr>
	
        <tr>
        <td colspan="6"><input type="button" class="btn btn-success" value="Save"  name="submit" onclick="insert_arrears()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

<script>
 function insert_arrears(){

    var data = $('form').serialize();
    $.ajax({
    type:'POST',
    data: data,
    url:"qvision/payroll/arrear_pay/arrear_submit.php",
    success:function(data){
		if(data==1)
		{
			alert("Inserted successfully");
			arrear_pay()
		}
		else
		{
			alert("Not inserted");
			arrear_pay()
		}
    }
	
    });
    }
	
	function back_to_arrears()
	{
		arrear_pay()
	}
	</script>