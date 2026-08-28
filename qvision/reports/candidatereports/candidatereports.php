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
		  <th>Id</th>
		  <th>Date</th>
		  <th>Name</th>
		  <th>Designation</th>
		  <th>Remark</th>
	      <th>Next Followup Date </th> 
		  <th>Resource Type</th>
		  <th>Status</th>
		  <th>Enter By</th>
		  <th>Action</th>
		</tr>
      </thead>
	<tbody>
	<?php
		require '../../../connect.php';	
     	  $date = $_REQUEST['candate'];
      // echo "$date";
      $emp_sql=$con->query("SELECT *,s.status as status,s.id as sid FROM resource_form_detail s left join jobdescription_master m on s.position=m.id join source_master sm on s.source=sm.id left join resource_feedback rf on s.id=rf.resource_id JOIN staff_master  on staff_master.id=s.created_by where s.old_status=0  AND s.date = '$date' order by s.id desc");

// echo "SELECT *,s.status as status,s.id as sid FROM resource_form_detail s left join jobdescription_master m on s.position=m.id join source_master sm on s.source=sm.id left join resource_feedback rf on s.id=rf.resource_id where s.old_status=0 AND s.date = '$date'  order by s.id desc";
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;

// Output the calculated $esicamount
//echo $esicamount;

		
			?>
			 <tr>
		  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['date']; ?></td>		 
		  <td><?php echo $emp_res['first_name']." ".$emp_res['last_name']; ?></td>		  
		  <td><?php echo $emp_res['tittle']; ?></td>		  
		  <td><?php echo $emp_res['feedback']; ?></td>		  
      <td><?php echo $emp_res['next_followup_date']; ?></td>	  
		  <td><?php echo $emp_res['employement_status']; ?></td>
		  <td><?php echo $emp_res['emp_name']; ?></td>		  
		  <td>
		  <?php 
		  if($emp_res['status'] == 1)
		  {
			  ?>
		<span style="color:green;text-align:center;"><b>Active</b></span>
		<?php
		  } else if($emp_res['status'] == 2)
		  {
		  ?>
		  <span style="color:orange;text-align:center;"><b>Mail Sent</b></span>
		  <?php
		  } else if($emp_res['status'] == 0 or $emp_res['status'] == 3)
		  {
		  ?>
		  <span style="color:red;text-align:center;"><b>InActive</b></span>
		  <?php
		  }  
		  ?>		   
		  </td>
		  
		   <td>
		  
		  <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['sid']; ?>" onclick="resource_view(<?php echo $emp_res['sid']; ?>)"> View</button>
		  
		 <?php if($emp_res['status'] == 1){
			  ?> 
		 <!--  <button class="btn btn-danger btn-sm" data-id="<?php echo $emp_res['sid']; ?>" onclick="resource_edit(<?php echo $emp_res['sid']; ?>)"> Edit</button>
		   
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['sid']; ?>" onclick="schedule(<?php echo $emp_res['sid']; ?>)"> <i class="fa fa-mail">Schedule</i> -->
		  <?php }  ?>
		  </button>
		 </td>
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
</html><script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<div class="col-md-12" style="text-align: end;margin: 5px;">
  <a href="#" id="1" style="font-size:20px;" class="excel btn btn-success" onclick="ExportToExcel('xlsx')">
  <span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;
  <!-- <a href="#" id="1" style="font-size:20px;" class="excel btn btn-success" onclick="tableToExcel('main', 'List User')">
  <span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp; -->
</div>

	<table class="dataTables-example table table-striped table-bordered table-hover" id="tbl_exporttable_to_xls" style="height: 100%;">
	<thead>
		<tr>
		  <th>Id</th>
		  <th>Date</th>
		  <th>Name</th>
		  <th>Designation</th>
		  <th>Remark</th>
	      <th>Next Followup Date </th> 
		  <th>Resource Type</th>
		  <th>Status</th>
		  <th>Enter By</th>
		  <th>Action</th>
		</tr>
      </thead>
	<tbody>
	<?php
		require '../../../connect.php';	
     	  $date = $_REQUEST['candate'];
      // echo "$date";
      $emp_sql=$con->query("SELECT *,s.status as status,s.id as sid FROM resource_form_detail s left join jobdescription_master m on s.position=m.id join source_master sm on s.source=sm.id left join resource_feedback rf on s.id=rf.resource_id JOIN staff_master  on staff_master.id=s.created_by where s.old_status=0  AND s.date = '$date' order by s.id desc");

