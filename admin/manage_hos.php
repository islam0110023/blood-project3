<?php
session_start();
require_once('../database/database.php');

if (isset($_SESSION["admin"])) {
    $db = db::getInstance('localhost', 'root', '', 'blood_donation', 'hospitals');
    $result = $db->select()
        ->join("reg r", "r.id", "=", "hospitals.reg_id")  // الانضمام على الأعمدة الصحيحة
        ->where("r.IS_active", "=", 0)
        ->andwhere("r.Role", "=", 3)
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
            <h1>Manage Hospitals!</h1>
            <div class="container">
                <!-- Manage Hospitals Section -->
                <div class="card">
                    <h3>Hospitals List</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Hospital Name</th>
                                <th>Location</th>
                                <th>Available Blood Types</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($result as $key => $value): ?>
                                <tr>
                                    <td><?= $value['name']; ?></td>
                                    <td><?= $value['location']; ?></td>
                                    <td><?= $value['licenses_number']; ?></td>
                                    <td>
                                        <!-- <button class="btn">Delete</button></td> -->
                                        <form action="deleteHD.php" method="post">
                                            <button type="submit" name="delete" value="<?= $value['reg_id']; ?>"
                                                class="btn">Delete</button>
                                        </form>

                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td></td>
                                <td>City A</td>
                                <td>A+, O-</td>
                                <td> <button class="btn">Delete</button></td>
                            </tr>
                            <tr>
                                <td>Hospital B</td>
                                <td>City B</td>
                                <td>B+, AB+</td>
                                <td> <button class="btn">Delete</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- <br>
                    <button class="btn">Add</button> -->
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