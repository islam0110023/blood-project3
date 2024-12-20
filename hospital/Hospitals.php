<?php
session_start();
require_once('../database/database.php');

if (isset($_SESSION['hospital'])) {
    $db = db::getInstance('localhost', 'root', '', 'blood_donation', 'hospitals');
    $result = $db->select()
        ->where('reg_id', '=', $_SESSION['hospital']['id'])
        ->get();
        $db->setTable('reg');

        $resultReg=$db->select()->where("id","=",$_SESSION['hospital']['id'])->get();
    // echo '<pre>';
    // print_r($result);
} else {
    echo "<script>alert('Login');</script>";
    header("location:../home/login_signup.php");
}

?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank and Donor Management System</title>
    <link rel="stylesheet" href="Hospitals.css">
</head>

<body>

    <!-- Navbar -->
    <div class="navbar">
        <nav>
            <div class="logo">
                <h2>Welcome</h2>
            </div>
            <div class="hidehome" onclick="toggleMenu()">☰</div>
            <ul id="menu">
                <li><a href="Hospitals.php">Home</a></li>
            </ul>
            <img class="img-user" src="../img/hospital-ico.png" alt="user-pic" onclick="toggleMenu2()">
            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                    <div class="hospital-info">
                        <img class="img-user" src="../img/hospital-ico.png">
                        <h2><?= $resultReg['user_names']; ?></h2>
                    </div>
                    <hr>
                    <a href="dashboard_hospital.php" class="sub-menu-link">
                        <img src="../img/profile.png">
                        <p>Dashboard</p>
                        <span>></span>
                    </a>
                    <a href="edit_dash_hos.php" class="sub-menu-link">
                        <img src="../img/edit.png">
                        <p>Edit Dashboard</p>
                        <span>></span>
                    </a>
                    <a href="setting.php" class="sub-menu-link">
                        <img src="../img/setting.png">
                        <p>Setting & Privacy</p>
                        <span>></span>
                    </a>
                    <a href="logout.php" class="sub-menu-link">
                        <img src="../img/logout.png">
                        <p>Logout</p>
                        <span>></span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <div class="hero-section">
        <div class="hero-overlay">
            <h1>A Drop of Blood, A Sea of Hope.</h1>
            <p>We are more than just a healthcare provider
                — we are a lifeline to our community.</p>
        </div>
    </div>

    <script>
        let subMenu = document.getElementById("subMenu")
        function toggleMenu2() {
            subMenu.classList.toggle("open-menu");
        }
        function toggleMenu() {
            var menu = document.getElementById('menu');
            menu.classList.toggle('show'); // Toggle the 'active' class to show/hide the menu
        }
    </script>


</body>

</html>