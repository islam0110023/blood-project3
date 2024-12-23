<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation App</title>
    <link rel="stylesheet" href="profile.css">
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">Blood Donation</div>
        <div class="menu-icon" onclick="toggleMenu()">☰</div>
    </div>

    <!-- Sidebar -->
    <!-- Sidebar -->
    <div class="side-menu" id="sideMenu">
        <ul>
            <li><a href="settings.php" target="_blank">⚙️ Settings</a></li>
            <li><a href="../hospital/logout.php">🚪 Logout</a></li>
        </ul>
        <!-- زر غلق القائمة الجانبية أسفل -->
        <button class="close-btn" onclick="toggleMenu()">☰</button>
    </div>


    <!-- Hero Section -->
    <div class="hero-section">
        <div class="overlay">
            <h1>Welcome to Blood Donation</h1>
            <p>Save lives by donating blood today!</p>
        </div>
    </div>

    <script>
        // Toggle the sidebar
        function toggleMenu() {
            const sideMenu = document.getElementById("sideMenu");
            sideMenu.classList.toggle("open");
        }
    </script>
</body>

</html>