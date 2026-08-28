<?php
require '../../../connect.php';
include("../../../user.php");
$id = $_REQUEST['id'];
$userrole = $_SESSION['userrole'];

$stmt = $con->prepare("SELECT a.id as enquiry_id,a.status as enquiry_status,
c.id as dep_id,d.id as candi_id,a.Company_name as comp_name,a.*,b.*,c.*,d.*  FROM `enquiry` a
	   join calls_master b ON a.Call_type=b.id
	   join z_department_master c ON a.Department=c.id
	   join candidate_form_details d ON a.employee=d.id
where a.id='$id'");

$stmt->execute();
$row = $stmt->fetch();

$enquiry_id = $row['enquiry_id'];
$company_name = $row['company_name'];
?>

<div class="card card-info">
	<div class="card-header">
		<center>
			<h3 class="card-title"><b>PLANT DETAILS FORM</b></h3>
		</center>
		<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"></i>Back</a>
	</div>

	<form method="POST" name="form" id="form" action="" autocomplete="off">
		<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
		<table class="table table-bordered">
			<tr>
				<td>
					<center><img src="/KerliERP/Recruitment/image/userlog/quadsel.png" style="width:200px;height:100px;"></center>
				</td>
				<td colspan="5">
					<center>
						<h1><b>Bluebase Software Services Private Limited</b></h1>
					</center>
				</td>
			</tr>
			<table class="table table-bordered" id="new_tab">
				<tr>
					<td>Client Org Name*</td>
					<td colspan="5">
						<select required aria-required="true" class="form-control" onChange="existing_record(this.value)" id="txt_org_name" name="txt_org_name">
							<option value="">Choose Org Name</option>
							<?php $stmt3 = $con->query("SELECT id,org_type,org_name FROM new_client_master order by id DESC");
							while ($row3 = $stmt3->fetch()) { ?>
								<option value="<?php echo $row3['org_type'] . '-' . $row3['org_name'] . '-' . $row3['id']; ?>"> <?php echo $row3['org_name']; ?></option>
							<?php }  ?>
						</select>
					</td>
				</tr>
				<div id="product_detail">
				</div>

				<tr>
					<td>Location</td>
					<td colspan="4"><input type="hidden" class="form-control" id="idee" name="idee" value="<?php echo $enquiry_id; ?>"><input type="text" class="form-control" id="Locationz" name="Locationz" placeholder="Enter Plant Locationz" onchange="pan()" required></td>
				</tr>
				<tr>
					<td>GST Partition</td>
					<td>
						<input type="text" id='ist' name="ist" maxlength="2" onchange="fcity()">
					</td>
					<td>
						<input type="text" id="sec" name="sec" maxlength="10">
					</td>
					<td>
						<input type="text" id="third" name="third" maxlength="3" onchange="gst()">
					</td>
				</tr>
				<tr id="txt_gst_noo">
					<td>GST NO</td>
					<td colspan="4"><input type="text" class="form-control gst form-control mandatory" style="text-transform:uppercase" id="txt_gst_no" name="txt_gst_no" onclick="makerCheckerField()" maxlength="15" readonly></td>
					<input type="hidden" name="txt_duplicate_gstno" id="txt_duplicate_gstno">
				</tr>

				<tr>
					<td>Company Address</td>
					<td colspan="4"><input type="text" class="form-control" id="txt_address_1" name="txt_address_1" placeholder=" Enter The Address"></td>
				</tr>
				<tr>
					<td>State*</td>
					<td colspan="5">
						<input type="text" class="form-control" id="state" name="state">
						<input type="hidden" class="form-control" id="state_id" name="state_id">
					</td>
				</tr>
				<td>City*</td>
				<tr>
					<td colspan="5"><select class="form-control" name="city_1" id="city_1" required>
						</select></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2"><input type="text" class="form-control " id="txt_area_1" name="txt_area_1" placeholder="Area"></td>
					<td colspan="2"><input type="text" class="form-control pin" id="txt_pincode_1" name="txt_pincode_1" placeholder="Pincode"></td>
				</tr>
				<tr>
					<td>IT Department</td>
					<td colspan="2"><input type="mail" class="form-control " id="txt_client_name_1" name="txt_client_name_1" placeholder="Client name"></td>
					<td colspan="2"><input type="text" class="form-control " id="txt_client_desig_1" name="txt_client_desig_1" placeholder="Client Designation"></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2"><input type="text" class="form-control mob" id="txt_mobileone_1" maxlength="10" name="txt_mobileone_1" placeholder="Enter Your Mobile Number"></td>
					<td colspan="2"><input type="text" class="form-control amob" id="txt_mobiletwo_1" maxlength="10" name="txt_mobiletwo_1" placeholder="Enter Your alternate mobile number"></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2"><input type="mail" class="form-control mail" id="txt_mail_idone_1" name="txt_mail_idone_1" placeholder="Enter Your Mail id"></td>
					<td colspan="2"><input type="mail" class="form-control amail" id="txt_mail_idtwo_1" name="txt_mail_idtwo_1" placeholder="Enter Your alternate Mail id"></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="4"><input type="text" class="form-control " id="txt_landno_1" name="txt_landno_1" placeholder="Land Line No"></td>
				</tr>
				<tr>
					<td>Purchase Department</td>
					<td colspan="2"><input type="text" class="form-control " id="pur_name_1" name="pur_name_1" placeholder="Name"></td>
					<td colspan="2"><input type="text" class="form-control " id="pur_designation_1" name="pur_designation_1" placeholder="Designation"></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2"><input type="text" class="form-control " id="pur_contact_1" name="pur_contact_1" placeholder="Contact Number"></td>
					<td colspan="2"><input type="mail" class="form-control purmail" id="pur_mail_1" name="pur_mail_1" placeholder="MailId"></td>
				</tr>
				<tr>
					<td>Finance Department</td>
					<td colspan="2"><input type="text" class="form-control " id="fin_name_1" name="fin_name_1" placeholder="Name"></td>
					<td colspan="2"><input type="text" class="form-control " id="fin_designation_1" name="fin_designation_1" placeholder="Designation"></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2"><input type="text" class="form-control " id="fin_contact_1" name="fin_contact_1" placeholder="Contact Number"></td>
					<td colspan="2"><input type="mail" class="form-control finmail" id="fin_mail_1" name="fin_mail_1" placeholder="MailId"></td>
				</tr>
				<tr>
					<td>Shipping Address</td>
					<td colspan="2"><input type="text" class="form-control " id="ship_address" name="ship_address" placeholder="Enter Shipping Address"></td>
					<td colspan="1"><select required aria-required="true" class="form-control" id="ship_location" name="ship_location">
							<option value="" selected disabled hidden>Choose Shipping Address</option>
							<?php $sqlx = $con->query("SELECT statename,id,country_id FROM   states  where country_id=101 order by statename ASC");
							while ($rowq = $sqlx->fetch()) { ?>
								<option value="<?php echo $rowq['id']; ?>"> <?php echo $rowq['statename']; ?></option>
							<?php }  ?>
						</select></td>
					<td colspan="1"><input type="number" class="form-control " id="ship_pincode" name="ship_pincode" placeholder="pincode"></td>
				</tr>
				<tr>
					<td>Billing Address</td>
					<td colspan="2"><input type="text" class="form-control " id="bill_address" name="bill_address" placeholder="Enter Billing Address"></td>
					<td colspan="1"><select required aria-required="true" class="form-control" id="bill_location" name="bill_location">
							<option value="" selected disabled hidden>Choose Shipping Address</option>
							<?php $sql = $con->query("SELECT statename,id,country_id FROM   states  where country_id=101 order by statename ASC");
							while ($rowv = $sql->fetch()) { ?>
								<option value="<?php echo $rowv['id']; ?>"> <?php echo $rowv['statename']; ?></option>
							<?php }  ?>
						</select></td>
					<td colspan="1"><input type="text" class="form-control pin" id="bill_pincode" name="bill_pincode" placeholder="pincode" maxlength="6"></td>
				</tr>
				<tr>
					<td>Status*</td>
					<td colspan="4">
						<select required aria-required="true" class="form-control" name="status_1" id="status_1">
							<option value="">Select Status</option>
							<option value="1">Active</option>
							<option value="0">InActive</option>
						</select>
					</td>
				</tr>

			</table>
		</table>
		<div style="text-align:right;">
			<input type="button" name="save" value="SAVE" onclick="plant_insert(event)" class="btn btn-primary btn-md">
			<br />
		</div>
	</form>


	<script>
		function existing_record(c) {

			jQuery.ajax({
				url: "qvision/CRM/calls/plant_fetch.php",
				type: "GET",
				data: {
					client: c
				},
				dataType: "html",
				success: function(data) {
					var split = data.split("=");
					$('#txt_client_name_1').val(split[0]);
					$('#txt_mobileone_1').val(split[1]);
					$('#txt_mobiletwo_1').val(split[2]);
					$('#txt_mail_idone_1').val(split[3]);
					$('#txt_mail_idtwo_1').val(split[4]);
					//$('#ship_address').val(split[5]);

					$('#txt_client_name_1').attr('readonly', 'readonly');
					$('#txt_mobileone_1').attr('readonly', 'readonly');
					$('#txt_mobiletwo_1').attr('readonly', 'readonly');
					$('#txt_mail_idone_1').attr('readonly', 'readonly');
					$('#txt_mail_idtwo_1').attr('readonly', 'readonly');
					//$('#ship_address').attr('readonly', 'readonly');
				}
			});
		}
	</script>


	<script type="text/javascript">
		//Pincode Validation
		$(document).ready(function() {
			$(".pin").change(function() {
				var inputvalues = $(this).val();
				var regex = /^(\d{4}|\d{6})$/;
				if (!regex.test(inputvalues)) {
					$(".pin").val("");
					alert("Please Enter Valid PINCODE");
					return regex.test(inputvalues);
				}
			});

			//Mobile Number Validation      
			$(".mob").change(function() {
				var inputvalues = $(this).val();
				var regex = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
				if (!regex.test(inputvalues)) {
					$(".mob").val("");
					alert("Please Enter Valid Mobile Number");
					return regex.test(inputvalues);
				}
			});

			$(".amob").change(function() {
				var inputvalues = $(this).val();
				var regex = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
				if (!regex.test(inputvalues)) {
					$(".amob").val("");
					alert("Please Enter Valid Alternate Mobile Number");
					return regex.test(inputvalues);
				}
			});

			//Mail validations           
			$(".mail").change(function() {
				var inputvalues = $(this).val();
				var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if (!regex.test(inputvalues)) {
					$(".mail").val("");
					alert("Please Enter Valid IT Mail ID");
					return regex.test(inputvalues);
				}
			});

			$(".amail").change(function() {
				var inputvalues = $(this).val();
				var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if (!regex.test(inputvalues)) {
					$(".amail").val("");
					alert("Please Enter Valid Alternate Mail ID");
					return regex.test(inputvalues);
				}
			});

			$(".purmail").change(function() {
				var inputvalues = $(this).val();
				var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if (!regex.test(inputvalues)) {
					$(".purmail").val("");
					alert("Please Enter Valid Purchase Mail ID");
					return regex.test(inputvalues);
				}
			});

			$(".finmail").change(function() {
				var inputvalues = $(this).val();
				var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if (!regex.test(inputvalues)) {
					$(".finmail").val("");
					alert("Please Enter Valid Finance Mail ID");
					return regex.test(inputvalues);
				}
			});

			//PAN NUMBER validation            
			$(".pan").change(function() {
				var inputvalues = $(this).val();
				var regex = "[A-Z]{5}[0-9]{4}[A-Z]{1}";
				if (!regex.test(inputvalues)) {
					$(".pan").val("");
					alert("Please Enter Valid PAN Number");
					return regex.test(inputvalues);
				}
			});

			//GST validation      
			$(".gst").change(function() {
				var inputvalues = $(this).val();
				var gstinformat = new RegExp('^([0][1-9]|[1-2][0-9]|[3][0-7])([a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9a-zA-Z]{1}[zZ]{1}[0-9a-zA-Z]{1})+$');
				if (gstinformat.test(inputvalues)) {
					return true;
				} else {
					alert('Please Enter Valid GST Number');
					$(".gst").val('');
					$(".gst").focus();
				}
			});

			$('#Department').on('change', function() {
				var department_id = this.value;
				//alert(department_id);
				$.ajax({
					url: "qvision/masters/client_master/find_emp.php",
					type: "POST",
					data: {
						department_id: department_id
					},
					cache: false,
					success: function(result) {
						$("#employee").html(result);
					}
				});
			});
		});

		function gst() {
			var cc = document.getElementById("ist").value;
			var pann = document.getElementById("sec").value;
			var third = document.getElementById("third").value;
			var gst = cc + pann + third;

			document.getElementById("txt_gst_no").value = gst;
		}



		function plant_insert(event) {
			var data = $('form').serialize();


			var gst_value = document.getElementById("txt_gst_no").value;


			var orge_type = document.getElementById("txt_org_name").value;

			var state_type = document.getElementById("state").value;


			var city_type = document.getElementById("city_1").value;
			var pin = document.getElementById("txt_pincode_1").value;
			var itname = document.getElementById("txt_client_name_1").value;


			if (orge_type == '') {
				alert("Please Enter Organization Type");
				event.preventDefault();
			}
			if (city_type == '') {
				alert("Please Select City");
				event.preventDefault();
			}
			if (pin == '') {
				alert("Please Enter Pin Code");
				event.preventDefault();
			}
			if (itname == '') {
				alert("Please Enter IT Client Name");
				event.preventDefault();
			}
			var status = document.getElementById("status_1").value;

			if (status == '') {
				alert("Please Select Plant Status");
				event.preventDefault();
			}


			$orge_type_value = orge_type.split("-");


			$.ajax({
				type: 'GET',
				data: data,
				url: 'qvision/CRM/calls/plant_submit.php',
				success: function(result) {
					//alert(result)
					if (result == 1) {

						alert("Plant Details Added Successfully");

						Cost_sheet()
					} else if (result == 2) {

						alert("Please Fill All Correct Details");

						Cost_sheet()
					} else {
						event.preventDefault();

					}
				}
			});

		}


		function back_ctc() {
			Cost_sheet()
		}




		//client type

		function client_typestatus(value) {
			if (value == '7') {
				//alert(1);
				document.getElementById('txt_gst_noo').style.visibility = "hidden";
				document.getElementById('txt_pan_noo').style.visibility = "visible";
			} else {
				//alert(2);
				document.getElementById('txt_pan_noo').style.visibility = "hidden";
				document.getElementById('txt_gst_noo').style.visibility = "visible";
			}
		}

		function getcitydata(v, c) {

			//alert(c);


			$.ajax({
				url: "qvision/masters/client_master/find_city.php?state_id=" + c,
				type: "GET",
				success: function(data) {

					$("#city_" + v).html(data);
				}
			});
		}

		function getgstdata(v, c) {
			var states_id = document.getElementById("state_1").value;
			var companys = document.getElementById("txt_org_name").value;
			orge_type_value = companys.split("-");

			var company = orge_type_value[1];

			$.ajax({
				url: "qvision/masters/client_master/find_gst.php?city_id=" + c + "&states_id=" + states_id + "&company=" + company,
				type: "GET",
				dataType: 'json',
				success: function(data) {
					$.each(data, function(index, element) {
						$('#txt_gst_no').val(element.gst_no);

						var gst_value = document.getElementById("txt_gst_no").value;

						if (gst_value != "") {
							$('#txt_gst_no').attr('readonly', 'readonly');
						} else {
							$('#txt_gst_no').removeAttr('readonly');
						}
					});
				}
			});
		}


		function pan() {
			var client = document.getElementById("txt_org_name").value;

			jQuery.ajax({

				url: "qvision/masters/client_master/find_pan.php",

				type: "GET",
				data: {

					client: client
				},
				dataType: "html",
				success: function(data) {
					jQuery('#sec').val(data);
				}
			});

		}


		$("#ist").keyup('#state', function() {
			var cc = document.getElementById("ist").value;

			jQuery.ajax({

				url: "qvision/masters/client_master/state_name.php",

				type: "GET",
				data: {

					cc: cc
				},
				dataType: "html",
				success: function(data) {
					var arr = data.split('-');

					jQuery('#state').val(arr[0]);
					jQuery('#state_id').val(arr[1]);

				}
			});
		});




		// $("#ist").keyup(function(){
		// var state_id = document.getElementById("state_id").value;
		// console.log(state_id)
		// alert(state_id)
		// jQuery.ajax({

		// url: "masters/client_master/find_city.php",

		// type: "GET",
		// data: {

		// client: state_id
		// },
		// dataType: "html",
		// success: function(data) {

		// $('#city_1').html(data);
		// } 
		// });         
		// });

		function fcity() {

			var state_id = document.getElementById("state_id").value;
			jQuery.ajax({
				url: "qvision/masters/client_master/find_city.php",
				type: "GET",
				data: {
					client: state_id
				},
				dataType: "html",
				success: function(data) {
					$('#city_1').html(data);
				}
			});
		}
	</script>