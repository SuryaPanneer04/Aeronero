<?php
require 'config.php';
include("user.php");
$username= $_SESSION['username'];	
$username;

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
     <title>Employee</title>
    <!-- Favicon icon -->
	
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="assets/libs/select2/dist/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/libs/jquery-minicolors/jquery.minicolors.css">
    <link rel="stylesheet" type="text/css"
        href="assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/libs/quill/dist/quill.snow.css">
    <link href="dist/css/style.min.css" rel="stylesheet">
	<link rel="stylesheet" href="summernote/summernote-bs4.css">
	
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<style>
body
{
	font-family: "Caudex, Sans-serif" !important;
text-transform: Capitalize !important;
font-size: 20px !important;
    font-weight: 400 !important;
	font-style: normal !important;
    --e-global-typography-text-font-family: "Roboto" !important;
    --e-global-typography-text-font-weight: 400 !important;
    --e-global-typography-accent-font-family: "Roboto" !important;
}
</style>
<style>
#navbarSupportedContent{
background: white !important;
}
#main-wrapper .left-sidebar[data-sidebarbg=skin5]
{
background: #fa4753   !important;
}
 #main-wrapper .left-sidebar[data-sidebarbg=skin5] ul {
 background: #fa4753   !important;
 }
 #main-wrapper .topbar .top-navbar .navbar-header[data-logobg=skin5]{
 background: #fa4753  !important;
 }
 .sidebar-nav ul .sidebar-item.selected>.sidebar-link{
 background: #fa4753   !important;
 }
 #main-wrapper .topbar[data-navbarbg=skin5]{
 background:#fa4753   !important;
 }
</style>
<style>
.footer {
   left: 0 !important;
   bottom: 0 !important;
   width: 100% !important;
   background-color: #80808026 !important;
   color: white !important;
   text-align: center !important;
   padding:6px;
}
</style>
<style>
* {box-sizing: border-box}

/* Set height of body and the document to 100% */
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial;
}

/* Style tab links */
.tablink {
  background-color: #555;
  color: white;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 19px;
  width: 18%;
}

.tablink:hover {
  background-color: #777;
}

/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
  color: black;
  display: none;
  padding: 100px 20px;
  height: 700%;
  min-height: 950px;
    max-height: 305px;
}

#Home {background-color: #aaa4b7a3;}
#News {background-color: white;}
#Contact {background-color: #aaa4b7a3;}
#About {background-color: #aaa4b7a3;}
#About1 {background-color: #aaa4b7a3;}
tbody{
	border-color: black !important;
}
.table{
border-color: black !important;
}
.table thead th{
	color: black !important;
    font-weight: 700 !important;
   
}
.table-striped>tbody>tr:nth-of-type(odd){
	color: black !important;
    font-weight: 700 !important;
}
.table>:not(caption)>*>*{
	background-color: white !important;
}
.btn-success{
	color: white !important;
    background-color: #fa4753 !important;
    border-color: #fa4753 !important;
}
</style>
<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
       <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark" style="position: fixed;width: 100%;">
                <div class="navbar-header" data-logobg="skin5">
                    
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index.php">
                        <!-- Logo icon -->
                        <b class="logo-icon ps-2">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            

                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text" style="font-size: 21px;">
                            <!-- dark Logo text -->
