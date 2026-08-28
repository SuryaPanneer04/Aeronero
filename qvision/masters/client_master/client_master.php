<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
   <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
	<style>
	.card-primary:not(.card-outline)>.card-header{
		background-color: #f1cc61 !important;
	}
	</style>
<div  class="card card-primary">
              <div class="card-header" style="background-color:#ff8b3d !important;">
                <h3 class="card-title"><font size="5">Client List</font></h3>		 	            			    
		    <!--<a onclick="plant_excel()" style="float: right;" data-toggle="modal" class="btn btn-danger btn"><i class="fa fa-plus"></i>PLANT EXCEL</a> &nbsp;&nbsp;&nbsp;&nbsp;-->
		    <a onclick="add_plant()" style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i> ADD PLANT</a>
		    
		   <!-- <a onclick="client_excel()" style="float: right;" data-toggle="modal" class="btn btn-danger btn"><i class="fa fa-plus"></i>CLIENT EXCEL</a> &nbsp;&nbsp;&nbsp;&nbsp;-->
			<a onclick="add_client()" style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i> ADD CLIENT</a>
              </div>
           
              <div class="card-body">
			  

    <table class="table table-bordered table-striped" id="example1">
    <thead>
    
     <th>S.No</th>
	  <th>Company Name</th>      
      <th>Location</th>
      <th>Created_by</th>
      <th>Created_on</th>
      <th>Modified_by</th>
      <th>Modified_On</th>
      <th>Approved_On</th>
      <th>Approved_by</th>
      <th colspan="2" class="text-center">Action</th>
	  
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT a.id,a.org_name,b.client_id,b.location,b.id as plant_id,b.created_by as created_by,b.created_on as created_on,b.modified_by as Modified_by,b.modified_on as modified_on FROM new_client_master a left join new_plant_master b on (a.id=b.client_id) where a.status='2' and b.location !='' order by b.id DESC");
	  
//echo "SELECT a.id,a.org_name,b.client_id,b.location,b.id as plant_id FROM new_client_master a left join new_plant_master b on (a.id=b.client_id) where a.status='2' and b.location !='' order by b.id DESC";	  
   

$i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
        $canidid=$emp_res['created_by'];
        $getname=$con->query("SELECT * FROM `z_user_master` WHERE candidate_id='$canidid'");
        $cname = $getname->fetch(PDO::FETCH_ASSOC);
		if($cname)
		{
			$showname=$cname['full_name'];
		}
		else
			{
				$showname='NULL';			}
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['org_name']; ?></td>
	  <td><?php echo $emp_res['location']; ?></td>
    <td><?php echo $showname;?></td>
    <td><?php echo $emp_res['created_on'];?></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
      <td class="text-center">
	  <button class="btn btn-info" data-id="<?php echo $emp_res['plant_id']; ?>" onclick="client_view(<?php echo $emp_res['plant_id']; ?>)"><i class="fa fa-eye"></i></button></td>
	  <td class="text-center">
	  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['plant_id']; ?>" onclick="client_edit(<?php echo $emp_res['plant_id']; ?>)"><i class="fa fa-edit"></i></button>
	  </td>
	  </tr>
      <?php
	  $i++;
	  
      }
      ?>
      </tbody>
      </table>
	    
    </div>
    
  </div>
</section>

</div>

<script>

//$('table').DataTable();

$(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
 
 function add_client()
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/client_master/client_add.php",
    success:function(data){
   $("#main_content").html(data);
    }
    })
  }
  
  	function add_plant()
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/client_master/plant_add.php",
    success:function(data){
   $("#main_content").html(data);
    }
    })
  }
  function client_view(v)

    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/client_master/client_details_view.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }

function client_excel(v)
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/client_master/excels.php?id="+v,
    success:function(data){
   $("#main_content").html(data);
    }
    })
    }
	
	function plant_excel(v)
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/client_master/plant_excel.php",
    success:function(data){
   $("#main_content").html(data);
    }
    })
    } 
  function client_edit(v)
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/client_master/plant_details_edit.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
   
</script>
<script>
$("[id$=myButtonControlID]").click(function(e) {
window.open('data:application/vnd.ms-excel,' + encodeURIComponent( $('div[id$=tblARCNewMember]').html()));
e.preventDefault();
});
</script>