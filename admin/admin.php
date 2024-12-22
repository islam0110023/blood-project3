<?php
session_start();
require_once('../database/database.php');

if (isset($_SESSION["admin"])) {
    $db = db::getInstance('localhost', 'root', '', 'blood_donation', 'reg');
  
    $result = $db->select("count(*) Total_D")->where('Role', '=', '2')->andwhere('is_active', '=', '0')->get();
    $resultH = $db->select("count(*) Total_H")->where('Role', '=', '3')->andwhere('is_active', '=', '0')->get();
    
} else {
        echo "<script>
        alert('Login');
        window.location.href = '../home/login_signup.php';
    </script>";
    
}
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
            <li><a href="admin.php">Dashboard</a></li>
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
                <p id="donors-count"><?= $result['Total_D'];
                ?></p> <!-- Total number of donors -->
            </div>
            <div class="card">
                <h3>Total Hospitals</h3>
                <p id="hospitals-count"><?= $resultH['Total_H'];
                ?></p> <!-- Total number of hospitals -->
            </div>
            <div class="card">
                <h3>Total Blood Types Available</h3>
                <p id="blood-types-count">8</p> <!-- Total number of blood types -->
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

    
    </script>
</body>

</html>