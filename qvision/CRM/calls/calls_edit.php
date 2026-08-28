<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
 $id=$_REQUEST['id'];

$sel=$con->query("select * from crm_calls where id='$id'");
$fet=$sel->fetch();
$call_type = $fet['call_type'];
?>
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<i class="fa fa-table"></i> Calls Edit
<a onclick="editBack()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
</div>
<div class="card-body">
<div class="tab-content">

    <div class="active tab-pane" id="for_employment">
    <form role="form" method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
      <?php
                        $stmt = $con->query("SELECT b.id as idc,b.name as name FROM crm_calls a join calls_master b where b.id='$call_type'");
                       $row1 = $stmt->fetch(); 
					   $nid = $row1['idc'];
					   $name = $row1['name'];
					   
                            ?>
      
        <tr>
        <td colspan="6"><center><b>Edit calls</b></center></td>
        </tr>
		
         <tr>
		
        <td>Call Source</td><td>
        <select class="form-control" id="Call_type" name="Call_type" >
	  <option value="<?php echo $nid; ?>"> <?php echo $name; ?> </option>
                       
                        <?php
                        $stmt = $con->query("SELECT * FROM calls_master");
                        while ($row = $stmt->fetch()) {
                            ?>
                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
<?php } ?>
                    </select></td>
        </tr>
	
     
        <tr>
		<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>"readonly>
        <td>Client Organisation Name</td>
        <td colspan="5"><input type="text" class="form-control" id="client_org1" name="client_org1" value="<?php echo $fet['client_org'];?>" ></td>
        </tr>
		<tr>
        <td>Client Name</td>
        <td colspan="5"><input type="text" class="form-control" id="client_name1" name="client_name1" value="<?php echo $fet['client_name'];?>"></td>
        </tr>
      <tr>
        <td>Contact Number</td>
        <td colspan="5"><input type="text" class="form-control"id="contact1" name="contact1" value="<?php echo $fet['contact'];?>"></td>
        </tr>
		<tr>
        <td>Whatsapp Number</td>
        <td colspan="5"><input type="text" class="form-control"id="whatsapp1" name="whatsapp1" value="<?php echo $fet['whatsapp'];?>"></td>
        </tr>
      <tr>
        <td>Email Id</td>
        <td colspan="5"><input type="text" class="form-control" id="email1" name="email1" value="<?php echo $fet['email'];?>"></td>
        </tr>
		 <tr>
                <td>Alternative Mail_id</td>
                <td colspan="5">
                    <input type="mail"  id="mail1" name="mail1" class="form-control mail" value="<?php echo $fet['alternative_mail'];?>">
                </td>
            </tr>
      <tr>
        <td>Website</td>
        <td colspan="5"><input type="text" class="form-control" id="website1" name="website1" value="<?php echo $fet['website'];?>"></td>
        </tr>
      <tr>
        <td>Address</td>
        <td colspan="5"><input type="text" class="form-control" id="address1" name="address1" value="<?php echo $fet['address'];?>"></td>
        </tr>
     <?php 
	 
					     $stmt1 = $con->query("SELECT b.id as id2,b.name as name2 FROM crm_calls a join services b where b.id='$call_type'");
                       $row2 = $stmt1->fetch(); 
					   $id2 = $row2['id2'];
					   $name2 = $row2['name2'];
					   ?>
      <tr>
        <td>Services</td>
       <td colspan="5">
                    <select class="form-control" id="services" name="services">
					 <option value="<?php echo $id2; ?>"> <?php echo $name2; ?> </option>
                        <option value="">Choose Services</option>
                        <?php
                        $stmt = $con->query("SELECT * FROM services");
                        while ($row = $stmt->fetch()) {
                            ?>
                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
<?php } ?>
                    </select></td>
        </tr>
      
      
      </table>
	   <?php
			$sel1=$con->query("select status from crm_calls where id='$id'");
$fet1=$sel1->fetch();
			if ($fet1['status'] == 2 || $fet1['status'] == 3) {
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
<td><input type="text" class="form-control" id="feedback1" name="feedback1" value="<?php echo  $rows['feedback']; ?>" ></td>
<td>Feedback Date:</td><td colspan="1"><input type="date" class="form-control" id="feedback_date1" name="feedback_date1" value="<?php echo  $rows['feedback_date']; ?>" ></td>


<td>Followup Date:</td><td colspan="1"><input type="date" class="form-control" id="fed_date1" name="fed_date1" value="<?php echo  $rows['date']; ?>" ></td>

</tr>
<?php 
$cnt=$cnt+1;
 }?>
 </tbody>
 
      </table>
	   <?php } ?>
	   <br>
            <br>
           
		  
        </div>
        <?php if ($fet1['status'] == 1 || $fet1['status'] == 2 || $fet1['status'] == 3) {
            ?>
               
<td>

							<button class="btn btn-primary btn-sm edit btn-flat" data-id="<?php echo $id; ?>" onclick="update_calls(<?php echo $id; ?>)"> Update</button>
</td>
			   <?php
        }
        ?>
       
        <!-- /.post -->
    </form>
    </div>

			<script>
			
	
	function editBack()
	
	{
		 cutomer_enquiry()

	}
	</script>
	<script>
   function update_calls(v)
{
	//alert(v);
	 var id=v;
	var data=$('form').serialize();
	$.ajax({
		type:"GET",
		data: data + "&" + "id="+id,
		url:"qvision/CRM/calls/calls_update.php",
		success:function(data)
		{
			alert("Updated successfully");
			
			cutomer_enquiry();
		
		}
	}) 
}
</script>