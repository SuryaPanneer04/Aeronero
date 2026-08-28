<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$user_id =$_SESSION['userid'];
?>

<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
		<style>
.card-primary:not(.card-outline)>.card-header{
background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
.btn-dark{
	background-color: #ed5d00 !important;
    border-color: #ed5d00 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black !important;
}
</style>
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title"><font size="5">Upload Plant Excel</font></h3>
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
</div>
<form enctype="multipart/form-data" method="post" action="qvision/masters/client_master/excels.php"   role="form">
	<div class="control-group"><br>
		<div class="has-feedback">
			  <a href='qvision/masters/client_master/new_plant_master.csv' target="_blank" style="color:blue;">Plant Templete</a>
		</div>

		<div class="form-group">
			<label>
				<span>File Upload</span>
					<input id="name" type="file" name="sel_file" size="150" placeholder="Your Full Name" />
				 <p class="help-block">Only Excel/CSV File Import.</p>
			</label>
		</div>
			<button type="submit" class="btn btn-success" name="submit" value="submit">Upload</button>
    </div>
</form>
<script>
function back_ctc()
{
  $.ajax({
    type:"POST",
    url:"qvision/masters/client_master/client_master.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}

</script>


<?php
 if(isset($_POST['submit']))
    {
         //$account_type = $_POST['account_type'];
         $fname = $_FILES['sel_file']['name'];
         echo '<center class=green>Uploaded file name is: '.$fname.'</center> ';
         $chk_ext = explode(".",$fname);

         if(strtolower(end($chk_ext)) == "csv")
         {

             $filename = $_FILES['sel_file']['tmp_name'];
             $handle = fopen($filename, "r");

             fgetcsv($handle); //skip the reading of the first line from the csv file

            $c = 0;
             while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
             {

                    $var = $data[3]; // dd.mm.yy
                    $data[3] = implode("-", array_reverse(explode(".", $var))); // converted -> yyy-mm-dd
					
					
					$id=$data[0];
					$client_id=$data[1];
					$client_org_name=$data[2];
					$state=$data[3];
					$city=$data[4];
					$gst_no=$data[5];
					$pan_no=$data[6];
					$address=$data[7];
					$area=$data[8];
					$pincode=$data[9];
					$it_name=$data[10];
					$it_designation=$data[11];
					$it_mob1=$data[12];
					$it_mob2=$data[13];
					$it_mail1=$data[14];
					$it_mail2=$data[15];
					$it_landno=$data[16];
					$pur_name=$data[17];
					$pur_designation=$data[18];
					$pur_contact=$data[19];
					$pur_mail=$data[20];
					$fin_name=$data[21];
					$fin_designation=$data[22];
					$fin_contact=$data[23];
					$fin_mail=$data[24];
					
					$sql=$con->query("insert into new_client_master(client_id,client_org_name,state,city,gst_no,pan_no,address,area,pincode,it_name,it_designation,it_mob1,it_mob2,it_landno,pur_name,pur_designation,pur_contact,pur_mail,fin_name,fin_designation,fin_contact,fin_mail,status,flow,created_by,created_on)
								values('$client_id','$client_org_name','$state','$city','$gst_no','$pan_no','$address','$area','$pincode','$it_name','$it_designation','$it_mob1','$it_mob2','$it_landno','$pur_name','$pur_designation','$pur_contact','$pur_mail','$fin_name','$fin_designation','$fin_contact','$fin_mail',1,1,'$user_id',NOW())");
								
             }//while

                 fclose($handle);
                 echo "<center class=green>Successfully Imported</center><br/>";


         }//if->csv
            else
            {
                echo "Invalid File";
            }   
			$c++;
    }//submit

    ?>
	


