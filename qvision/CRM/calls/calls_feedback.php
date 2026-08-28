<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
  $user_id = $_SESSION['userid'];
  $candidate_id = $_SESSION['candidateid'];
$id=$_REQUEST['id'];


$sel=$con->query("select * from crm_calls where id='$id'");
$fet=$sel->fetch();
$call_type = $fet['call_type'];
 $client_org = $fet['client_org'];
 $client_type = $fet['client_type'];
?>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
    max-width: 600px;
    padding: 10px;
    background-color: white;
    margin-left: 15%;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
.content {
    max-width: 153% !important;
    margin-left: 19% !important;
}
</style>
</head>
<section class="content">

<div class="card">
<div class="card-header">
 calls  Add
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>

<div class="tab-content">

    <div class="active tab-pane" id="for_employment">
    <form method="POST" name='name' enctype="multipart/form-data">
   
    <table class="table table-bordered">
     
         <?php
                        $stmt = $con->query("SELECT b.id as idc,b.name as name FROM crm_calls a 
						join calls_master b where b.id='$call_type'");
                       $row1 = $stmt->fetch(); 
					   $nid = $row1['idc'];
					   $name = $row1['name'];
					   
					   
					     $stmt1 = $con->query("SELECT b.id as id2,b.name as name2 
						 FROM crm_calls a join services b where b.id='$call_type'");
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
        <td colspan="5"><input type="text" class="form-control"id="contact" name="contact" value="<?php echo $fet['contact'];?>"readonly></td>
        </tr>
		<tr>
        <td>Whatsapp Number</td>
        <td colspan="5"><input type="text" class="form-control"id="whatsapp" name="whatsapp" value="<?php echo $fet['whatsapp'];?>"readonly></td>
        </tr>
      <tr>
        <td>Email Id</td>
        <td colspan="5"><input type="text" class="form-control" id="email" name="email" value="<?php echo $fet['email'];?>"readonly></td>
        </tr>
		<tr>
        <td>Alternative Mail_id</td>
        <td colspan="5"><input type="text" class="form-control" id="mail" name="mail" value="<?php echo $fet['alternative_mail'];?>"readonly></td>
        </tr>
      <tr>
        <td>Website</td>
        <td colspan="5"><input type="text" class="form-control" id="website" name="website" value="<?php echo $fet['website'];?>"readonly></td>
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
		 <td colspan="5"><input type="text" value="<?php echo $rowl ['name'] ?? "Solution"; ?>" class="form-control" name="services" id="services" readonly>		
		</td>
        </tr>
     
    <tr>
                <td>File</td>
                <td colspan="5"><a href="/KerliERP/CRM/calls/uploads/<?php echo $fet['image']; ?>" download="<?php echo $fet['image']; ?>"><?php echo $fet['image']; ?></a>
                </td>
            </tr>
			<tr>
        <td>Remarks</td>
        <td colspan="5"><input type="text" class="form-control" id="remarks" name="remarks"value="<?php echo $fet['remarks'];?>"readonly></td>
        </tr>
      </table>
	   <?php
			$sel1=$con->query("select status from crm_calls where id='$id'");
$fet1=$sel1->fetch();

			if ($fet1['status'] == 2  || $fet1['status'] == 3 || $fet1['status'] == 5) {
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
<td><input type="text" class="form-control" id="feedbacks" name="feedbacks[]" value="<?php echo  $rows['feedback']; ?>" readonly></td>
<td>Feedback Date:</td><td colspan="1"><input type="text" class="form-control" id="date_0" name="dates1[]" value="<?php echo  $rows['feedback_date']; ?>" readonly></td>


<td>Followup Date:</td><td colspan="1"><input type="text" class="form-control" id="date_1" name="dates[]" value="<?php echo  $rows['date']; ?>" readonly></td>

</tr>
<?php 
$cnt=$cnt+1;
 }?>
 </tbody>
 
      </table>
	  	 <?php
		/*  echo "SELECT b.dept_name as department,c.emp_name as employee FROM  crm_calls_feedback a join z_department_master b on a.department = b.id join staff_master c on a.employee = c.candid_id where calls_id='$id'"; */

$sql=$con->query("SELECT b.dept_name as department,c.emp_name as employee,a.employee as emp,a.status as statuss FROM  crm_calls a join z_department_master b on (a.department = b.id) join staff_master c on (a.employee = c.candid_id) where a.id='$id'");


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
		<?php

		if($rows['statuss'] == '2' && $candidate_id == $rows['emp']){ ?>
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

                        <td><input type="text" class="form-control" id="feedback" name="feedback1[]"></td>
                        <td><input type="date" class="form-control" id="feedback_date" name="feedback_date1[]"></td>
						<td><input type="date" class="form-control" id="fed_date" name="fed_date1[]"></td>
                        <td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check11()" value="Add">
                            <input type="button" class="btn btn-danger" id="enquiry_row_remove11"  value="Remove">
                        </td>
						
						
						
                    </tr>


                </table>
				<input type="button" class="btn btn-success" id="save" name="save" style="position: relative;left: 20px;" onclick="feedback_callss1()" value="Save">
				
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
                    <select class="form-control" name="employee" id="emp" required>



                    </select></td>
            </tr>
     
        </table>
		<div class="form-popup" id="myForm" style="display:none;margin-right: 753px;bottom: 155px;height: 300px;width: 409px;background-color: cornsilk;">
		  <table class="table table-bordered">
			<h3><center>Remark</center></h3>
			 <tr>
  <input type="hidden" name="rid" id="rid" value="<?php echo $id;?>">
		
			<textarea type="text" placeholder="Enter Remark" class="form-control" name="drop_remarks" id ="drop_remarks" style="height: 154px;" required></textarea>
			 </tr><br/>
			<!--<a href="employeer_form_reject.php?status=3&del=< ?php echo $row['id']; ?>&remark=< ?php echo $row['hidden_remarks']; ?>"  class="btn">Submit</button>-->
		 <tr>	<center>   <input type="hidden" name="idd" id="idd" value="<?php echo $id;   ?>" class="btn btn-success submitBtn" >
			<button type="button" class="btn btn-success" onclick="genrate_enquiry(event)">Submit</button>
			<button type="button" class="btn btn-danger cancel"  onclick="closeForm()">Close</button></center>
		   </tr>
		 </table>
		</div>
		 <div class="form-popup1" id="myForm1" >
           <center>
		   <input type="button" class="btn btn-success" id="save" name="save" onclick="feedback_calls(event)" value="Assign">
		   <input type="button" class="btn btn-danger" id="save" name="save" onclick="openForm()" value="Drop"></center>
			  </div>
			<?php } } } ?>
	   <br>
            <br>
            <?php
			$sel1=$con->query("select id,status,created_by,employee from crm_calls where id='$id'");
			
			
