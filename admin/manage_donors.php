<?php
session_start();
require_once('../database/database.php');

if (isset($_SESSION["admin"])) {
    $db = db::getInstance('localhost', 'root', '', 'blood_donation', 'users u');
   // $result = $db->select()->join("reg r", "r.IS_active", "=", 0)->join("blood_types bt", "bt.id", "=", "u.blood_type_id")->where("r.Role", "=", "2")->show();
    $result = $db->select()
    ->join("reg r", "r.id", "=", "u.reg_id")
    ->join("blood_types bt", "bt.id", "=", "u.blood_type_id")  
    ->where("r.IS_active", "=", 0)
    ->andwhere("r.Role", "=", 2)
    ->show();
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
    <title>Admin Panel - Blood Donation System</title>
    <link rel="stylesheet" href="manage_hos.css">

</head>

<body>
    <div class="main-container">

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
            <h1>Manage Donors!</h1>
            <div class="container">
                <!-- Manage Donors Section -->
                <div class="card">
                    <h3>Donors List</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Donor Name</th>
                                <th>Blood Type</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $key => $value): ?>
                                <tr>
                                    <td><?= $value['first_name'] . " " . $value["last_name"]; ?></td>
                                    <td><?= $value['Blood_Types']; ?></td>
                                    <td><?= $value['phone_Num']; ?></td>
                                    <td>
                                        <form action="updateVD.php" method="post">
                                            <button type="submit" name="available" value="<?= $value['reg_id']; ?>"
                                                class="btn">Edit</button>
                                        </form>
                                        <form action="deleteVD.php" method="post">
                                            <button type="submit" name="delete" value="<?= $value['reg_id']; ?>"
                                                class="btn">Delete</button>
                                        </form>

                                        <!-- <button class="btn">Delete</button> -->
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td>John Doe</td>
                                <td>A+</td>
                                <td>+20123456789</td>
                                <td><button class="btn">Edit</button> <button class="btn">Delete</button></td>
                            </tr>
                            <tr>
                                <td>Jane Smith</td>
                                <td>O-</td>
                                <td>+20112233445</td>
                                <td><button class="btn">Edit</button> <button class="btn">Delete</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <button class="btn">Add</button>
                </div>
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