<?php
session_start();
require_once('../database/database.php');

if (isset($_SESSION["admin"])) {
    $db = db::getInstance('localhost', 'root', '', 'blood_donation', 'reg');
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
    <link rel="stylesheet" href="register_hospital.css">

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
        <div class="auth-container">
            <!-- Registeration Form -->
            <div class="auth-form" id="RegisterForm">
                <h2>Register For Hospitals</h2>
                <form id="RegisterFormContent" onsubmit="return validateForm()" method="post" action="signupA.php">
                    <label for="HospitalName">Hospital Name</label>
                    <input type="text" id="HospitalName" name="HospitalName" placeholder="Enter hospital name" required>

                    <label for="HospitalUName">Hospital User Name</label>
                    <input type="text" id="HospitalUName" name="userName" placeholder="Enter hospital user name"
                        required>

                    <label for="HospitalEmail">Email</label>
                    <input type="email" id="HospitalEmail" name="HospitalEmail" placeholder="Enter hospital email"
                        required>

                    <label for="HospitalPassword">Password</label>
                    <input type="password" id="HospitalPassword" name="HospitalPassword"
                        placeholder="Enter hospital password" required>

                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword"
                        placeholder="Confirm hospital password" required>
                    <p id="errorMessage" class="error" style="color: red;"></p>
                    <label for="HospitalNumber">Phone Number</label>
                    <input type="tel" id="HospitalNumber" name="HospitalNumber"
                        placeholder="Enter hospital phone number" required>

                    <!-- <label for="Hospitallocation">Location</label>
                    <input type="text" id="Hospitallocation" name="Hospitallocation"
                        placeholder="Enter hospital location" required> -->
                    <label for="location">Location:</label>
                    <input list="locations" id="location" name="location" placeholder="Start typing your location..."
                        required>
                    <datalist id="locations">
                        <option value="Cairo">
                        <option value="Alexandria">
                        <option value="Giza">
                        <option value="Qalyubia">
                        <option value="Sharqia">
                        <option value="Dakahlia">
                        <option value="Beheira">
                        <option value="Kafr El-Sheikh">
                        <option value="Monufia">
                        <option value="Gharbia">
                        <option value="Damietta">
                        <option value="Port Said">
                        <option value="Ismailia">
                        <option value="Suez">
                        <option value="North Sinai">
                        <option value="South Sinai">
                        <option value="Red Sea">
                        <option value="Minya">
                        <option value="Beni Suef">
                        <option value="Fayoum">
                        <option value="Assiut">
                        <option value="Sohag">
                        <option value="Qena">
                        <option value="Luxor">
                        <option value="Aswan">
                        <option value="New Valley">
                        <option value="Matrouh">
                    </datalist>
                    <label for="Hospitallicense">License</label>
                    <input type="text" id="Hospitallicense" name="Hospitallicense" placeholder="Enter hospital license"
                        required>

                    <button type="submit" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function validateForm() {
            const HospitalPassword = document.getElementById("HospitalPassword").value;
            const confirmPassword = document.getElementById("confirmPassword").value;
            const errorMessage = document.getElementById("errorMessage");

            // Reset the error message
            errorMessage.textContent = "";

            if (HospitalPassword !== confirmPassword) {
                errorMessage.textContent = "Passwords do not match. Please try again.";
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const menuList = document.querySelector('.sidebar ul');
            sidebar.classList.toggle('active');
            menuList.classList.toggle('active');
        }
    </script>

</body>

</html>