$fet1=$sel1->fetch();


			if ($fet1['status'] == 1 ) {
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
<td><input type="text" class="form-control" id="feedbacks" name="feedbacks[]" value="<?php echo  $rows['feedback']; ?>" readonly></td>
<td>Feedback Date:</td><td colspan="1"><input type="text" class="form-control" id="date_0" name="dates1[]" value="<?php echo  $rows['feedback_date']; ?>" readonly></td>


<td>Followup Date:</td><td colspan="1"><input type="text" class="form-control" id="date_1" name="dates[]" value="<?php echo  $rows['date']; ?>" readonly></td>

</tr>
<?php 
$cnt=$cnt+1;
 }?>
 </tbody>
 
      </table>
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

                        <td><input type="text" class="form-control" id="feedback" name="feedback1[]"></td>
                        <td><input type="date" class="form-control" id="feedback_date" name="feedback_date1[]"></td>
						<td><input type="date" class="form-control" id="fed_date" name="fed_date1[]"></td>
                        <td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check22()" value="Add">
                            <input type="button" class="btn btn-danger" id="enquiry_row_remove22"  value="Remove">
                        </td>
						

			 </table><input type="hidden" name="idd" id="idd" value="<?php echo $id;   ?>" class="btn btn-success submitBtn" >
			 <input type="button" class="btn btn-success" id="save" name="save" onclick="feedback_callss2()" value="Save"> 
		 <table class="table table-bordered">
		 <h3><center>Assign To</center></h3>
		 <tr id="dep1">
                <td>Assign To Department :</td>
                <td colspan="5">
                    <select class="form-control" id="Department1" name="Department" >
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
                    <select class="form-control" name="employee" id="employee1" required>



                    </select></td>
            </tr>
      
        </table>
		 
        </div>
       
			<div class="form-popup" id="myForm" style="display:none;margin-right: 753px;bottom: 155px;height: 300px;width: 409px;background-color: cornsilk;">
		  <table class="table table-bordered">
			<h3><center>Remark</center></h3>
			 <tr>
  <input type="hidden" name="rid" id="rid" value="<?php echo $id;?>">
		
			<textarea type="text" placeholder="Enter Remark" class="form-control" name="drop_remarks" id ="drop_remarks" style="height: 154px;" required></textarea>
			 </tr><br/>
			<!--<a href="employeer_form_reject.php?status=3&del=< ?php echo $row['id']; ?>&remark=< ?php echo $row['hidden_remarks']; ?>"  class="btn">Submit</button>-->
		 <tr>	<center>   <input type="hidden" name="idd" id="idd" value="<?php echo $id;   ?>" class="btn btn-success submitBtn" >
			<button type="button" class="btn btn-success" onclick="genrate_enquiry(event)">Submit</button>
			<button type="button" class="btn btn-danger cancel"  onclick="closeForm()">Close</button></center>
		   </tr>
		 </table>
		</div>
		
		<div class="form-popup1" id="myForm1" >
           <center>
		   <input type="button" class="btn btn-success" id="save" name="save" onclick="feedback_calls(event)" value="Assign">
		   <input type="button" class="btn btn-danger" id="save" name="save" onclick="openForm()" value="Drop"></center>
			  </div><br/> 
			  <div class="form-popup2" id="myForm3" >
		<input type="hidden" name="idd" id="idd" value="<?php echo $id;   ?>" class="btn btn-success submitBtn" >
            <center>
			
			 <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal1">
  Verify Costsheet