<h3 style="color:white;background-color:#fa4753 !important;left: 37px;position: relative;">Employee</h3>	
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-start me-auto">
                        <li class="nav-item d-none d-lg-block"><a
                                class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                                data-sidebartype="mini-sidebar"><i style="color:#fa4753  !important;" class="mdi mdi-menu font-24"></i></a></li>
                       
                        <li class="nav-item d-none d-lg-block">
						
						<h4 style="color: #fa4753 ;position: absolute;top: 20px;"> <?php echo $username;?></h4>
						</li>
                    </ul>
					
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-end">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                       
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                       <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="image/1.jpg" alt="user" class="rounded-circle" width="31">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="profile.php"><i class="ti-user me-1 ms-1"></i>
                                    My Profile</a>
                            
                                <a href="logout.php" class="dropdown-item" ><i
                                        class="fa fa-power-off me-1 ms-1"></i> Logout</a>
										
										<a href="reset-password.php" class="dropdown-item" ><img src="image/forgot.png" style="width: 8%;top: 0px;position: relative;"> Change Password</a>
                                <div class="dropdown-divider"></div>
                              
                            </ul>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
         <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="pt-4">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                                    class="hide-menu">Dashboard</span></a></li>
							<!--	 <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="product_master.php" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span
                                    class="hide-menu">Add New Products</span></a></li>-->
                      <!-- 	<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="product_master.php" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span
                                    class="hide-menu">Employeer</span></a></li>-->
										<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="product_master1.php" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span
                                    class="hide-menu">Employee</span></a></li>
									<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="product_approval.php" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span
                                    class="hide-menu">View Requesting</span></a></li>
									<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="project_work.php" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span
                                    class="hide-menu">Project Work</span></a></li>
									
									<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="project_work1.php" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span
                                    class="hide-menu">Project Status</span></a></li>
									
									 <!--<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                                href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span
                                    class="hide-menu">Reports </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
										 <li class="sidebar-item"><a href="vendor_product_view_details.php" class="sidebar-link"><i
                                            class="mdi mdi-all-inclusive"></i><span class="hide-menu">Vendor Product Details
                                        </span></a></li>
										<li class="sidebar-item"><a href="vendor_review_products.php" class="sidebar-link"><i
                                            class="mdi mdi-all-inclusive"></i><span class="hide-menu">Vendor Review Details
                                        </span></a></li>
										<li class="sidebar-item"><a href="vendor_enquiry_products.php" class="sidebar-link"><i
                                            class="mdi mdi-all-inclusive"></i><span class="hide-menu">Vendor Enquiry Details
                                        </span></a></li>
                            </ul>
                        </li>-->
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
           
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
           <br>
	
	<button class="tablink" onclick="openPage('Home', this, 'rgb(42 97 179)')" style="margin-left: 20px;margin-top: 20px;" id="defaultOpen">Personal Profile</button>
<button class="tablink" style="margin-top: 20px;" onclick="openPage('News', this, 'rgb(42 97 179)')" >Educational Qualification</button>
<button class="tablink" style="margin-top: 20px;" onclick="openPage('Contact', this, 'rgb(42 97 179)')">Work Experience</button>
<button class="tablink" style="margin-top: 20px;" onclick="openPage('About', this, 'rgb(42 97 179)')">Professional Profile</button>
<button class="tablink"  style="margin-top: 20px;" onclick="openPage('About1', this, 'rgb(42 97 179)')">Reference</button>

<div id="Home" class="tabcontent">
  		 <div class="row">
                    <div class="col-md-9">
					<div class="row" style="width: 135%;">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
					 <div class="form-group">  
                     <form name="add_name" id="add_name" enctype="multipart/form-data">  
					  <div class="form-group row">
                                        <div class="col-md-12">
                                          <h3 style="text-align: center;background: #fa4753 ;color: white;height: 43px;line-height: 38px;">Personal Profile</h3>
                                        </div>
                                    </div>
					  <div class="form-group row">
                                       <div class="row">
			<div class=" row col-md-12">
			 <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">First Name</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="First Name" name="first_name" class="form-control" id="inputEmail3">
    </div>
  
   <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Last Name</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Last Name" name="last_name" class="form-control" id="inputEmail3">
    </div>
  
  </div>
  </div>
      </div>
	  
	   <div class="form-group row">
                                       <div class="row">
			<div class=" row col-md-12">
			 <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">DOB</label>
	</div>
    <div class="col-md-3">
      <input type="date" placeholder="Date Of Birth" name="dob" class="form-control" id="inputEmail3">
    </div>
  
   <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Contact Number</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Contact Number" name="contact_number" class="form-control" id="inputEmail3">
    </div>
  
  </div>
  </div>
      </div>
	  
	  
	  <div class="form-group row">
                                       <div class="row">
			<div class=" row col-md-12">
			 <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Alternate Contact Number</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Alternate Contact Number" name="alternate_contact_number" class="form-control" id="inputEmail3">
    </div>
  
   <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">WhatsApp Number</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="WhatsApp Number" name="whatsapp_number" class="form-control" id="inputEmail3">
    </div>
  
  </div>
  </div>
      </div>
	  
	  
	    <div class="form-group row">
                                       <div class="row">
			<div class=" row col-md-12">
			 <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Email ID</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Email ID" name="email_id" class="form-control" id="inputEmail3">
    </div>
  
   <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Alternate Email ID</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Alternate Email ID" name="alternate_email_id" class="form-control" id="inputEmail3">
    </div>
  
  </div>
  </div>
      </div>
	  
	  
	  <div class="form-group row">
                                       <div class="row">
			<div class=" row col-md-12">
			 <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Gender</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Gender" name="gender" class="form-control" id="inputEmail3">
    </div>
  
   <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Differently Abled</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Differently Abled" name="differently_abled" class="form-control" id="inputEmail3">
    </div>
  
  </div>
  </div>
      </div>
	  
	  
	   <div class="form-group row">
                                       <div class="row">
			<div class=" row col-md-12">
			 <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Languages Known</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Example : Tamil,English" name="languages_known" class="form-control" id="inputEmail3">
    </div>
  
   <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Marital Status</label>
	</div>
    <div class="col-md-3">
	
	
