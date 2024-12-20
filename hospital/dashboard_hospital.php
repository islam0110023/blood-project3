<?php
session_start();
require_once('../database/database.php');

if (isset($_SESSION['hospital'])) {
    $db = db::getInstance('localhost', 'root', '', 'blood_donation', 'hospitals');
    $result = $db->select()
        ->where('reg_id', '=', $_SESSION['hospital']['id'])
        ->get();
    $db->setTable('hospitals_blood_inventory hb');

    $resultBlood = $db->select()->join("blood_types bt", "bt.id", "=", "hb.blood_type_id")->where("hospitals_id", "=", $result['hospitals_id'])->show();
    // echo "<pre>";
    // print_r($resultBlood);
    $db->setTable('reg');

    $resultReg=$db->select()->where("id","=",$_SESSION['hospital']['id'])->get();


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
    <link rel="stylesheet" href="dash_hos.css">
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <nav>
            <div class="logo">
                <h2>Dashboard</h2>
            </div>
            <img class="img-user" src="../img/hospital-ico.png" alt="user-pic" onclick="toggleMenu2()">
            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                    <div class="hospital-info">
                        <img class="img-user" src="../img/hospital-ico.png">
                        <h2><?= $resultReg['user_names']; ?></h2>
                    </div>
                    <hr>
                    <a href="Hospitals.php" class="sub-menu-link">
                        <img src="../img/icon-home.png">
                        <p>Home</p>
                        <span>></span>
                    </a>
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
    <!-- Main Content -->
    <div class="main-content">
        <h1>Our Dashboard</h1>
        <div class="container">
            <div class="card">
                <h3>Stock List</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Blood types</th>
                            <th>Available Blood Units</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($resultBlood as $key => $value): ?>
                        <tr>
                            <td><?=$value['Blood_Types'];?></td>
                            <td><?=$value['Quantity']; echo " Units";?></td>
                        </tr>
                        <?php endforeach; ?>

                        <!-- <tr>
                            <td>B+</td>
                            <td>10 Units</td>
                        </tr>
                        <tr>
                            <td>O+</td>
                            <td>10 Units</td>
                        </tr>
                        <tr>
                            <td>A-</td>
                            <td>10 Units</td>
                        </tr>
                        <tr>
                            <td>B-</td>
                            <td>10 Units</td>
                        </tr>
                        <tr>
                            <td>O-</td>
                            <td>10 Units</td>
                        </tr>
                        <tr>
                            <td>AB+</td>
                            <td>10 Units</td>
                        </tr>
                        <tr>
                            <td>AB-</td>
                            <td>10 Units</td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        let subMenu = document.getElementById("subMenu")
        function toggleMenu2() {
            subMenu.classList.toggle("open-menu");
        }
    </script>

</body>

</html>