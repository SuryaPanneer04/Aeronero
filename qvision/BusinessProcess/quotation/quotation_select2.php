<?php
require '../../../connect.php';
require '../../../user.php';
$cs=$_REQUEST['ids'];


$quote=$con->query("select q.*,c.cost_sheet_no,c.enquiry_id from quote_generate q left join cost_sheet_entry c ON q.cost_sheet_id=c.id where q.id='$cs'");
$quote_no=$quote->fetch(PDO::FETCH_ASSOC);
$quoteno=$quote_no['quote_no'];
$enquiry_id = $quote_no['enquiry_id'];

 /* echo "SELECT MAX(id) AS cmax,cost_sheet_no,enquiry_id from cost_sheet_entry where enquiry_id='$enquiry_id'";
$stmtg = $con->query("SELECT MAX(id) AS cmax,cost_sheet_no,enquiry_id from cost_sheet_entry where enquiry_id='$enquiry_id'");
$stmtg->execute();
$rowg        = $stmtg->fetch();
$cc_id = $rowg['cmax'];

$stmtf = $con->query("SELECT cost_sheet_no,enquiry_id from cost_sheet_entry where id='$cc_id'");
$stmtf->execute();
$rowf        = $stmtf->fetch(); */
 
$cost_sheet_nos = $quote_no['cost_sheet_no'];

	
$stmt = $con->query("SELECT a.id as costsheet_id,a.cost_sheet_no as cst_no,a.*,b.*,e.*,f.*,g.*,h.*,i.employee as acc_manager,b.org_name as cname,p.*,ci.*,s.* from cost_sheet_entry a 
		 left join new_client_master b on(b.id=a.client_id) 
		 left join new_plant_master p on b.org_name=p.client_org_name
		 left join states s on p.state=s.id
		 left join cities ci on p.city=ci.id
		 left join product_services f on (f.id = a.business_id)
		left join staff_master e ON e.candid_id=a.candid_id 
		left join z_user_master g ON (g.candidate_id = e.id)
		left join quote_generate h on(h.cost_sheet_no=a.cost_sheet_no)
		left join Enquiry i on (a.enquiry_id=i.id)
		where a.cost_sheet_no='$cost_sheet_nos' and a.status ='3' ");
	 	
 
$stmt->execute();
$row        = $stmt->fetch();
$company_id = $row['company_id'];
$enquiry_id = $row['enquiry_id'];
$quote_type = $row['quote_type'];
$cost_sheet_no = $row['cst_no'];

$design_id  = $row['design_id'];
$acc_manager  = $row['acc_manager'];
//$quote_type = $row['quote_type'];
// Create a function for converting the amount in words
function AmountInWords($amount)
{
    $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
    // Check if there is any number after decimal
    $amt_hundred = null;
    $count_length = strlen($num);
    $x = 0;
    $string = array();
    $change_words = array(
        0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
    );
    $here_digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    while ($x < $count_length) {
        $get_divider = ($x == 2) ? 10 : 100;
        $amount = floor($num % $get_divider);
        $num = floor($num / $get_divider);
        $x += $get_divider == 10 ? 1 : 2;
        if ($amount) {
            $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
            $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
            $string[] = ($amount < 21) ? $change_words[$amount] . ' ' . $here_digits[$counter] . $add_plural . ' 
       ' . $amt_hundred : $change_words[floor($amount / 10) * 10] . ' ' . $change_words[$amount % 10] . ' 
       ' . $here_digits[$counter] . $add_plural . ' ' . $amt_hundred;
        } else $string[] = null;
    }
    $implode_to_Rupees = implode('', array_reverse($string));
    $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
    return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
}
//$cst_no=$row ['cost_sheet_no'];
?>


<style>
    .form-control {

        width: 60px !important;
    }

    .row1 {
        border: 1px solid black;
    }

    .row2 {
        height: 6px;
    }

    .table>tbody {
        width: 300px;
    }

    .table-bordered>tbody>tr>td,
    .table-bordered>tbody>tr>th,
    .table-bordered>tfoot>tr>td,
    .table-bordered>tfoot>tr>th,
    .table-bordered>thead>tr>td,
    .table-bordered>thead>tr>th {
        padding: 4px;
        border: none;
    }

    .border>tbody>tr>td,
    .border>tbody>tr>th,
    .border>tfoot>tr>td,
    .border>tfoot>tr>th,
    .border>thead>tr>td,
    .border>thead>tr>th {

        border: 1px solid black;
    }

    .m_b_0px {
        margin-bottom: 0px !important;
    }

    #leftbox {
        float: left;
    }

    #middlebox {
        float: left;
        margin-left: 400px;
    }

    #rightbox {
        float: right;
    }
	
