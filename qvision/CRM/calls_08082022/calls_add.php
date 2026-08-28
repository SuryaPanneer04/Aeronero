<?php
require '../../config.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];

?>
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<i class="fa fa-table"></i> Calls  Add
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
</div>
<div class="card-body">
<div class="tab-content">

    <div class="active tab-pane" id="for_employment">
    <form method="POST" name="fupForm" id="fupForm" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
      
      
        <tr>
        <td colspan="6"><center><b>Add calls</b></center></td>
        </tr>
		<tr>
                <td>Call Type</td>
                <td colspan="5">
                    <select class="form-control" id="Call_type" name="Call_type" onchange="callstatus(this.value)">
                        <option value="">Choose Type</option>
						<option value="1">Corporate</option>
                        <option value="2">Individual</option>
						<!--<option value="3">Individual Customer</option>-->
                        

                    </select></td>
            </tr>
		<tr >
                <td>Call Source</td>
                <td colspan="5">
                    <select class="form-control" id="Call_type" name="Call_type" onchange="get_consultant(this.value)">
                        <option value="">Choose Source</option>
                        <?php
                        $stmt = $con->query("SELECT * FROM calls_master");
                        while ($row = $stmt->fetch()) {
                            ?>
                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
<?php } ?>
                    </select></td>
            </tr>
		 <tr id="client1">
                <td>Client Type</td>
                <td colspan="5">
                    <select class="form-control" id="Client_type" name="Client_type" onchange="clientstatus(this.value)">
                        <option value="">Choose Client Type</option>
						<option value="2">New</option>
                        <option value="1">Existing</option>
						<!--<option value="3">Individual Customer</option>-->
                        

                    </select></td>
            </tr>
			<tr id="client2">
                <td>Individual Customer Type</td>
                <td colspan="5">
                    <select class="form-control" id="Client_type" name="Client_type" onchange="cusstatus(this.value)">
                        <option value="">Choose Customer Type</option>
						<option value="2">New</option>
                        <option value="1">Existing</option>
						<!--<option value="3">Individual Customer</option>-->
                        

                    </select></td>
            </tr>
        <tr id="dep1">
        <td>Company Name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Company Name" id="client_org1" name="client_org1"></td>
        </tr>
		<tr id="old" style="display:none;">
					<td>Company Name</td>
					<td colspan="5">
					<select class="form-control" name="client_org" id="client_org"  onchange="compvalue(this.value)">
					<option value="">Choose Company Name</option>
							<?php 
							$query = $con->query("SELECT distinct org_name,id FROM new_client_master");
							while ($row_fetch = $query->fetch()) {?>	
							
							<option value="<?php echo $row_fetch['org_name']; ?>"> <?php echo $row_fetch['org_name']; ?> </option>
							<?php } ?>
                     </select>
					</td>
				</tr>
		<tr id="new1">
        <td>Client Name</td>
        <td colspan="5"><input type="text" class="form-control" id="client_name" placeholder="Enter Name" name="client_name"></td>
        </tr>
		<tr id="old1" style="display:none;">
					<td>Client Name</td>
					<td colspan="5">
					<select class="form-control" name="client_org" id="client_org"  onchange="compvalue(this.value)">
					<option value="">Choose Client Name</option>
							<?php 
							$query = $con->query("SELECT distinct client_org,id FROM individual_form");
							while ($row_fetch = $query->fetch()) {?>	
							
							<option value="<?php echo $row_fetch['org_name']; ?>"> <?php echo $row_fetch['org_name']; ?> </option>
							<?php } ?>
                     </select>
					</td>
				</tr>
      <tr>
        <td>Contact Number*</td>
        <td colspan="5"><input type="text" class="form-control"id="contact" placeholder="Enter Contact No" name="contact"></td>
        </tr>
		<tr>
        <td>Whatsapp Number</td>
        <td colspan="5"><input type="text" class="form-control"id="whatsapp" placeholder="Enter Whatsapp No" name="whatsapp"></td>
        </tr>
		  <tr>
        <td>Email Id*</td>
        <td colspan="5"><input type="text" class="form-control" id="email" placeholder="Enter Email" name="email"></td>
        </tr>
		 <tr>
                <td>Alternative Mail_id</td>
                <td colspan="5">
                    <input type="mail"  id="mail" name="mail" class="form-control mail"  placeholder="Enter Mail" required="true">
                </td>
            </tr>
			<!--<tr id="pan">
        <td>Pan No*</td>
        <td colspan="5"><input type="text" class="form-control" id="pan" placeholder="Enter Pan" name="pan"></td>
        </tr>-->
			<tr id="dep1">
        <td>Address</td>
        <td colspan="5"><input type="text" class="form-control" id="address" placeholder="Enter Address" name="address"></td>
        </tr>
		
			 <tr id="web">
        <td>Website</td>
        <td colspan="5"><input type="text" class="form-control" id="website" placeholder="Enter Website" name="website"></td>
        </tr>
   
	  <tr>
					<td>Product/Service</td>
					<td colspan="5">
						<select name="Product" class="form-control" id="Product">
							<option>Select</option>
							<option value="1">Product</option>
							<option value="2">Services</option>
							<option value="3">Solution</option>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="5">
					 <select class="form-control" name="services" id="services" required></select>				
					</td>
				</tr>
				 <tr>
	<!--	<td>Attach File</td>
		<td colspan="5">
		<input type="file" class="form-control"  id="attachfile" name="attachfile[]"></td>	-->
     </tr>
    
		 </table>
        <!-- /.post -->
		
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
		 <td colspan="6"><input type="submit" class="btn btn-success" name="save" value="save"></td>
	
    </form>
    </div>
