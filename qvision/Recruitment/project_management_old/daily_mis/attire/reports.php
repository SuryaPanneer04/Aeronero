<?php 
require '../../../../../connect.php';
include("../../../../../user.php");
$user=$_SESSION['userid'];
 $premonth = date("Y-m-d",strtotime("-1 months"));
$cur = date("Y-m-d",strtotime("+1 days"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <!-- plugins:css -->
 
  <style>
	.tableFixHead{
		overflow: auto;
		height: 390px; 
	}
		
    .tableFixHead thead th { 
	 position: sticky; 
	 top: 0; 
	 z-index: 1; 
	  background:#eee; 
	 }

     /* Just common table stuff. Really. */
     table{
		 border-collapse: collapse;
		 width: 100%; 
    }
     th, td { 
	 padding: 8px 16px; 
    }
     th{ 
	 background:#eee; 
	 }
	 
 </style>
</head>

<body>
  <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card" style="height: 200px;">
                <div>
                  <h4 class="card-title">Attire Reports</h4>
				
				 </div>
         <form method="POST" >
     <div class="row" >
                     	 <div class="col-md-2">
						  
						  
														
																<div class="input-group" >
															<input type="date" class="add-on form-control" id="from_date" name="from_date" title=" Date" value="<?php echo $premonth; ?>" />
																	</div>
																	
													
													

						  
                      	</div> <!-- col -sm-3-->
				
					   	<div class="col-md-2">
						 	
					              
														<div id="datetimepicker1" class="input-append date">
																<div class="input-group" >
																
															<input type="date" class="add-on form-control" id="to_date" name="to_date" title=" Date" value="<?php echo $cur; ?>">
																	</div>
																
														</div>
												

                      		
					</div><!--col-sm-9-->
					 
					
<div class="col-md-2">
								
									<span class="input-group-btn">
										 <button class="btn btn-info btn-flat" style="border-color: #ffffff;background: #0163a3;
    color: #ffffff;" type="button" onClick="reports()">Go!</button>
									</span>
                      		
					</div><!--col-sm-3--> 
					
					 </div>
					
                  </form>
		<script>

	
	 function reports()
		{
			
						var from_date=$('#from_date').val();
						var to_date=$('#to_date').val();
					
						$.ajax({
    							type: "POST",
    							url: "qvision/Recruitment/project_management/daily_mis/attire/overallreport.php",
    							data: "from_date=" + from_date +"&to_date=" + to_date,
		 
    							success: function(data){
        									$('#main_content').html(data);	
   													 }
								}); 
				
			
		}
</script>