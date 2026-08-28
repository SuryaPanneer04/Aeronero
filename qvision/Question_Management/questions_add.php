<?php
require '../../connect.php';
?>
<html>
<body>
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<i class="fa fa-table"></i> QUESTIONS  Add
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i>Back</a>
</div>
<div class="card-body">
<div class="tab-content">

    <div class="active tab-pane" id="for_employment">
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td><center><img src="qvision/images/logo123.jpg" alt="quadsel" style="width:100px;height:50px;"></center></td>
        <td colspan="5"><center><b>Bluebase Software Services Private Limited</b></center></td>
        </tr>
      
        <tr>
        <td colspan="6"><center><b>Add Questions</b></center></td>
        </tr>
		<tr>
        <td>Question Name</td>
        <td colspan="5"><select name="qn_name" id="qn_name" class="form-control" required>
		<option value="">Select Qn Name</option>
<?php 
$que=$con->query("SELECT * FROM question_name_master where status='1'");
 while($answer = $que->fetch(PDO::FETCH_ASSOC))
      {
     
?>
<option value="<?php echo $answer['id'];?>"><?php echo $answer['name'];?></option>
<?php
	  }
	  ?>
		</td>
        </tr>
        <tr>
		
        <tr>
        <td>Section</td>
        <td colspan="5"><select name="section" id="section" class="form-control" required>
		<option value="">Select Section</option>
<?php 
$que1=$con->query("SELECT * FROM section_master where status='1'");
 while($answer1 = $que1->fetch(PDO::FETCH_ASSOC))
      {
     
?>
<option value="<?php echo $answer1['id'];?>"><?php echo $answer1['name'];?></option>
<?php
	  }
	  ?>
		</td>
        </tr>
        <tr>
        
        <tr>
        <td>Questions</td>
        <td colspan="5"><textarea  class="form-control" id="Questions"  placeholder="Enter Questions" name="Questions"></textarea></td>
        </tr>
        <tr>
        <td>Option A</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Option_A" id="Option_A" name="Option_A" ></td>
        </tr>
        <tr>
       <td>Option B</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Option_B" id="Option_B" name="Option_B" ></td>
        </tr>
        <tr>
        <td>Option C</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Option_C" id="Option_C" name="Option_C" ></td>
        </tr>
        
         <tr>
        <td>Option D</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Option_D" id="Option_D" name="Option_D" ></td>
        </tr>
		 <tr>
        <td>Correct Answer Key</td>
        <td colspan="5">
			<input type="text"  id="answer_key" name="answer_key" class="form-control"  placeholder="Enter Correct Answer" required="true">
		</td>
        </tr>
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="subbtnnnn()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
   function subbtnnnn() {

    $.ajax({
        type: "POST",
        url: "qvision/Question_Management/insert_questions.php",
        data: $("form").serialize() + "&id=0",
        success: function(res){

            console.log(res);

            if(res.trim()=="success"){
                alert("Entry Successfully");
                question_managements();
            }else{
                alert(res);
            }

        },
        error:function(xhr){

            console.log(xhr.responseText);
            alert("Server Error");

        }
    });

}

	function back_ctc()
	{
		question_managements();
	}
    </script>
</body>
</html>