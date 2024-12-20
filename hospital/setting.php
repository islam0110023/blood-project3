<?php
session_start();
require_once('../database/database.php');

if (isset($_SESSION['hospital'])) {
    $db = db::getInstance('localhost', 'root', '', 'blood_donation', 'hospitals');
    $result = $db->select()
        ->where('reg_id', '=', $_SESSION['hospital']['id'])
        ->get();
        $db->setTable('reg');

        $resultReg=$db->select()->where("id","=",$_SESSION['hospital']['id'])->get();
    // echo '<pre>';
    // print_r($result);
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
    <title>Blood Bank and Donor Management System</title>
    <link rel="stylesheet" href="setting.css">
</head>

<body>

    <!-- Navbar -->
    <div class="navbar">
        <nav>
            <div class="logo">
                <h2>Setting</h2>
            </div>
            <img class="img-user" src="../img/hospital-ico.png" alt="user-pic" onclick="toggleMenu2()">
            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                    <div class="hospital-info">
                        <img class="img-user" src="../img/hospital-ico.png">
                        <h2><?= $resultReg['user_names']; ?></h2>
                    </div>
                    <hr>
                    <a href="Hospitals.php" class="sub-menu-link">
                        <img src="../img/icon-home.png">
                        <p>Home</p>
                        <span>></span>
                    </a>
                    <a href="dashboard_hospital.php" class="sub-menu-link">
                        <img src="../img/profile.png">
                        <p>Dashboard</p>
                        <span>></span>
                    </a>
                    <a href="edit_dash_hos.php" class="sub-menu-link">
                        <img src="../img/edit.png">
                        <p>Edit Dashboard</p>
                        <span>></span>
                    </a>
                    <a href="setting.php" class="sub-menu-link">
                        <img src="../img/setting.png">
                        <p>Setting & Privacy</p>
                        <span>></span>
                    </a>
                    <a href="logout.php" class="sub-menu-link">
                        <img src="../img/logout.png">
                        <p>Logout</p>
                        <span>></span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <div class="content" style="background-color: #b74b4b;">
        <div class="settings-container">
            <h2>Hospital Settings</h2>
            <form action="updateH.php" method="POST">
                <div class="form-section">
                    <!-- Section for Viewing Data -->
                    <!-- <div class="view-data">
                        <h3>Hospital Name: <span id="hospital-name-view">Hospital A</span></h3>
                        <h3>Email: <span id="email-view">hospital@example.com</span></h3>
                        <h3>Phone: <span id="phone-view">123-456-7890</span></h3>
                        <h3>Address: <span id="address-view">123 Street, City, Country</span></h3>
                    </div> -->
                    <div class="view-data">
                        <h3>Hospital Name: <span id="hospital-name-view"><?=$result['name'];?></span></h3>
                        <h3>Email: <span id="email-view"><?= $resultReg['emails']; ?></span></h3>
                        <h3>Phone: <span id="phone-view"><?=$result['phone_Num'];?></span></h3>
                        <h3>Address: <span id="address-view"><?=$result['location'];?></span></h3>
                    </div>

                    <!-- Section for Editing Data -->
                    <div class="edit-data">
                        <div class="form-group">
                            <label for="hospital-name">Hospital Name:</label>
                            <input type="text" id="hospital-name" name="hospital-name" placeholder="Enter hospital name"
                                value="<?=$result['name'];?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" placeholder="Enter email address"
                                value="<?= $resultReg['emails']; ?>" >
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="tel" id="phone" name="phone" placeholder="Enter phone number"
                                value="<?=$result['phone_Num'];?>">
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" id="address" name="address" placeholder="Enter address"
                                value="<?=$result['location'];?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Change Password:</label>
                            <input type="password" id="password" name="password" placeholder="Enter new password">
                        </div>
                    </div>
                </div>

                <button type="button" class="btn-edit" onclick="toggleEdit()">Edit</button>
                <button type="submit" class="btn-submit" name="submit">Save Changes</button>
            </form>
        </div>
    </div>
    <script>
        let subMenu = document.getElementById("subMenu")
        let isEditMode = false;

        function toggleEdit() {
            const viewSection = document.querySelector('.view-data');
            const editSection = document.querySelector('.edit-data');
            const editButton = document.querySelector('.btn-edit');

            if (isEditMode) {
                viewSection.style.display = 'block';
                editSection.style.display = 'none';
                editButton.textContent = 'Edit';
            } else {
                viewSection.style.display = 'none';
                editSection.style.display = 'block';
                editButton.textContent = 'Cancel';
            }

            isEditMode = !isEditMode;
        }
        function toggleMenu2() {
            subMenu.classList.toggle("open-menu");
        }
    </script>


</body>

</html>