<select  class="form-control" name="marital_status">
<option value="">Select Marital Status</option>
<option value="Married">Married</option>
<option value="Unmarried">Unmarried</option>
</select>
    </div>
  
  </div>
  </div>
      </div>
	  
	    <div class="form-group row">
                                       <div class="row">
			<div class=" row col-md-12">
			 <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Permanent Address</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Permanent Address" name="permanent_address" class="form-control" id="inputEmail3">
    </div>
  
   <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Home Town</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Home Town" name="home_town" class="form-control" id="inputEmail3">
    </div>
  
  </div>
  </div>
      </div>
	  <div class="form-group row">
                                       <div class="row">
			<div class=" row col-md-12">
			 <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Do you have Passport</label>
	</div>
   
	<div class="col-md-1">
  <input type="radio" name="chkbox[]" value="Yes">
  <label>Yes
</label>
</div>
<div class="col-md-2">
  <input type="radio" name="chkbox[]" value="No">
  <label>No
</label>
</div>

  
   <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Upload Passport size Photo</label>
	</div>
    <div class="col-md-3">
      <input type="file" placeholder="" name="passport_image" class="form-control" id="inputEmail3">
    </div>
  
  </div>
  </div>
      </div>
	  
	  <div class="form-group row">
                                       <div class="row">
			<div class=" row col-md-12">
			
    <div class="col-md-3">
	<label for="inputEmail3" style="font-weight:700 !important;">Country</label>
	<select class="form-control" name="country" id="country" onchange="getstatedata(this.value);">
					<option value="">Choose Country</option>
					<?php $stmt = mysqli_query($mysqli,"SELECT id,countries_name FROM countries");
					while ($row = mysqli_fetch_array ($stmt)) {?>
					<option value="<?php echo $row['id']; ?>"> <?php echo $row['countries_name']; ?> </option>
					<?php } ?>
					</select>
				<input type="hidden" value="<?php echo$username;?>" name="emp_id" id="emp_id">	
			
    </div>
  
   
    <div class="col-md-3">
	<label for="inputEmail3" style="font-weight:700 !important;">State</label>
      <select class="form-control" name="State" id="State" onchange="getcitydata(this.value)" required>
	  <option value="">Choose State</option>
	  </select>
    </div>
	
	 <div class="col-md-3">
	 <label for="inputEmail3" style="font-weight:700 !important;">City</label>
      <select  placeholder="City" name="city" class="form-control"   id="city">
	  <option value="">Choose City</option>
	  </select>
    </div>
	  
  </div>
  </div>
      </div>
	  
	  
	  <div class="form-group row">
                                       <div class="row">
			<div class=" row col-md-12">
	  <div class="col-md-12">
	 <span style="font-weight: 700;">Work Permit For Other Countries</span>
<input type="button" value="Yes"  onclick="ShowHideDiv(this)" />
<input type="button" value="No" onclick="ShowHideDiv(this)" />
<div id="dvPassport" style="display: none">
    <input type="text" name="work_permit_country" id="txtPassportNumber" />
