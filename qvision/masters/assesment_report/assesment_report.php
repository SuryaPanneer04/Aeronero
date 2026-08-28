<?php
	require '../../../connect.php';
?>

<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
</style>	
<head>

<link rel="stylesheet" href="Qvision\commonstyle.css">
</head>


	<div  class="card card-primary">
    <div class="card-header">
	<div class="col-lg-12">
	<center><h4>ASSESMENT REPORT</h4></center>
	</div>
    <div class="panel-body">
	<form method="POST" name="att_reports" role="form">

	<div class="row">	
		<div class="col-lg-2">
		<div class="form-group">
			<label> ASSESMENT TYPE</label>
		</div>
		</div>

		<div class="col-lg-3">
		<div class="form-group">
		    <select class="form-control" name="emp_name" id="name">
				<option value="0"> -- Select type-- </option>
				<?php
                                    $asses_sql = $con->query("SELECT * FROM asses_master");
                                    while ($asses_sql_res = $asses_sql->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <option value="<?php echo $asses_sql_res['id']; ?>"><?php echo $asses_sql_res['asses_name']; ?></option>
                                    <?php
                                    }
                                    ?>
			</select> 
		</div>
		</div>

		<div class="col-lg-2"><input type="button" class="btn btn-success" name="view" onclick="myfunction()" value="view" style="float:right;"></th>
		</div>
	</form>
	</div>
   

 
  <script>

function myfunction(){

var ttt = document.getElementById("name").value;
var dataa = ttt;

$.ajax({
    type:"POST",
    url:"qvision/masters/assesment_report/asses_report_view.php",
	data: {name:dataa},
    success:function(data){
	//	alert(dataa);
    $("#main_content").html(data);
    }
    })
								}

// function question_view(v,e)

//     {
//     $.ajax({
//     type:"POST",
//     url:"qvision/masters/assesment_report/asses_report_view.php",
//     success:function(data){
		
//     $("#main_content").html(data);
//     }
//     })
//   }
  


  
           
      </script>       