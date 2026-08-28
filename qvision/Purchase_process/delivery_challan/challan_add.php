<?php
require '../../../connect.php'; 
require '../../../user.php'; 

 $user_id =$_SESSION['userid'];
 $candidateid=$_SESSION['candidateid'];
 //
?>
<html>
<head>
<link rel="stylesheet" href="Qvision\commonstyle.css">

</head>
<div class="card card-info">
	  <div class="card-header">
	 <h2 class="card-title"><font size="4"><b>Add Challan</b></font> </h2>
	 <a onclick="return backxx()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a></div>
	 
	</div>
     
	<form id="fupFormz" name="fupFormz" class="form-horizontal" method="POST" enctype="multipart/form-data">
		<div><tr><td><b>Customer Name</b></td><td>
			 <select name="cus_name" id="cus_name" class="form-control">
		 <?php 
		$query = $con->query("SELECT id,client_org_name FROM new_plant_master");
		while ($row_fetch = $query->fetch()) {?>
		
		<option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['client_org_name']; ?></option>
        <?php } ?>
    </select>

					</td>
				 </tr></div>
				 <table class="table table-bordered">
					 
<div>
   <tr>
    <input type="button" class="delete-row btn btn-danger" value="Delete" style="float:right;margin-right: 9px;" onclick="deleteRow('new_tab')"/>&nbsp;&nbsp;&nbsp;&nbsp;
	                 <input type="button" class="add-row btn btn-success" value="Add " onclick="add_line()" style="float:right;margin-right:20px;"><br/><br/>
					  </tr>
					  </div>
		<table class="table table-striped table-bordered table-hover display nowrap"  id="new_tab" style="width:100%" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered">
	 
	 	<tbody id="cost_sheett">
			
		  <tr>
		  <th style="width: 2%;">
			    <input type="checkbox" name="select" id="select" onclick="select(); required" >
		      </th>
		     
		       
		       <th style=" WIDTH: 4%;">Product Name</th>
		       <th style=" WIDTH: 4%;">Product Spec</th>
			   <th style=" WIDTH: 4%;">Qty</th>
		       <th style=" WIDTH: 4%;">Serial Number</th>
		       <th style=" WIDTH: 4%;">Remark</th>		      
		      
		 </tr>
         <tr>
		     <td>
			     <input type="checkbox" name="chk[]">
		     </td>
			 <td>
				<select name="pro_name[]" id="pro_name1" onchange="get_desc(1,this.value)" class="form-control">
					 <?php 
					$query = $con->query("SELECT id,name,description FROM product_master");
					?>
					<option disabled selected>-- Select product --</option>
					<?php
					while ($row_fetch = $query->fetch()) {?>
					
					<option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['name']; ?></option>
						<?php } ?>
				</select>
			</td>		
		     <td>
			     <select class="form-control" name="desc_1[]" id="desc_1"  required></select></td>
		     
		     <td>
			     <input type="text" id="qty1" name="qty[]" style="width:100%"  class="form-control" ></td>
		     <td>
			     <input type="text" id="serial_no1" name="serial_no[]"  style="width:100%"   class="form-control">
		     </td>
			 <td>
		         <INPUT type="text" id="remark1" name="remark[]" style="width:100%" onchange="kilometer(1,this.value);tot_amt(1,this.value)" class="form-control" >
		     </td>
		     
		     
			 
	      </tr>	
		  </tbody>
      </table>
	  <tr>
    <td colspan="6"><input type="submit" name="submit" class="btn btn-success submitBtn" value="Generate DC"></td>
    </tr>
    </form>
    </html>
	<script>
	document.getElementById('select').onclick = function() {
    var checkboxes = document.getElementsByName('id[]');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }

}

	function get_desc(v,c)
{
	//alert(c);
			  $.ajax({
				  url: "qvisionnew/qvision/Purchase_process/delivery_challan/get_desc.php?id="+c,
                   type: "GET",
					success: function(data){
						
					$("#desc_"+v).html(data);
					}
					});
}
	</script>
	<script>
	function add_line()
    {  

	var lenz=$('#new_tab tr').length;
    len=lenz+0; 
	
	
	$('#new_tab').append('<tr><td><input type="checkbox" name="chk[]"></td><td><select name="pro_name[]" id="pro_name'+len+'" onchange="get_desc('+len+',this.value)" class="form-control"><?php $query = $con->query("SELECT id,name,description FROM product_master");?><option disabled selected>-- Select product --</option><?php while ($row_fetch = $query->fetch()) {?><option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['name']; ?></option><?php } ?></select></td><td><select class="form-control" name="desc_1[]" id="desc_'+len+'"  required></select></td><td><input type="text" id="qty'+len+'" name="qty[]" style="width:100%"  class="form-control" ></td><td><input type="text" id="serial_no'+len+'" name="serial_no[]"  style="width:100%"   class="form-control"></td><td><INPUT type="text" id="remark1" name="remark[]" style="width:100%" class="form-control" ></td></tr>'); 
	}
	
	$(document).ready(function(){  
		$("form[name='fupFormz']").on("submit", function(ev) {
		 ev.preventDefault();
var formData = new FormData(this);
  
           $.ajax({  
                 url: 'qvision/Purchase_process/delivery_challan/insert_record.php',
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
				processData: false,
                success:function(data)  
                {  
                    alert('DC Generated Successfully'); 
                  
				  delivery_challan()
                }  
           });  
      });  
	   }); 

function deleteRow(new_tab) {
    try {
		
      var table = document.getElementById(new_tab);
      var rowCount = table.rows.length;
      var tabCount = table.rows.length;

      document.getElementById("select-all").checked = false;

      for (var i = 1; i < rowCount; i++) {
		 
        var row = table.rows[i];
        var chkbox = row.cells[0].childNodes[0];
        if (null != chkbox && true == chkbox.checked) {
          table.deleteRow(i);

         rowCount--;
          i--;
        }

      }
	  
	  //alert(tabCount);
	   var finalamount = 0;
		for (var j = 1; j < tabCount; j++) 
		{
			 var tota=$('#amount' + j).val();
			 var tot1=parseFloat(tota);
		
			if(isNaN(tot1)) tot1=0.00;
			
			finalamount = finalamount +tot1;
			var finalamount1=parseFloat(finalamount).toFixed(2);  

		}   
	
	 $('#total_item').val(finalamount1); 
	  
    } 
	catch (e) {
      alert(e);
    }

	
  }
  function backxx(){
	  delivery_challan()
  }
</script>