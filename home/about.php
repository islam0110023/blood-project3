<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Blood Donation</title>
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
            <li><a href="about.php" class="active">About Us</a></li>
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

    <!-- Hero Section for About Us -->
    <div class="hero-section-about">
        <div class="hero-overlay-about">
            <h1>About Us</h1>
            <p>We are dedicated to saving lives by connecting blood donors with those in need.</p>
        </div>
    </div>

    <!-- About Us Content -->
    <div class="about-us-section">
        <h1>Who We Are</h1>
        <p>We are a non-profit organization working to provide blood to those in need. We collaborate with hospitals,
            clinics, and other healthcare providers to ensure that blood is always available for patients in need of
            transfusions.</p>
        <p>Join us and help make a difference by donating blood today!</p>
    </div>

    <footer>
        <!-- Contact Us Section -->
        <div id="contact" class="contact-section">
            <h2>Contact Us</h2>
            <p>Feel free to reach us through any of the following platforms:</p>
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