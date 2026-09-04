<?php
$username = $_SESSION['username'];
$name = $_SESSION['fullname'];
?>

<style>
    .header-menu {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #0191dc;
        color: white;
        padding: 10px;
    }

    .header-menu {
        align-items: center;
        background-color: #009EE3;
        /* Changed to Aeronero Blue */
        color: white;
        padding: 10px;
    }

    .menu-item {
        margin-right: 20px;
        position: static;
    }

    .menu-item:last-child {
        margin-right: 0;
    }

    .menu-item a {
        color: white;
        text-decoration: none;
    }

    .menu-title.active {
        /* text-decoration: underline; */
        color: #d80831 !important;

    }

    /* .submenu.active {
    background-color: white !important;
}

.active-submenu a {
    color: #d80831 !important;
} */


    .submenu.active-submenu {
        background-color: white !important;
        color: #d80831 !important;
        display: block;
    }


    .submenu:hover {
        background-color: white;
        color: #d80831 !important;
    }

    .submenu {
        color: white !important;
    }
</style>
<!-- Navbar -->

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <div style="margin:-200px;">
        <i class="fa fa-user fa-fw" style="color:#df8459"></i>
        <b style="color:#df8459;"><?php echo $name . '-' . $username; ?></b>
    </div>
    <!-- Left navbar links -->
    <!--<ul class="navbar-nav">
<li class="nav-item">
<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
</li>
</ul>-->

    <ul class="navbar-nav ml-auto">
        <a href="index.php">
            <img src="qvision/images/logo123.jpg" alt="Aeronero Solutions Private Limited" style="width:auto;height:75px;">
        </a>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="dropdown">
            <a href="login/login.php" style="font-size17px;"><img src="qvision/images/logoutbtn.png" style="width:35px; height:35px;">Logout</a>

        </li>
    </ul>
</nav>

<div class="header-menu">
    <?php
    $userrole = $_SESSION['userrole'];
    $sql = $con->query("SELECT zmsm.id,zmsm.menu_name,zmsm.call_method FROM z_masters_menu zmsm join z_role_detail zrd on zrd.menu_id=zmsm.id WHERE zrd.code='$userrole'  and zrd.view_only='1' AND zrd.edit_only='1' AND zrd.all_only='1'group by menu_name ORDER BY zmsm.id");
    //echo"SELECT zmsm.id,zmsm.menu_name,zmsm.call_method FROM z_masters_menu zmsm join z_role_detail zrd on zrd.menu_id=zmsm.id WHERE zrd.code='$userrole'  and zrd.view_only='1' AND zrd.edit_only='1' AND zrd.all_only='1'group by menu_name ORDER BY zmsm.id";
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $menuid = $row['id'];
    ?>
        <div class="menu-item">
            <span class="menu-title" onclick="setActiveMenu(this);loadSubMenu('<?php echo $row['menu_name']; ?>','<?php echo $menuid; ?>','<?php echo $userrole; ?>')" style="color:white;font-family: helvetica;font-size: x-large;">
                <?php echo $row['menu_name']; ?>
            </span>
            <i class="menu-arrow"></i>
        </div>
        <input type="hidden" id="menuid" name="menuid" value="">
    <?php
    } ?>

</div>

<style>
    .navv {
        list-style-type: none;
        /* Remove the marker */
    }
</style>
<nav class="sidebarr" id="sidebar" style="display: none;margin: -17px -42px;">
    <ul class="navv">
        <div id="submenuContainer" style="width:240px; background-color: #009EE3; position: absolute; height:100vh; overflow: auto;">
    </ul>