</button>
<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-body">
       You have trying to generate a <h2 style="color:DodgerBlue;"><?php echo $Product_value; ?></h2> based Cost Sheet.
      </div>
      <div class="modal-footer">
       
       <input type="button" class="btn btn-primary" id="save" name="save" 
			 data-dismiss="modal" onclick="openForm33()" value="Ok">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
			</center>
			</div>

			  <?php
        }
		
        ?>
            <?php
			
 if ($fet1['status'] == 2 && $fet1['employee'] == $candidate_id) {
	
		
		?>

		<div class="form-popup1" id="myForm2" >
		<input type="hidden" name="idd" id="idd" value="<?php echo $id;   ?>" class="btn btn-success submitBtn" >
            <center>
			 <!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Verify Costsheet
</button>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-body">
       You have trying to generate a <h2 style="color:DodgerBlue;"><?php echo $Product_value; ?></h2> based Cost Sheet.
      </div>
      <div class="modal-footer">
       
       <input type="button" class="btn btn-primary" id="save" name="save" 
			 data-dismiss="modal" onclick="openForm22()" value="Ok">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
			</center>
			</div>

			<?php
		 
			
        ?>
			<?php	} ?>
		
        <!-- /.post -->
    </form>
  
	<div class="form-popup2" id="myForm33" style="display:none;">
  <form action="" name='fupForm11' class="form-container">
    <h1>Requirement File</h1>

    <label for="email"><b>Upload file</b></label>
   <input type="file" class="form-control"  id="attachfile" name="attachfile[]" required></td>

    <label for="psw"><b>Requirement</b></label>
	<input type="hidden" name="idd" id="idd" value="<?php echo $id;   ?>" class="btn btn-success submitBtn" >
   <textarea id="sco" name="sco" class="form-control" style="height:168px" required>

                            </textarea>