</div>
    </div>
  
  </div>
  </div>
      </div>
			
								  <input type="submit" name="submit" id="submit" style="float: right;" class="btn btn-info" value="Submit" /> 
                     </form>  
                </div> 
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div id="News" class="tabcontent">
 <div class="form-group row">
                                        <div class="col-md-12">
                                          <h3 style="text-align: center;background: #fa4753 ;color: white;height: 43px;line-height: 38px;">Educational Qualification</h3>
                                        </div>
                                    </div>
  <form name="education" id="education" method="POST">
        <div class="container" style="margin-left:-11px;">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th style="text-align: left;">Educational Qualification Details</th>
                        <th><input type="button" class="add-row btn btn-primary" value="Add Row"> - <button type="button" class="delete-row btn btn-danger">Delete Row</button></th>
                    </tr>					
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">
                            <table class="table table-bordered table-striped">
                                <tbody id="stud_details">
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Education</th>
                                        <th>Name Of Institution</th>
                                        <th>Degree</th>
                                        <th>Field Of Specialization</th>
                                        <th>Year Of Passout</th>
                                        <th>Percentage</th>
                                        <th>Certifications</th> 
										
                                        <th>Upload</th>  
                                    </tr>               
                                    <tr>													
                                        <td><input  type='checkbox' name='record[]'></td>
                                        <td><input style="width:220px;" type='text' name='stud_name[]'></td>
                                        <td><input style="width:250px;" type='text' name='stud_department[]'></td>
                                        <td><input style="width:90px;" type='text' name='degree[]'></td>
                                        <td><input style="width:120px;" type='text' name='specialization[]'></td>
                                        <td><input style="width:110px;" type='text' name='passout[]'></td>
                                        <td><input style="width:100px;" type='text' name='percentage[]'></td>
                                        <td><input style="width:180px;" type='text' name='certifications[]'></td>
										
                                        <td><input style="width:180px;" type='file' id='certificationzoho_1' name='certificationzoho[]'></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>					
                </tbody>
            </table>
        </div>
		<input type="submit" name="submit" id="submit" class="btn btn-success"  style="float: right;" value="Submit">
		</form>
</div>
<script type="text/javascript">
// For Adding and Deleting New Row start -----------------------------------------------------------
$(document).ready(function()
{  
    $(".add-row").click(function()
    {  
	
        var html  = "";
        html     += "<tr><td><input type='checkbox' name='record[]'></td>";			
        html     += "<td><input type='text' style='width:220px;' name='stud_name[]'></td><td><input style='width:250px;' type='text' name='stud_department[]'></td><td><input type='text' style='width:90px;' name='degree[]'></td><td><input style='width:120px;' type='text' name='specialization[]'></td><td><input type='text' style='width:110px;' name='passout[]'></td><td><input style='width:100px;' type='text' name='percentage[]'></td><td><input style='width:180px;' type='text' name='certifications[]'></td><td><input style='width:180px;' id='certificationzoho_1' type='file' name='certificationzoho[]'></td></tr>";			
 
        $("table tbody#stud_details").append(html);
    });
 
    // Find and remove selected table rows
    $(".delete-row").click(function()
    {
        var row_count         = $("#stud_details").find('input[name="record[]"]').length;
        var checked_row_count = $('[name="record[]"]:checked').length;
 
        if(row_count != checked_row_count)
        {
            $("#stud_details").find('input[name="record[]"]').each(function()
            {
                if($(this).is(":checked"))
                {
                    $(this).parents("#stud_details tr").remove();
                }
            });
        }
        else
        {
            alert("All rows can't be deleted");
            return false;
        }
    });	



  $("form[name='education']").on("submit", function(ev) {
		 ev.preventDefault();
var formData = new FormData(this);	  
           $.ajax({  
                url:"save.php",  
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
    processData: false,
                success:function(data)  
                {  
                    alert('Educational Qualification Form Added Successfully.Please fill out the Work Experience form'); 
                     $('#education')[0].reset();  
                }  
           });  
      });  
	  
	  }); 
</script>


<div id="Contact" class="tabcontent">
  <div class="row">
                    <div class="col-md-9">
					<div class="row" style="width: 135%;">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
					 <div class="form-group"> 
	

