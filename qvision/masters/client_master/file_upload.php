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
					$department_id=$data[1];
					$employee_id=$data[2];
					$org_name=$data[3];
					$org_type=$data[4];
					$website=$data[5];
					
					$sql=$con->query("insert into new_client_master(department_id,employee_id,org_name,org_type,website,status,flow,created_by,created_on)
								values('$department_id','$employee_id','$org_name','$org_type','$website',1,1,'$user_id',NOW())");
								
             }//while

                 fclose($handle);
                 echo "<center class=green>Successfully Imported</center><br/>";


         }//if->csv
            else
            {
                echo "Invalid File";
            }   
			//$c++;
    }//submit

    ?>
	