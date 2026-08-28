<?php
require '../../config.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$id=$_REQUEST['id'];

$sel=$con->query("select * from crm_calls where id='$id'");
$fet=$sel->fetch();
$call_type = $fet['call_type'];
 $client_org = $fet['client_org'];
?>
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<i class="fa fa-table"></i> calls  Add
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
</div>
<div class="card-body">
<div class="tab-content">

    <div class="active tab-pane" id="for_employment">
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
     
         <?php
                        $stmt = $con->query("SELECT b.id as idc,b.name as name FROM crm_calls a join calls_master b where b.id='$call_type'");
                       $row1 = $stmt->fetch(); 
					   $nid = $row1['idc'];
					   $name = $row1['name'];
					   
					   
					     $stmt1 = $con->query("SELECT b.id as id2,b.name as name2 FROM crm_calls a join services b where b.id='$call_type'");
                       $row2 = $stmt1->fetch(); 
					   $id2 = $row2['id2'];
					   $name2 = $row2['name2'];
					   
                            ?>
        <tr>
        <td colspan="6"><center><b>Add calls</b></center></td>
        </tr>
		
        <tr>
		<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
        <td>Call Source</td>
        <td colspan="5"><input type="text" class="form-control" id="client_org" name="client_org" value="<?php echo $name;?>" readonly></td>
        </tr>
		
     
        <tr>
		<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
        <td>Client Organisation Name</td>
        <td colspan="5"><input type="text" class="form-control" id="client_org" name="client_org" value="<?php echo $fet['client_org'];?>" readonly></td>
        </tr>
		<tr>
        <td>Client Name</td>
        <td colspan="5"><input type="text" class="form-control" id="client_name" name="client_name" value="<?php echo $fet['client_name'];?>"readonly></td>
        </tr>
      <tr>
        <td>Contact Number</td>
        <td colspan="5"><input type="text" class="form-control"id="contact" name="contact"value="<?php echo $fet['contact'];?>"readonly></td>
        </tr>
		<tr>
        <td>Whatsapp Number</td>
        <td colspan="5"><input type="text" class="form-control"id="whatsapp" name="whatsapp"value="<?php echo $fet['whatsapp'];?>"readonly></td>
        </tr>
      <tr>
        <td>Email Id</td>
        <td colspan="5"><input type="text" class="form-control" id="email" name="email"value="<?php echo $fet['email'];?>"readonly></td>
        </tr>
		<tr>
        <td>Alternative Mail_id</td>
        <td colspan="5"><input type="text" class="form-control" id="mail" name="mail"value="<?php echo $fet['alternative_mail'];?>"readonly></td>
        </tr>
      <tr>
        <td>Website</td>
        <td colspan="5"><input type="text" class="form-control" id="website" name="website"value="<?php echo $fet['website'];?>"readonly></td>
        </tr>
      <tr>
        <td>Address</td>
        <td colspan="5"><input type="text" class="form-control" id="address" name="address"value="<?php echo $fet['address'];?>"readonly></td>
        </tr>
    
     <tr>
        <td>Product/Service</td>
		<?php
                 $Product=$fet['Product'];

				 if($Product=='1')
				 {
					 $Product_value="Product";
				 }elseif($Product=='2')
				 {
					 $Product_value="Services";
				 }elseif($Product=='3')
				 {
					 $Product_value="Solution";
				 }
				?>
        <td colspan="5"><input type="text" value="<?php echo $Product_value; ?>" name="Product" class="form-control" id="Product" readonly></td>
        </tr>
		<tr>
		<td></td>
		<?php
		$list=$fet['services'];
			$stmtl = $con->query("SELECT * FROM product_services where id='$list'");
							$rowl = $stmtl->fetch();?>
		 <td colspan="5"><input type="text" value="<?php echo $rowl ['name']; ?>" class="form-control" name="services" id="services" readonly>		
		</td>
        </tr>
      
      
      </table>
	   <?php
			$sel1=$con->query("select status from crm_calls where id='$id'");
$fet1=$sel1->fetch();
			if ($fet1['status'] == 2  || $fet1['status'] == 3) {
                ?>
	  	  <table class="table table-bordered">
<h3><center>Feedback  Details</center></h3>
<tbody>

<?php

$sql=$con->query("SELECT * FROM  crm_calls_feedback where calls_id='$id'");


$cnt=1;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))

