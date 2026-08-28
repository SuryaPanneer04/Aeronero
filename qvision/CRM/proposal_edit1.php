<?php
require '../config.php';
include("../user.php");
 $id=$_REQUEST['id'];

$stmt = $con->prepare("SELECT * FROM `Enquiry` WHERE id='$id'"); 
$stmt->execute(); 
$row = $stmt->fetch();

?>
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<i class="fa fa-table"></i> Lead Edit
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>
<div class="card-body">
<div class="tab-content">

    <div class="active tab-pane" id="for_employment">
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td><center><img src="/qvision/Recruitment/image/userlog/quadsel.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
        <td colspan="5"><center><b>Bluebase Software Services Private Limited</b></center></td>
        </tr>
      
        <tr>
        <td colspan="6"><center><b>Edit Lead</b></center></td>
        </tr>
		
        
		
        
        <tr>
		<td>Product:</td>
		<td colspan="5">
		 <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $row['id']; ?>">
		<select class="form-control" id="product" name="product">
		
		<option value="1">Product</option>
		<option value="2">Solution</option>
		</select></td>
        </tr>
       
        
        
        
		
      
		
		
		
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="update_proposal()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

    <script>
     function update_proposal()
    {
    var id=$('#get_id').val();
	//alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
    url:'/KerliERP/CRM/update_proposal.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
		lead()
      }
      
    }       
    });
    }
    </script>
