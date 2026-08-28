<?php
require '../config.php';
include("../user.php");
?>
<div class="container-fluid">
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Daily Task
            <a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-primary">BACK</a>
        </div>
        <form method="POST">
            <table class="table table-bordered">
                <tr>
                    <td></td>
                <td colspan="5"><center><b>Quadsel Systems Pvt Ltd</b></center></td>
                </tr>
                <tr>
                    <td>Task Name</td>
                    <td colspan="2"><input type="text" class="form-control" id="title" name="title" ></td>
                </tr>

                <tr>
                    <td>Task Description</td>
                    <td colspan="2"><textarea class="form-control" id="description" name="description"> </textarea> </td>
                </tr>
            </table>
           
		<input type="button" class="btn btn-success" name="save" onclick="insert_task()" value="save" style="float: right;">
        </form>
	
	 <script>
     function back(){
        work()
     }

	 function insert_task()
    {
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data: data,
    url:'Daily_Task/daily_task_submit.php',
    success:function(data)
    { 
      alert("Daily Task Fixed");
	  work()  
    }    
  });
    }
	 </script>