</style>

<div class="row">
<div class="col-xs-2">
<!--<b>Quote Type : </b>-->
</div>
<div class="col-xs-4">
<!--<select class="form-control" id="mail_type" onchange="mail_typefun(this.value)" style="width: 191px !important;margin-left: 20px;" name="mail_type" required="true"> <!--onchange="showDiv(this)"-->
					<!--<option disabled selected>Choose Type</option>
					<option value="1">Static Quote</option>
					<option value="2">Alternative Quote</option>
				</select>-->
</div>
<!--<div class="col-xs-2" style="margin-left: 20px;">
<b>Client Mail ID : </b>
</div>
<div class="col-xs-4">
<input type="text" style="width: 553px !important;margin-left: 20px;" class="form-control" id="sendermail" name="sendermail" placeholder="Enter Client Mail ID">
</div>-->
</div>
<section class="wage_content"></section>
<section class="content" id="content">
 
    <div class="container-fluid">
        <div class="row">
		
            <div class="card-body">

               


                <div class="col-sm-12">
                    <!--<div class="col-sm-12"  style="text-align:left;">
	   <img src="../../ss-information/images/04.png" alt="ssinformation">$cc_id
	</div>-->


<!--<div id="regularform">--->
						<div class="col-sm-12 row2"  style="text-align:right;">
	  <input type ="hidden" name="costsheet_id" id ="costsheet_id" value="<?php echo $cc_id; ?>">
	  
	 
	  <a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>BACK</a> &nbsp;&nbsp;
	   <!--<input type="button" class="btn btn-success" id="save" name="save" onclick="mail_send()"  value="Send Mail"> -->
	  <?php /* if($row ['flag']==0){ ?>
	    
	  <?php }elseif($row ['flag']==1) { ?>
	   <input type="button" class="btn btn-success" id="save" name="save" onclick="quote_rewise()"  value="Rewise Quote">
	  <?php } */ ?>
	   <!--<input type="print" class="btn btn-success" id="print" name="print" onclick="window.print()"  value="print">-->
	   &nbsp;<br/><br/>
	</div>
						
                       
						
                        <?php /* if($row ['flag']==0){ ?>
	    
	  <?php }elseif($row ['flag']==1) { ?>
	   <input type="button" class="btn btn-success" id="save" name="save" onclick="quote_rewise()"  value="Rewise Quote">
	  <?php } */ ?>
                        <!--<input type="print" class="btn btn-success" id="print" name="print" onclick="window.print()"  value="print">-->
                        &nbsp;<br /><br />
                   


                    <table id="dataTable" width="350px" border="1" style="border-collapse:collapse;border: 1px solid !important;" class="table border m_b_0px">
                        <h4 align="center"><b><u>QUOTATION</u></b></h4>



                        <tr>
                            <td colspan='10' style="padding:10px;">
                                <h4>
                                    <b>SS Information Systems Private Limited</b><br /><br />
                                    No.1/102, First Floor, Periyar Pathai (West),<br>
                                    100 Feet Road, Arumbakkam,Chennai,Tamil-Nadu 600 106
                            </td>
                        </tr>
                        <tr>
                            <td colspan='4' style="padding:10px;"><b>Company E-Mail : </b>info@ssinformation.in</td>
                            <!--<td><b>GST NO : </b>33AAACQ0129P1ZG</td>-->
                            <td colspan='6'><b>Company Phone No : </b>044 2362 3544</td>
                        </tr>
                        <tr>
                            <td colspan='4' style="padding:10px;"><b>Quote. NO : </b><?php echo $row['quote_no']; ?><br /><br />
                                <b>Currency : </b><?php $quote_type = $row['quote_type'];
                                                    if ($quote_type == '1') {
                                                        echo "INDIAN RUPEES";
                                                    } else {
                                                        echo "Dollar RUPEES";
                                                    } ?>
                            </td>

                            <?php $query1 =  $con->prepare("select a.*,b.*,c.* from staff_master a inner join designation_master b on 
		                  (b.id = a.design_id) inner join z_user_master c on (c.candidate_id=a.id) where a.id = '$acc_manager'");

                            $query1->execute();
                            $row4 = $query1->fetch();
                            ?>


                            <td colspan='3'>
                                <b>Acct Manager : </b><?php echo $row['emp_name']; ?><br /><br />
                                <b>Mobile Number : </b><?php echo $row['mobile_no']; ?><br /><br />
                                <b>Email : </b> <?php echo $row4['email_id']; ?> <br /><br />
                            </td>

                            <td colspan='3'>
                                <b>Date : </b><?php echo $quote_date = date('d-m-Y', strtotime($row['quote_date'])); ?> <br /><br />

                            </td>
                        </tr>

                        <tr style="border:1px solid black; padding:10px;">
                            <td colspan='10' style="padding:10px;">
                                <b><u>Client Name & Details </u></b><br />
                                <?php echo $row['org_name']; ?> </b><br />
                                <b>Contact Person : </b> <?php echo $row['contact_person']; ?><br />


                                <b> Address : </b><br><?php echo $row['address']; ?>,<br />
                                <?php echo $row['area']; ?>,<?php echo $row['city_name']; ?>,<?php echo $row['pincode']; ?>,<br /><?php echo $row['statename']; ?></b><br />
                                <b>Mobile No : </b><?php echo $row['mobile_no']; ?><br /><br />
                                <b>Dear Sir,</b><br />
                                As per your requirement, please find attached below our proposal
                            </td>
                        </tr>

                       <tr>
				  <th>S.No</th>
				  <th>SPECIFICATION</th>
				  <th>QTY</th>
				  <!--th>UNIT</th-->
				  <th>UNIT RATE</th>
				  <th>TOTAL</th>
				  
				  <th>GST PERCENTAGE</th>
				  <th>GST AMOUNT</th>
				  
				  <th>IGST PERCENTAGE</th>
				  <th>IGST AMOUNT</th>
				  
				 
				  <th>TOTAL WITH GST</th>
				</tr>
                        <?php
                        $query = $con->query("SELECT a.id as costsheet_id,a.*,b.*,e.* from cost_sheet_entry a 
				 inner join new_client_master b on(b.id=a.client_id) 
				 inner join staff_master e ON e.candid_id=a.candid_id
				 where a.status ='3' and a.cost_sheet_no='$cost_sheet_no' order by a.id desc");


                        $sum_total = 0;
                        $cnt = 1;
                        while ($quote = $query->fetch(PDO::FETCH_ASSOC)) {
                            $net_amt    = $quote['net_amt'];
                            $gst_per    = $quote['gst_per'];
                            $gst_amt    = $quote['gst_amt'];
                            $igst_per    = $quote['igst_per'];
                            $igst_amount    = $quote['igst_amount'];
                            $grand_totals = $quote['grand_amt'];

                            //$sum_total+= $quote['total_price'];
                            $gst    = $row['gst_per'];
                            $withgst     = ($net_amt) * ($gst / 100);

                            $grand_total = round($withgst + $net_amt);



                            if ($gst == '18') {
                                $SGST_cal  = ($net_amt) * (9 / 100);
                            } elseif ($gst == '28') {
                                $SGST_cal  = ($net_amt) * (14 / 100);
                            } elseif ($gst == '3') {
                                $SGST_cal  = ($net_amt) * (1.5 / 100);
                            } elseif ($gst == '5') {
                                $SGST_cal  = ($net_amt) * (2.5 / 100);
                            } elseif ($gst == '12') {
                                $SGST_cal  = ($net_amt) * (6 / 100);
                            } else {
                                $SGST_cal = ($net_amt) * (0 / 100);
                            }

                            if ($gst == '18') {
                                $CGST_cal  = ($net_amt) * (9 / 100);
                            } elseif ($gst == '28') {
                                $CGST_cal  = ($net_amt) * (14 / 100);
                            } elseif ($gst == '3') {
                                $CGST_cal  = ($net_amt) * (1.5 / 100);
                            } elseif ($gst == '5') {
                                $CGST_cal  = ($net_amt) * (2.5 / 100);
                            } elseif ($gst == '12') {
                                $CGST_cal  = ($net_amt) * (6 / 100);
                            } else {
                                $CGST_cal = ($net_amt) * (0 / 100);
                            }

                            if ($gst == '18') {
                                $sgst_per =  "9 %";
                            } elseif ($gst == '28') {
                                $sgst_per =  "14%";
                            } elseif ($gst == '3') {
                                $sgst_per =  "1.5%";
                            } elseif ($gst == '5') {
                                $sgst_per =  "2.5%";
                            } elseif ($gst == '12') {
                                $sgst_per =  "6%";
                            }

                            if ($gst == '18') {
                                $cgst_per =  "9 %";
                            } elseif ($gst == '28') {
                                $cgst_per =  "14%";
                            } elseif ($gst == '3') {
                                $cgst_per =  "1.5%";
                            } elseif ($gst == '5') {
                                $cgst_per =  "2.5%";
                            } elseif ($gst == '12') {
                                $cgst_per =  "6%";
                            }
                            $totalamt = $quote['total_amt'];
                            echo "<br/>";
                            $iteam_rate = $totalamt / $quote['qty'];
                            //echo $quote['total_amt'];

                            //$logengcom =$quote['log_amt']+$quote['eng_amt']+$quote['com_amt'];

                            $tax_amount = $SGST_cal + $CGST_cal + $igst_amount;
                        ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td>
                                    <INPUT type="hidden" id="cost_sheet_no" name="cost_sheet_no" class="form-control" value="<?php echo $quote['cost_sheet_no']; ?>" readonly="readonly">
                                    <?php echo $quote['specification']; ?>
                                </td>
                                <td><?php echo $quote['qty']; ?></td>
                                <!--td><!?php echo $quote['unit']; ?></td-->
                                <td><?php echo $iteam_rate; ?></td>
                                <td><?php echo $quote['total_amt']; ?></td>
                                <td><?php echo $quote['gst_per']; ?>%</td>
                                <td><?php echo $quote['gst_amt']; ?></td>
                                <td><?php echo $quote['igst_per']; ?>%</td>
                                <td><?php echo $quote['igst_amount']; ?></td>
                                <td><?php echo $quote['total_gst']; ?></td>



                                <!--<td>
					<INPUT type="button" class="btn btn-success" value="Add " onclick="addRow('dataTable')" />
					<INPUT type="button" class="btn btn-danger" value="Delete" onclick="deleteRow('dataTable')" />
				   </td>-->
                            </tr>
                        <?php $cnt = $cnt + 1;
                        } ?>
                        <tr>
                            <td colspan="8" align="center"><b>Net Amount</b></td>

                            <td align="left" colspan="5"><?php echo number_format($net_amt, 2); ?>
                            </td>
                        </tr>
                        <!--<tr>

                            <td colspan="4" align="center"><b>GST Persentage < ?php echo $gst_per; ?>%</b></td>

                            <td colspan="5" align="left">< ?php echo number_format($gst_amt, 2); ?></td>
                        </tr>
                        <tr>
                        <tr>
                            <td colspan="4" align="center"><b>IGST Persentage < ?php echo $igst_per; ?>%</b></td>
                            <td colspan="5" align="left">< ?php echo number_format($igst_amount, 2); ?></td>
                        </tr>-->
                        <tr>
                            <td colspan="8" align="center"><b>Grand Total</b></td>
                            <td colspan="2" align="left">
                                <?php echo number_format($grand_totals, 2); ?>
                            </td>
                        </tr>


                        <tr style="border-bottom-style: hidden;">
                            <TD colspan="10" style="text-align:left;"> <b>Tax Summary</b> </TD>
                        </tr>
						<?php
						$queryd =  $con->prepare("SELECT cost_sheet_no, SUM(gst_amt) as gst_score,SUM(igst_amount) as igst_score from cost_sheet_entry where cost_sheet_no='$cost_sheet_no'");

                            $queryd->execute();
                            $rowd = $queryd->fetch();
                            $gst_score=$rowd['gst_score'];
                            $igst_score=$rowd['igst_score'];
							$total_score=$gst_score+$igst_score;
                            $gst_split=$gst_score/2;
							
                            $first_score=$gst_split;
                            $second_score=$gst_split;
							
						
						?>
                        <tr>
                            <TD colspan="10">
                                <u>
                                    <h5 style="font-weight: bold;margin-left: 600px;"> Tax Details : </h5>
                                </u><br />
                                <div style="margin-left: 610px;">
                                    <div class="row">
                                        <div class="col-md-3">SGST </div>
                                        <!--<div class="col-md-2"> < ?php echo $sgst_per; ?> </div>-->
                                        <div class="col-md-5"> <?php echo $first_score; ?> </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-md-3">CGST </div>
                                        <!--<div class="col-md-2"> < ?php echo $cgst_per; ?> </div>--> 
                                        <div class="col-md-5"> <?php echo $second_score; ?> </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-md-3">IGST </div>
                                        <!--<div class="col-md-2"> < ?php echo $igst_per; ?> </div>-->
                                        <div class="col-md-5"> <?php echo $igst_score; ?> </div>
                                    </div>
                                    <br />
                                    ....................................................................................... <br />
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h5 style="font-weight: bold;margin-left: 10px;"> Tax Amount :
                                        </div>
                                        <div class="col-md-3"><?php echo number_format($total_score, 2); ?>
                                            <h5 />
                                        </div>
                                    </div>
                                    ....................................................................................... <br />
                                </div>
                            </TD>
                        </tr>
                    </table>


                    <tr style="page-break-after: always;">
                        <td>E. & O.E</td>
                    </tr>

                    <br>

                    <?php
                    $stmt = $con->query("select * from terms_and_condition where cost_sheet_no='$cost_sheet_no'");
                    //echo "select * from terms_and_condition where cost_sheet_no ='$cost_sheet_no'";
                    $stmt->execute();
                    $row_fetch = $stmt->fetch();


                    ?>
                    <br>
                    <div style="text-align:left;">
                        <img src="/ssinfo1/images/04.png" alt="ssinformation">
                    </div>
                    <div style="text-align:center;font-weight:bold;"><b><u>QUOTATION</u></b></div><br />
                    <div style="font-size:15px;min-width:708px;min-height:500px;border-top: 1px solid black;border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;">

                        <div style="padding: 10px;">
                            <div> <u><b>Terms and Condition</b></u> </div>
                            <br />

                            <div class="row">
                                <div class="col-md-1 txtcolor"> VALIDITY </div>
                                <div class="col-md-1 txtcolor"> : </div>
                                <div class="col-md-9"> <?php echo $row_fetch['validity']; ?> </div>
                            </div>
                            <br />

                            <div class="row">
                                <div class="col-md-1 txtcolor"> IMPORTANT </div>
                                <div class="col-md-1 txtcolor"> : </div>
                                <div class="col-md-10"> <?php echo $row_fetch['important']; ?> </div>
                            </div>
                            <br />

                            <div class="row">
                                <div class="col-md-1 txtcolor"> DELIVERY </div>
                                <div class="col-md-1 txtcolor"> : </div>
                                <div class="col-md-10"> <?php echo $row_fetch['delivery']; ?> </div>
                            </div>
                            <br />

                            <div class="row">
                                <div class="col-md-1 txtcolor">WARRANTY </div>
                                <div class="col-md-1 txtcolor"> : </div>
                                <div class="col-md-10"> <?php echo $row_fetch['warrenty']; ?> </div>
                            </div>
                            <br />

                            <div class="row">
                                <div class="col-md-1 txtcolor">PAYMENT </div>
                                <div class="col-md-1 txtcolor"> : </div>
                                <div class="col-md-10"> <?php echo $row_fetch['payment']; ?> </div>
                            </div>
                            <br />




                            <div>
                                <b><u>BANK DETAILS FOR NEFT / RTGS / IMPS</u></b>
                            </div>
                            <br />

                            <div class="row">
                                <div class="col-md-2 txtcolor"> ACC HOLDER NAME </div>
                                <div class="col-md-1 txtcolor"> : </div>
                                <div class="col-md-4"> <?php echo $row_fetch['acc_holder_name']; ?> </div>
                            </div>
                            <br />

                            <div class="row">
                                <div class="col-md-2 txtcolor"> BANK NAME </div>
                                <div class="col-md-1 txtcolor"> : </div>
                                <div class="col-md-4"> <?php echo $row_fetch['bank_name']; ?> </div>
                            </div>
                            <br />

                            <div class="row">
                                <div class="col-md-2 txtcolor"> BRANCH NAME </div>
                                <div class="col-md-1 txtcolor"> : </div>
                                <div class="col-md-4"> <?php echo $row_fetch['branch_name']; ?></div>
                            </div>
                            <br />

                            <div class="row">
                                <div class="col-md-2 txtcolor"> CURRENT A/C NO </div>
                                <div class="col-md-1 txtcolor"> : </div>
                                <div class="col-md-4"> <?php echo $row_fetch['account_no']; ?> </div>
                            </div>
                            <br />

                            <div class="row">
                                <div class="col-md-2 txtcolor"> IFSC CODE </div>
                                <div class="col-md-1 txtcolor"> : </div>
                                <div class="col-md-4"> <?php echo $row_fetch['ifsc_code']; ?> </div>
                            </div>
                            <br />

                        </div>

                        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
                        <div style="width: 100%;border-top: 1px solid black;border-bottom: 1px solid black;height:100px;">
                            <div style="width: 50%; height: 100px; float: left;border-right: 1px solid black;">
                                <div style="min-height:30px"><br /><br />
                                </div>
                                <div style="border-top: 1px solid black;min-height:30px;padding: 10px;">
                                    <br />
                                    <?php $grand_totalz = number_format(round($grand_totals), 2);
                                    echo $get_amount = AmountInWords($grand_totals); ?>
                                </div>
                            </div>
                            <div style="height: auto;margin-left:50%;">

                                <div style="width: 100%; padding: 10px;">
                                    <div style="width: 85%; height: 70px; float: left;">

                                        <!--<div class="row">
                                            <div class="col-md-3 txtcolor"> Amount </div>
                                            <div class="col-md-3 txtcolor"> : </div>
                                            <div> < ?php echo $net_amt; ?> </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-3 txtcolor"> Tax </div>
                                            <div class="col-md-3 txtcolor"> : </div>
                                            <div> < ?php echo round($tax_amount, 2); ?> </div>
                                        </div>-->


                                        <div class="row">
                                            <div class="col-md-3 txtcolor"> Net Amount </div>
                                            <div class="col-md-3 txtcolor"> : </div>
                                            <div> <?php echo round($grand_totals, 2); ?> </div>
                                        </div>


                                    </div>
                                </div>

                            </div>

                        </div>
                        <div style="margin-left:65%;justify-content: center;">
                            <br />
                            <?php $query1 =  $con->prepare("select a.*,b.*,c.*,f.position as desg from staff_master a left join designation_master b on 
		                  (a.design_id=b.id) left join z_user_master c on (a.id=c.candidate_id) left join candidate_form_details f on (a.candid_id=f.id) where a.id = '$acc_manager'");
                            /* echo "select a.*,b.*,c.* from staff_master a inner join designation_master b on 
		                  (b.id = a.design_id) inner join z_user_master c on (c.candidate_id=a.id) where a.id = '$acc_manager'"; */
                            //echo "select designation_name from designation_master where id ='$design_id'";
                            $query1->execute();
                            $row1 = $query1->fetch();
                            ?>
                            <div style="font-weight:bold;"><?php echo $row1['emp_name']; ?></div>
                            <div style="font-weight:bold;"><?php echo $row1['desg']; ?></div>
                            <div style="font-weight:bold;">Mobile No : <?php echo $row1['mobile_no']; ?></div>
                            <div style="font-weight:bold;">Email Id : <?php echo $row1['email_id']; ?></div>
                            <br />
                        </div>
                    </div>

                </div>
                </div>
				 
            </div>
        </div>
    </div>
	 <input type="hidden" name="costsheet_id" id="costsheet_id" value="<?php echo $cc_id; ?>">
                    <input type="hidden" name="enquiry_id" id="enquiry_id" value="<?php echo $enquiry_id; ?>">
    <!--<div id="extraform">
	<form method="POST" name="add_name" id="add_name" enctype="multipart/form-data">
                    <input type="hidden" name="costsheet_id" id="costsheet_id" value="< ?php echo $cc_id; ?>">
                    <input type="hidden" name="enquiry_id" id="enquiry_id" value="< ?php echo $enquiry_id; ?>">
                    <label>ADD FILE : </label><input type="file" name="extra_file" id="extra_file" style="margin-left: 20px;">
                    <input type="submit" name="submit" id="submit" onclick="mailhidefun(1,this.value)" class="btn btn-info" value="Add" />
			
					<input type="button" class="btn btn-success" id="save" name="save" onclick="mail_send_post()" value="Send Mail">
                </form>
				 </div>-->
</section>
<script>
function mail_typefun(v)
{
	//alert(v)
if(v==1){
	document.getElementById('extraform').style.display = "none";
	document.getElementById('regularform').style.display = "block";
}else{
	document.getElementById('regularform').style.display = "none";
	document.getElementById('extraform').style.display = "block";
}
	
}
</script>
<script>
function mailhidefun(c){
	if(c==1){
		document.getElementById('mailhide').style.display = "none";
	}else{
		document.getElementById('mailhide').style.display = "block";
	}
	
}
</script>
<script>

    $(document).ready(function() {
        //alert('ff'); 
        $("form[name='add_name']").on("submit", function(ev) {
            ev.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "/ssinfo1/qvision/BusinessProcess/quotation/name.php",
                method: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    alert('File Upload Successfully');

                }
            });
        });
    });
