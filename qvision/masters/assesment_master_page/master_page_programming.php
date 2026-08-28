<?php
require '../../../connect.php';
include("../../../user.php");

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
</style>
<div  class="card card-primary">
    <div class="card-header">
	<div class="col-lg-12">
	<h4> PROGRAMMING QUESTIONS </h4>
	<a onclick="back_Assesment_master_page()" style="float: right;" data-toggle="modal" class="btn btn-danger">Back</a>
	</div>
</div>
</div>
<form method="post" >
<table class="table table-bordered">
<thead>
    <tr>
        <th style="width: 10%"> sno </th>
        <th><center> Questions </center></th>
        <th style="width: 10%">action </th>
    </tr>
    
</thead>

<tbody>
   
<?php


      $asses_sql=$con->query("SELECT * FROM asses_question where question_type = 6 ");
      $i=1;
      while($asses_res = $asses_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php  echo $i; ?></td>
      <td><?php echo $asses_res['question']; ?></td>
    
      
        <th colspan="6"><input type="checkbox" class="checkbox"  id="question"   name="question[]"  value="<?php echo $asses_res['question']; ?>"onchange = "checkbox()" style="float:right;"></th>
        
        <?php
      $i++;
    }

     ?> 
    
    <tr>
    <td>
     <colspan="6"><input type="button"  class="btn btn-dark" value="Submit"  style="float:right;color:white !important;" name="submit" onclick="submit_master()" value="submit">
</tr>
  </tbody>
</tbody>
  </table>
</form>


<script>


      function checkbox() {
         let checkbox = document.getElementById('question');
         let pan_input = document.getElementById('pan-input');
         if (checkbox.checked) {
            pan_input.style.display = "flex";
         } else {
            pan_input.style.display = "none";
         }
      }





 function submit_master()

{
    var id=0;
    var data = $('form').serialize();
   $.ajax({
    type:"POST",
	data: data + "&" + "id="+id,
    url:"qvision/masters/assesment_master_page/submit_programming.php",
    success:function(data){
		if(data=0)
		{
			alert("inserted successfully");
			master_page_add();
		}
		else
		{
			alert("Not inserted");
			master_page_add();
		}
    }
  }) 
}

function back_Assesment_master_page()
	
	{
	  Assesment_master_page();

	}
  function back()
  {
    Assesment_master_page()
  }
  </script>