{
	
		?>
<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $rows['calls_id']; ?>">
<td>Feedback</td>
<td><input type="text" class="form-control" id="feedback_1" name="feedbacks[]" value="<?php echo  $rows['feedback']; ?>" readonly></td>
<td>Feedback Date:</td><td colspan="1"><input type="text" class="form-control" id="date_0" name="dates1[]" value="<?php echo  $rows['feedback_date']; ?>" readonly></td>


<td>Followup Date:</td><td colspan="1"><input type="text" class="form-control" id="date_1" name="dates[]" value="<?php echo  $rows['date']; ?>" readonly></td>

</tr>
<?php 
$cnt=$cnt+1;
 }?>
 </tbody>
 
      </table><?php

$sql=$con->query("SELECT b.dept_name as department,c.emp_name as employee FROM  crm_calls_feedback a join z_department_master b on a.department = b.id join staff_master c on a.employee = c.candid_id where calls_id='$id'");


$cnt=1;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))

{
	
		?>
	   <table class="table table-bordered">
		 <h3><center>Assign To</center></h3>
		 <tr>
                <td>Assign To Department :</td>
                <td><input type="text" class="form-control" id="department" name="department[]" value="<?php echo  $rows['department']; ?>" readonly></td>
            </tr>
            <tr>
                <td>Assign To Employee :</td>
               
                   <td><input type="text" class="form-control" id="employee" name="employee[]" value="<?php echo  $rows['employee']; ?>" readonly></td>
            </tr>
      
        </table>
<?php } } ?>
	   <br>
            <br>
            <?php
			$sel1=$con->query("select status from crm_calls where id='$id'");
$fet1=$sel1->fetch();
			if ($fet1['status'] == 1) {
                ?>
		 <table class="table table-bordered" id="new_tab">
                    <tr>
                    <h3><center>Feedback Entry </center></h3>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Feedback</th>
                        <th>Feedback Date</th>
<th>Followup Date</th>
                    </tr>


                    <tr>
                        <td><input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/></td>

                        <td><input type="text" class="form-control" id="feedback" name="feedback[]"></td>
                        <td><input type="date" class="form-control" id="feedback_date" name="feedback_date[]"></td>
<td><input type="date" class="form-control" id="fed_date" name="fed_date[]"></td>
                        <td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
                            <input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove">
                        </td>
                    </tr>


                </table>
		 <table class="table table-bordered">
		 <h3><center>Assign To</center></h3>
		 <tr id="dep1">
                <td>Assign To Department :</td>
                <td colspan="5">
                    <select class="form-control" id="Department" name="Department" >
                        <option value="">Choose Department</option>
                        <?php
                        $stmt = $con->query("SELECT * FROM z_department_master");
                        while ($row = $stmt->fetch()) {
                            ?>
                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['dept_name']; ?> </option>
<?php } ?>
                    </select></td>
            </tr>
            <tr id="emp1">
                <td>Assign To Employee :</td>
                <td colspan="5">
                    <select class="form-control" name="employee" id="employee" required>



                    </select></td>
            </tr>
      
        </table>
		   <?php } ?>
        </div>
        <?php if ($fet1['status'] == 1) {
            ?>
			<div class="form-popup" id="myForm" style="display:none;">
		  <table class="table table-bordered">
			<h3><center>Remark</center></h3>
			 <tr>
  <input type="hidden" name="rid" id="rid" value="<?php echo $id;?>">
		
			<textarea type="text" onmouseout="remarkss();" placeholder="Enter Remark" class="form-control" name="remarks" id ="remarks" required></textarea>
			 </tr><br/>
			<!--<a href="employeer_form_reject.php?status=3&del=< ?php echo $row['id']; ?>&remark=< ?php echo $row['hidden_remarks']; ?>"  class="btn">Submit</button>-->
		 <tr>	<center>   <input type="hidden" name="idd" id="idd" value="<?php echo $id;   ?>" class="btn btn-success submitBtn" >
			<button type="button" class="btn btn-success" onclick="genrate_enquiry()">Submit</button>
			<button type="button" class="btn btn-danger cancel"  onclick="closeForm()">Close</button></center>
		   </tr>
		 </table>
		</div>
		<div class="form-popup" id="myForm1" >
           <center>
		   <input type="button" class="btn btn-success" id="save" name="save" onclick="feedback_calls()" value="Assign">
		   <input type="button" class="btn btn-danger" id="save" name="save" onclick="openForm()" value="Drop"></center>
			  </div> <?php
        }
        ?>
            
		
		 <?php if ($fet1['status'] == 2) {
			 
			 $lead = $con->query("select * from crm_calls a join new_client_master b on a.client_org=b.org_name where a.client_org='$client_org'");
			 //echo "select * from crm_calls a join new_client_master b on a.client_org=b.org_name where a.client_org='$client_org'";
			//echo "select * from crm_calls a join enquiry b on a.client_org=b.company_name where a.client_org='$client_org'";
			 $lead1 = $lead->rowCount();
		if($lead1 >= 1) {
            ?>
<input type="hidden" name="idd" id="idd" value="<?php echo $id;   ?>" class="btn btn-success submitBtn" >
            <center><input type="button" class="btn btn-primary" id="save" name="save" onclick="genn()" value="Generate Costsheet">
			</center>
         	   <?php
		} else {  ?>
		<input type="hidden" name="idd" id="idd" value="<?php echo $id;   ?>" class="btn btn-success submitBtn" >
            <center><input type="button" class="btn btn-danger" id="save" name="save" onclick="client_masterss(<?php echo $id; ?>)" value="New Client Master">
			</center>
		<?php }
        }
        ?>
        <!-- /.post -->
    </form>
	<script>
