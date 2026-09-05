<?php
$username = $_SESSION['username'];
$name = $_SESSION['fullname'];

$display_doj = '-';
$display_dept = '-';
$display_email = '-';
$display_role = '-';
$display_mobile = '-';
$display_location = '-'; 

try {
    $profile_query = "
        SELECT 
            s.DOJ, 
            s.location, 
            d.dept_name,
            u.email_id,
            u.mobile_no,
            r.role_name
        FROM staff_master s 
        LEFT JOIN z_department_master d ON s.dep_id = d.id 
        LEFT JOIN z_user_master u ON s.emp_code = u.user_name 
        LEFT JOIN z_role_master r ON u.user_group_code = r.code 
        WHERE s.emp_code = '$username'
    ";
                      
    $sql_profile = $con->query($profile_query);
    
    if ($sql_profile) {
        $employeeData = $sql_profile->fetch(PDO::FETCH_ASSOC);
        
        if ($employeeData) {
            $display_doj = !empty($employeeData['DOJ']) ? $employeeData['DOJ'] : '-';
            $display_dept = !empty($employeeData['dept_name']) ? $employeeData['dept_name'] : '-';
            $display_email = !empty($employeeData['email_id']) ? $employeeData['email_id'] : '-';
            $display_role = !empty($employeeData['role_name']) ? $employeeData['role_name'] : '-';
            $display_mobile = !empty($employeeData['mobile_no']) ? $employeeData['mobile_no'] : '-';
            
            $display_location = !empty($employeeData['location']) ? $employeeData['location'] : '-';
        }
    }
} catch(PDOException $e) {
    echo "<script>console.log('DB Fetch Error: " . addslashes($e->getMessage()) . "');</script>";
}
?>

