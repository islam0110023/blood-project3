<?php
require_once('../database/database.php');
$db = db::getInstance('localhost', 'root', '', 'blood_donation', 'reg');
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Blood Donation System</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="menu-btn" onclick="toggleSidebar()">☰</div>
        <h2>Blood Donation Admin</h2>
        <ul>
            <li><a href="#" onclick="showDashboard()">Dashboard</a></li>
            <li><a href="manage_hos.php">Manage Hospitals</a></li>
            <li><a href="manage_donors.php">Manage Donors</a></li>
            <li><a href="register_hospital.php">Regiser For Hospitals</a></li>
            <li><a href="../hospital/logout.php">Log Out</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Welcome, Admin!</h1>
        <div class="dashboard">
            <div class="card">
                <h3>Total Donors</h3>
                <p id="donors-count">0</p> <!-- Total number of donors -->
            </div>
            <div class="card">
                <h3>Total Hospitals</h3>
                <p id="hospitals-count">0</p> <!-- Total number of hospitals -->
            </div>
            <div class="card">
                <h3>Total Blood Types Available</h3>
                <p id="blood-types-count">0</p> <!-- Total number of blood types -->
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const menuList = document.querySelector('.sidebar ul');
            sidebar.classList.toggle('active');
            menuList.classList.toggle('active');
        }

        function showDashboard() {
            document.querySelector('.main-content').style.display = 'block';
        }
    </script>
</body>

</html>