// echo "SELECT *,s.status as status,s.id as sid FROM resource_form_detail s left join jobdescription_master m on s.position=m.id join source_master sm on s.source=sm.id left join resource_feedback rf on s.id=rf.resource_id where s.old_status=0 AND s.date = '$date'  order by s.id desc";
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;

// Output the calculated $esicamount
//echo $esicamount;

		
			?>
			 <tr>
		  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['date']; ?></td>		 
		  <td><?php echo $emp_res['first_name']." ".$emp_res['last_name']; ?></td>		  
		  <td><?php echo $emp_res['tittle']; ?></td>		  
		  <td><?php echo $emp_res['feedback']; ?></td>		  
      <td><?php echo $emp_res['next_followup_date']; ?></td>	  
		  <td><?php echo $emp_res['employement_status']; ?></td>
		  <td><?php echo $emp_res['emp_name']; ?></td>		  
		  <td>
		  <?php 
		  if($emp_res['status'] == 1)
		  {
			  ?>
		<span style="color:green;text-align:center;"><b>Active</b></span>
		<?php
		  } else if($emp_res['status'] == 2)
		  {
		  ?>
		  <span style="color:orange;text-align:center;"><b>Mail Sent</b></span>
		  <?php
		  } else if($emp_res['status'] == 0 or $emp_res['status'] == 3)
		  {
		  ?>
		  <span style="color:red;text-align:center;"><b>InActive</b></span>
		  <?php
		  }  
		  ?>		   
		  </td>
		  
		   <td>
		  
		  <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['sid']; ?>" onclick="resource_view(<?php echo $emp_res['sid']; ?>)"> View</button>
		  
		 <?php if($emp_res['status'] == 1){
			  ?> 
		 <!--  <button class="btn btn-danger btn-sm" data-id="<?php echo $emp_res['sid']; ?>" onclick="resource_edit(<?php echo $emp_res['sid']; ?>)"> Edit</button>
		   
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['sid']; ?>" onclick="schedule(<?php echo $emp_res['sid']; ?>)"> <i class="fa fa-mail">Schedule</i> -->
		  <?php }  ?>
		  </button>
		 </td>
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
</html><script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<div class="col-md-12" style="text-align: end;margin: 5px;">
  <a href="#" id="1" style="font-size:20px;" class="excel btn btn-success" onclick="ExportToExcel('xlsx')">
  <span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;
  <!-- <a href="#" id="1" style="font-size:20px;" class="excel btn btn-success" onclick="tableToExcel('main', 'List User')">
  <span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp; -->
</div>

	<table class="dataTables-example table table-striped table-bordered table-hover" id="tbl_exporttable_to_xls" style="height: 100%;">
	<thead>
		<tr>
		  <th>Id</th>
		  <th>Date</th>
		  <th>Name</th>
		  <th>Designation</th>
		  <th>Remark</th>
	      <th>Next Followup Date </th> 
		  <th>Resource Type</th>
		  <th>Status</th>
		  <th>Enter By</th>
		  <th>Action</th>
		</tr>
      </thead>
	<tbody>
	<?php
		require '../../../connect.php';	
     	  $date = $_REQUEST['candate'];
      // echo "$date";
      $emp_sql=$con->query("SELECT *,s.status as status,s.id as sid FROM resource_form_detail s left join jobdescription_master m on s.position=m.id join source_master sm on s.source=sm.id left join resource_feedback rf on s.id=rf.resource_id JOIN staff_master  on staff_master.id=s.created_by where s.old_status=0  AND s.date = '$date' order by s.id desc");

// echo "SELECT *,s.status as status,s.id as sid FROM resource_form_detail s left join jobdescription_master m on s.position=m.id join source_master sm on s.source=sm.id left join resource_feedback rf on s.id=rf.resource_id where s.old_status=0 AND s.date = '$date'  order by s.id desc";
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;