<style>
    .header-menu {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #009EE3; 
        padding: 10px;
    }

    .menu-item {
        margin-right: 5px; 
        position: static;
    }

    .menu-item:last-child {
        margin-right: 0;
    }

    .menu-item a, .menu-title {
        color: white;
        text-decoration: none;
        padding: 5px 10px; 
        font-weight: 500;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .menu-item a:hover, .menu-title:hover {
        color: #FBC710 !important; 
        background-color: rgba(255, 255, 255, 0.15) !important; 
    }

    .menu-title.active {
        background-color: transparent !important; 
        color: #FBC710 !important; 
        text-shadow: 0 0 10px rgba(251, 199, 16, 0.8), 0 0 20px rgba(251, 199, 16, 0.4); 
        transform: scale(1.05); 
        display: inline-block; 
    }

    .submenu.active-submenu {
        background-color: transparent !important; 
        color: #FBC710 !important;
        text-shadow: 0 0 8px rgba(251, 199, 16, 0.6); 
        display: block;
    }

    .submenu:hover {
        background-color: rgba(255, 255, 255, 0.05) !important; 
        color: #FBC710 !important;
        text-shadow: 0 0 8px rgba(251, 199, 16, 0.6);
    }

    .submenu {
        color: white !important;
    }

    .navv {
        list-style-type: none; 
    }
    /* ========================================================= */
    /* PREMIUM PROFILE CARD POPUP CSS (WITH BLUE HEADER & LOGO)  */
    /* ========================================================= */
    .premium-profile-card {
        position: fixed;
        top: 155px; 
        right: 25px; 
        width: 380px; 
        background: #ffffff;
        border-radius: 12px; 
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15); 
        z-index: 99999; 
        border: 1px solid #e2e8f0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; 
        overflow: hidden; /* To keep the blue header rounded */
        
        opacity: 0;
        visibility: hidden;
        transform: translateY(-20px);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .premium-profile-card.show-card {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    /* ========================================================= */
    /* ANIMATED WATER WAVE KEYFRAMES                             */
    /* ========================================================= */
   /* ========================================================= */
    /* ANIMATED WATER WAVE KEYFRAMES                             */
    /* ========================================================= */
    @keyframes waveFlow {
        0% { background-position-x: 0; }
        100% { background-position-x: 1440px; }
    }

    /* Rendaavathu wave cross-a move aaga */
    @keyframes waveFlowReverse {
        0% { background-position-x: 1440px; }
        100% { background-position-x: 0; }
    }

    /* --- PREMIUM PROFILE CARD POPUP CSS --- */
    .premium-profile-card {
        position: fixed;
        top: 145px; 
        right: 25px; 
        width: 420px; /* INCREASED SIZE: Pazhaya mari side-la nalla perusa aakiyachu */
        background: #ffffff;
        border-radius: 12px; 
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15); 
        z-index: 99999; 
        border: 1px solid #e2e8f0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; 
        overflow: hidden; 
        
        opacity: 0;
        visibility: hidden;
        transform: translateY(-20px);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .premium-profile-card.show-card {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    /* --- PREMIUM BLUE HEADER --- */
    .premium-header-bg {
        background: linear-gradient(135deg, #009EE3 0%, #006b99 100%);
        padding: 22px 25px;
        position: relative;
        overflow: hidden; 
    }

    /* --- WATER WAVE 1 (Back Layer - Slower & Light) --- */
    .premium-header-bg::before {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 75%;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='0.25' d='M0,160L48,170.7C96,181,192,203,288,197.3C384,192,480,160,576,149.3C672,139,768,149,864,170.7C960,192,1056,224,1152,229.3C1248,235,1344,213,1392,202.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
        background-size: 1440px auto; 
        background-position: 0 bottom;
        z-index: 1;
        animation: waveFlow 15s linear infinite;
    }

    /* --- WATER WAVE 2 (Front Layer - Faster & High Opacity for Heavy Effect) --- */
    .premium-header-bg::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 65%;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='0.45' d='M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,213.3C672,224,768,224,864,208C960,192,1056,160,1152,149.3C1248,139,1344,149,1392,154.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
        background-size: 1440px auto; 
        background-position: 0 bottom;
        z-index: 1;
        animation: waveFlowReverse 10s linear infinite;
    }

    /* --- ALIGNMENT FIX (Avatar & Text Side-by-Side) --- */
    .premium-header-content {
        display: flex;
        align-items: center; 
        gap: 15px;
        position: relative;
        z-index: 2; 
    }

    .premium-close-btn {
        position: absolute;
        top: 10px;
        right: 15px;
        color: rgba(255, 255, 255, 0.8);
        font-size: 22px;
        cursor: pointer;
        line-height: 1;
        transition: 0.2s;
        z-index: 2; /* Ensure close button is clickable above waves */
    }

    .premium-close-btn {
        position: absolute;
        top: 10px;
        right: 15px;
        color: rgba(255, 255, 255, 0.7);
        font-size: 22px;
        cursor: pointer;
        line-height: 1;
        transition: 0.2s;
        z-index: 2;
    }

    .premium-close-btn:hover {
        color: #ffffff;
    }

    .premium-avatar {
        width: 65px;
        height: 65px;
        border-radius: 50%;
        background: #004d73;
        border: 2px solid rgba(255, 255, 255, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        color: #ffffff;
        font-size: 24px;
        font-weight: 700;
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
        flex-shrink: 0; 
    }

    .premium-header-text {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    
    .premium-user-title-white {
        color: #ffffff; 
        font-size: 17px;
        font-weight: 700;
        letter-spacing: 0.3px;
        margin-bottom: 3px;
    }
    
    .premium-user-role-white {
        color: rgba(255, 255, 255, 0.9); 
        font-size: 14px;
        font-weight: 500;
    }

    .premium-user-dept-white {
        color: rgba(255, 255, 255, 0.7); 
        font-size: 13px;
        font-weight: 400;
    }

    /* --- BODY SECTION --- */
    .premium-body-section {
        padding: 15px 25px;
    }

    .premium-list-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        font-size: 14px;
        border-bottom: 1px solid #f1f5f9; 
    }

    .premium-list-item:last-child {
        border-bottom: none;
    }

    .premium-icon {
        color: #475569; 
        width: 26px;
        font-size: 15px;
    }

    .premium-label {
        color: #64748b; 
        width: 140px; 
        font-weight: 500;
    }

    .premium-value {
        color: #0f172a; 
        font-weight: 600;
        flex: 1;
    }

   /* --- PREMIUM FOOTER LOGO --- */
    .premium-footer-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 25px; /* Slight padding adjust for bigger logo */
        border-top: 1px solid #f1f5f9;
        background: #f8fafc;
    }

    .premium-motto {
        font-family: 'Brush Script MT', 'Comic Sans MS', cursive; 
        color: #cbd5e1;
        font-size: 19px; /* Konjam perusa aakiyachu */
    }

    .premium-logo img {
        height: 70px; /* 35px la irunthu 55px ku increase panniyachu */
        width: auto;
    }
</style>

<<<<<<< Updated upstream
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <div style="margin:-200px; position: relative; z-index: 1000;">
        <a href="#" class="username-trigger" onclick="togglePremiumProfile(event)" style="text-decoration: none; cursor: pointer;">
            <i class="fa fa-user fa-fw" style="color:#FBC710"></i>
            <b style="color:#009EE3;"><?php echo $name . '-' . $username; ?></b>
        </a>
    </div>
    
    <ul class="navbar-nav ml-auto">
        <a href="index.php">
            <img src="qvision/images/logo123.jpg" alt="Aeronero Solutions Private Limited" style="width:auto;height:75px;">
=======
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-left: 0 !important; display: flex; justify-content: space-between; align-items: center; padding: 10px 20px;">
    <!-- Left Section -->
    <div style="display: flex; align-items: center; flex: 1; justify-content: flex-start;">
        <a href="user_profile.php" style="text-decoration: none; display: flex; align-items: center; gap: 5px;">
            <i class="fa fa-user fa-fw" style="color:#FBC710; font-size: 1.2rem;"></i>
            <b style="color:#009EE3; font-size: 1.1rem;"><?php echo $name . '-' . $username; ?></b>
>>>>>>> Stashed changes
        </a>
    </div>

<<<<<<< Updated upstream
    <ul class="navbar-nav ml-auto">
        <li class="dropdown">
            <a href="login/login.php" style="font-size:17px;"><img src="qvision/images/logoutbtn.png" style="width:35px; height:35px;">Logout</a>
        </li>
    </ul>
</nav>

<!-- ======================================================= -->
<!-- PREMIUM PROFILE CARD HTML (EXACT 1ST IMAGE UI)          -->
<!-- ======================================================= -->
<div id="premiumProfile" class="premium-profile-card">
    
    <!-- TOP HEADER: Blue Gradient with Avatar -->
    <div class="premium-header-bg">
        <span class="premium-close-btn" onclick="togglePremiumProfile(event)">&times;</span>
        <div class="premium-header-content">
            <!-- Circular Initials Avatar -->
            <div class="premium-avatar">
                <?php 
                    // Automatically get initials (e.g. "Demo HR" -> "DH")
                    $n = trim($_SESSION['fullname']);
                    $parts = explode(' ', $n);
                    $initials = strtoupper(substr($n, 0, 1));
                    if(count($parts) > 1) {
                        $initials .= strtoupper(substr($parts[count($parts)-1], 0, 1));
                    }
                    echo $initials;
                ?>
            </div>
            
            <div class="premium-header-text">
                <div class="premium-user-title-white">
                    <?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : ''; ?>-<?php echo $username; ?>
                </div>
                <div class="premium-user-role-white">
                    <?php echo $display_role; ?>
                </div>
                <div class="premium-user-dept-white">
                    <?php echo $display_dept; ?> Department
                </div>
            </div>
        </div>
    </div>

    <!-- LIST OF DETAILS -->
    <div class="premium-body-section">
        <div class="premium-list-item">
            <i class="fa fa-user premium-icon"></i>
            <span class="premium-label">Employee ID</span>
            <span class="premium-value"><?php echo $username; ?></span>
        </div>
        
        <div class="premium-list-item">
            <i class="fa fa-user premium-icon"></i>
            <span class="premium-label">Full Name</span>
            <span class="premium-value"><?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : '-'; ?></span>
        </div>
        
        <div class="premium-list-item">
            <i class="fa fa-envelope premium-icon"></i>
            <span class="premium-label">Email</span>
            <span class="premium-value"><?php echo $display_email; ?></span>
        </div>
        
        <div class="premium-list-item">
            <i class="fa fa-phone premium-icon"></i>
            <span class="premium-label">Mobile</span>
            <span class="premium-value"><?php echo $display_mobile; ?></span>
        </div>
        
        <div class="premium-list-item">
            <i class="fa fa-building premium-icon"></i>
            <span class="premium-label">Department</span>
            <span class="premium-value"><?php echo $display_dept; ?></span>
        </div>
        
        <div class="premium-list-item">
            <i class="fa fa-briefcase premium-icon"></i>
            <span class="premium-label">Designation</span>
            <span class="premium-value"><?php echo $display_role; ?></span>
        </div>
        
        <div class="premium-list-item">
            <i class="fa fa-map-marker-alt premium-icon"></i>
            <span class="premium-label">Location</span>
            <span class="premium-value"><?php echo $display_location; ?></span>
        </div>
        
        <div class="premium-list-item">
            <i class="fa fa-calendar-alt premium-icon"></i>
            <span class="premium-label">Date of Joining</span>
            <span class="premium-value"><?php echo $display_doj; ?></span>
        </div>
    </div>

    <!-- FOOTER WITH MOTTO AND LOGO -->
    <div class="premium-footer-section">
        <div class="premium-motto">People Power Progress</div>
        <div class="premium-logo">
            <!-- Using your navbar logo path -->
            <img src="login/assets/background_img.png" alt="Aeronero Solutions">
        </div>
    </div>

</div>
<!-- ======================================================= -->
<div class="header-menu">
    <?php
    $userrole = $_SESSION['userrole'];
    $sql = $con->query("SELECT zmsm.id,zmsm.menu_name,zmsm.call_method FROM z_masters_menu zmsm join z_role_detail zrd on zrd.menu_id=zmsm.id WHERE zrd.code='$userrole'  and zrd.view_only='1' AND zrd.edit_only='1' AND zrd.all_only='1'group by menu_name ORDER BY zmsm.id");
    
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $menuid = $row['id'];
    ?>
        <div class="menu-item">
            <span class="menu-title" onclick="setActiveMenu(this);loadSubMenu('<?php echo $row['menu_name']; ?>','<?php echo $menuid; ?>','<?php echo $userrole; ?>')" style="color:white;font-family: helvetica;font-size: x-large; cursor:pointer;">
=======
    <!-- Center Section -->
    <div style="display: flex; justify-content: center; align-items: center; flex: 1;">
        <a href="index.php">
            <img src="qvision/images/logo123.jpg" alt="Aeronero Solutions Private Limited" style="width:auto; height:75px;">
        </a>
    </div>

    <!-- Right Section -->
    <div style="display: flex; align-items: center; flex: 1; justify-content: flex-end;">
        <a href="login/login.php" style="font-size:17px; color: #333; text-decoration: none; display: flex; align-items: center; gap: 5px;">
            <img src="qvision/images/logoutbtn.png" style="width:35px; height:35px;"> Logout
        </a>
    </div>
</nav>

<div class="header-menu" style="position: relative; z-index: 1001; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <?php
    $userrole = $_SESSION['userrole'];
    $sql = $con->query("SELECT zmsm.id,zmsm.menu_name,zmsm.call_method FROM z_masters_menu zmsm join z_role_detail zrd on zrd.menu_id=zmsm.id WHERE zrd.code='$userrole'  and zrd.view_only='1' AND zrd.edit_only='1' AND zrd.all_only='1'group by menu_name ORDER BY zmsm.id");
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $menuid = $row['id'];
    ?>
        <div class="menu-item" style="cursor: pointer;">
            <span class="menu-title" onclick="setActiveMenu(this);loadSubMenu('<?php echo $row['menu_name']; ?>','<?php echo $menuid; ?>','<?php echo $userrole; ?>')" style="color:white;font-family: helvetica;font-size: 18px;">
>>>>>>> Stashed changes
                <?php echo $row['menu_name']; ?>
            </span>
        </div>
        <input type="hidden" id="menuid" name="menuid" value="">
    <?php
    } ?>
</div>

<<<<<<< Updated upstream
<nav class="sidebarr" id="sidebar" style="display: none;margin: -17px -42px;">
    <ul class="navv">
        <div id="submenuContainer" style="width:240px; background-color: #009EE3; position: absolute; height:100vh; overflow: auto;">
    </ul>
</nav>

=======
<style>
    .navv {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }
    .sidebarr {
        display: none;
        width: 240px;
        position: absolute; /* Using absolute so it can float over or be left-aligned */
        left: 0;
        background-color: #009EE3;
        height: calc(100vh - 130px);
        overflow-y: auto;
        z-index: 1000;
        box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    }
    .nav-item .nav-link.submenu {
        padding: 12px 20px !important;
        display: block !important;
        cursor: pointer !important;
        font-family: helvetica;
        font-size: 16px !important;
        color: white !important;
        border-bottom: 1px solid rgba(255,255,255,0.1) !important;
        transition: all 0.3s ease !important;
    }
    .nav-item .nav-link.submenu:hover,
    .nav-item .nav-link.submenu.active-submenu {
        background-color: rgba(255, 255, 255, 0.1) !important;
        color: #FBC710 !important;
        border-left: 4px solid #FBC710 !important;
        padding-left: 16px !important; 
    }
</style>

<nav class="sidebarr" id="sidebar">
    <ul class="navv" id="submenuContainer">
    </ul>
</nav>
>>>>>>> Stashed changes
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function togglePremiumProfile(event) {
        event.preventDefault(); 
        event.stopPropagation(); 
        
        const profileCard = document.getElementById('premiumProfile');
        profileCard.classList.toggle('show-card');
    }

    document.addEventListener('click', function(event) {
        const profileCard = document.getElementById('premiumProfile');
        const triggerBtn = document.querySelector('.username-trigger');
        
        if (profileCard.classList.contains('show-card')) {
            if (!profileCard.contains(event.target) && !triggerBtn.contains(event.target)) {
                profileCard.classList.remove('show-card');
            }
        }
    });
</script>

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