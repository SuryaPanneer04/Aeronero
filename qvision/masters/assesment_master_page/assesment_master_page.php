<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<head>
<style>
#page-wrapper{
	margin-left: 117px !important;
}
.btn-warning{
	padding-top: 0px !important;
}

.btn-warning{
	background-color: #337ab7 !important;
    border-color: #337ab7 !important;
}
.btn-success{
	background-color: #5cb85c !important;
    border-color: #5cb85c !important;
}
.page-header{
	border-bottom: 3px solid #eee !important;
}
.content-wrapper{
  width: 100% !important;
} 
</style>

<link rel="stylesheet" href="Qvision\commonstyle.css">
 </head>
<div  class="card card-primary">

 <div class="card-header">
  <h3 class="card-title"><font size="5"> ASSESMENT MASTER  PAGE</font></h3>
  <div class="card-body">
	 <a onclick="add_master()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-plus"></i> ADD</a>
   <input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove">	</th>
</div>
</div>
</div>
<table class="table table-striped table-bordered table-hover display nowrap"  id="dataTable" style="width:109%">


<!-- <div class="card-body">
    <table id="example1" class="dataTables-example table table-bordered">
    <thead>
      <th>S.No</th>
      <th>ASSESMENT</th>
      <th>STATUS</th>
      <th>LOGICAL</th>
      <th>TECHNICAL</th>
      <th>REASONING</th>
      <th>VERBAL</th>
      <th>PROGRAMMING</th>
      <th>ACTION</th>
      </thead>
<tr>

</tr> -->
</table>


            <table class="table table-bordered">
            
	<td><b><span style="font-size:20px;">SNO</span></b></td>

  <td><b><span style="font-size:20px;">QUESTION</span></b></td>

  <td><b><span style="font-size:20px;">STATUS</span></b></td>

  <td><b><span style="font-size:20px;">LOGICAL</span></b></td>

  <td><b><span style="font-size:20px;">APTITUDE</span></b></td>

  <td><b><span style="font-size:20px;">TECHNICAL</span></b></td>

  <td><b><span style="font-size:20px;">REASONING</span></b></td>

  <td><b><span style="font-size:20px;">VERBAL</span></b></td>
 

  <td><b><span style="font-size:20px;">PROGRAMMING</span></b></td>


  <td><b><span style="font-size:20px;">ACTION</span></b></td>

  <td><b><span style="font-size:20px;">delete</span></b></td>

<tr>
  <form method="POST" role="form">
<tbody>
      <?php
      $emp_sql=$con->query("SELECT * FROM master_page WHERE 1");
  
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $emp_res['id']; ?></td>
      <td ><?php echo $emp_res['name']; ?></td>
     
      <input type="hidden" id="<?php echo $emp_res['name']; ?>" name="namee" value="<?php echo $emp_res['name']; ?>"></input>
	  <td>
	  <?php



	  if($emp_res['status']==1)
	  {
		 echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  }
	  else
	  {
		  echo '<span style="color:red;text-align:center;"><b>Inactive</b></span>';
	  }
	  ?>
	  </td>
      <td>
	   <button class="btn btn-dark btn-sm edit btn-dark" id="<?php echo $emp_res['id']; ?>" onclick=" ()" ><i class="fa fa-edit"></i> Edit</button>
     <button class="btn btn-info btn-sm edit btn-flat" id="<?php echo $emp_res['id']; ?>" onclick="add_page()"><i class="fa fa-edit"></i> ADD</button>
    
	  </td>
     <td>
	   <button class="btn btn-dark btn-sm edit btn-dark" id="<?php echo $emp_res['id']; ?>" onclick= "()"><i class="fa fa-edit"></i> Edit</button>
     <button class="btn btn-info btn-sm edit btn-flat" id="<?php echo $emp_res['id']; ?>" onclick="add_aptitude()"><i class="fa fa-edit"></i> ADD</button>
	  </td>
    <td>
	   <button class="btn btn-dark btn-sm edit btn-dark" id="<?php echo $emp_res['id']; ?>" onclick="()"><i class="fa fa-edit"></i> Edit</button>
     <button class="btn btn-info btn-sm edit btn-flat" id="<?php echo $emp_res['id']; ?>" onclick="add_technical()"echo ><i class="fa fa-edit"></i> ADD</button>
	  </td>
    <td>
	   <button class="btn btn-dark btn-sm edit btn-dark" id="<?php echo $emp_res['id']; ?>" onclick=" ()" ><i class="fa fa-edit"></i> Edit</button>
     <button class="btn btn-info btn-sm edit btn-flat" id="<?php echo $emp_res['id']; ?>" onclick="add_reasoning()"><i class="fa fa-edit"></i> ADD</button>
	  </td>


    <td>
	   <button class="btn btn-dark btn-sm edit btn-dark" id="<?php echo $emp_res['id']; ?>" onclick= "()"><i class="fa fa-edit"></i> Edit</button>
     <button class="btn btn-info btn-sm edit btn-flat" id="<?php echo $emp_res['id']; ?>" onclick="add_verbal(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> ADD</button>
	  </td>




    <td><button class="btn btn-dark btn-sm edit btn-dark" id="<?php echo $emp_res['id']; ?>" onclick="()"><i class="fa fa-edit"></i> Edit</button>
     <button class="btn btn-info btn-sm edit btn-flat" id="<?php echo $emp_res['id']; ?>" onclick="add_programming()"><i class="fa fa-edit"></i> ADD</button>
    </td>



    
    <td> <button class="btn btn-success btn-sm edit btn-dark" id="<?php echo $emp_res['id']; ?>" onclick="edit_asses (<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> view</button></td>
    <td>
    
   <input type="checkbox" class="checkbox"  id="question"   name="question[]"  value="" onchange = "checkbox()" style="float:right;">
      
  </td>
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
   
    </form>
      </table>

</tr>

      <script>
		function add_master()
    {
		
  $.ajax({
    type:"POST",
    url:"qvision/masters/assesment_master_page/assesmaster_page_add.php",
    success:function(data){
    $("#main_content").html(data);
    }
    }) 
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


  function add_page()
    {
		
  $.ajax({
    type:"POST",
    url:"qvision/masters/assesment_master_page/master_page_add.php",
    success:function(data){
    $("#main_content").html(data);
    }
    }) 
  }


  function add_aptitude()
    {
		
  $.ajax({
    type:"POST",
    url:"qvision/masters/assesment_master_page/master_page_aptitude.php",
    success:function(data){
    $("#main_content").html(data);
    }
    }) 
  }

  function add_technical()
    {
		
  $.ajax({
    type:"POST",
    url:"qvision/masters/assesment_master_page/master_page_technical.php",
    success:function(data){
    $("#main_content").html(data);
    }
    }) 
  }



function add_reasoning()
{
  $.ajax({

    type:"POST",
    url:"qvision/masters/assesment_master_page/master_page_reasoning.php",
    success:function(data){
      $("#main_content").html(data);
    }
  }
  )
}




function add_verbal(v)
{

  var id=v;
var data=$('form').serialize();
//var data = document.getElementById("namee");

alert(data);
  $.ajax({

    type:"POST",
    data:"name="+data,
    url:"qvision/masters/assesment_master_page/master_page_verbal.php",
    success:function(data){
      $("#main_content").html(data);
    }
  }
  )
}

function add_programming()
{
  $.ajax({

    type:"POST",
    url:"qvision/masters/assesment_master_page/master_page_programming.php",
    success:function(data){
      $("#main_content").html(data);
    }
  }
  )
}
  </script>
