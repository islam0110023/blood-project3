<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank and Donor Management System</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <h2>Blood Donation</h2>
        </div>
        <div class="hamburger" onclick="toggleMenu()">☰</div>
        <ul id="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="#contact">Contact Us</a></li>
            <li><a href="../donor/donor.php" target="_blank">Donor List</a></li>
            <?php if (!isset($_SESSION['user'])): ?>
                <li><a href="login_signup.php">Login/ Sign Up</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="../profile/profile.php">Profile</a></li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-overlay">
            <h1>A Drop of Blood, A Sea of Hope.</h1>
            <p>Donate blood and save lives</p>
        </div>
    </div>

    <!-- New Section: Are You Eligible? -->
    <div class="eligibility-section">
        <h2>Are you eligible to donate blood?</h2>
        <p>Click the button below to learn the requirements for blood donation.</p>
        <a href="donation_rules.php" class="btn">Check Eligibility</a>
    </div>


    <footer>
        <!-- Contact Us Section -->
        <div id="contact" class="contact-section">
            <h2>Contact Us</h2>
            <p>Feel free to reach us through any of the following platforms</p>
            <div class="contact-icons">
                <a href="https://facebook.com" target="_blank" class="icon">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="https://wa.me/yourwhatsappnumber" target="_blank" class="icon">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="mailto:youremail@example.com" target="_blank" class="icon">
                    <i class="fas fa-envelope"></i>
                </a>
                <a href="https://twitter.com" target="_blank" class="icon">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://instagram.com" target="_blank" class="icon">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>


        <p>&copy; 2024 Blood Donation System. All rights reserved For The Organization.</p>
    </footer>

    <script>
        function toggleMenu() {
            var menu = document.getElementById('menu');
            menu.classList.toggle('active'); // Toggle the 'active' class to show/hide the menu
        }
    </script>

</body>

</html>