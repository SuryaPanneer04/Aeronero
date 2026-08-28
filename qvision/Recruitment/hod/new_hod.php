<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<!--div class="container-fluid"-->
<style>
.btn-danger{
	background-color: #ed5d00;
    border-color: #ed5d00;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black;
}
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
</style>
  <div class="card card-primary">
              <div class="card-header">
                 
 <h3 class="card-title" style="color:black !important;"><font size="5">HOD LIST</font></h3>
		<a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-danger">BACK</a>
              </div>
<br>
<form method="POST" action="qvision/Recruitment/hod/hod_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered" >
<tr>

                        <!-- /.col-lg-12 -->
                    </div>
</tr>

<tr > 
     <td>Department Name</td>
	 <td colspan="2">
		<select class="form-control" name="dept_name" id="dept_name">
		<!--option value="all">-- Select Department --</option-->
		<option value="all">All</option>
		<?php
		$dep_sql=$con->query("SELECT * FROM  z_department_master where id!='1'");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
			<?php
		}
		?>
		</select>
	 </td>
	 <td>Employee Name</td>

<td colspan="2">
<select class="form-control" name="emp_name" id="emp_name">
				
		</select> 
		</td>
	 </tr>

<tr >
<td>Asset</td>
<td colspan="2"><select class="form-control" id="asset_1" name="asset[]">
<option value="">Select Assets</option>
		<?php
		$dep_sql=$con->query("SELECT * FROM staff_asset_master");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['asset']; ?></option>
			<?php
		}
		?>
		</select> </td>
		<td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
		   <input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove">
		</td>
	
      </tr>
	  
	  <tr id="new_tab">
	<td>
	</td>
	  </tr>
<tr>
<td>Mail Id</td>
<td colspan="2">
<input type="text" class="form-control" id="mail_id" name="mail_id" ></td>
</tr>
<tr>
<td>Others</td>
<td colspan="2">
<input type="text" class="form-control" id="others" name="others" ></td>

</tr>
</table>
<input type="submit" name="submit" class="btn btn-danger" style="float:right;position:relative;left:-5px;">
<br>
<br>
</form>
<script>
		function back()
    {
    hod();
  }
  </script>
  <script>
  $(document).ready(function() {
$('#dept_name').on('change', function() {

var department_id = this.value;
//alert(department_id);
$.ajax({
url: "qvision/CRM/find_emp.php",
type: "POST",
data: {
department_id: department_id
},
cache: false,
success: function(result){
$("#emp_name").html(result);

}
});
});
});

    function check() 
    {
    var len=$('#new_tab tr').length;	
    len=len+1; 
    $('#new_tab').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td><select class="form-control" id="asset_'+len+'"  name="asset[]"><option value="">Select</option><option value="3">Files</option><option value="2">Visiting Cards</option><option value="1">Office Stationary</option><option value="4">Keys</option><option value="5">System </option><option value="6">Laptop </option><option value="7">ID Card </option><option value="8">CUG</option><option value="9">Access Card </option><option value="10">ERP Access</option></select></td></tr>'); 
    }
	
	 $('#enquiry_row_remove').click(function(){
    $('input:checkbox:checked.chk').map(function(){
    var id=$(this).val();
    var le=$('#new_tab tr').length;

    if(le==1)
    {
    alert("You Can't Delete All the Rows");
    }
    else
    {
    $('.row_'+id).remove();
    }

    });
    });
	</script>
	