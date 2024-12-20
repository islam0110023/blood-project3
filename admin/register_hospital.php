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
                <li><a href="#">Dashboard</a></li>
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
                <form id="RegisterFormContent" onsubmit="return validateForm()">
                    <label for="HospitalName">Hospital Name</label>
                    <input type="text" id="HospitalName" name="HospitalName" placeholder="Enter hospital name" required>

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

                    <label for="Hospitallocation">Location</label>
                    <input type="text" id="Hospitallocation" name="Hospitallocation"
                        placeholder="Enter hospital location" required>

                    <button type="submit">Submit</button>
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