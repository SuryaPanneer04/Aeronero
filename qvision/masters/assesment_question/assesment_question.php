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


input[type=text], select {
  width: 100%;
  /* padding: 12px 500px; */
  margin: 13px 0;
}
.checkbox label{
  width: 100% !important;
}

</style>	
<head> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 </head>
 
	<div  class="card card-primary">
    <div class="card-header">
	<div class="col-lg-12">
	<h4>ASSESMENT </h4>
	
	</div>
</div>
</div>
</table>
    <div class="panel-body">
	<form method="POST"  name="assesment_name" id="assesment_name">

	 <div class="row">	
		<div class="col-lg-2"> 
		<div class="form-group">
			<label> ASSESMENT TYPE</label>
		</div>
		</div>   

		<div class="col-lg-2">
                            <div class="form-group">
                                <select class="form-control" name="name" id="asses" onchange="change_asses()">
                                    <option value="0">-- SELECT ASSESMENT --</option>
									<?php                                                       
                                    $asses_sql = $con->query("SELECT * FROM question_name_master where status=1");
                                    while ($asses_sql_res = $asses_sql->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <option value="<?php echo $asses_sql_res['id']; ?>"><?php echo $asses_sql_res['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
    </div>
    
                            
   <center> <h1>ASSESMENT QUESTION <span class="badge badge-secondary">New</span></h1></center>
<div class="form-outline">
  <div class="checkbox">
      <label>
       Question
      
     <textarea name="question" id ="question" rows="7" class="form-control" ></textarea>
     
    </label>
    </div>


    <div class="checkbox">
      <label>
        <input type="checkbox"   name="option" id="option" value="a">Option A
      <input type="text" name="option_a" id="option_a" rows="3" class="form-control" >
    </label>
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="option" id="option" value="b">Option B
      <input type="text" name="option_b" id="option_b" class="form-control" >
    </label>
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="option" id="option" value="c">Option C
        <input type="text" name="option_c" id="option_c" class="form-control" >
    </label>
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="option" id="option" value="d">Option D
        <input type="text" name="option_d" id="option_d" class="form-control" >
    </label>
    </div>
    


    <div class="input-group mb-8">
  <div class="input-group-prepend">
   
    </div>
  </div>
 
</div>


  <input type="button" class="btn btn-dark" value="Save" onclick="logic_sub()"  style="float:right;color:white !important;" name="submit" id="submit" value="save">

 
        </form>
                           </div>
                                
</body>
</html>


	
 <!-- <script>
var question_type=$('#question_type').val();
var question = $('#question').val();
var option_a = $('#option_a').val();
var option_b = $('#option_b').val();
var option_c = $('#option_c').val();
var option_d = $('#option_d').val();
var option = $('#option').val();


							   function logic_sub()
                {
                      $.ajax({
                       type: "POST",
                       data:$(this).serialize(),
                       url: "/qvisionnew/qvision/masters/assesment_question/logic_submit.php",
                            success: function (data) {
                            $("#main_content").html(data);
                }
             })
               }
							</script> -->





          <script>
function logic_sub()
	{
	var id=0;
	//alert(id);
	var data = $('form').serialize();
	//alert(data);
	$.ajax({
	type:'GET',
	data: data + "&" + "id="+id,
  url: "qvision/masters/assesment_question/logic_submit.php",
	success:function(data)
	{      
		alert("Entry Successfully");
		assesment_question()
				  
	}       
	});
	}
	function back()

	{
		assesment_question()

	}
</script>
