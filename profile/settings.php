<?php
session_start();
require_once('../database/database.php');


if(isset($_SESSION['user']))
{
    $db = db::getInstance('localhost', 'root', '', 'blood_donation', 'reg');
    

}
else{
    echo "<script>
    alert('Login');
    window.location.href = '../home/login_signup.php';
  </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="settings.css">
</head>

<body>
    <div class="settings-container">
        <div class="settings-form">
            <h2>Account Settings</h2>

            <form action="save_changes.php" method="POST"> <!-- هنا سيكون معالج الـ PHP -->
                <!-- First Name & Last Name Fields -->
                <div class="input-group">
                    <div class="input-field">
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" name="first-name" value="John" disabled>
                    </div>
                    <div class="input-field">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last-name" value="Doe" disabled>
                    </div>
                </div>

                <!-- Email Address -->
                <div class="input-field">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="john.doe@example.com" disabled>
                </div>

                <!-- Location Field -->
                <div class="input-field">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" value="New York" disabled>
                </div>

                <!-- Phone Number Field -->
                <div class="input-field">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="+1234567890" disabled>
                </div>

                <!-- Blood Type (Pre-filled and not editable) -->
                <div class="input-field">
                    <label for="blood-type">Blood Type</label>
                    <select id="blood-type" name="blood-type" disabled>
                        <option value="A+" selected>A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                </div>

                <!-- Change Password Fields -->
                <div class="input-field">
                    <label for="current-password">Current Password</label>
                    <input type="password" id="current-password" name="current-password" placeholder="Enter Current Password" required>
                </div>
                <div class="input-field">
                    <label for="new-password">New Password</label>
                    <input type="password" id="new-password" name="new-password" placeholder="Enter New Password" required>
                </div>
                <div class="input-field">
                    <label for="confirm-password">Confirm New Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm New Password" required>
                </div>

                <!-- Save Changes Button -->
                <button type="submit" class="submit-btn">Save Changes</button>

                <!-- Available for Donation Section -->
                <div id="donation-container">
                    <!-- Hidden field for donation status -->
                    <input type="hidden" id="donation-status" name="donation-status" value="0"> <!-- 0 means not available -->

                    <button type="button" id="donation-btn" class="donation-btn" onclick="toggleDonationStatus()">Available for Donation</button>
                    <button type="button" id="undo-btn" class="donation-btn undo" style="display:none;" onclick="toggleDonationStatus()">Undo</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle Available for Donation button visibility
        function toggleDonationStatus() {
            var donationBtn = document.getElementById("donation-btn");
            var undoBtn = document.getElementById("undo-btn");
            var donationStatusField = document.getElementById("donation-status");

            // Toggle between available and undo buttons and update the hidden field value
            if (donationBtn.style.display === "none") {
                donationBtn.style.display = "block";
                undoBtn.style.display = "none";
                donationStatusField.value = "0"; // Mark as not available for donation
            } else {
                donationBtn.style.display = "none";
                undoBtn.style.display = "block";
                donationStatusField.value = "1"; // Mark as available for donation
            }
        }
    </script>
</body>

</html>