<div id="myRadioGroup">
      <label for="inputEmail3" style="font-weight:700 !important;">Work Status : </label>
   &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="cars" checked="checked" value="twoCarDiv"  /> Fresher
    
    &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="cars" value="threeCarDiv" />  Experience
   
    <div id="twoCarDiv" class="desc">
        
    </div>
    <div id="threeCarDiv" class="desc">
	
	
	<form name="work" id="work" method="POST">
        <div class="container" style="margin-left:-11px;">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th style="text-align: left;">Work Experience</th>
                        <th><input type="button" class="add-row btn btn-success" onclick="check()" value="Add Row"> - <button type="button" class="delete-row1 btn btn-danger">Delete Row</button></th>
                    </tr>					
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">
                            <table id="new_tab" class="table table-striped table-bordered">
							<tbody id="stud_details1">
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Industry</th>
                                        <th>Organization</th>
                                        <th>Designation</th>
                                       <!-- <th>Skills</th>-->
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>No Of Years and Months Experience</th>  
										<th>Technology</th>  
										<th>CTC</th>  
										<th>Currently Working (If yes please enter the notice period)</th>  
										
                                    </tr>               
                                    <tr>													
                                        <td><input  type='checkbox' id="chk1" name='chk[]'></td>
                                        <td><input style="width:100px;" type='text' id="stud_name1" name='stud_name1[]'></td>
                                        <td><input style="width:100px;" type='text' id="stud_department1" name='stud_department1[]'></td>
                                        <td><input style="width:100px;" type='text' id="degree1" name='degree1[]'></td>
                                        <!--<td><input style="width:80px;" type='text' id="specialization1" name='specialization1[]'></td>-->
                                        <td><input style="width:170px;" type='date' id='fromdate_1' name='passout1[]'></td>
                                        <td><input style="width:170px;" type='date' id='todate1' name='percentage1[]'  onchange='compvalue(1,this.value)'></td>
                                        <td><input style="width:100px;" type='text' id='experience_1' name='certifications1[]'></td>
                                        <td><input style="width:100px;" type='text' id="technology1" name='certifications2[]'></td>
                                        <td><input style="width:100px;" type='text' id="ctc1" name='certifications3[]'></td>
                                        <td><input style="width:120px;" placeholder='Notice Period' id="notice1" type='text' name='certifications4[]'></td>
										
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>					
                </tbody>
            </table>
        </div>
		<input type="submit" name="submit" id="submit" class="btn btn-success" name="save"  style="float:right;" value="Submit">
		</form>
	<script type="text/javascript">
// For Adding and Deleting New Row start -----------------------------------------------------------
$(document).ready(function()
{  
    // Find and remove selected table rows
    $(".delete-row1").click(function()
    {
        var row_count         = $("#stud_details1").find('input[name="chk[]"]').length;
        var checked_row_count = $('[name="chk[]"]:checked').length;
 
        if(row_count != checked_row_count)
        {
            $("#stud_details1").find('input[name="chk[]"]').each(function()
            {
                if($(this).is(":checked"))
                {
                    $(this).parents("#stud_details1 tr").remove();
                }
            });
        }
        else
        {
            alert("All rows can't be deleted");
            return false;
        }
    });	

// For Adding and Deleting New Row close ----------------------------------------------------------->

	
	$("form[name='work']").on("submit", function(ev) {
		 ev.preventDefault();
		 var id=document.getElementById('emp_id').value;
		// alert(id)
		 
var formData = new FormData(this);	
//alert(formData)  
//return false;
           $.ajax({  
                url:"save1.php",  
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
    processData: false,
                success:function(data)  
                {  
                    alert('Work Experience Form Added Successfully.Please fill out the Professional Profile form'); 
                    $('#work')[0].reset();  
                }  
           });  
      });  
	  
	  }); 
</script>
	
	<script type="text/javascript">
