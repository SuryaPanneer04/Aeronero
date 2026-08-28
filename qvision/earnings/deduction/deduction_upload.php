<?php
 require '../../../connect.php';
?>
<style>
table th {
	padding:8px;
}
</style>

	<div class="col-12">
	<!-- Default box -->
	<div class="card">
	<div class="card-header">
	<h3 class="card-title">Deduction Upload</h3>
	</div>
	<div class="card-body">
	<a onclick="deduction_add()" style="float: right;" data-toggle="modal" class="btn btn-warning"><i class="fa fa-plus"></i> ADD</a>
	</div>
	
	<form role="form" name="area"  id="deleteForm" method="post">
	<table class="table table-striped table-bordered" style="font-family:'Times New Roman', Times, serif">
		<tr>
		<th><input type="checkbox" checked id="classaall"></th>
		<th>Employee Code</th>
		<th>Emp_Name</th>
		<th>TDS</th>
		<th>SAD</th>
	<!--	<th>Status</th>		-->	
		</tr>
		<?php
		
		$deduction_sql="SELECT e.id as earn_id,e.emp_code,e.emp_name,e.payroll_month,e.payroll_year,e.TDS,e.SAD,e.status,b.prefix_code,b.emp_code as ecode FROM salary_monthly_deduction e left join staff_master b on(e.emp_code=b.id) order by e.id ASC	";
		
		$deduction_list = $con->query($deduction_sql);
		$i=1;
		$total=0;
		while($deduct_data = $deduction_list->fetch(PDO::FETCH_ASSOC))
		{ 
			?>					
			<tr>
			<td>
			<input type="checkbox" name="deduct_id[]" class="classacheck" checked value="<?php echo $deduct_data['earn_id'] ; ?>" >
			</td>
			<td><?php echo $deduct_data['prefix_code'] ; ?><?php echo $deduct_data['ecode'] ; ?></td>
			<td><?php echo $deduct_data['emp_name'] ; ?></td>
			<td><?php echo $deduct_data['TDS'] ; ?></td>
			<td><?php echo $deduct_data['SAD'] ; ?></td>
		<!--	<td><?php echo $deduct_data['status'] ; ?></td> -->
			</tr>
			<?php
		}
		?>
		</table>
		<div>
		<input type="submit" class="btn btn-primary" value="Delete Deduction" name="submit">
		</div>
	</form>
	<!-- /.card-body -->
	</div>
	<!-- /.card -->
	</div>
	<script>
		$(document).ready(function ()
		{
			$("#classaall").click(function () {
			$(".classacheck").prop('checked', $(this).prop('checked'));
			});
		});
		
  function deduction_add()
    {
	$.ajax({
    type:"POST",
    url:"qvision/earnings/deduction/deduction_add.php",
    success:function(data){
      $("#earning_view").html(data);
    }
     })
   }
   $("#deleteForm").submit(function(e){
    e.preventDefault();

    $.ajax({
        url: "qvision/earnings/deduction/deduction_delete.php",
        type: "POST",
        data: $(this).serialize(),
        success: function(){
            $.ajax({
                url: "qvision/earnings/deduction/deduction_upload.php",
                success: function(data){
                    $("#earning_view").html(data);
                }
            });
        }
    });
});
	</script>