// Output the calculated $esicamount
//echo $esicamount;

		
			?>
			 <tr>
		  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['date']; ?></td>		 
		  <td><?php echo $emp_res['first_name']." ".$emp_res['last_name']; ?></td>		  
		  <td><?php echo $emp_res['tittle']; ?></td>		  
		  <td><?php echo $emp_res['feedback']; ?></td>		  
      <td><?php echo $emp_res['next_followup_date']; ?></td>	  
		  <td><?php echo $emp_res['employement_status']; ?></td>
		  <td><?php echo $emp_res['emp_name']; ?></td>		  
		  <td>
		  <?php 
		  if($emp_res['status'] == 1)
		  {
			  ?>
		<span style="color:green;text-align:center;"><b>Active</b></span>
		<?php
		  } else if($emp_res['status'] == 2)
		  {
		  ?>
		  <span style="color:orange;text-align:center;"><b>Mail Sent</b></span>
		  <?php
		  } else if($emp_res['status'] == 0 or $emp_res['status'] == 3)
		  {
		  ?>
		  <span style="color:red;text-align:center;"><b>InActive</b></span>
		  <?php
		  }  
		  ?>		   
		  </td>
		  
		   <td>
		  
		  <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['sid']; ?>" onclick="resource_view(<?php echo $emp_res['sid']; ?>)"> View</button>
		  
		 <?php if($emp_res['status'] == 1){
			  ?> 
		 <!--  <button class="btn btn-danger btn-sm" data-id="<?php echo $emp_res['sid']; ?>" onclick="resource_edit(<?php echo $emp_res['sid']; ?>)"> Edit</button>
		   
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['sid']; ?>" onclick="schedule(<?php echo $emp_res['sid']; ?>)"> <i class="fa fa-mail">Schedule</i> -->
		  <?php }  ?>
		  </button>
		 </td>
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
</html><script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<div class="col-md-12" style="text-align: end;margin: 5px;">
  <a href="#" id="1" style="font-size:20px;" class="excel btn btn-success" onclick="ExportToExcel('xlsx')">
  <span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;
  <!-- <a href="#" id="1" style="font-size:20px;" class="excel btn btn-success" onclick="tableToExcel('main', 'List User')">
  <span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp; -->
</div>

	<table class="dataTables-example table table-striped table-bordered table-hover" id="tbl_exporttable_to_xls" style="height: 100%;">
	<thead>
		<tr>
		  <th>Id</th>
		  <th>Date</th>
		  <th>Name</th>
		  <th>Designation</th>
		  <th>Remark</th>
	      <th>Next Followup Date </th> 
		  <th>Resource Type</th>
		  <th>Status</th>
		  <th>Enter By</th>
		  <th>Action</th>
		</tr>
      </thead>
	<tbody>
	<?php
		require '../../../connect.php';	
     	  $date = $_REQUEST['candate'];
      // echo "$date";
      $emp_sql=$con->query("SELECT *,s.status as status,s.id as sid FROM resource_form_detail s left join jobdescription_master m on s.position=m.id join source_master sm on s.source=sm.id left join resource_feedback rf on s.id=rf.resource_id JOIN staff_master  on staff_master.id=s.created_by where s.old_status=0  AND s.date = '$date' order by s.id desc");

// echo "SELECT *,s.status as status,s.id as sid FROM resource_form_detail s left join jobdescription_master m on s.position=m.id join source_master sm on s.source=sm.id left join resource_feedback rf on s.id=rf.resource_id where s.old_status=0 AND s.date = '$date'  order by s.id desc";
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;

// Output the calculated $esicamount
//echo $esicamount;

		
			?>
			 <tr>
		  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['date']; ?></td>		 
		  <td><?php echo $emp_res['first_name']." ".$emp_res['last_name']; ?></td>		  
		  <td><?php echo $emp_res['tittle']; ?></td>		  
		  <td><?php echo $emp_res['feedback']; ?></td>		  
      <td><?php echo $emp_res['next_followup_date']; ?></td>	  
		  <td><?php echo $emp_res['employement_status']; ?></td>
		  <td><?php echo $emp_res['emp_name']; ?></td>		  
		  <td>
		  <?php 
		  if($emp_res['status'] == 1)
		  {
			  ?>
		<span style="color:green;text-align:center;"><b>Active</b></span>
		<?php
		  } else if($emp_res['status'] == 2)
		  {
		  ?>
		  <span style="color:orange;text-align:center;"><b>Mail Sent</b></span>
		  <?php
		  } else if($emp_res['status'] == 0 or $emp_res['status'] == 3)
		  {
		  ?>
		  <span style="color:red;text-align:center;"><b>InActive</b></span>
		  <?php
		  }  
		  ?>		   
		  </td>
		  
		   <td>
		  
		  <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['sid']; ?>" onclick="resource_view(<?php echo $emp_res['sid']; ?>)"> View</button>
		  
		 <?php if($emp_res['status'] == 1){
			  ?> 
		 <!--  <button class="btn btn-danger btn-sm" data-id="<?php echo $emp_res['sid']; ?>" onclick="resource_edit(<?php echo $emp_res['sid']; ?>)"> Edit</button>
		   
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['sid']; ?>" onclick="schedule(<?php echo $emp_res['sid']; ?>)"> <i class="fa fa-mail">Schedule</i> -->
		  <?php }  ?>
		  </button>
		 </td>
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