// For Adding and Deleting New Row start -----------------------------------------------------------
function check()
    {  
	var len=$('#new_tab tr').length;	
    len=len+0; 
	//alert(len);
	$('#new_tab').append('<tr class="row_'+len+'"><td><input type="checkbox" name="chk[]" id="chk_'+len+'" value="'+len+'"></td><td><input type="text"  style="width:100px;" name="stud_name1[]" id="stud_name'+len+'" class="form-control"></td><td><input type="text" style="width:100px;" id="stud_department'+len+'" name="stud_department1[]"></td><td><input type="text" style="width:100px;" id="degree'+len+'" name="degree1[]"></td><td> <input type="date" style="width:170px;" id="fromdate_'+len+'" name="passout1[]"></td><td> <input type="date"  style="width:170px;" id="todate'+len+'" name="percentage1[]" onchange="compvalue('+len+',this.value)"></td><td><input type="text" style="width:100px;" id="experience_'+len+'" name="certifications1[]"></td><td><INPUT type="text" style="width:100px;" id="technology'+len+'" name="certifications2[]"></td><td> <INPUT type="text"  style="width:100px;" id="ctc'+len+'" name="certifications3[]"></td><td> <INPUT type="text"  style="width:120px;" placeholder="Notice Period" id="notice'+len+'" name="certifications4[]"></td></tr>'); 
										
    }
	</script>
    </div>
</div>
<script>
$(document).ready(function() {
    $("div.desc").hide();
    $("input[name$='cars']").click(function() {
        var test = $(this).val();
        $("div.desc").hide();
        $("#" + test).show();
    });
});
</script>                   
                </div> 
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div id="About" class="tabcontent">
   <div class="row">
                    <div class="col-md-9">
					<div class="row" style="width: 135%;">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
					 <div class="form-group">  
                     <form name="professional" id="professional" enctype="multipart/form-data">  
					  <div class="form-group row">
                                        <div class="col-md-12">
                                          <h3 style="text-align: center;background: #fa4753 ;color: white;height: 43px;line-height: 38px;">Professional Profile</h3>
                                        </div>
                                    </div>
					  <div class="form-group row">
                                       <div class="row">
			<div class=" row col-md-12">
			 <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Linkedin Link</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Linkedin Link" name="linkedin_link" class="form-control" id="linkedin_link">
    </div>
  
   <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Resume Link</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Resume Link" name="resume_link" class="form-control" id="resume_link">
    </div>
  
  </div>
  </div>
      </div>
	  
	   <div class="form-group row">
                                       <div class="row">
			<div class=" row col-md-12">
			 
 <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Resume Upload</label>
	</div>
    <div class="col-md-3">
      <input type="file" placeholder="" name="resume_upload" class="form-control" id="resume_upload">
    </div>
   <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Skills Required</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Skills" name="skills" class="form-control" id="resume_link">
    </div>
  </div>
  </div>
      </div>
								  <input type="submit" name="submit" id="submit" style="float: right;" class="btn btn-info" value="Submit" /> 
                     </form>  
                </div> 
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div id="About1" class="tabcontent">
  <div class="row">
                    <div class="col-md-9">
					<div class="row" style="width: 135%;">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
					 <div class="form-group">  
                     <form name="reference" id="reference" enctype="multipart/form-data">  
					  <div class="form-group row">
                                        <div class="col-md-12">
                                          <h3 style="text-align: center;background: #fa4753 ;color: white;height: 43px;line-height: 38px;">Reference Details 1</h3>
                                        </div>
                                    </div>
					  <div class="form-group row">
                                       <div class="row">
			<div class=" row col-md-12">
			 <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Name</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Name" name="name" class="form-control" id="name">
    </div>
  
   <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Organization</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Organization" name="organization" class="form-control" id="organization">
    </div>
  
  </div>
  </div>
      </div>
	  
	   <div class="form-group row">
                                       <div class="row">
			<div class=" row col-md-12">
			 
 <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Contact Number</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Contact Number" name="contact_number" class="form-control" id="contact_number">
    </div>
   <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Email ID</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Email ID" name="email_id" class="form-control" id="email_id">
    </div>
  </div>
  </div>
      </div>
	  <div class="form-group row">
                                        <div class="col-md-12">
                                          <h3 style="text-align: center;background: #fa4753 ;color: white;height: 43px;line-height: 38px;">Reference Details 2</h3>
                                        </div>
                                    </div>
					  <div class="form-group row">
                                       <div class="row">
			<div class=" row col-md-12">
			 <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Name</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Name" name="name1" class="form-control" id="name1">
    </div>
  
   <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Organization</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Organization" name="organization1" class="form-control" id="organization1">
    </div>
  </div>
  </div>
      </div>
	   <div class="form-group row">
                                       <div class="row">
			<div class=" row col-md-12">
 <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Contact Number</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Contact Number" name="contact_number1" class="form-control" id="contact_number1">
    </div>
   <div class="col-md-3">
    <label for="inputEmail3" style="font-weight:700 !important;">Email ID</label>
	</div>
    <div class="col-md-3">
      <input type="text" placeholder="Email ID" name="email_id1" class="form-control" id="email_id1">
    </div>
  </div>
  </div>
      </div>
								  <input type="submit" name="submit" id="submit" style="float: right;" class="btn btn-info" value="Submit" /> 
                     </form>  
                </div> 
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
	<div class="footer">
 <footer class="main-footer">
