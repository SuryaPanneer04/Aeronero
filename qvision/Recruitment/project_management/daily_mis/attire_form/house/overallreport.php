 <?php
 require '../../../../../../connect.php';
include("../../../../../../user.php");
$user=$_SESSION['userid'];
  
  $from_date1=$_REQUEST['from_date'];
  $from_date=date("Y-m-d",strtotime($from_date1));
  $to_date1=$_REQUEST['to_date'];
  $to_date=date("Y-m-d",strtotime($to_date1));
  
 

 ?>
<div class="right">
<a href="#" id="1" class="excel"  onclick="tableToExcel('summarySplitTable', 'List User')">
								<span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;
</div>
<br>
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
</script>	
 <div  class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">House Keeping Report List</font></h3>
       <a onclick="add_enquree()" style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i> Back</a>

    </div>

    <div class="card-body">

        
<table border="1" class="table table-bordered table-striped display nowrap" id="summarySplitTable" style="font-family:'Times New Roman', Times, serif;">
            <thead>
            <th>#</th>
          
            <th>Date</th>
            <th>Floor Cleaning</th>
            <th>Bathroom Cleaning</th>
            <th>Morning - 1</th>
<th>Morning - 2</th>
<th>Afternoon - 1</th>
            <th>Afternoon - 2</th>
            <th>Desk Cleaning</th>
            </thead>
            <tbody>

<?php
$reports = $con->query("select * from house_sheet where (date between '$from_date' and '$to_date')order by date desc");
 $cnt = 1;
while($rep=$reports->fetch()){
	?>
	<tr>
                        <td><?php echo $cnt; ?>.</td>
                        <td><?php echo $rep['date']; ?></td>
                        <td><?php if ($rep['yes'] == 1) {

                                echo '<span style="color:green;text-align:center;"><b>Yes</b></span>';
                            }
                            if ($rep['yes'] == 2) {

                                echo '<span style="color:red;text-align:center;"><b>No</b></span>';
                            } ?></td>
                       <td><?php if ($rep['yes1'] == 1) {

                                echo '<span style="color:green;text-align:center;"><b>Yes</b></span>';
                            }
                            if ($rep['yes1'] == 2) {

                                echo '<span style="color:red;text-align:center;"><b>No</b></span>';
                            } ?></td>
                       <td><?php if ($rep['yes2'] == 1) {

                                echo '<span style="color:green;text-align:center;"><b>Yes</b></span>';
                            }
                            if ($rep['yes2'] == 2) {

                                echo '<span style="color:red;text-align:center;"><b>No</b></span>';
                            } ?></td>
                        <td><?php if ($rep['yes3'] == 1) {

                                echo '<span style="color:green;text-align:center;"><b>Yes</b></span>';
                            }
                            if ($rep['yes3'] == 2) {

                                echo '<span style="color:red;text-align:center;"><b>No</b></span>';
                            } ?></td>
                        <td><?php if ($rep['yes4'] == 1) {

                                echo '<span style="color:green;text-align:center;"><b>Yes</b></span>';
                            }
                            if ($rep['yes4'] == 2) {

                                echo '<span style="color:red;text-align:center;"><b>No</b></span>';
                            } ?></td>
							 <td><?php if ($rep['yes5'] == 1) {

                                echo '<span style="color:green;text-align:center;"><b>Yes</b></span>';
                            }
                            if ($rep['yes5'] == 2) {

                                echo '<span style="color:red;text-align:center;"><b>No</b></span>';
                            } ?></td>
							 <td><?php if ($rep['yes6'] == 1) {

                                echo '<span style="color:green;text-align:center;"><b>Yes</b></span>';
                            }
                            if ($rep['yes6'] == 2) {

                                echo '<span style="color:red;text-align:center;"><b>No</b></span>';
                            } ?></td>
                       
	
<?php
 $cnt = $cnt + 1;
}
?>
</tbody>
        </table>

    </div>
    <!-- /.card-body -->
</div>
<script>
  $(document).ready(function() {
    $('#summarySplitTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           
            'excelHtml5'
           
            
        ]
    } );
} );

  </script>

 <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	 <script>
  

 $(function () {
      
        $('#reportsTable').DataTable({
          "paging": false,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });	
	  
	  function add_enquree(){
        house_sheet_report()
	  }
</script>