<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Rules</title>
    <link rel="stylesheet" href="index.css">
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
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="../donor/donor.php" target="_blank">Donor List</a></li>

            <?php if (!isset($_SESSION['user'])): ?>
                <li><a href="login_signup.php">Login/ Sign Up</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="../profile/profile.php">Profile</a></li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Rules Section -->
    <div class="rules-section">
        <h1>Blood Donation Rules</h1>
        <ul>
            <li>You must be at least 18 years old to donate blood.</li>
            <li>You must weigh at least 50 kg (110 lbs).</li>
            <li>You must be in good general health and feeling well.</li>
            <li>You should not have donated blood within the last 3 months.</li>
            <li>If you have had any recent illnesses, surgeries, or infections, consult your doctor first.</li>
            <li>Pregnant women or nursing mothers are not eligible to donate blood.</li>
            <li>You should not have consumed alcohol within 24 hours of donation.</li>
            <li>Ensure proper hydration and have a healthy meal before donating blood.</li>
        </ul>
        <p>If you meet all the above requirements, we welcome you to donate and save lives!</p>
    </div>

    <footer>
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