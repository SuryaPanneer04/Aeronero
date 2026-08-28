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
		  <th>SI.No</th>
		  <th>Organisation</th>
		  <th>Client</th>
		  <th> Feedback</th>
          <th> Feedback Date</th>
          <th> Followup Date</th>
          <th>Created By</th>
          
		</tr>
      </thead>
	<tbody>
	<?php
		require '../../../connect.php';	
     	  $date = $_GET['candate'];
      // echo "$date";
      $emp_sql=$con->query("SELECT a.id,a.client_org,a.created_by as created_by,a.created_on as created_on,a.client_name,b.feedback,b.feedback_date,b.date,a.status FROM `crm_calls` a left join `crm_calls_feedback` b on  (a.id=b.calls_id) where b.feedback_date LIKE '$date%'  order by a.id desc");

// echo "SELECT a.id,a.client_org,a.created_by as created_by,a.created_on as created_on,a.client_name,b.feedback,b.feedback_date,b.date,a.status FROM `crm_calls` a left join `crm_calls_feedback` b on  (a.id=b.calls_id) where  b.feedback_date = '$date'  order by a.id desc";
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;

// Output the calculated $esicamount
//echo $esicamount;

		
	?>
		
	   <tr>
		<td><?php echo $i;?>.</td>		
		<td><?php echo $emp_res['client_org'];?></td>
		<td><?php echo $emp_res['client_name'];?></td>
		<td><?php echo $emp_res['feedback'];?></td>	
		<td><?php echo $emp_res['feedback_date'];?></td>
		<td><?php echo $emp_res['date'];?></td>
		<td><?php  $created_by = $emp_res['created_by'];
		$cc = $con->query("select * from z_user_master where user_id='$created_by'");
		$cc1 = $cc->fetch();
		echo $cc1['full_name'];?></td>

		<td>
		  
		  
		  
      </tr>
			<?php
			  $i++;
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