</script>
<script>
    function mail_send() {
        var data = $('form').serialize();
        /* var extra_file = document.getElementById("extra_file").value; */
        /* var mail_type = document.getElementById("mail_type").value;

		if(mail_type=='Choose Type'){
			alert("Please Select Mail Type");
			return false;
		}*/
		var sendermail = document.getElementById("sendermail").value;
		if (sendermail==''){
			alert("Please Enter the Mail ID");
			return false;
		} 
		
        var id = document.getElementById("costsheet_id").value;
        $('.wage_content').html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');
        document.getElementById('content').style.display = "none";
        $.ajax({
            type: 'GET',
            data:'id='+id+'&sendermail='+sendermail,
            url: "qvision/BusinessProcess/quotation/quotation_mail_post.php",
            success: function(data) {
                alert("Quote Details has been send successfully...");
                enquiry()

            }
        });
    }

function mail_send_post() {
        var data = $('form').serialize();
        var extra_file = document.getElementById("extra_file").value;
		var mail_type = document.getElementById("mail_type").value;

		if(mail_type=='Choose Type'){
			alert("Please Select Mail Type");
			return false;
		}
		
        var sendermail = document.getElementById("sendermail").value;

if(extra_file==''){
			alert("Please Choose the Quotation File")
			return false;
		}

        var id = document.getElementById("costsheet_id").value;
        $('.wage_content').html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');
        document.getElementById('content').style.display = "none";
        $.ajax({
            type: 'GET',
			data:'id='+id+'&sendermail='+sendermail,
            url: "qvision/BusinessProcess/quotation/quotation_extra_post.php",
            success: function(data) {
                alert("Quote Details has been send successfully...");
                enquiry()

            }
        });
    }



    function back()

    {
        quotation_view()

    }

    function quoateedit() {
        alert()
        var enquiry_id = document.getElementById("enquiry_id").value;
        alert(enquiry_id)
        $.ajax({
            url: "/ssinfo1/qvision/BusinessProcess/quotation/name.php",
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                alert('File Upload Successfully');

            }
        });
    }
</script>
