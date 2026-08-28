<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<div class="col-md-12" style="text-align: end;margin: 5px;">
  <a href="#" id="1" style="font-size:20px;" class="excel btn btn-success" onclick="ExportToExcel('xlsx')">
  <span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;
  <!-- <a href="#" id="1" style="font-size:20px;" class="excel btn btn-success" onclick="tableToExcel('main', 'List User')">
  <span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp; -->
</div>

	<table class="dataTables-example table table-striped table-bordered table-hover" id="tbl_exporttable_to_xls" style="height: 100%;">
	<thead>
		<tr>
		 	<th>#</th>
      <th> Date</th>
      <th> Organisation</th>
      <th> Client</th>
      <th> Feedback</th>
      <th> Feedback Date</th>
      <th> Followup Date</th>
      <th>Created By</th>
      <th>Status</th>
		</tr>
      </thead>
	<tbody>
	<?php
		require '../../../connect.php';	
     	  $date = $_GET['candate'];
      // echo "$date";
    
	$sql=$con->query("SELECT a.id,a.client_org,a.created_by as created_by,a.created_on as created_on,a.client_name,b.feedback,b.feedback_date,b.date,a.status FROM `crm_calls` a left join `crm_calls_feedback` b on  (a.id=b.calls_id) WHERE b.feedback_date LIKE '$date%' group by a.id  order by a.id desc");


$cnt=1;
 while($products_master = $sql->fetch(PDO::FETCH_ASSOC))
{
	
?>
<tr>
<td><?php echo $cnt;?>.</td>
<td><?php echo $products_master['created_on'];?></td>
<td><?php echo $products_master['client_org'];?></td>
<td><?php echo $products_master['client_name'];?></td>
<td><?php echo $products_master['feedback'];?></td>
<td><?php echo $products_master['feedback_date'];?></td>
<td><?php echo $products_master['date'];?></td>
<td><?php  $created_by = $products_master['created_by'];
$cc = $con->query("select * from z_user_master where user_id='$created_by'");
$cc1 = $cc->fetch();
echo $cc1['full_name'];?></td>

<td>
	  <?php 
	  if($products_master['status'] ==1)
	  {
		  
	  echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  ?>
	  <?php }
	   elseif($products_master['status'] ==2)
	  {
		  
	  echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  ?>
	   <?php }
	   elseif($products_master['status'] ==3 || $products_master['status'] ==4)
	  {
		  
	  echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  ?>
	  <?php }else {
		  
		 echo '<span style="color:red;text-align:center;"><b>INActive</b></span>';
		 ?>
<?php } ?>
	 
	  
     </td>
     
<!-- <td>

							<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $products_master['id']; ?>" onclick="calls_feedback(<?php echo $products_master['id']; ?>)"><i class="fa fa-edit"></i> Feedback</button>
</td>
     -->
<!--<td>

							<button class="btn btn-default btn-sm edit btn-flat" data-id="<?php echo $products_master['id']; ?>" onclick="calls_edit(<?php echo $products_master['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
</td>

<td>

							<button class="btn btn-danger btn-sm edit btn-flat" data-id="<?php echo $products_master['id']; ?>" onclick="calls_delete(<?php echo $products_master['id']; ?>)"><i class="fa fa-edit"></i> Delete</button>
</td>-->

</tr>
			<?php
			  $cnt++;
      } ?>
		</tbody>
		</table>
	
<script type="text/javascript">
 var tableToExcel = (function() {
var uri = 'data:application/vnd.ms-excel;base64,'
, template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
, base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
, format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
return function(table, name) {
if (!table.nodeType) table = document.getElementById(table)
var ctx = {worksheet: name || 'Worsheet', table: table.innerHTML}

window.location.href = uri + base64(format(template, ctx))
}
})() 

 $(function () {
      
        $('#tbl_exporttable_to_xls').DataTable({
        //   "paging": true,
        //   "lengthChange": true,
        //   "searching": true,
        //   "ordering": true,
        //   "info": true,
		//   "responsive": true,
        //   "autoWidth": true,
		"scrollX": true,
        "pageLength": 50,
        });
      });
	  
	  function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('tbl_exporttable_to_xls');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('Quadsel_Candiadte_Reports.' + (type || 'xlsx')));
    }

     function resource_view(v)
	  {
		
 	$.ajax({
	type:"POST",
	url:"qvision/resource/resource_form/resource_view.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	}) 

	  }
	  
	  function schedule(v)
	  {		 
		  $.ajax({
	type:"POST",
	url:"qvision/Resource/Resource_form/interview_schedule.php?id="+v,
	success:function(data)
	{
		$('#main_content').html(data);
	}
	})
		  
	  }
	  
	  function resource_edit(v)
	  {
	$.ajax({
	type:"POST",
	url:"qvision/Resource/Resource_form/resource_edit.php?id="+v,
	success:function(data)
	{
		$('#main_content').html(data);
			
	}
	  })
	}
</script>
</body>
</html>