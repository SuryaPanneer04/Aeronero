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
                <td>Call Source</td>
                <td colspan="5">
                    <select class="form-control" id="Call_type" name="Call_type" onchange="get_consultant(this.value)">
                        <option value="">Choose Type</option>
                        <?php
                        $stmt = $con->query("SELECT * FROM calls_master");
                        while ($row = $stmt->fetch()) {
                            ?>
                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
<?php } ?>
                    </select></td>
            </tr>
		 <tr>
                <td>Client Type</td>
                <td colspan="5">
                    <select class="form-control" id="Client_type" name="Client_type" onchange="clientstatus(this.value)">
                        <option value="">Choose Type</option>
                        <option value="1">Existing</option>
                        <option value="2">New</option>

                    </select></td>
            </tr>
        <tr id="dep1">
        <td>Company Name</td>
        <td colspan="5"><input type="text" class="form-control" id="client_org1" name="client_org1"></td>
        </tr>
		<tr id="old" style="display:none;">
					<td>Company Name</td>
					<td colspan="5">
					<select class="form-control" name="client_org" id="client_org"  onchange="compvalue(this.value)">
					<option value="">Choose Type</option>
							<?php 
							$query = $con->query("SELECT distinct org_name FROM new_client_master");
							while ($row_fetch = $query->fetch()) {?>			
							<option value="<?php echo $row_fetch['org_name']; ?>"> <?php echo $row_fetch['org_name']; ?> </option>
							<?php } ?>
                     </select>
					</td>
				</tr>
		<tr>
        <td>Client Name</td>
        <td colspan="5"><input type="text" class="form-control" id="client_name" name="client_name"></td>
        </tr>
      <tr>
        <td>Contact Number</td>
        <td colspan="5"><input type="text" class="form-control"id="contact" name="contact"></td>
        </tr>
		<tr>
        <td>Whatsapp Number</td>
        <td colspan="5"><input type="text" class="form-control"id="whatsapp" name="whatsapp"></td>
        </tr>
		  <tr>
        <td>Email Id</td>
        <td colspan="5"><input type="text" class="form-control" id="email" name="email"></td>
        </tr>
		 <tr>
                <td>Alternative Mail_id</td>
                <td colspan="5">
                    <input type="mail"  id="mail" name="mail" class="form-control mail"  placeholder="Enter mail" required="true">
                </td>
            </tr>
			<tr id="dep1">
        <td>Address</td>
        <td colspan="5"><input type="text" class="form-control" id="address" name="address"></td>
        </tr>
		
			 <tr>
        <td>Website</td>
        <td colspan="5"><input type="text" class="form-control" id="website" name="website"></td>
        </tr>
   
	  <tr>
           
                <td>Services</td>
                <td colspan="5">
                    <select class="form-control" id="services" name="services" onchange="get_service(this.value)">
                        <option value="">Choose Services</option>
                        <?php
                        $stmt = $con->query("SELECT * FROM services");
                        while ($row = $stmt->fetch()) {
                            ?>
                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
<?php } ?>
                    </select></td>
            </tr>
     <tr>
	  <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_calls()" value="save"></td>
        </tr>
		 </table>
        <!-- /.post -->
    </form>
    </div>
<script>
			 function insert_calls()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
  url:"CRM/Calls/calls_submit.php",
    success:function(data)
    {      
        alert("Entry Successfully");
		 calls()
		          
    }       
    });
    }
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
    }
	</script>