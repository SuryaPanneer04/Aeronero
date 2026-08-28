 <?php
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];
?>



<style>
.card-primary:not(.card-outline)>.card-header{
	background-color:#343a40 !important;
}
.card-primary:not(.card-outline)>.card-header{
color: white !important;
}
.btn-dark{
background-color: rgb(237, 93, 0) !important;
    color: rgb(60, 8, 8) !important;
    border-color: rgb(237, 93, 0) !important;
}
</style>






<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">


   <div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5"><b>ASSESMENT MASTER PAGE STS</b></font></h3>
			
                <a onclick="back_Assesment_master_page()" style="float: right;" data-toggle="modal" class="btn btn-danger">Back</a>
              </div>
			 
<div class="tab-content">

    <div class="active tab-pane" id="for_employment">
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
      
     
        <tr>
        <td>Question Name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Question Name" id="question" name="question" ></td>
        </tr>
      


		<tr>
<td>Status</td>
<td colspan="2">
<select class="form-control" name="status" id="status">
<option value="1">Active</option>
<option value="0">InActive</option>
</select>
</td>
</tr>
       
		
        <td colspan="6"><input type="button" class="btn btn-dark" value="Submit"  style="float:right;color:white !important;" name="submit" onclick="insert_master()" value="submit"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

<script>
function back_Assesment_master_page()
	
	{
	  Assesment_master_page();

	}
  function back()
  {
    Assesment_master_page()
  }
  </script>


			<script>
			 function insert_master()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
  url:"qvision/masters/Assesment_master_page/insert_master.php",
    success:function(data){
		
		if(data==0)
		{
			alert(" Not inserted ");
			Assesment_master_page();
		}
		else
		{
			alert(" inserted");
			Assesment_master_page();
		}
      //$("#main_content").html(data);
    }
	
    });
    }

	</script>






























<!-- <head>
<style>
.card-header{
background: #007bff !important;
}
</style>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
 </head>
<div class="card card-primary">
   <div class="card-header">
   <center><h3 class="card-title"><b>Assesment Master Page STS</b></h3></center>
   <a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger">BACK</a>
 </div>
</div>

<form method="POST" action="">

<table class="table table-bordered">
<tr>
<td> question Name :</td>
<td colspan="2"><input type="text" class="form-control" id="question_name" name="question_name" ></td>
</tr>

<tr>
<td>Status</td>
<td colspan="2">
<select class="form-control" name="status" id="status">
<option value="">Select Status</option>
<option value="1">Active</option>
<option value="0">InActive</option>
</select>
</td>
</tr>


</table>
<input type="button" name="submit" class="btn btn-primary btn-md" value="Submit" onclick="master_insert()"style="float:right;">
</form>



<script>

 function master_insert()
 {
     var id=0;
    var data = $('form').serialize();
   $.ajax({
    type:"GET",
	data: data + "&" + "id="+id,
    url:"qvision/masters/assesment_master_page/insert_master.php",
    success:function(data){
		if(data=0)
		{
			alert("Not inserted");
			assesment_master_page();
		}
		else
		{
			alert("inserted successfully");
			assesment_master_page();
		}
    }
  }) 
} 


// <script>

// function  master_insert()
//     {
//         var data = $('form').serialize();
//         $.ajax({
//             type: 'GET',
//             data: data + "&" + "id="+id,
//             url: "qvision/masters/assesment_master_page/insert_master.php",
//             success: function (data)
//             {
//                 alert("Entry Successfully");
//               assesment_master_page  ()
//             }
//         });
//     }
function back()
{
	assesment_master_page();
}
</script> --> 