<script>
	$(document).ready(function(){  
		$("form[name='fupForm']").on("submit", function(ev) {
		 ev.preventDefault();
var formData = new FormData(this);
  
           $.ajax({  
                 url:"CRM/Calls/calls_submit.php",
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
				processData: false,
                success:function(data)  
                {  
                    alert('Entry Successfully'); 
                  
				  calls()
                }  
           });  
      });  
	   }); 
		
	function back()
	
	{
		 calls()

	}
	
	function clientstatus(value)
    {
        if (value == '1')
        {
              var ddlPassport = document.getElementById("fupForm");
			  document.getElementById("old").style.display = "revert";

        } else
        {
           document.getElementById("old").style.display = "none";

        }
		if (value == '2')
        {
              var ddlPassport = document.getElementById("fupForm");
			  document.getElementById("dep1").style.display = "revert";

        } else
        {
           document.getElementById("dep1").style.display = "none";

        }
		/* if (value == '3')
        {
              document.getElementById("dep1").style.display = "none";
			    document.getElementById("old").style.display = "none";
			    document.getElementById("web").style.display = "none";

        } else
        {
          

        } */
    }
	function cusstatus(value)
    {
        if (value == '1')
        {
              var ddlPassport = document.getElementById("fupForm");
			  document.getElementById("old1").style.display = "revert";

        } else
        {
           document.getElementById("old1").style.display = "none";

        }
		if (value == '2')
        {
              var ddlPassport = document.getElementById("fupForm");
			  document.getElementById("new1").style.display = "revert";

        } else
        {
           document.getElementById("new1").style.display = "none";

        }
		/* if (value == '3')
        {
              document.getElementById("dep1").style.display = "none";
			    document.getElementById("old").style.display = "none";
			    document.getElementById("web").style.display = "none";

        } else
        {
          

        } */
    }
	
	function callstatus(value)
    {
        if (value == '1')
        {
            
 document.getElementById("client2").style.display = "none";
   document.getElementById("dep1").style.display = "none";
             document.getElementById("old").style.display = "none";
			   var ddlPassport = document.getElementById("fupForm");
			  document.getElementById("old1").style.display = "revert";

        } else
        {
           document.getElementById("old").style.display = "none";
           document.getElementById("old1").style.display = "none";

        }
		if (value == '2')
        {
			var ddlPassport = document.getElementById("fupForm");
			  document.getElementById("client2").style.display = "revert";
             document.getElementById("client1").style.display = "none";
             document.getElementById("dep1").style.display = "none";
             document.getElementById("old").style.display = "none";
			    var ddlPassport = document.getElementById("fupForm");
			  document.getElementById("new1").style.display = "revert";

        } else
        {
           document.getElementById("dep1").style.display = "none";
           document.getElementById("new1").style.display = "none";

        }
	    }
	</script><script>
$(document).ready(function() {
$('#Product').on('change', function() {

var Product = this.value;

$.ajax({
url: "/KerliERP/CRM/find_services.php",
type: "POST",
data: {
Product: Product
},
cache: false,
success: function(result){
$("#services").html(result);

}
});
});
});   
</script>