function openForm() {
	
  
   document.getElementById('myForm1').style.visibility="hidden";
 
}
function closeForm() {
	
   document.getElementById('myForm1').style.visibility="visible";
 
}
</script> 
    </div>

			<script>
			 $(document).ready(function () {
        $('#Department').on('change', function () {

            var department_id = this.value;
//alert(department_id);
            $.ajax({
                url: "CRM/find_emp.php",
                type: "GET",
                data: {
                    department_id: department_id
                },
                cache: false,
                success: function (result) {
                    $("#employee").html(result);

                }
            });
        });
    });
			 function feedback_calls()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
  url:"CRM/Calls/calls_feedback_insert.php",
    success:function(data)
    {      
        alert("Entry Successfully");
		 calls()
		          
    }       
    });
    }
	function genn()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
  url:"CRM/Calls/enquiry_insertuh.php",
    success:function(data)
    {      
        alert("Entry Successfully");
		 Cost_sheet()
		          
    }       
    });
    }
	function client_masterss(v){
	//  alert(v);
	$.ajax({
	type:"POST",
	url:"CRM/calls/client_insert.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
	 function genrate_enquiry()
    {
		
		var idd    = document.getElementById("idd").value;
   var remark    = document.getElementById("remarks").value;
   var feedback    = document.getElementById("feedback").value;
   var feedback_date    = document.getElementById("feedback_date").value;
   var fed_date    = document.getElementById("fed_date").value;
    $.ajax({
    type:'GET',
    data:"id="+idd+'&remark='+remark+'&feedback='+feedback+'&feedback_date='+feedback_date+'&fed_date='+fed_date,
 
    success:function(data)
    {      
       
		 url:"CRM/Calls/enquiry_insert.php",
		  alert("Entry Successfully");
		 cost()
		          
    }       
    });
    }
	
	
	function back()
	
	{
		 calls()

	}
	</script>
	<script>
    function check() // education
    {
        var len = $('#new_tab tr').length;
        len = len + 1;
        $('#new_tab').append('<tr class="row_' + len + '"><td><input type="checkbox" class="chk" name="chk[]" id="chk_' + len + '" value="' + len + '"</td><td><input type="text" class="form-control" id="feedback' + len + '" name="feedback[]"></td><td><input type="date" class="form-control" id="feedback_date' + len + '" name="feedback_date[]"></td><td><input type="date" class="form-control" id="fed_date' + len + '" name="fed_date[]"></td></tr>');
    }



    $('#enquiry_row_remove').click(function () {
        $('input:checkbox:checked.chk').map(function () {
            var id = $(this).val();
            var le = $('#new_tab tr').length;

            if (le == 1)
            {
                alert("You Can't Delete All the Rows");
            } else
            {
                $('.row_' + id).remove();
            }

        });
    });
</script>
