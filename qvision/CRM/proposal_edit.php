<?php
require '../config.php';
include("../user.php");
$id = $_REQUEST['id'];

$candidateid = $_SESSION['candidateid'];
$userrole = $_SESSION['userrole'];
$id = $_REQUEST['id'];
$stmt = $con->prepare("SELECT a.employee as employee,a.flag as flag,A.client_name as name,e.feedback_date as date,a.client_org as company_name,a.address as location,a.contact as mobile,e.date as follup,d.first_name as first_name,a.status as enquiry_status,a.id as enquiry_id FROM `Crm_calls` A INNER JOIN Calls_master B ON A.Call_type=B.Id INNER Join Z_department_master C ON A.Department=C.Id INNER JOIN Candidate_form_details D ON A.Employee=D.Id INNER JOIN crm_calls_feedback e on a.id=e.calls_id
where a.id='$id' ");

$stmt->execute();
$row = $stmt->fetch();
?>
<div class="card card-info">
   
    <div class="card-header">  
        <center><h3 class="card-title"><b>COST SHEET </b></h3></center>
        <a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
    </div>
    
      <!-- /.card-header -->
    <!-- form start -->
    <form role="form" name="" action="" method="post" enctype="multipart/type">

        <div class="card-body">
            <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo $row['enquiry_id']; ?>">
            <input type="hidden" class="form-control" id="get_emp_id" name="get_emp_id" value="<?php echo $row['employee']; ?>">
            <?php if ($row['flag'] == 2) {
                ?>
                <?php
                $stmt1 = $con->prepare("SELECT * FROM `quotation`
where quotation.Enquire_id='$id'");

                $stmt1->execute();
                $row_stmt1 = $stmt1->fetch();
				
                ?>
                <table class="table table-bordered">
 <tr>
                        <td>Cost Sheet Number</td>
                        <td colspan="2"><input type="text" class="form-control" placeholder="Cost Sheet Number" id="Cost_Sheet_Number" name="Cost_Sheet_Number" id="Cost_Sheet_Number"  value="<?php echo $row_stmt1['cost_sheet_number']; ?>" readonly></td></tr>
                    <tr>
                        <td>Proposal</td>
                        <td colspan="2"><input type="text" class="form-control" placeholder="Proposal For" id="proposal_for" name="proposal_for" id="Client"  value="<?php echo $row_stmt1['proposal']; ?>" ></td>
                        <td>Organization</td>
                        <td colspan="2"><input type="text" class="form-control" placeholder="Client" id="Client" name="Client" id="Client" value="<?php echo $row['company_name']; ?>" ></td>
                    </tr>

                    <tr>
                        <td>Proposal Date</td>
                        <td colspan="2"><input type="text" class="form-control" placeholder="Proposal Date" id="date" name="date" value="<?php echo $row_stmt1['Date']; ?>" ></td>
                    </tr>


                    <tr>
                        <td>Employee Name</td>
                        <td colspan="2">

                            <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $row['first_name']; ?>">
                        </td>
                        <td>Employee Email ID</td>
                        <td colspan="2"><input type="text" id="email_id" name="email_id" class="form-control"  value="<?php echo $row_stmt1['email_id']; ?>"></td>
                    </tr>


                    <tr>
                        <td>Employee Mobile No</td>
                        <td colspan="2">
                            <input type="hidden" id="id" name="id" class="form-control" value="<?php echo $id; ?>">
                            <input type="text" id="tel_no" name="tel_no" class="form-control"  value="<?php echo $row_stmt1['tel_no']; ?>"></td>
                    </tr>


                    <tr>
                        <td>Scope Statement</td>
                        <td colspan="2">
                            <input type="text"  class="form-control" id="scope" name="scope"   value="<?php echo $row_stmt1['scope']; ?>"></td>

                    </tr>

                    <tr>
                        <td>Proposal - Bluebase Software Services Private Limited </td>
                        <td colspan="5">
                            <input type="text"  class="form-control" id="proposal" name="proposal"  value="<?php echo $row_stmt1['Proposal_statement']; ?>">
                        </td>
                    </tr>




                    <tr>
                        <td>Terms & Conditions </td>
                        <td colspan="5">
                            <input type="text"  class="form-control" id="conditions" name="conditions" value="<?php echo $row_stmt1['Conditions']; ?>">

                        </td>
                    </tr>
                    <br>
                    <br>

                </table>
            <?php }
            ?>
			
		 <?php
            $candidateid = $_SESSION['candidateid'];
            $userrole = $_SESSION['userrole'];
            if ($userrole == 'R002' || $userrole == 'R007' || $userrole == 'R016') {
                ?>

                <br>
                <br>
                <?php
                $ph1 = $con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='1' AND cost_totl.Phases='1'");
                $ph1->execute();
               $row_ph1 = $ph1->fetch();
					
                ?>
                   <?php if ($row_ph1) { 
					if ($row_ph1['Phases'] == 1 && $row_ph1['amount_type'] == 1) { 
                    ?>
                    <table class="table table-bordered">


                        <center><h2><b>Cost sheet Entry Details </b></h2></center>

                        <td><b>Phases</b></td>
                        <td>Particulars</b></td>
                        <td><b>Man/hours/days<b></td>
			 <td><b>Amount Type<b></td>
                                    <td><b>Amount<b></td>

                                                <tbody>

                                                    <?php
                                                    $sql_1 = $con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='1' AND cost_totl.Phases='1'");


                                                    $cnt = 1;
                                                    while ($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC)) { 
                                                        ?>
                                                        <?php if ($rows_1['Phases'] == 1 && $rows_1['amount_type'] == 1) {
                                                            ?>
                                                            <tr>
                                                        <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo $rows_1['enquiry_id']; ?>"
														>

                                                         <td >

<select class="form-control" name="phases">


		
		<?php
		$dep_sql=$con->query("SELECT * FROM phases ");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option ><?php echo $dep_sql_res['phases'];?></option>
			<?php
		}
		?>
		</select>
</td>
                                                        <td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo $rows_1['Specification']; ?>" ></td>
                                                        <td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo $rows_1['day']; ?>" ></td>
                                                       <td colspan="1"><select class="form-control" name="amount_type">


		
		<?php
		$dep_sql=$con->query("SELECT * FROM cur ");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option  value="1" ><?php echo $dep_sql_res['cur'];?></option>
			<?php
		}
		?>
		</select></td>
														<td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo $rows_1['Amount']; ?>" ></td>
                                                        </tr>
                                                    <?php } } ?>
                                                    <?php
                                                    $cnt = $cnt + 1;
                                                }
                                                ?>
                                                <?php
                                                $sqlquery_1 = $con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='1' AND cost_totl.Phases='1'");

                                                $sqlquery_1->execute();
                                                $sqlquery_1row = $sqlquery_1->fetch();
                                                ?>
                                                <?php if ($sqlquery_1row['Phases'] == 1 && $sqlquery_1row['amount_type'] == 1) {
                                                    ?>
                                                    <tr>


                                                        <td colspan="3"><center>Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo $sqlquery_1row['total']; ?>" ></td>
                                                    </tr>
                                                    <tr>

                                                        <td colspan="3"><center>IGST</center></td><td colspan="1"><input type="text" class="form-control" id="GST" name="GST" value="28%" ></td>
                                                    </tr>
                                                  
                                                    <tr>
  <?php
                                                    $gst = $sqlquery_1row['total'] * 28 / 100;
                                                    $grant_total = $gst + $sqlquery_1row['total'];
                                                    ?>
                                                        <td colspan="3"><center>Grand Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo $grant_total; ?>" ></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                                </table>
                                            <?php }
                                            ?>
                                            <br>
<?php if ($row_ph1) {
					if ($row_ph1['Phases'] == 1 && $row_ph1['amount_type'] == 2) {
                    ?>
                    <table class="table table-bordered">


                        <center><h2><b>Cost sheet Entry Details </b></h2></center>

                        <td><b>Phases</b></td>
                        <td>Particulars</b></td>
                        <td><b>Man/hours/days<b></td>
			 <td><b>Amount Type<b></td>
                                    <td><b>Amount<b></td>

                                                <tbody>

                                                    <?php
                                                    $sql_1 = $con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='1' AND cost_totl.Phases='1'");


                                                    $cnt = 1;
                                                    while ($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC)) {
                                                        ?>
                                                        <?php if ($rows_1['Phases'] == 1 && $rows_1['amount_type'] == 2) {
                                                            ?>
                                                            <tr>
                                                        <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo $rows_1['enquiry_id']; ?>">

                                                       <td >

<select class="form-control" name="phases">


		
		<?php
		$dep_sql=$con->query("SELECT * FROM phases ");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option ><?php echo $dep_sql_res['phases'];?></option>
			<?php
		}
		?>
		</select>
</td>
                                                        <td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo $rows_1['Specification']; ?>" ></td>
                                                        <td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo $rows_1['day']; ?>" ></td>
                                                      <td colspan="1"><select class="form-control" name="amount_type">


		
		<?php
		$dep_sql=$con->query("SELECT * FROM cur ");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="2"><?php echo $dep_sql_res['cur'];?></option>
			<?php
		}
		?>
		</select></td>
														<td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo $rows_1['Amount']; ?>" ></td>
                                                        </tr>
                                                    <?php } } ?>
                                                    <?php
                                                    $cnt = $cnt + 1;
                                                }
                                                ?>
                                                <?php
                                                $sqlquery_1 = $con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='1' AND cost_totl.Phases='1'");

                                                $sqlquery_1->execute();
                                                $sqlquery_1row = $sqlquery_1->fetch();
                                                ?>
                                                <?php if ($sqlquery_1row['Phases'] == 1 && $sqlquery_1row['amount_type'] == 2) {
                                                    ?>
                                                    <tr>


                                                        <td colspan="3"><center>Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo $sqlquery_1row['total']; ?>" ></td>
                                                    </tr>
                                                    <tr>

                                                        <td colspan="3"><center>GST</center></td><td colspan="1"><input type="text" class="form-control" id="GST" name="GST" value="18%" ></td>
                                                    </tr>
                                                  
                                                    <tr>
  <?php
                                                    $gst = $sqlquery_1row['total'] * 18 / 100;
                                                    $grant_total = $gst + $sqlquery_1row['total'];
                                                    ?>
                                                        <td colspan="3"><center>Grand Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo $grant_total; ?>" ></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                                </table>
                                            <?php }
                                            ?>
                                            <br>
											
                                          <br>
                                            <?php
                                            $ph1 = $con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='2' AND cost_totl.Phases='2'");
                                            $ph1->execute();
                                            $row_ph1 = $ph1->fetch();
                                            ?>
                                            <?php if ($row_ph1) {
												if ($row_ph1['Phases'] == 2 && $row_ph1['amount_type'] == 2) {
                                                ?>

                                                <table class="table table-bordered">


                                                    <td><b>Phases</b></td>
                                                    <td>Specification</b></td>
                                                    <td><b>Man/hours/days<b></td>
                                                             <td><b>Amount Type<b></td>
															   <td><b>Amount<b></td>


                                                                            <tbody>

                                                                                <?php
                                                                                $sql_1 = $con->query("SELECT * FROM  cost_sheet_entry where enquiry_id='$id'");


                                                                                $cnt = 1;
                                                                                while ($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC)) {
                                                                                    ?>
                                                                                    <?php if ($rows_1['Phases'] == 2 && $rows_1['amount_type'] == 2) {
                                                                                        ?>
                                                                                        <tr>
                                                                                    <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo $rows_1['enquiry_id']; ?>">

                                                                                    <td >

<select class="form-control" name="phases">


		
		<?php
		$dep_sql=$con->query("SELECT * FROM phases ");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option ><?php echo $dep_sql_res['phases'];?></option>
			<?php
		}
		?>
		</select>
</td>
                                                                                    <td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo $rows_1['Specification']; ?>" ></td>
                                                                                    <td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo $rows_1['day']; ?>" ></td>
                                                                                  
                                                                                   <td colspan="1"><select class="form-control" name="amount_type">


		
		<?php
		$dep_sql=$con->query("SELECT * FROM cur ");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="2"><?php echo $dep_sql_res['cur'];?></option>
			<?php
		}
		?>
		</select></td>
																				   <td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo $rows_1['Amount']; ?>" ></td>
                                                                                    </tr>
                                                                                <?php } } ?>
                                                                                <?php
                                                                                $cnt = $cnt + 1;
                                                                            }
                                                                            ?>
                                                                            <?php
                                                                            $sqlquery_1 = $con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='2' AND cost_totl.Phases='2'");

                                                                            $sqlquery_1->execute();
                                                                            $sqlquery_1row = $sqlquery_1->fetch();
                                                                            ?>
                                                                            <?php if ($sqlquery_1row['Phases'] == 2 && $sqlquery_1row['amount_type'] == 2) {
                                                                                ?>
                                                                                <tr>

                                                                                    <td colspan="3"><center>Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo $sqlquery_1row['total']; ?>" ></td>
                                                                                </tr>
                                                                                <tr>

                                                                                    <td colspan="3"><center>GST</center></td><td colspan="1"><input type="text" class="form-control" id="GST" name="GST" value="18%" ></td>
                                                                                </tr>
                                                                                <?php
                                                                                $gst = $sqlquery_1row['total'] * 18 / 100;
                                                                                $grant_total = $gst + $sqlquery_1row['total'];
                                                                                ?>
                                                                                <tr>

                                                                                    <td colspan="3"><center>Grand Total</center></td><td colspan="8"><input type="text" class="form-control" id="total" name="total" value="<?php echo $grant_total; ?>" ></td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                            </tbody>

                                                                            </table>
                                                                        <?php } ?>
																		<?php if ($row_ph1) {
												if ($row_ph1['Phases'] == 2 && $row_ph1['amount_type'] == 1) {
                                                ?>

                                                <table class="table table-bordered">


                                                    <td><b>Phases</b></td>
                                                    <td>Specification</b></td>
                                                    <td><b>Man/hours/days<b></td>
                                                             <td><b>Amount Type<b></td>
															   <td><b>Amount<b></td>


                                                                            <tbody>

                                                                                <?php
                                                                                $sql_1 = $con->query("SELECT * FROM  cost_sheet_entry where enquiry_id='$id'");


                                                                                $cnt = 1;
                                                                                while ($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC)) {
                                                                                    ?>
                                                                                    <?php if ($rows_1['Phases'] == 2 && $rows_1['amount_type'] == 1) {
                                                                                        ?>
                                                                                        <tr>
                                                                                    <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo $rows_1['enquiry_id']; ?>">

                                                                                     <td >

<select class="form-control" name="phases">


		
		<?php
		$dep_sql=$con->query("SELECT * FROM phases ");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option ><?php echo $dep_sql_res['phases'];?></option>
			<?php
		}
		?>
		</select>
</td>
                                                                                    <td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo $rows_1['Specification']; ?>" ></td>
                                                                                    <td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo $rows_1['day']; ?>" ></td>
                                                                                  
                                                                                   <td colspan="1"><select class="form-control" name="amount_type">


		
		<?php
		$dep_sql=$con->query("SELECT * FROM cur ");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="1"><?php echo $dep_sql_res['cur'];?></option>
			<?php
		}
		?>
		</select></td>
																				   <td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo $rows_1['Amount']; ?>" ></td>
                                                                                    </tr>
                                                                                <?php } } ?>
                                                                                <?php
                                                                                $cnt = $cnt + 1;
                                                                            }
                                                                            ?>
                                                                            <?php
                                                                            $sqlquery_1 = $con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='2' AND cost_totl.Phases='2'");

                                                                            $sqlquery_1->execute();
                                                                            $sqlquery_1row = $sqlquery_1->fetch();
                                                                            ?>
                                                                            <?php if ($sqlquery_1row['Phases'] == 2 && $sqlquery_1row['amount_type'] == 1) {
                                                                                ?>
                                                                                <tr>

                                                                                    <td colspan="3"><center>Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo $sqlquery_1row['total']; ?>" ></td>
                                                                                </tr>
                                                                                <tr>

                                                                                    <td colspan="3"><center>IGST</center></td><td colspan="1"><input type="text" class="form-control" id="GST" name="GST" value="28%" ></td>
                                                                                </tr>
                                                                                <?php
                                                                                $gst = $sqlquery_1row['total'] * 28 / 100;
                                                                                $grant_total = $gst + $sqlquery_1row['total'];
                                                                                ?>
                                                                                <tr>

                                                                                    <td colspan="3"><center>Grand Total</center></td><td colspan="8"><input type="text" class="form-control" id="total" name="total" value="<?php echo $grant_total; ?>" ></td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                            </tbody>

                                                                            </table>
                                                                        <?php } ?>
                                                                        <br>
                                                                        <br>
                                                                        <?php
                                                                        $ph1 = $con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='3' AND cost_totl.Phases='3'");
                                                                        $ph1->execute();
                                                                        $row_ph1 = $ph1->fetch();
                                                                        ?>
                                                                        <?php if ($row_ph1) {
																			if ($row_ph1['Phases'] == 3 && $row_ph1['amount_type'] == 2) {
                                                                            ?>
                                                                            <table class="table table-bordered">


                                                                                <td><b>Phases</b></td>
                                                                                <td>Specification</b></td>
                                                                                <td><b>Man/hours/days<b></td>
																				 <td><b>Amount Type<b></td>
                                                                                            <td><b>Amount<b></td>

                                                                                                        <tbody>

                                                                                                            <?php
                                                                                                            $sql_1 = $con->query("SELECT * FROM  cost_sheet_entry where enquiry_id='$id'");


                                                                                                            $cnt = 1;
                                                                                                            while ($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC)) {
                                                                                                                ?>
                                                                                                                <?php if ($rows_1['Phases'] == 3 && $rows_1['amount_type'] == 2) {
                                                                                                                    ?>
                                                                                                                    <tr>
                                                                                                                <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo $rows_1['enquiry_id']; ?>">

                                                                                                                <td >

<select class="form-control" name="phases">


		
		<?php
		$dep_sql=$con->query("SELECT * FROM phases ");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option><?php echo $dep_sql_res['phases'];?></option>
			<?php
		}
		?>
		</select>
</td>
                                                                                                                <td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo $rows_1['Specification']; ?>" 
																												></td>
                                                                                                                <td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo $rows_1['day']; ?>" 
																												></td>
																												<td colspan="1"><select class="form-control" name="amount_type">


		
		<?php
		$dep_sql=$con->query("SELECT * FROM cur ");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="2"><?php echo $dep_sql_res['cur'];?></option>
			<?php
		}
		?>
		</select></td>
                                                                                                                <td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo $rows_1['Amount']; ?>" 
																												></td>
                                                                                                                </tr>
                                                                                                            <?php } } ?>
                                                                                                            <?php
                                                                                                            $cnt = $cnt + 1;
                                                                                                        }
                                                                                                        ?>
                                                                                                        <?php
                                                                                                        $sqlquery_1 = $con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='3' AND cost_totl.Phases='3'");

                                                                                                        $sqlquery_1->execute();
                                                                                                        $sqlquery_1row = $sqlquery_1->fetch();
                                                                                                        ?>
                                                                                                        <?php if ($sqlquery_1row['Phases'] == 3 && $sqlquery_1row['amount_type'] == 2) {
                                                                                                            ?>
                                                                                                            <tr>

                                                                                                                <td colspan="3"><center>Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo $sqlquery_1row['total']; ?>" 
																												></td>
                                                                                                            </tr>
                                                                                                            <tr>

                                                                                                                <td colspan="3"><center>GST</center></td><td colspan="1"><input type="text" class="form-control" id="GST" name="GST" value="18%" 
																												></td>
                                                                                                            </tr>
                                                                                                            <?php
                                                                                                            $gst = $sqlquery_1row['total'] * 18 / 100;
                                                                                                            $grant_total = $gst + $sqlquery_1row['total'];
                                                                                                            ?>
                                                                                                            <tr>

                                                                                                                <td colspan="3"><center>Grand Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo $grant_total; ?>" 
																												></td>
                                                                                                            </tr>
                                                                                                        <?php } ?>
                                                                                                        </tbody>

                                                                                                        </table>
                                                                                                        <br>
                                                                                                        <br>
                                                                                                    <?php } ?>
																									<?php if ($row_ph1) {
																			if ($row_ph1['Phases'] == 3 && $row_ph1['amount_type'] == 1) {
                                                                            ?>
                                                                            <table class="table table-bordered">


                                                                                <td><b>Phases</b></td>
                                                                                <td>Specification</b></td>
                                                                                <td><b>Man/hours/days<b></td>
																				 <td><b>Amount Type<b></td>
                                                                                            <td><b>Amount<b></td>

                                                                                                        <tbody>

                                                                                                            <?php
                                                                                                            $sql_1 = $con->query("SELECT * FROM  cost_sheet_entry where enquiry_id='$id'");


                                                                                                            $cnt = 1;
                                                                                                            while ($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC)) {
                                                                                                                ?>
                                                                                                                <?php if ($rows_1['Phases'] == 3 && $rows_1['amount_type'] == 1) {
                                                                                                                    ?>
                                                                                                                    <tr>
                                                                                                                <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo $rows_1['enquiry_id']; ?>">

                                                                                                               <td >

<select class="form-control" name="phases">


		
		<?php
		$dep_sql=$con->query("SELECT * FROM phases ");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option><?php echo $dep_sql_res['phases'];?></option>
			<?php
		}
		?>
		</select>
</td>
                                                                                                                <td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo $rows_1['Specification']; ?>" 
																												></td>
                                                                                                                <td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo $rows_1['day']; ?>" 
																												></td>
																											<td colspan="1"><select class="form-control" name="amount_type">


		
		<?php
		$dep_sql=$con->query("SELECT * FROM cur ");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="1"><?php echo $dep_sql_res['cur'];?></option>
			<?php
		}
		?>
		</select></td>
                                                                                                                <td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo $rows_1['Amount']; ?>" 
																												></td>
                                                                                                                </tr>
                                                                                                            <?php } } ?>
                                                                                                            <?php
                                                                                                            $cnt = $cnt + 1;
                                                                                                        }
                                                                                                        ?>
                                                                                                        <?php
                                                                                                        $sqlquery_1 = $con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='3' AND cost_totl.Phases='3'");

                                                                                                        $sqlquery_1->execute();
                                                                                                        $sqlquery_1row = $sqlquery_1->fetch();
                                                                                                        ?>
                                                                                                        <?php if ($sqlquery_1row['Phases'] == 3 && $sqlquery_1row['amount_type'] == 1) {
                                                                                                            ?>
                                                                                                            <tr>

                                                                                                                <td colspan="3"><center>Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo $sqlquery_1row['total']; ?>" 
																												></td>
                                                                                                            </tr>
                                                                                                            <tr>

                                                                                                                <td colspan="3"><center>IGST</center></td><td colspan="1"><input type="text" class="form-control" id="GST" name="GST" value="28%" 
																												></td>
                                                                                                            </tr>
                                                                                                            <?php
                                                                                                            $gst = $sqlquery_1row['total'] * 28 / 100;
                                                                                                            $grant_total = $gst + $sqlquery_1row['total'];
                                                                                                            ?>
                                                                                                            <tr>

                                                                                                                <td colspan="3"><center>Grand Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo $grant_total; ?>" 
																												></td>
                                                                                                            </tr>
                                                                                                        <?php } ?>
                                                                                                        </tbody>

                                                                                                        </table>
																										   <?php } ?>
                                                                                                        <br>
                                                                                                        <br>
                                                                                                 

                                                                                                   <?php
                                                                        $ph1 = $con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='4' AND cost_totl.Phases='4'");
                                                                        $ph1->execute();
                                                                        $row_ph1 = $ph1->fetch();
                                                                        ?>
                                                                        <?php if ($row_ph1) {
																			if ($row_ph1['Phases'] == 4 && $row_ph1['amount_type'] == 2) {
                                                                            ?>
                                                                            <table class="table table-bordered">


                                                                                <td><b>Phases</b></td>
                                                                                <td>Specification</b></td>
                                                                                <td><b>Man/hours/days<b></td>
																				 <td><b>Amount Type<b></td>
                                                                                            <td><b>Amount<b></td>

                                                                                                        <tbody>

                                                                                                            <?php
                                                                                                            $sql_1 = $con->query("SELECT * FROM  cost_sheet_entry where enquiry_id='$id'");


                                                                                                            $cnt = 1;
                                                                                                            while ($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC)) {
                                                                                                                ?>
                                                                                                                <?php if ($rows_1['Phases'] == 4 && $rows_1['amount_type'] == 2) {
                                                                                                                    ?>
                                                                                                                    <tr>
                                                                                                                <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo $rows_1['enquiry_id']; ?>">

                                                                                                               <td >

<select class="form-control" name="phases">


		
		<?php
		$dep_sql=$con->query("SELECT * FROM phases ");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option ><?php echo $dep_sql_res['phases'];?></option>
			<?php
		}
		?>
		</select>
</td>
                                                                                                                <td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo $rows_1['Specification']; ?>" ></td>
                                                                                                                <td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo $rows_1['day']; ?>" ></td>
																												 <td colspan="1"><select class="form-control" name="amount_type">


		
		<?php
		$dep_sql=$con->query("SELECT * FROM cur ");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="2"><?php echo $dep_sql_res['cur'];?></option>
			<?php
		}
		?>
		</select></td>
                                                                                                                <td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo $rows_1['Amount']; ?>" ></td>
                                                                                                                </tr>
                                                                                                            <?php } } ?>
                                                                                                            <?php
                                                                                                            $cnt = $cnt + 1;
                                                                                                        }
                                                                                                        ?>
                                                                                                        <?php
                                                                                                        $sqlquery_1 = $con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='4' AND cost_totl.Phases='4'");

                                                                                                        $sqlquery_1->execute();
                                                                                                        $sqlquery_1row = $sqlquery_1->fetch();
                                                                                                        ?>
                                                                                                        <?php if ($sqlquery_1row['Phases'] == 4 && $sqlquery_1row['amount_type'] == 2) {
                                                                                                            ?>
                                                                                                            <tr>

                                                                                                                <td colspan="3"><center>Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo $sqlquery_1row['total']; ?>" ></td>
                                                                                                            </tr>
                                                                                                            <tr>

                                                                                                                <td colspan="3"><center>GST</center></td><td colspan="1"><input type="text" class="form-control" id="GST" name="GST" value="18%" ></td>
                                                                                                            </tr>
                                                                                                            <?php
                                                                                                            $gst = $sqlquery_1row['total'] * 18 / 100;
                                                                                                            $grant_total = $gst + $sqlquery_1row['total'];
                                                                                                            ?>
                                                                                                            <tr>

                                                                                                                <td colspan="3"><center>Grand Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo $grant_total; ?>" ></td>
                                                                                                            </tr>
                                                                                                        <?php } ?>
                                                                                                        </tbody>

                                                                                                        </table>
                                                                                                        <br>
                                                                                                        <br>
                                                                                                    <?php } ?>
																									<?php if ($row_ph1) {
																			if ($row_ph1['Phases'] == 4 && $row_ph1['amount_type'] == 1) {
                                                                            ?>
                                                                            <table class="table table-bordered">


                                                                                <td><b>Phases</b></td>
                                                                                <td>Specification</b></td>
                                                                                <td><b>Man/hours/days<b></td>
																				 <td><b>Amount Type<b></td>
                                                                                            <td><b>Amount<b></td>

                                                                                                        <tbody>

                                                                                                            <?php
                                                                                                            $sql_1 = $con->query("SELECT * FROM  cost_sheet_entry where enquiry_id='$id'");


                                                                                                            $cnt = 1;
                                                                                                            while ($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC)) {
                                                                                                                ?>
                                                                                                                <?php if ($rows_1['Phases'] == 4 && $rows_1['amount_type'] == 1) {
                                                                                                                    ?>
                                                                                                                    <tr>
                                                                                                                <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo $rows_1['enquiry_id']; ?>">

                                                                                                               <td >

<select class="form-control" name="phases">


		
		<?php
		$dep_sql=$con->query("SELECT * FROM phases ");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option ><?php echo $dep_sql_res['phases'];?></option>
			<?php
		}
		?>
		</select>
</td>
                                                                                                                <td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo $rows_1['Specification']; ?>" ></td>
                                                                                                                <td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo $rows_1['day']; ?>" ></td>
																								<td colspan="1"><select class="form-control" name="amount_type">


		
		<?php
		$dep_sql=$con->query("SELECT * FROM cur ");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="1"><?php echo $dep_sql_res['cur'];?></option>
			<?php
		}
		?>
		</select></td>
                                                                                                                <td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo $rows_1['Amount']; ?>" ></td>
                                                                                                                </tr>
                                                                                                            <?php } } ?>
                                                                                                            <?php
                                                                                                            $cnt = $cnt + 1;
                                                                                                        }
                                                                                                        ?>
                                                                                                        <?php
                                                                                                        $sqlquery_1 = $con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='4' AND cost_totl.Phases='4'");

                                                                                                        $sqlquery_1->execute();
                                                                                                        $sqlquery_1row = $sqlquery_1->fetch();
                                                                                                        ?>
                                                                                                        <?php if ($sqlquery_1row['Phases'] == 4 && $sqlquery_1row['amount_type'] == 1) {
                                                                                                            ?>
                                                                                                            <tr>

                                                                                                                <td colspan="3"><center>Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo $sqlquery_1row['total']; ?>" ></td>
                                                                                                            </tr>
                                                                                                            <tr>

                                                                                                                <td colspan="3"><center>IGST</center></td><td colspan="1"><input type="text" class="form-control" id="GST" name="GST" value="28%" ></td>
                                                                                                            </tr>
                                                                                                            <?php
                                                                                                            $gst = $sqlquery_1row['total'] * 28 / 100;
                                                                                                            $grant_total = $gst + $sqlquery_1row['total'];
                                                                                                            ?>
                                                                                                            <tr>

                                                                                                                <td colspan="3"><center>Grand Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo $grant_total; ?>" ></td>
                                                                                                            </tr>
                                                                                                        <?php } ?>
                                                                                                        </tbody>

                                                                                                        </table>
																										   <?php } ?>
																										   </br>
																										   </br>
																										   <?php
                                                                        $ph1 = $con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='5' AND cost_totl.Phases='5'");
                                                                        $ph1->execute();
                                                                        $row_ph1 = $ph1->fetch();
                                                                        ?>
                                                                        <?php if ($row_ph1) {
																			if ($row_ph1['Phases'] == 5 && $row_ph1['amount_type'] == 2) {
                                                                            ?>
                                                                            <table class="table table-bordered">


                                                                                <td><b>Phases</b></td>
                                                                                <td>Specification</b></td>
                                                                                <td><b>Man/hours/days<b></td>
																				 <td><b>Amount Type<b></td>
                                                                                            <td><b>Amount<b></td>

                                                                                                        <tbody>

                                                                                                            <?php
                                                                                                            $sql_1 = $con->query("SELECT * FROM  cost_sheet_entry where enquiry_id='$id'");


                                                                                                            $cnt = 1;
                                                                                                            while ($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC)) {
                                                                                                                ?>
                                                                                                                <?php if ($rows_1['Phases'] == 5 && $rows_1['amount_type'] == 2) {
                                                                                                                    ?>
                                                                                                                    <tr>
                                                                                                                <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo $rows_1['enquiry_id']; ?>">

                                                                                                              <td >

<select class="form-control" name="phases">


		
		<?php
		$dep_sql=$con->query("SELECT * FROM phases ");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option ><?php echo $dep_sql_res['phases'];?></option>
			<?php
		}
		?>
		</select>
</td>
                                                                                                                <td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo $rows_1['Specification']; ?>" ></td>
                                                                                                                <td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo $rows_1['day']; ?>" ></td>
																												<td colspan="1"><select class="form-control" name="amount_type">


		
		<?php
		$dep_sql=$con->query("SELECT * FROM cur ");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="2"><?php echo $dep_sql_res['cur'];?></option>
			<?php
		}
		?>
		</select></td>
                                                                                                                <td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo $rows_1['Amount']; ?>" ></td>
                                                                                                                </tr>
                                                                                                            <?php } } ?>
                                                                                                            <?php
                                                                                                            $cnt = $cnt + 1;
                                                                                                        }
                                                                                                        ?>
                                                                                                        <?php
                                                                                                        $sqlquery_1 = $con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='5' AND cost_totl.Phases='5'");

                                                                                                        $sqlquery_1->execute();
                                                                                                        $sqlquery_1row = $sqlquery_1->fetch();
                                                                                                        ?>
                                                                                                        <?php if ($sqlquery_1row['Phases'] == 5 && $sqlquery_1row['amount_type'] == 2) {
                                                                                                            ?>
                                                                                                            <tr>

                                                                                                                <td colspan="3"><center>Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo $sqlquery_1row['total']; ?>" ></td>
                                                                                                            </tr>
                                                                                                            <tr>

                                                                                                                <td colspan="3"><center>GST</center></td><td colspan="1"><input type="text" class="form-control" id="GST" name="GST" value="18%" ></td>
                                                                                                            </tr>
                                                                                                            <?php
                                                                                                            $gst = $sqlquery_1row['total'] * 18 / 100;
                                                                                                            $grant_total = $gst + $sqlquery_1row['total'];
                                                                                                            ?>
                                                                                                            <tr>

                                                                                                                <td colspan="3"><center>Grand Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo $grant_total; ?>" ></td>
                                                                                                            </tr>
                                                                                                        <?php } ?>
                                                                                                        </tbody>

                                                                                                        </table>
                                                                                                        <br>
                                                                                                        <br>
                                                                                                    <?php } ?>
																									<?php if ($row_ph1) {
																			if ($row_ph1['Phases'] == 5 && $row_ph1['amount_type'] == 1) {
                                                                            ?>
                                                                            <table class="table table-bordered">


                                                                                <td><b>Phases</b></td>
                                                                                <td>Specification</b></td>
                                                                                <td><b>Man/hours/days<b></td>
																				 <td><b>Amount Type<b></td>
                                                                                            <td><b>Amount<b></td>

                                                                                                        <tbody>

                                                                                                            <?php
                                                                                                            $sql_1 = $con->query("SELECT * FROM  cost_sheet_entry where enquiry_id='$id'");


                                                                                                            $cnt = 1;
                                                                                                            while ($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC)) {
                                                                                                                ?>
                                                                                                                <?php if ($rows_1['Phases'] == 5 && $rows_1['amount_type'] == 1) {
                                                                                                                    ?>
                                                                                                                    <tr>
                                                                                                                <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo $rows_1['enquiry_id']; ?>">

                                                                                                                <td >

<select class="form-control" name="phases">


		
		<?php
		$dep_sql=$con->query("SELECT * FROM phases ");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option ><?php echo $dep_sql_res['phases'];?></option>
			<?php
		}
		?>
		</select>
</td>
                                                                                                                <td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo $rows_1['Specification']; ?>" ></td>
                                                                                                                <td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo $rows_1['day']; ?>" ></td>
																											<td colspan="1"><select class="form-control" name="amount_type">


		
		<?php
		$dep_sql=$con->query("SELECT * FROM cur ");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="1"><?php echo $dep_sql_res['cur'];?></option>
			<?php
		}
		?>
		</select></td>
                                                                                                                <td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo $rows_1['Amount']; ?>" ></td>
                                                                                                                </tr>
                                                                                                            <?php } } ?>
                                                                                                            <?php
                                                                                                            $cnt = $cnt + 1;
                                                                                                        }
                                                                                                        ?>
                                                                                                        <?php
                                                                                                        $sqlquery_1 = $con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='5' AND cost_totl.Phases='5'");

                                                                                                        $sqlquery_1->execute();
                                                                                                        $sqlquery_1row = $sqlquery_1->fetch();
                                                                                                        ?>
                                                                                                        <?php if ($sqlquery_1row['Phases'] == 5 && $sqlquery_1row['amount_type'] == 1) {
                                                                                                            ?>
                                                                                                            <tr>

                                                                                                                <td colspan="3"><center>Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo $sqlquery_1row['total']; ?>" ></td>
                                                                                                            </tr>
                                                                                                            <tr>

                                                                                                                <td colspan="3"><center>IGST</center></td><td colspan="1"><input type="text" class="form-control" id="GST" name="GST" value="28%" ></td>
                                                                                                            </tr>
                                                                                                            <?php
                                                                                                            $gst = $sqlquery_1row['total'] * 28 / 100;
                                                                                                            $grant_total = $gst + $sqlquery_1row['total'];
                                                                                                            ?>
                                                                                                            <tr>

                                                                                                                <td colspan="3"><center>Grand Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo $grant_total; ?>" ></td>
                                                                                                            </tr>
                                                                                                        <?php } ?>
                                                                                                        </tbody>

                                                                                                        </table>
																										   <?php } ?>
                                                                                                                        <?php } ?>                                                                                                                     

                                                                                                                      </div>


                                    <!-- /.post -->
                                </form>
								                                                       
   <center>                                                                                                                                                         <input type="button" class="btn btn-success" id="save" name="save" onclick="update_proposal()" value="Update Cost Sheet">
        </center>                                                                                                                                                    <br>
                        
                                                                                                                                                            
                            </div>

                            <script>
                                function update_proposal()
                                {
                                    var id = $('#get_id').val();
                                    //alert(id);
                                    var data = $('form').serialize();
									//alert(data)
                                    $.ajax({
                                        type: 'GET',
                                        data: data + "&" + "id=" + id,
                                        url: 'CRM/update_proposal.php',
                                        success: function (data)
                                        {
                                            if (data == 1)
                                            {
                                                alert('Not updated');

                                            } else
                                            {
                                               // alert("Update Successfully");
                                                //cost_sheet_reverse()
                                            }

                                        }
                                    });
                                }
                            </script>
							<script>
							function back_ctc() {
								cost_sheet_reverse()
							}
							</script>
