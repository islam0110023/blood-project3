<?php
session_start();
require_once('../database/database.php');


if (isset($_SESSION['user'])) {
    $db = db::getInstance('localhost', 'root', '', 'blood_donation', 'reg');
    $db->setTable('reg');

    $resultReg = $db->select()->where("id", "=", $_SESSION['user']['id'])->get();
    $db->setTable('users');

    $resultuser = $db->select()->where("reg_id", "=", $_SESSION['user']['id'])->get();
    $_SESSION['is_doner']=$resultuser['is_doner'];


} else {
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

            <form action="updateP.php" method="POST"> <!-- هنا سيكون معالج الـ PHP -->
                <!-- First Name & Last Name Fields -->
                <div class="input-group">
                    <div class="input-field">
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" name="first-name" value="<?= $resultuser['first_name']; ?>">
                    </div>
                    <div class="input-field">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last-name" value="<?= $resultuser['last_name']; ?>">
                    </div>
                </div>

                <!-- Email Address -->
                <div class="input-field">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="<?= $resultReg['emails']; ?>">
                </div>

                <!-- Location Field -->
                <div class="input-field">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" value="<?= $resultuser['location']; ?>">
                </div>

                <!-- Phone Number Field -->
                <div class="input-field">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="<?= $resultuser['phone_Num']; ?>">
                </div>

                <!-- Blood Type (Pre-filled and not editable) -->
                <div class="input-field">
                    <label for="blood-type">Blood Type</label>

                    <select id="blood-type" name="blood-type">
                        <option value="1" <?php echo $resultuser['blood_type_id'] == '1' ? 'selected' : ''; ?>>A+</option>
                        <option value="2" <?php echo $resultuser['blood_type_id'] == '2' ? 'selected' : ''; ?>>A-</option>
                        <option value="3" <?php echo $resultuser['blood_type_id'] == '3' ? 'selected' : ''; ?>>B+</option>
                        <option value="4" <?php echo $resultuser['blood_type_id'] == '4' ? 'selected' : ''; ?>>B-</option>
                        <option value="5" <?php echo $resultuser['blood_type_id'] == '5' ? 'selected' : ''; ?>>O+</option>
                        <option value="6" <?php echo $resultuser['blood_type_id'] == '6' ? 'selected' : ''; ?>>O-</option>
                        <option value="7" <?php echo $resultuser['blood_type_id'] == '7' ? 'selected' : ''; ?>>AB+
                        </option>
                        <option value="8" <?php echo $resultuser['blood_type_id'] == '8' ? 'selected' : ''; ?>>AB-
                        </option>
                    </select>
                </div>

                <!-- Change Password Fields -->
                <div class="input-field">
                    <label for="current-password">Current Password</label>
                    <input type="password" id="current-password" name="cpassword" placeholder="Enter Current Password"
                        required>
                </div>
                <div class="input-field">
                    <label for="new-password">New Password</label>
                    <input type="password" id="new-password" name="password" placeholder="Enter New Password">
                </div>
                <!-- <div class="input-field">
                    <label for="confirm-password">Confirm New Password</label>
                    <input type="password" id="confirm-password" name="cnpassword"
                        placeholder="Confirm New Password" required>
                </div> -->

                <!-- Save Changes Button -->
                <button type="submit" class="submit-btn" name="update">Save Changes</button>

                <!-- Available for Donation Section -->

            </form>
            <form action="updateV.php" method="POST">
                <div id="donation-container">
                    <!-- Hidden field for donation status -->
                    <!-- <input type="hidden" id="donation-status" name="donation-status" value="0"> -->
                    <!-- 0 means not available -->
                    
                    <?php if ($_SESSION['is_doner']===0): ?>
                        <button type="submit" id="donation-btn" class="donation-btn" name="available">Available for
                            Donation</button>
                    <?php endif; ?>
                    <?php if ($_SESSION['is_doner']===1): ?>
                        <button type="submit" id="undo-btn" class="donation-btn undo" name="available">Undo</button>
                    <?php endif; ?>
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