<div class="row">
<div class="col-md-6">
    <p style="color: black;margin-top:8px;">© All rights reserved @2022</p>
	 </div>
	 <div class="col-md-6" style="margin-top:8px;">
     <a href="https://bluebase.in" style="color:#fa4753;" target="_blank">Developed & Maintained by Bluebase Software Services Private Limited.</a>
	 </div>
	 </div>
  </footer>
  </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
	
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!-- This Page JS -->
    <script src="assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="dist/js/pages/mask/mask.init.js"></script>
    <script src="assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
    <script src="assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
    <script src="assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/libs/quill/dist/quill.min.js"></script>
	<script src="summernote/summernote-bs4.min.js"></script>
	<script>  
 $(document).ready(function(){  
	  $("form[name='add_name']").on("submit", function(ev) {
		 ev.preventDefault();
var formData = new FormData(this);	  
           $.ajax({  
                url:"name1.php",  
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
    processData: false,
                success:function(data)  
                {  
                    alert('Personal Profile Form Added Successfully.Please fill out the Educational Qualifications form'); 
                     $('#add_name')[0].reset();  
                }  
           });  
      });  
 });  
 </script>
 <script>  
 $(document).ready(function(){  
	  $("form[name='professional']").on("submit", function(ev) {
		 ev.preventDefault();
var formData = new FormData(this);	  
           $.ajax({  
                url:"name2.php",  
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
    processData: false,
                success:function(data)  
                {  
                    alert('Professional Profile Form Added Successfully.Please fill out the Reference form'); 
                     $('#professional')[0].reset();  
                }  
           });  
      });  
 });  
 </script>
 
 <script>  
 $(document).ready(function(){  
	  $("form[name='reference']").on("submit", function(ev) {
		 ev.preventDefault();
var formData = new FormData(this);	  
           $.ajax({  
                url:"name3.php",  
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
    processData: false,
                success:function(data)  
                {  
                    alert('Reference Form Added Successfully.'); 
                     $('#reference')[0].reset();  
                }  
           });  
      });  
 });  
 </script>
<script>
 function getstatedata(country){
			  $.ajax({
				  url: "find_state.php?country="+country,
                   type: "GET",
					success: function(data){
						$("#State").html(data);
					}
					});
 } 
 function getcitydata(city){
			  $.ajax({
				  url: "find_city.php?city="+city,
                   type: "GET",
					success: function(data){
						$("#city").html(data);
					}
					});
 } 
</script>
<script>
 function compvalue(v,todate){
	 //alert(v);
var from_date=$('#fromdate_1').val();
//alert(from_date)

			//alert(from_date)
			  $.ajax({
				  url: "get_date.php?todate="+todate+"&from_date="+from_date,
                   type: "GET",
					success: function(data){
						//alert(data);
						$("#experience_"+v).val(data);
					}
					});
 } 
</script>
<script type="text/javascript">
    function ShowHideDiv(btnPassport) {
        var dvPassport = document.getElementById("dvPassport");
        dvPassport.style.display = btnPassport.value == "Yes" ? "block" : "none";
    }
</script>				
<SCRIPT src="http://code.jquery.com/jquery-2.1.1.js"></SCRIPT>
</body>
</html>