</nav>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // function loadSubMenu(menuName, menuid, userrole) {
    // 	//debugger;
    //     console.log(menuName, menuid, userrole);


    //     var submenuContainer = document.getElementById("submenuContainer");
    //        document.getElementById("menuid").value = menuid;
    //     submenuContainer.innerHTML = "";

    //     $.ajax({
    //         type: "POST",
    //         url: 'sidebarr.php',
    //         data: { menuid: menuid, userrole: userrole }, // Include the userrole parameter here
    //         success: function (submenus) {
    //             var submenusArray = JSON.parse(submenus);


    //             if (Array.isArray(submenusArray)) {

    //                       for (var i = 0; i < submenusArray.length; i++) {
    //                           var submenuData = submenusArray[i];
    //                           var submenuName = submenuData.name;
    //                           var callMethod = submenuData.call_method;

    //                           var subMenuItem = document.createElement("li");
    //                         subMenuItem.className = "nav-item";
    //                         subMenuItem.innerHTML = '<a onclick="' + callMethod + '" class="nav-link submenu" style="font-family: helvetica; font-size:17px;color:white">' + submenuName + '</a>';

    //                         // subMenuItem.addEventListener("mouseover", function() {
    //                         //     this.style.backgroundColor = "white";
    //                         //     this.getElementsByClassName("submenu")[0].style.color = "#d80831";
    //                         // });

    //                         // subMenuItem.addEventListener("mouseout", function() {
    //                         //     this.style.backgroundColor = "transparent";
    //                         //     this.getElementsByClassName("submenu")[0].style.color = "white";
    //                         // });

    //                        submenuContainer.appendChild(subMenuItem);
    //                           document.getElementById("sidebar").style.display = "block";
    //                       }
    //                   }

    //         }
    //     });
    // }


    function loadSubMenu(menuName, menuid, userrole) {
        console.log(menuName, menuid, userrole);

        var submenuContainer = document.getElementById("submenuContainer");
        document.getElementById("menuid").value = menuid;

        submenuContainer.innerHTML = "";

        $.ajax({
            type: "POST",
            url: 'sidebarr.php',
            data: {
                menuid: menuid,
                userrole: userrole
            },
            success: function(submenus) {

                var submenusArray = JSON.parse(submenus);

                if (Array.isArray(submenusArray)) {

                    for (var i = 0; i < submenusArray.length; i++) {

                        var submenuData = submenusArray[i];
                        var submenuName = submenuData.name;
                        var callMethod = submenuData.call_method;


                        var subMenuItem = document.createElement("li");
                        subMenuItem.className = "nav-item";

                        var link = document.createElement("a");
                        link.className = "nav-link submenu";
                        link.innerText = submenuName;

                        link.setAttribute("onclick", callMethod);

                        link.addEventListener("click", function() {

                            var allLinks = document.querySelectorAll(".submenu");
                            allLinks.forEach(function(el) {
                                el.classList.remove("active-submenu");
                            });

                            this.classList.add("active-submenu");
                        });

                        subMenuItem.appendChild(link);
                        submenuContainer.appendChild(subMenuItem);
                    }

                    document.getElementById("sidebar").style.display = "block";
                }
            }
        });
    }
</script>

