<?php
require '../../../connect.php';
require '../../../user.php';

$id = $_REQUEST['question_no'];

$stmtss = $con->prepare("SELECT * FROM asses_question WHERE question_no= '$id'");
$stmtss->execute();
$row = $stmtss->fetch();

?>


<div class="card card-primary">
<div class="card-header">
<h3 class="card-title"><font size="5">ASSESMENT EDIT</font></h3>
<a onclick="back_assesment()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
</div>
</div>

<!-- <div class="container-fluid">
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i><h> ASSESMENT EDIT</h>
            <a onclick="back_assesment()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
            <a onclick="back_assesment()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a> -->
</div>
        </div> 
        <div class="card-body" id="printableArea">
            <form method="POST" enctype="multipart/type">


  <!-- <table class="table table-bordered">
	<th>
	<p><span style="font-size:20px;">QUESTION</span></p> 
	<div class="row">	
	<textarea type="question"class="form-control"  id ="question" rows="7" value="<?php echo  $row['question']; ?>"  rows="5"></textarea>
</div>
</th>  -->
</table>
            <table class="table table-bordered">
            
	<td><b><span style="font-size:20px;">QUESTION</span></b></td>
             <!-- <td><b style="font-size:20px;"> QUESTION </b></td>  -->
             <td colspan="4">  <input name="question" id ="question" rows="7" value="<?php echo  $row['question']; ?>" class="form-control" style=" height: 250px; width: 900px;"></input></td> 
    </label> 
    </div>


 <table class="table table-bordered">
    <tr>
    <div class="checkbox">
     <td><b style="font-size:15px;">OPTION A</b></td>
     <td colspan="1"> <input type="text" name="option_a" id="option_a"   style=" height: 50px;"value="<?php echo  $row['option_a']; ?>" class="form-control" > </td>
    </label> 
    </div>
    </tr>

<tr>
    <div class="checkbox">
     <td><b style="font-size:15px;">OPTION B</b></td>
     <td colspan="1"> <input type="text" name="option_b" id="option_b"style=" height: 50px;" value="<?php echo  $row['option_b']; ?>" class="form-control" ></td>
    </label>
    </div>
    </tr>
<tr>
    <div class="checkbox">
      <td><b style="font-size:15px;">OPTION C</b></td>
      <td colspan="1">  <input type="text" name="option_c" id="option_c" style=" height: 50px;" value="<?php echo  $row['option_c']; ?>" class="form-control" >
    </label></td>

    </div>

</tr>
    <div class="checkbox">
    <td> <b style="font-size:15px;">OPTION C</b></td>
    <td colspan="1">
        <input type="text" name="option_d" id="option_d"value="<?php echo  $row['option_d']; ?>" style=" height: 50px;"class="form-control" >
        <input type="hidden" name="qno" id="qno" value="<?php echo  $row['question_no']; ?>" class="form-control" >
    </td>

   <tr>

   <td> <b style="font-size:15px;">ANSWER</b></td>
 
        <td colspan="1">
        <input type="text" name="answer"  id="answer"style=" height: 50px;" value="<?php echo  $row['answer']; ?>" class="form-control "  ></td></tr>
    

    <!-- <div class="input-group mb-8">
  <div class="input-group-prepend">
   
    </div>
  </div>
 
</div> -->
<table class="table table-bordered">
<tr>
<td><input type="button" name="update" value="Update" class="btn btn-primary btn-md" id="update" onclick="update_asses(<?php echo $row['question_no']; ?>)" style="float:right;">
</tr>
</table>
</table>

        </form>
                           </div>
                                
</body>
</html>


	






          <script>
// function logic_sub()
// 	{
// 	var id=0;
// 	//alert(id);
// 	var data = $('form').serialize();
// 	//alert(data);
// 	$.ajax({
// 	type:'GET',
// 	data: data + "&" + "id="+id,
//   url: "/qvisionnew/qvision/masters/assesment_report/asses_report_view.php",
// 	success:function(data)
// 	{      
// 		alert("updated Successfully");
// 		assesment_question()
				  
// 	}       
// 	});
// 	}
// 	function back()

// 	{
// 		assesment_question()

// 	}
// </script>



                <script>
    // function  back_assesment()
    // { 
    //   asses_report_view();
                
    // }
    // function back()
    // {
    //   asses_report_view()
    // }
// function back_assesment()
// {
// 	assesment_report()
// } 
// 	function back()
// s
// 	{
// 		assesment_report()

// 	}

function update_asses(v)
{

	  var question_no = document.getElementById("qno").value;
    alert(question_no);

	var data=$('form').serialize();
	$.ajax({
		type:"POST",
		data: data + "&" + "id="+question_no,
		url:"qvision/masters/assesment_report/asses_report_update.php?question_no="+v,
		success:function(data)
		{
		
			alert("Updated successfully");
			asses_report_view()
		}
		}); 
}


// function  back_assesment()
//     { 
//       asses_report_view();
                
//     }
//     function back()
//     {
//       asses_report_view()
//     }


    function back_assesment()

	{
 		assesment_question()

 	}


</script>