<input type="submit" class="btn btn-success" name="save" value="Generate Costsheet">
  
    <button type="button" class="btn cancel" onclick="closeForm33()">Close</button>
  </form> 
</div>
	<div class="form-popup1" id="myForm22" style="display:none;">
  <form action="" name='fupForm' class="form-container">
    <h1>Requirement File</h1>

    <label for="email"><b>Upload file</b></label>
   <input type="file" class="form-control"  id="attachfile" name="attachfile[]" required></td>

    <label for="psw"><b>Requirement</b></label>
	<input type="hidden" name="idd" id="idd" value="<?php echo $id;   ?>" class="btn btn-success submitBtn" >
   <textarea id="sco" name="sco" class="form-control" style="height:168px" required>

                            </textarea><br>
<input type="submit" class="btn btn-success" name="save" value="Generate Client">
  
    <button type="button" class="btn cancel" onclick="closeForm22()">Close</button>
  </form> 
</div>
</div>
</section>


<script>
function openForm33() {
  document.getElementById('myForm3').style.visibility="hidden";
  var x = document.getElementById("myForm33");
   if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function closeForm33() {
  document.getElementById('myForm3').style.visibility="visible";
   var x = document.getElementById("myForm33");
   if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>
	<script>
function openForm22() {
  document.getElementById('myForm2').style.visibility="hidden";
 // document.getElementById('contact-form').style.visibility="hidden";
 // var x = document.getElementById("contact-form");
  var x = document.getElementById("myForm22");
   if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function closeForm22() {
  document.getElementById('myForm2').style.visibility="visible";
   var x = document.getElementById("myForm22");
   if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>
	<script>
	function openForm44() {
	
  
   document.getElementById('myForm2').style.visibility="hidden";
  var x = document.getElementById("myForm4");
   if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function openForm() {
	
  
   document.getElementById('myForm1').style.visibility="hidden";
  var x = document.getElementById("myForm");
   if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function closeForm() {
	
   document.getElementById('myForm1').style.visibility="visible";
   var x = document.getElementById("myForm");
   if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script> 
   

			<script>
			 $(document).ready(function () {
        $('#Department').on('change', function () {

            var department_id = this.value;
//alert(department_id);
            $.ajax({
                url: "qvision/CRM/calls/find_emp1.php",
                type: "GET",
                data: {
                    department_id: department_id
                },
                cache: false,
                success: function (result) {
                    $("#emp").html(result);

                }
            });
        });
    });
	 $(document).ready(function () {
        $('#Department1').on('change', function () {

            var department_id = this.value;
//alert(department_id);
            $.ajax({
                url: "qvision/CRM/calls/find_emp.php",
                type: "GET",
                data: {
                    department_id: department_id
                },
				
                cache: false,
                success: function (result) {
					
                    $("#employee1").html(result);

                }
            });
        });
    });
			  function feedback_calls(event)
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data:data,	
  url:"qvision/CRM/Calls/calls_feedback_insert.php",
    success:function(data)
    {   

       if(data==1)
						{
							
						alert("Calls Assigned Successfully");
						  
						  cutomer_enquiry()
						}else{
							event.preventDefault();
							alert("Calls Not Assigned");
							//cutomer_enquiry()
				 
			}
		          
    }       
    });
    } 
	function feedback_callss1()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
  url:"qvision/CRM/Calls/calls_feedback_insert1.php",
    success:function(data)
    {      
        alert("Feedback Inserted Successfully");
		 cutomer_enquiry()
		          
    }       
    });
    } 
	function feedback_callss2()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
  url:"qvision/CRM/Calls/calls_feedback_insert2.php",
    success:function(data)
    {      
        alert("Feedback Inserted Successfully");
		 cutomer_enquiry()
		          
    }       
    });
    } 
	/*  function genn()
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
		 cutomer_enquiry()
		          
    }       
    }); 
	   } */
	
 
	function client_masterss(v){
	//  alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/CRM/calls/client_insert.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
	 function genrate_enquiry(event)
    {
		var data = $('form').serialize();
		var idd    = document.getElementById("idd").value;
   var remark    = document.getElementById("drop_remarks").value;
   var feedback    = document.getElementById("feedback").value;
   var feedback_date    = document.getElementById("feedback_date").value;
   var fed_date    = document.getElementById("fed_date").value;
    if(remark==''){
		alert("Please Fill Remarks"); 
		event.preventDefault();
	 }
    $.ajax({
    type:'POST',
    data:"id="+idd+'&remark='+remark+'&feedback='+feedback+'&feedback_date='+feedback_date+'&fed_date='+fed_date,
	url:"qvision/CRM/Calls/enquiry_insert.php",
	success:function(data)
	{
		
		if(data==1)
						{
							
						alert("Calls Dropped Successfully");
						  
						  cutomer_enquiry()
						}else{
							event.preventDefault();
							//cutomer_enquiry()
				 
			}
		 
	}
	})
    }
	
	
	function back()
	
	{
		 cutomer_enquiry()

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
	<script>
    function check11() // education
    {
        var len = $('#new_tab tr').length;
        len = len + 1;
        $('#new_tab').append('<tr class="row_' + len + '"><td><input type="checkbox" class="chk" name="chk[]" id="chk_' + len + '" value="' + len + '"</td><td><input type="text" class="form-control" id="feedback' + len + '" name="feedback1[]"></td><td><input type="date" class="form-control" id="feedback_date' + len + '" name="feedback_date1[]"></td><td><input type="date" class="form-control" id="fed_date' + len + '" name="fed_date1[]"></td></tr>');
    }



    $('#enquiry_row_remove11').click(function () {
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
<script>
    function check22() // education
    {
        var len = $('#new_tab tr').length;
        len = len + 1;
        $('#new_tab').append('<tr class="row_' + len + '"><td><input type="checkbox" class="chk" name="chk[]" id="chk_' + len + '" value="' + len + '"</td><td><input type="text" class="form-control" id="feedback' + len + '" name="feedback1[]"></td><td><input type="date" class="form-control" id="feedback_date' + len + '" name="feedback_date1[]"></td><td><input type="date" class="form-control" id="fed_date' + len + '" name="fed_date1[]"></td></tr>');
    }



    $('#enquiry_row_remove22').click(function () {
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
	
	$('#myForm').on('submit', function(e){
  $('#myModal').modal('show');
  e.preventDefault();
});
</script>
<script>
 $("form[name='fupForm']").on("submit", function(ev) {
		 ev.preventDefault();
var formData = new FormData(this);

            $.ajax({  
                 url:"qvision/CRM/Calls/enquiry_insertuh.php",
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
				processData: false,
                success:function(data)  
                {  
                    alert('Client Generated Successfully'); 
                  
                    client_master()
                }  
           });   
      });  
</script>
<script>
 $("form[name='fupForm11']").on("submit", function(ev) {
		 ev.preventDefault();
var formData = new FormData(this);
$.ajax({  
                 url:"qvision/CRM/Calls/enquiry_insertuhh.php",
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
				processData: false,
                success:function(data)  
                {  
                    alert('Costsheet Generated Successfully'); 
                  
				  costsheet_add()
                }  
           });   
           
      });  
</script>