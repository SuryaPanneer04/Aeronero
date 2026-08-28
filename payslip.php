<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Menu</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            display: flex;
        }

        /* Sidebar Style */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #333;
            color: white;
            padding-top: 20px;
            position: fixed;
            top: 0;
            left: 0;
            transition: width 0.3s;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 15px 20px;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #ff8b3d;
            border-radius: 5px;
        }

        .sidebar .menu-title {
            font-weight: bold;
            margin-bottom: 15px;
            padding-left: 20px;
            font-size: 20px;
        }

        .sidebar .menu-item {
            margin-bottom: 10px;
        }

        .sidebar .submenu {
            display: none;
            padding-left: 20px;
        }

        .sidebar .submenu a {
            font-size: 16px;
        }

        .sidebar .menu-item:hover .submenu {
            display: block;
        }

        /* Content area */
        .content {
            margin-left: 260px;
            padding: 20px;
            width: 100%;
        }

        /* For mobile screens */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .content {
                margin-left: 220px;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 0;
            }

            .content {
                margin-left: 0;
            }

            .sidebar.active {
                width: 250px;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="menu-title">Main Menu</div>
        
        <!-- Payslip Menu -->
        <div class="menu-item">
            <a href="#">Payroll</a>
            <div class="submenu">
                <a href="payslip_view.php">View Payslip</a>
                <a href="payslip_download.php">Download Payslip</a>
                <a href="payslip_history.php">Payslip History</a>
            </div>
        </div>
        
        <!-- Another Menu Item -->
        <div class="menu-item">
            <a href="#">CRM</a>
        </div>

        <!-- Other Menu Items -->
        <div class="menu-item">
            <a href="#">Reports</a>
        </div>

        <div class="menu-item">
            <a href="#">Settings</a>
        </div>
        
    </div>

    <!-- Content Section -->
    <div class="content">
        <h1>Welcome to the Dashboard</h1>
        <p>This is the main content area where different sections will be loaded dynamically based on the menu selection.</p>
    </div>

</body>
</html>
