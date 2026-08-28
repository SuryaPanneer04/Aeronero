<?php
require '../../../connect.php'; 
?>

<html>
<head>
<link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<div class="card card-info">
	  <div class="card-header">
	   <h2 class="card-title"><font size="4"><b>Add Challan</b></font> </h2>
	   <a onclick="return backxx()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
	  </div> 
</div>
     
	<form name="fupFormz" class="form-horizontal" method="POST" enctype="multipart/form-data">

		<table class="table table-bordered">	
		 <tr>
			<td><b>SO Number</b></td>
			<td> 
			 <select name="cus_name" id="cus_name" class="form-control" onchange="getDCvalue(this.value)">
			 <option value=""> -- Select -- </option>

		      <?php 
		        $so_num = $con->query("SELECT b.id as pvm_id,a.cost_sheets_id,b.so_number,c.po_date,a.grn_id FROM purchase_generate a left join purchase_vendor_master b on a.cost_sheets_id = b.cost_sheet_id left join po_generate c on b.cost_sheet_no = c.cost_sheet_no where a.status = 2 && b.status = 3 group by b.so_number");
		        while ($row_fetch = $so_num->fetch()) { ?>
		
		       <option value="<?php echo $row_fetch['cost_sheets_id']; ?>" data-id="<?php echo $row_fetch['po_date']; ?>" data-pvm = "<?php echo $row_fetch['pvm_id']; ?>" data-so = "<?php echo $row_fetch['so_number']; ?>" data-grn="<?php echo $row_fetch['grn_id']; ?>"> <?php echo $row_fetch['so_number']; ?> </option>
             <?php } ?>
            </select>
           </td>
		 </tr>
		</table>
<div id="dcList">

</div>

    </form>

<script>
  function backxx(){
	  delivery_challan()
  }

  function getDCvalue(v){ 
	const des = document.getElementById('cus_name') 
	let grn = des.options[des.selectedIndex].getAttribute('data-grn')

	$.ajax({
		type: "POST",
		url: "qvision/Purchase_process/delivery_challan/dc_details_view.php?cost_no=" + v + "&grn=" + grn,
		success:function(data){
			$('#dcList').html(data)
		}
	})
  }

$("form[name='fupFormz']").on("submit", function(ev) {
		 ev.preventDefault();
		 
		 		let chkArray = [];
		$(".approveCheck:checked").each(function() {
			chkArray.push($(this).val());

		});  //Checking all the checkbox are checked or not.If not then if condition alert work, else condition insert DC and Update GRN ENTRY against serial no. 

		if (chkArray == '') {
			alert("Select Atleast One Serial Number");

		} else {
			
         let formData = new FormData(this);
	     const des = document.getElementById('cus_name')
         let podate = des.options[des.selectedIndex].getAttribute('data-id')
		 let pvmid = des.options[des.selectedIndex].getAttribute('data-pvm')
		 let so = des.options[des.selectedIndex].getAttribute('data-so')

           $.ajax({  
                url: 'qvision/Purchase_process/delivery_challan/insert_record.php?poDate='+ podate + "&pvmId=" + pvmid + "&so_no=" + so,
                method: "POST",  
                data: formData, 
				cache: false,
				contentType: false,
				processData: false,
                success: function(data)  
                {  
					if(data==1){
                    alert('DC Generated Successfully'); 
				    delivery_challan()
					}
					else{
					  alert('DC Generate Failed'); 
				      delivery_challan()
					}
                }  
           }); 
		}		   
      });  
</script>

</html>