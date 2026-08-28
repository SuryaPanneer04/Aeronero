<?php
require '../../../connect.php';
include("../../../user.php");
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT distinct a.cost_sheet_no,a.approved_by,a.status as cs_status,a.enquiry_id as const,a.business_id,b.*,c.*,p.* FROM cost_sheet_entry a 
left join new_client_master c on (a.client_id=c.id)
left join new_plant_master p on c.org_name=p.client_org_name
left join quote_generate b on (a.cost_sheet_no=b.cost_sheet_no) where b.id='$id'"); 


$stmt->execute(); 
$row = $stmt->fetch();
?>
<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header{
color: black !important;
}
.btn-dark{
background-color: rgb(237, 93, 0) !important;
    color: rgb(60, 8, 8) !important;
    border-color: rgb(237, 93, 0) !important;
}
</style>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
	<section class="wage_content">
<div class="card card-primary">
<div class="card-header">
  <h3 class="card-title"><font size="5">PO UPLOAD DETAILS</font></h3>
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
</div>



              <!-- /.card-header -->
              <!-- form start -->
<form id="fupForm12" class="form-horizontal" name="fupForm" method="POST" enctype="multipart/form-data">
         
            <div class="card-body">
				   <div class="form-group row">
				  <label for="inputname" class="col-sm-2 col-form-label">Client Name</label>
				  <div class="col-sm-5">
                      <input type="text" class="form-control" name="cost_sheet_no" id="cost_sheet_no" value="<?php echo  $row['org_name'];?>"readonly>
                    </div>
					</div>
					<div class="form-group row">
				  <label for="inputname" class="col-sm-2 col-form-label">Contact Person Name</label>
				  <div class="col-sm-5">
                      <input type="text" class="form-control" name="cost_sheet_no" id="cost_sheet_no" value="<?php echo  $row['contact_person'];?>"readonly>
                    </div>
					</div>
                    <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Cost Sheet No</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="cost_sheet_no" id="cost_sheet_no" value="<?php echo  $row['cost_sheet_no'];?>"readonly>
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="inputname" class="col-sm-2 col-form-label">Quote No</label>
                    <div class="col-sm-5">
			          <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $row['id']; ?>">
			         
					 <input type="hidden" class="form-control" id="enquiry_id" name="enquiry_id" value="<?php echo  $row['const']; ?>">
					 
					 
					 <input type="hidden" class="form-control" id="business_id" name="business_id" value="<?php echo  $row['business_id']; ?>">
				 

                      <input type="text" class="form-control" name="quote_no" id="quote_no" value="<?php echo  $row['quote_no'];?>"readonly>
                  </div>
				  </div>
				  
				  
				   <div class="form-group row">
                    <label for="inputdob" class="col-sm-2 col-form-label">Quote Date</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="quote_date" id="quote_date" value="<?php echo  $row['quote_date'];?>"readonly>
                    </div>
                  </div>

				  <!--div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Cost Sheet No</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="cost_sheet_no" id="cost_sheet_no" value="<!?php echo  $row['cost_sheet_no'];?>"readonly>
                    </div>
                  </div-->
				
				
				  <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">PO Upload</label>
                    <div class="col-sm-5">
				<input type="file" class="form-control" id="attachment_1" name="attachment[]"  />
                    </div>
                  </div>
				  
				   <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">PO Date</label>
                    <div class="col-sm-5">
                      <input type="date" class="form-control" name="po_date" id="po_date" >
                    </div>
                  </div>
				 
			     <input type="submit" name="submit" class="btn btn-success submitBtn" value="SAVE">
</form>
			   
			
			  
            </div>
			
	<script>
function back_ctc(v){
	  //alert(v);
	enquiry();
}	

/* var date = new Date();
var day = date.getDate();
var month = date.getMonth() + 1;
var year = date.getFullYear();

if (month < 10) month = "0" + month;
if (day < 10) day = "0" + day;

var today = year + "-" + month + "-" + day;

document.getElementById("po_date").value = today;

function po_upload_submit(){
	   var data = $('form').serialize();
	$.ajax({
	type:"GET",
	data: data + "&" + "id="+id,
	url:"qvision/BusinessProcess/po_upload/po_upload_view/po_upload_submit.php",
	success:function(data)
	{
		$(".content").html(data);
	}
	})
} */
</script>
<script>
/* $(document).ready(function(){
    // Submit form data via Ajax
    $("#po_upload").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'qvision/BusinessProcess/po_approval/po_upload_submit.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
           
            success: function(response){
      if(response==0)
      { 
        alert('Certification Details form entry Successfully Completed.Then fill out the Employement details');
        application();
      }
      else
      {
        alert("Entry Unsuccessfull");
		application();
      }
      
    }   
        });
    });
	
    // File type validation
    var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
    $("#file").change(function() {
        for(i=0;i<this.files.length;i++){
            var file = this.files[i];
            var fileType = file.type;
			
            if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
                alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
                $("#file").val('');
                return false;
            }
        }
    });
}); */
</script>
<script>
/* $(document).ready(function(){
    // Submit form data via Ajax
    $("#fupForm12").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'qvision/BusinessProcess/po_approval/po_upload_submit.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
           
            success: function(response){
     
        alert("Uploaded successfully");
		
		po_upload();
     
      
    }   
        });
    });
	}); */
	
	
	</script>
	<script>
		 $(document).ready(function(){  
		$("form[name='fupForm']").on("submit", function(ev) {
		 ev.preventDefault();
var formData = new FormData(this);
$('.wage_content').html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');	  
           $.ajax({  
                url: 'qvision/BusinessProcess/po_approval/po_upload_submit.php',
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
		processData: false,
                success:function(data)  
                {  
                    alert('SOF Uploaded Successfully'); 
                  // $('#fupForm')[0].reset();  
				  po_status()
                }  
           });  
      });  
	   }); 
</script>
	
	
	</script>
	<script>
    // File type validation
   /*  var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office','application/text','image/jpeg', 'image/png', 'image/jpg'];
    $("#file").change(function() {
        for(i=0;i<this.files.length;i++){
            var file = this.files[i];
            var fileType = file.type;
			
            if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
                alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
                $("#file").val('');
                return false;
            }
        }
    }); */

</script>