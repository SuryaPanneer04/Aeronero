<?php
require '../../connect.php';
?>
<style>
.breadcrumb>.active{
	color: black !important;
    font-weight: bold !important;
}
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
</style>

<div class="card card-primary">
    <div class="card-header">
 <h3 class="card-title"><font size="5">DEPARTMENT REPORT</font></h3>
		</div>
		
	<table class="table table-bordered"> 
	<tr> 
     <td> 
		<select class="form-control" id="tech_department" name="tech_department" onchange="report()" >
				<option value="">Choose Department</option>
			<?php $stmt = $con->query("SELECT * FROM z_department_master where status=1");
				while ($row = $stmt->fetch()) {?>
				 <option value="<?php echo $row['id']; ?>"> <?php echo $row['dept_name']; ?> </option>
			<?php } ?>
		</select> 
	 </td>
	 </tr>
	 </table>
	</div>
	<div class="card-body" id="response">
      
	</div>
  </div>
</div>
<script>
function report(id)
{  
debugger;
	//var from_date=$('#from_date').val();// alert(from_date);
  var id=$('#tech_department').val();// alert(to_date);
	$.ajax({
    type:"GET",
	//data:"from_date="+from_date+"&to_Date="+to_date,
    url:"qvision/departmentreports/response.php?id="+id,
    success:function(data){
      $("#response").html(data);
    }
  })
}
</script>
<script src="js/sb-admin-datatables.min.js"></script>