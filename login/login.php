<?php
require("../connect.php");

session_start();
if (isset($_SESSION['user'])) {
    // var_dump($_SESSION);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QVision ERP LOGIN</title>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Custom Style-->
    <link rel="stylesheet" href="./css/Style.css">
</head>

<body>

    <div class="login-page">

        <!-- LEFT PANEL: Slanted Background with Water Animation -->
        <div class="left-bg-container">
            <div class="left-bg-image"></div>
        </div>

        <section class="left-panel">
            
            <!-- TOP GROUP: Logo and Hero Text -->
            <div class="left-top">
                <div class="left-header">
                    <img src="../images/logo123.jpg" alt="Aeronero Logo" class="left-logo">
                </div>

                <div class="hero-content">
                    <h1 class="hero-title">Smart ERP for<br><span class="highlight-blue">Water</span> Solutions</h1>
                    <div class="yellow-dash"></div>
                    <p class="hero-desc">Manage leads, quotations, and service<br>operations for your water & aeration systems<br>business, in one place.</p>
                </div>
            </div>

            <!-- Orbit Graphic -->
            <div class="orbit-container">
                <div class="orbit-circle orbit-outer">
                    <div class="orbit-icon icon-1"><i class="fas fa-users"></i></div>
                    <div class="orbit-icon icon-2"><i class="fas fa-chart-line"></i></div>
                </div>
                <div class="orbit-circle orbit-inner">
                    <div class="orbit-icon icon-3" style="color: #FBC710; border-color: #FBC710;"><i class="fas fa-bars"></i></div>
                </div>
                <div class="orbit-center">
                    <div class="center-icon-bg">
                        <img src="assets/Aeronero Fav_page-0002.jpg" alt="Center Icon" class="center-icon">
                    </div>
                </div>
            </div>

            <!-- BOTTOM GROUP: Stats and Footer pushed to the very bottom -->
            <div class="left-bottom">
                <div class="stats-row">
                    <div class="stat-item">
                        <div class="stat-icon"><i class="fas fa-users"></i></div>
                        <div class="stat-text">
                            <h4>500+</h4>
                            <p>Happy Clients</p>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon"><i class="fas fa-tint"></i></div>
                        <div class="stat-text">
                            <h4>1200+</h4>
                            <p>Projects Completed</p>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon"><i class="fas fa-shield-alt"></i></div>
                        <div class="stat-text">
                            <h4>99.9%</h4>
                            <p>System Uptime</p>
                        </div>
                    </div>
                </div>

                <div class="left-footer">
                    &copy; 2026 Aeronero Solutions Private Limited | Powered by QVision ERP
                </div>
            </div>
        </section>

        <!-- RIGHT PANEL: Glassmorphic White Login Form -->
        <section class="right-panel">
            <div class="form-card">
            

                <div class="form-header">
                    <img src="../images/logo123.jpg" alt="Aeronero Solutions Private Limited" class="form-logo">
                    <h2>Welcome back!</h2>
                    <p>Sign in to continue to your HRMS workspace</p>
                </div>

                <!-- Backend inputs UNTOUCHED -->
                <form method="POST" action="validation.php" class="login-form">
                    
                    <div class="field-group">
                        <label for="username">User name</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" id="username" name="Inputusername" placeholder="Enter your user name" autocomplete="off" autofocus>
                        </div>
                    </div>

                    <div class="field-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="password" name="InputPassword" placeholder="Enter your password" autocomplete="off">
                            <i class="fas fa-eye toggle-icon" id="toggleIcon" onclick="togglePassword()"></i>
                        </div>
                    </div>

                    <div class="form-actions">
                        <label class="remember-me">
                            <input type="checkbox" checked>
                            <span class="checkmark"></span>
                            Remember me
                        </label>
                    </div>

                    <button type="submit" class="btn-signin">Sign in <i class="fas fa-arrow-right"></i></button>
                </form>

                <p class="signup-text" style="margin-top: 2rem;">
                    Don't have an account? <a href="#">Contact your administrator</a>
                </p>

            </div>
        </section>

    </div>

    <script>
        function togglePassword() {
            var password = document.getElementById("password");
            var icon = document.getElementById("toggleIcon");

            if (password.type === "password") {
                password.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                password.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>

</html>