<script>
    function vms() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/vms.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function claim_request() {
        //alert()
        $.ajax({
            type: "POST",
            url: "qvision/claim/claim_fin_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function accounts_master() {
        $.ajax({
            type: "POST",
            url: "/qvision/Accounts/main.php",
            success: function(data) {
                $("#page_loader").html(data);
            }
        })
    }

    function Testsidebar() {
        $.ajax({
            type: "POST",
            url: "qvision/test/test.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }


    function document_view() {
        $.ajax({
            type: "POST",
            url: "qvision/HR/document_view/main.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        });
    }

    function password_masters() {
        $.ajax({
            type: "POST",
            url: "qvision/password/password_master/password_master.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function application() {
        alert('Kindly Fill the Application Form')
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/new.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function feedback() {
        $.ajax({
            type: "POST",
            url: "qvision/interview_feedback/new.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }
    /*function attaire_form()
	{
		//debugger;
	$.ajax({
            type: "POST",
            url: "qvision/Recruitment/project_management/daily_mis/attire/attire.php",
            success: function (data) {
                $("#main_content").html(data);
            }
        })	
	}*/
    function attaire_form() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/project_management/daily_mis/attire_form/main.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function attaire_report() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/project_management/daily_mis/attire_form/attire/reports.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function house_sheet_report() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/project_management/daily_mis/attire_form/house/reports.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function user_role() {
        $.ajax({
            type: "POST",
            url: "qvision/user_role/role.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function calls_report() {
        $.ajax({
            type: "POST",
            url: "qvision/reports/calls_report/calls_report.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function ctc_approval() {
        $.ajax({
            type: "POST",
            url: "qvision/ctcapproval/CTC_view.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function interview_reports() {
        $.ajax({
            type: "POST",
            url: "qvision/interviewreports/interviewreports.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function daily_att_report() {
        $.ajax({
            type: "POST",
            url: "qvision/reports/attreports/att_daily_report_main.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function client_approval() {
        $.ajax({
            type: "POST",
            url: "qvision/CRM/client_details_view.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function department_reports() {
        $.ajax({
            type: "POST",
            url: "qvision/departmentreports/departmentreports.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function ctc_reports() {
        $.ajax({
            type: "POST",
            url: "qvision/ctc_reports/ctc_reports.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function menu_mapping_view() {
        $.ajax({
            type: "POST",
            url: "qvision/masters/menu_mapping/menu_mapping_ui.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function role_master() {
        $.ajax({
            type: "POST",
            url: "qvision/role/role.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function enquiry_report() {
        $.ajax({
            type: "POST",
            url: "qvision/reports/enquiry_report/enquiry.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })

    }

    function calls() {
        $.ajax({
            type: "POST",
            url: "qvision/calls/calls_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function staff_report() {
        $.ajax({
            type: "POST",
            url: "qvision/staff_report/staff_list_report.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function leave_master() {
        $.ajax({
            type: "POST",
            url: "qvision/leave_master/main.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function leave_management() {
        $.ajax({
            type: "POST",
            url: "qvision/Leave_Management/main.php?menu=hr",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function scale_master() {
        $.ajax({
            type: "POST",
            url: "qvision/scale_master/main.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function leave_details() {
        $.ajax({
            type: "POST",
            url: "qvision/Leave_Management/leave_request/leave_approve_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function brihday_list() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/birthday_list/index.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function daily_mis() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/project_management/time_sheet.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function permission_main() {
        //debugger;
        $.ajax({
            type: "POST",
            url: "qvision/Leave_Management/permission/main.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function permission_approval_list() {
        //debugger;
        $.ajax({
            type: "POST",
            url: "qvision/Leave_Management/permission/permission_approvel.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function daily_mis_report() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/project_management/time_sheet_report.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function emp_leave() {
        $.ajax({
            type: "POST",
            url: "qvision/employees_leave/main.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function employess() {
        $.ajax({
            type: "POST",
            url: "qvision/employees/main.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function employee_allowance() {
        $.ajax({
            type: "POST",
            url: "qvision/departmentreports/departmentreports.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function candidate() {
        $.ajax({
            type: "POST",
            url: "qvision/reports/candidatereports/candidate_reports_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function addition_allowance() {
        $.ajax({
            type: "POST",
            url: "qvision/addittion_allowance/main.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function employee_payroll() {
        $.ajax({
            type: "POST",
            url: "qvision/departmentreports/departmentreports.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function question_managements() {

        // alert("bala");
        $.ajax({
            type: "POST",
            url: "qvision/Question_Management/new.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })

    }

    function candicate_results() {

        //alert("bala");
        $.ajax({
            type: "POST",
            url: "qvision/Question_Management/candicate_results.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })

    }

    function question() {
        //alert("gopi");
        $.ajax({
            type: "POST",
            url: "qvision/Question_Management/aptitude.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function candidate_form() {
        $.ajax({
            type: "POST",
            url: "qvision/candidate/Candidate_form.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function appraisal_master() {
        $.ajax({
            type: "POST",
            url: "qvision/masters/appraisal_master/appraisal_master.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function kra_approve_emp() {
        $.ajax({
            type: "POST",
            url: "qvision/masters/appraisal_master/kra_approve.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function costsheet_add() {

        $.ajax({
            type: "POST",
            url: "qvision/CRM/costsheet.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function appraisal() {
        $.ajax({
            type: "POST",
            url: "qvision/appraisal/appraisal_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }


    function self_appraisal_master() {
        $.ajax({
            type: "POST",
            url: "qvision/masters/self_appraisal_master/self_appraisal_master.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function self_appraisal() {
        $.ajax({
            type: "POST",
            url: "qvision/appraisal/self_appraisal/self_appraisal.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function appraisal_approve_md() {
        $.ajax({
            type: "POST",
            url: "qvision/appraisal/appraisal_approve_md.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }


    function appraisal_round_mapping() {
        $.ajax({
            type: "POST",
            url: "qvision/masters/appraisal_round_mapping/appraisal_rounds_mapping.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function appraisal_approval() {
        $.ajax({
            type: "POST",
            url: "qvision/appraisal/appraisal_approve.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function department_master() {
        $.ajax({
            type: "POST",
            url: "qvision/masters/department_master/department_master.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function devision_master() {
        $.ajax({
            type: "POST",
            url: "qvision/masters/devision_master/devision_master.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function designation_master() {
        $.ajax({
            type: "POST",
            url: "qvision/masters/designation_master/designation_master.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function interview_rounds() {
        $.ajax({
            type: "POST",
            url: "qvision/masters/interview_rounds/interview_rounds.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function interview_rounds_mapping() {
        $.ajax({
            type: "POST",
            url: "qvision/masters/interview_rounds_mapping/interview_rounds_mapping.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function department_mapping() {

        $.ajax({
            type: "POST",
            url: "qvision/masters/department_mapping/department_mapping.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function company_master() {
        $.ajax({
            type: "POST",
            url: "qvision/masters/company_master/company_master.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function candidate_details() {
        $.ajax({
            type: "POST",
            url: "qvision/applicationform/view.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }
    //assesment 

    function question_name() {
        $.ajax({
            type: "POST",
            url: "qvision/assesment/question_name.php?t=" + Math.random(),
            success: function(data) {
                $("#main_content").html(data);
            },
            error: function(xhr, status, error) {
                alert("Back button failed: " + xhr.status + " " + error);
            }
        })
    }

    function section_master() {
        $.ajax({
            type: "POST",
            url: "qvision/assesment/section_master.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function assessment_employee() {
        $.ajax({
            type: "POST",
            url: "qvision/assessment_candidate/assessment_emp_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function emp_assessment_question() {
        $.ajax({
            type: "POST",
            url: "qvision/assesment_question/empwise_assesment_qn.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function assessment_result() {
        $.ajax({
            type: "POST",
            url: "qvision/assesment_question/candidate_results.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function Payoll_generation() {
        $.ajax({
            type: "POST",
            url: "qvision/payroll/payroll_process/payroll_generation.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function salary_summary() {
        $.ajax({
            type: "POST",
            url: "qvision/salary_details/salary_details_main.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function leaves() {
        $.ajax({
            type: "POST",
            url: "qvision/payroll/leaves.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function leave_apply() {
        $.ajax({
            type: "POST",
            url: " qvision/Leave_Management/main.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function holidays() {
        $.ajax({
            type: "POST",
            url: "qvision/payroll/holiday/holiday.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function holidays_approve() {
        $.ajax({
            type: "POST",
            url: "qvision/payroll/holiday/holiday_approve.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function holidays_list() {
        $.ajax({
            type: "POST",
            url: "qvision/payroll/holiday/holidays_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function iozd() {
        $.ajax({
            type: "POST",
            url: "/qvision/payroll/od.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function wedredf() {
        alert()
        $.ajax({
            type: "POST",
            url: "/qvision/payroll/od_requests.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function reports() {
        $.ajax({
            type: "POST",
            url: "qvision/payroll/payroll_reports.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function Payroll_close() {
        $.ajax({
            type: "POST",
            url: "qvision/payroll/payroll_process/payroll_close.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function deduction() {
        $.ajax({
            type: "POST",
            url: "qvision/deduction/main.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function earnings() {
        $.ajax({
            type: "POST",
            url: "qvision/earnings/earnings.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function Attendance() {
        $.ajax({
            type: "POST",
            url: "qvision/attendance/attendance.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function arrear_pay() {
        $.ajax({
            type: "POST",
            url: "qvision/payroll/arrear_pay/arrears.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }




    function receivable_payment() {
        $.ajax({
            type: "POST",
            url: "qvision/receivable_payable/receivable/receivable.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function receivable_list() {
        $.ajax({
            type: "POST",
            url: "qvision/receivable_payable/receivable/receivable_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function payable_payment() {
        $.ajax({
            type: "POST",
            url: "qvision/receivable_payable/payable/payable.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function payable_list() {
        $.ajax({
            type: "POST",
            url: "qvision/receivable_payable/payable/payable_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }


    function pay_slip() {
        //debugger;
        var menuid = document.getElementById("menuid").value; // Get the value of menuid
        if (menuid == 1) {
            $.ajax({
                type: "POST",
                url: "qvision/payroll/payslip/payslip_self.php",
                success: function(data) {
                    $("#main_content").html(data);
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: "qvision/payroll/payslip/payslip_main.php",
                success: function(data) {
                    $("#main_content").html(data);
                }
            });
        }
    }

    function document_approve() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/document_view_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function staff_list() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff/staff_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function staff_asset() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_asset/main_page.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        });
    }

    function staff_asset_request() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_asset/staff_asset_request.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        });
    }

    function staff_asset_master() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_asset_master/staff_asset_master.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function hod() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/hod/hod.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function od() {
        $.ajax({
            type: "POST",
            url: "qvision/claim/od.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function customer_db() {

        $.ajax({
            type: "POST",
            url: "qvision/CRM/customer_db.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function enquiry() {

        $.ajax({
            type: "POST",
            url: "qvision/CRM/enquiry.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function cost_sheet_approval() {
        $.ajax({
            type: "POST",
            url: "qvision/CRM/cost_sheet_approval.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function client_master() {
        $.ajax({
            type: "POST",
            url: "qvision/masters/client_master/client_master.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }



    function lead() {

        $.ajax({
            type: "POST",
            url: "qvision/CRM/proposal.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function cutomer_enquiry() {

        $.ajax({
            type: "POST",
            url: "qvision/CRM/calls/calls_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function Cost_sheet() {

        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/quotation/cost_sheet_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function quotation_list() {

        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/quotation/overall_quotation_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function quotation_view() {

        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/quotation/quotation_select_view.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })

    }

    function Cost_sheet_upload() {

        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/quotation/cost_sheet_upload_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function Cost_sheet_approve() {

        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/quotation/cost_sheet_view.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function Cost_sheet_revise() {

        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/quotation/costsheet_revise_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function Quotation() {

        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/quotation/quatation_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function Quotation_approve() {

        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/quotation/quotation_view.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function Quotation_send() {

        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/quotation/quotation_send_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function Quotation_revise() {

        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/quotation/quotation_revise_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function quotation_regenerate() {

        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/quotation/quotation_reg_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function interview_candidate_list() {

        $.ajax({
            type: "POST",
            url: "qvision/candidate/candidate_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function Product_master() {
        //debugger;
        $.ajax({
            type: "POST",
            url: "qvision/masters/product_master/product_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }
    /*function daily_task()
    {
//debugger;
        $.ajax({
            type: "POST",
            url: "qvision/Daily_Task/daily_task_view.php",
            success: function (data) {
                $("#main_content").html(data);
            }
        })
    }*/
    function service_master() {

        $.ajax({
            type: "POST",
            url: "qvision/masters/Service_master/service.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function calls_master() {

        $.ajax({
            type: "POST",
            url: "qvision/masters/Calls_master/calls.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function resource_master() {

        $.ajax({
            type: "POST",
            url: "qvision/masters/Resource_master/resource.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function feedback_master() {

        $.ajax({
            type: "POST",
            url: "qvision/masters/Feedback_master/feedback.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function vendor_master() {

        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/doller_vendor_master/vendor.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function resource_form() {
        $.ajax({
            type: "POST",
            url: "qvision/Resource/Resource_form/resource_form.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function resource_list() {
        $.ajax({
            type: "POST",
            url: "qvision/Resource/Resource_form/resource_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function jobdescription_form() {
        $.ajax({
            type: "POST",
            url: "qvision/Resource/jobdescription_form/jobdescription_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function job_description() {
        $.ajax({
            type: "POST",
            url: "qvision/masters/job_description/job_description_master.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function jobdescription_list() {
        $.ajax({
            type: "POST",
            url: "qvision/Resource/jobdescription_form/jobdescription_allocated_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function job_description_approval() {
        $.ajax({
            type: "POST",
            url: "qvision/Resource/jobdescription_form/job_description_approval.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function job_description_approve_list() {
        $.ajax({
            type: "POST",
            url: "qvision/Resource/jobdescription_form/job_description_approval_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function finance_po_approve() {
        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/po_approval/po_approve_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function service_po_approve() {
        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/po_approval/service_po_approve_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function service_po_status() {
        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/po_approval/service_po_status.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function marketing_po_approve() {
        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/po_approval/marketing_po_approve_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function marketing_po_approve2() {
        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/po_approval/marketing_po_approve_level2_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }


    function po_status() {
        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/po_approval/po_status.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function po_upload() {
        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/po_approval/po_upload.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function staff_resignation_form() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_resignation/staff_resignation_form.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function staff_resignation_list() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_resignation/staff_resignation_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function hr_resignation_approve() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_resignation/hr_resignation_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function staff_resignation_status() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_resignation/staff_resignation_status.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function candidate_reject_list() {
        $.ajax({
            type: "POST",
            url: "qvision/candidate/candidate_reject_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function candidate_qn() {
        $.ajax({
            type: "POST",
            url: "qvision/candidate/candidwise_assesment_qn.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function prefix_code() {
        $.ajax({
            type: "POST",
            url: "qvision/masters/Prefixcode_master/prefixcode.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function consultant_master() {
        $.ajax({
            type: "POST",
            url: "qvision/consultant_master/consultant.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function quotation_text() {
        $.ajax({
            type: "POST",
            url: "qvision/consultant_master/consultant.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }


    function asset_master() {
        $.ajax({
            type: "POST",
            type: "POST",
            url: "qvision/masters/asset_master/asset.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function asset_form() {
        $.ajax({
            type: "POST",
            type: "POST",
            url: "qvision/assetsQ/asset_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function stock_form()

    {
        $.ajax({
            type: "POST",
            url: "qvision/assetsQ/stock_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function sim_master() {
        $.ajax({
            type: "POST",
            type: "POST",
            url: "qvision/Recruitment/sim_master/sim_master.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function sim_mapping() {
        $.ajax({
            type: "POST",
            type: "POST",
            url: "qvision/Recruitment/sim_mapping/sim_mapping.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function staff_asset_allocate() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_asset/staff_asset_allocate_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function staff_asset_accept() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_asset/staff_asset_accept_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function staff_asset_approve() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_asset/staff_asset_approve_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function staff_assets_view_md() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_asset/staff_asset_list_md.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function staff_assets_return() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_asset/staff_assets_return_hr.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function staff_assets_recollect() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_asset/staff_assets_recollect.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function additional_activities() {
        $.ajax({
            type: "POST",
            url: "qvision/performance_analysis/additional_activities.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function performance_review() {
        $.ajax({
            type: "POST",
            url: "qvision/performance_analysis/performance_review.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function weekly_review() {
        $.ajax({
            type: "POST",
            url: "qvision/performance_analysis/weekly_review.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function site_master() {
        $.ajax({
            type: "POST",
            url: "qvision/masters/site_master/site.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        });
    }

    function location_master() {
        $.ajax({
            type: "POST",
            url: "qvision/masters/location_master/location_master.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function purchase_order() {
        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/purchase_order_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function Salary_advance() {

        $.ajax({
            type: "POST",
            url: "qvision/payroll/salary_advance/salary_advance_index.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })

    }

    function mail_password() {

        $.ajax({
            type: "POST",
            url: "qvision/mail_password/mail_password_view.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })

    }


    function purchase_requisition() {

        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/purchase_requisition_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function finance_requisition_approve() {

        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/finance_requisition_approve.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function purchase_requisition_approve() {

        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/purchase_requisition_approve.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function hike_master() {

        $.ajax({
            type: "POST",
            url: "qvision/masters/hike_master/hikelist.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    //// PF Reports ////
    function pf_report() {
        $.ajax({
            type: "POST",
            url: "qvision/reports/pf_reports/pf_report.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    //// Salary Reports ////
    function salary_report() {
        $.ajax({
            type: "POST",
            url: "qvision/reports/salary_reports/salary_report.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    ///// Attendance Report /////
    function att_reports() {
        $.ajax({
            type: "POST",
            url: "qvision/reports/attreports/attreports.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    ///// ESIC Reports ////// 
    function esic_reports() {
        $.ajax({
            type: "POST",
            url: "qvision/reports/esicreports/esicreports.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    ////Purchase //////////////////

    function vendor_po_generate() {
        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/vendor_po_generate/vendor_po_list.php",
            success: function(data) {
                $("#main_content").html(data);
            },
            error: function(xhr) {
                alert("Error " + xhr.status + ": " + xhr.statusText);
            }
        });
    }


    function grn_list() {
        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/grn_list.php",
            success: function(data) {
                $("#main_content").html(data);
            },
            error: function(xhr) {
                alert("Error " + xhr.status + ": " + xhr.statusText);
            }
        });
    }


    function finance_vendor_approve() {
        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/finance_purchase/finance_vendor_list.php",
            success: function(data) {
                $("#main_content").html(data);
            },
            error: function(xhr) {
                console.error("Error loading finance_vendor_list.php:", xhr.status, xhr.statusText);
                $("#main_content").html("<p style='color:red;'>Failed to load Finance Vendor Approval page.</p>");
            }
        });
    }


    function purchase_order_list() {
        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/purchase_process_list.php",
            success: function(data) {
                $("#main_content").html(data);
            },
            error: function(xhr) {
                console.error("Error loading purchase_process_list.php:", xhr.status, xhr.statusText);
                $("#main_content").html("<p style='color:red;'>Failed to load Purchase Order List.</p>");
            }
        });
    }



    function delivery_challan() {
        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/delivery_challan/delivery_challan_list.php",
            success: function(data) {
                $("#main_content").html(data);
            },
            error: function(xhr) {
                alert("Error " + xhr.status + ": " + xhr.statusText);
            }
        })
    }


    function invoice() {
        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/delivery_challan/invoice_list.php",
            success: function(data) {
                $("#main_content").html(data);
            },
            error: function(xhr) {
                alert("Error " + xhr.status + ": " + xhr.statusText);
            }
        });
    }




    // Ticketing System
    function tickets_raising() {
        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/Ticketing_system/tickets_raising_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function assign_tickets() {
        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/Ticketing_system/ticket_assign_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function ticket_assigned() {
        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/poTicket/assigned_ticket_list.php",
            success: function(data) {
                $("#main_content").html(data);
            },
            error: function(xhr) {
                alert("Error " + xhr.status + ": " + xhr.statusText);
            }
        });
    }


    //////////////// PO Product Customization After GRN Generate //////////////
    function po_product_customization() {
        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/poTicket/ticket_assign_list.php",
            success: function(data) {
                $("#main_content").html(data);
            },
            error: function(xhr) {
                alert("Error " + xhr.status + ": " + xhr.statusText);
            }
        });
    }


    ////////////////  After GRN Generate/// Purchase  //////////////
    function generate_purchase() {
        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/grn_purchase_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    ////////////////  Invoice Approve to raising  //////////////
    function invoice_approve() {
        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/delivery_challan/invoiceApprove.php",
            success: function(data) {
                $("#main_content").html(data);
            },
            error: function(xhr) {
                console.error("Error loading invoiceApprove.php:", xhr.status, xhr.statusText);
                $("#main_content").html("<p style='color:red;'>Failed to load Invoice Approve page.</p>");
            }
        });
    }


    /////////////////// LR/courier /////////////////////////
    function lr_courier() {

        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/courier_master/lr_courier.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    ///////////////////  installation /////////////////////////
    function installation() {

        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/installation/ticket_assign_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    ///////////////////  installation /////////////////////////
    function install_material() {

        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/installation/assigned_ticket_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function comp() {

        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/poTicket/bomverifylist.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function warrenty() {

        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/installation/warrentyintimationlist.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }


    function invoice_rerequest() {

        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/delivery_challan/invoice_re_request_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function assesment_master() {
        $.ajax({
            type: "POST",
            url: "qvision/masters/assesment_master/assesment_master.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function assesment_question() {
        $.ajax({
            type: "POST",
            url: "qvision/masters/assesment_question/assesment_question.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }


    function Assesment_Report() {
        $.ajax({
            type: "POST",
            url: "qvision/masters/assesment_report/assesment_report.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function Assesment_master_page() {
        $.ajax({
            type: "POST",
            url: "qvision/masters/assesment_master_page/assesment_master_page.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }

    function setActiveMenu(element) {
        // Remove active class from all menu titles
        var menus = document.querySelectorAll('.menu-title');
        menus.forEach(function(menu) {
            menu.classList.remove('active');
        });

        // Add active class to clicked one
        element.classList.add('active');
    }
</script>
<script>
    /* function  _apporove()
    {
		alert();
        $.ajax({
            type: "POST",
            url: "qvision/mail_password/mail_password_view.php",
            success: function (data) {
                $("#main_content").html(data);
            }
        })
    } */
</script>
<!-- /.navbar -->