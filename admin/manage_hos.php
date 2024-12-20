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
                <li><a href="#">Dashboard</a></li>
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
                            <tr>
                                <td>Hospital A</td>
                                <td>City A</td>
                                <td>A+, O-</td>
                                <td><button class="btn">Edit</button> <button class="btn">Delete</button></td>
                            </tr>
                            <tr>
                                <td>Hospital B</td>
                                <td>City B</td>
                                <td>B+, AB+</td>
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